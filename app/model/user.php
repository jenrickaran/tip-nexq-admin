<?php
require_once '../../config/dbConfig.php';
class User
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function login($username, $password)
    {
        $sql = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
        $sql->bindParam(':username', $username);
        $sql->execute();
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return [
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => $user['password'],
                'role' => $user['role']
            ];
        } else {
            return false;
        }
    }
}
