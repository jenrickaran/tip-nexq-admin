<?php
require_once __DIR__ . '/../../config/dbConfig.php';

class Serving
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getAllServings()
    {
        $sql = "SELECT email, ticket_no FROM email WHERE status = 'Waiting' LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $currentServing = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$currentServing) {
            return null; // No current serving found
        }

        return [
            'ticket_no' => $currentServing['ticket_no']
        ];
    }
}
