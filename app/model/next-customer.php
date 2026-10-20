
<?php
require_once '../../config/dbConfig.php';

class NextCustomer
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getNextCustomer()
    {
        $sql = "SELECT ticket_no FROM email WHERE status = 'WAITING' ORDER BY timestamp ASC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $nextCustomer = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($nextCustomer) {
            // Mark the next customer as served
            $sqlUpdate = "UPDATE email
                          SET status = 'SERVED', serve_time = NOW()
                          WHERE ticket_no = :ticket_no";

            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':ticket_no', $nextCustomer['ticket_no']);
            $stmtUpdate->execute();

            // Reduce appointment time by 4 minutes for remaining customers
            $sqlAdjust = "UPDATE email
                          SET appointment_time = DATE_SUB(appointment_time, INTERVAL 4 MINUTE)
                          WHERE status = 'WAITING'
                          AND DATE(timestamp) = CURDATE()";

            $stmtAdjust = $this->conn->prepare($sqlAdjust);
            $stmtAdjust->execute();

            return $nextCustomer['ticket_no'];
        }

        return false;
    }
}
