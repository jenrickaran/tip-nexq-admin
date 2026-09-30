<?php
require_once '../config/dbConfig.php';
date_default_timezone_set('Asia/Manila');

class QueueOverview
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getWaitingQueue()
    {
        $sql = "SELECT id, ticket_no, status, timestamp
            FROM email
            ORDER BY id ASC";

        $result = $this->conn->query($sql);

        if (!$result) {
            return [];
        }

        $queue = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $queue[] = $row;
        }

        return $queue;
    }
}
