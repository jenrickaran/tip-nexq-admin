<?php
require_once __DIR__ . '/../../config/dbConfig.php';

class AverageWaitTime
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getAverageWaitTime()
    {
        $sql = "SELECT AVG(TIMESTAMPDIFF(SECOND, timestamp, serve_time)) AS average_wait_seconds
            FROM email
            WHERE DATE(timestamp) = CURDATE()
            AND status = 'SERVED'
            AND serve_time IS NOT NULL";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['average_wait_seconds'] ?? 0;
    }
}
