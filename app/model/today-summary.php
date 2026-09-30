<?php

class TodaySummary
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getTotalIssued()
    {
        $sql = "SELECT COUNT(*) AS total
                FROM email
                WHERE DATE(timestamp) = CURDATE()";

        $result = $this->conn->query($sql);

        if (!$result) {
            return 0;
        }

        $row = $result->fetch(PDO::FETCH_ASSOC);

        return (int) $row['total'];
    }

    public function getTotalServed()
    {
        $sql = "SELECT COUNT(*) AS total
                FROM email
                WHERE DATE(timestamp) = CURDATE()
                AND status = 'served'";

        $result = $this->conn->query($sql);

        if (!$result) {
            return 0;
        }

        $row = $result->fetch(PDO::FETCH_ASSOC);

        return (int) $row['total'];
    }

    public function getStillWaiting()
    {
        $sql = "SELECT COUNT(*) AS total
                FROM email
                WHERE DATE(timestamp) = CURDATE()
                AND status = 'waiting'";

        $result = $this->conn->query($sql);

        if (!$result) {
            return 0;
        }

        $row = $result->fetch(PDO::FETCH_ASSOC);

        return (int) $row['total'];
    }
}
