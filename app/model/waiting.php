<?php
require_once __DIR__ . '/../../config/dbConfig.php';

class Waiting{
    private PDO $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function getAllWaiting() {
        $sql = "SELECT COUNT(*) AS waiting_count FROM email WHERE status = 'Waiting'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $currentWaiting = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$currentWaiting) {
            return null; // No current waiting found
        }

        return [
            'waiting_count' => $currentWaiting['waiting_count']
        ];
    }
}
?>