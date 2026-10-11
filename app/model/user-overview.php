<?php
require_once __DIR__ . '/../../config/dbConfig.php';

class UserOverview
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getAllUsers(): array
    {
        $stmt = $this->conn->query("
            SELECT id, first_name, middle_name, last_name, username, email, role, status
            FROM users
            ORDER BY id DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Update the password for a given user id.
     * Password is hashed with PASSWORD_DEFAULT (bcrypt).
     */
    public function updatePassword(int $userId, string $plainPassword): bool
    {
        $hash = password_hash($plainPassword, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("UPDATE users SET password = :password WHERE id = :id");
        return $stmt->execute([
            ':password' => $hash,
            ':id'       => $userId,
        ]);
    }
}
