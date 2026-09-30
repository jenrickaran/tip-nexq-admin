<?php
require_once '../../config/dbConfig.php';

class NextCustomer {
    private PDO $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function getNextCustomer() {
        $sql = "SELECT ticket_no FROM email WHERE status = 'WAITING' LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $nextCustomer = $stmt->fetch(PDO::FETCH_ASSOC);

       if ($nextCustomer) {
            $sqlUpdate = "UPDATE email SET status = 'SERVED' WHERE ticket_no = :ticket_no";
            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':ticket_no', $nextCustomer['ticket_no']);
            $stmtUpdate->execute();
            return $nextCustomer['ticket_no'];
        }

        return false;
    }
}
?>