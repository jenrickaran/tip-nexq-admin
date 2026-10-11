<?php
require_once __DIR__ . '/../../config/dbConfig.php';
class TotalUser
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function totalUsers()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM users");
        return (int) $stmt->fetchColumn();
    }

    public function totalAdmins()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM users WHERE role = 'superadmin'");
        return (int) $stmt->fetchColumn();
    }

    public function totalActive()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM users WHERE status = 'active'");
        return (int) $stmt->fetchColumn();
    }
}
