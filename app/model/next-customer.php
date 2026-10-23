
<?php

require_once __DIR__ . '/../../config/dbConfig.php';

class NextCustomer
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getNextCustomer()
    {
        try {
            $this->conn->beginTransaction();

            // 1. Get the customer currently at the front of the queue.
            $sql = "SELECT id, ticket_no
                    FROM email
                    WHERE UPPER(status) = 'WAITING'
                    ORDER BY timestamp ASC, id ASC
                    LIMIT 1
                    FOR UPDATE";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $currentCustomer = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$currentCustomer) {
                $this->conn->commit();
                return false;
            }

            // 2. Mark that customer as served.
            $sqlUpdate = "UPDATE email
                          SET status = 'SERVED',
                              serve_time = NOW()
                          WHERE id = :id";

            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            $stmtUpdate->execute([
                ':id' => $currentCustomer['id']
            ]);

            // 3. Adjust appointment times for remaining waiting customers.
            $sqlAdjust = "UPDATE email
                          SET appointment_time =
                              DATE_SUB(appointment_time, INTERVAL 4 MINUTE)
                          WHERE UPPER(status) = 'WAITING'
                            AND DATE(timestamp) = CURDATE()";

            $stmtAdjust = $this->conn->prepare($sqlAdjust);
            $stmtAdjust->execute();

            // 4. Select the NEXT waiting customer to notify.
            $sqlNext = "SELECT id, email, ticket_no, status,
                               serve_time, reminder_sent
                        FROM email
                        WHERE serve_time IS NULL
                          AND reminder_sent = 0
                          AND UPPER(status) = 'WAITING'
                        ORDER BY id ASC
                        LIMIT 1";

            $stmtNext = $this->conn->prepare($sqlNext);
            $stmtNext->execute();

            $nextCustomer = $stmtNext->fetch(PDO::FETCH_ASSOC);

            $this->conn->commit();

            // Return the next waiting customer, not the served customer.
            return $nextCustomer ?: false;
        } catch (Throwable $e) {
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }

            throw $e;
        }
    }

    public function markNotificationSent($id)
    {
        $sql = "UPDATE email
                SET reminder_sent = 1
                WHERE id = :id
                  AND reminder_sent = 0";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}
