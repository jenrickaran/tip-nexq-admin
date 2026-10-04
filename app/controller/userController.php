<?php
session_start();
include '../model/user.php';

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

if (empty($username) || empty($password)) {
    echo "Username and password are required.";
    exit;
}

try {
    $userModel = new User($conn);
    if ($userModel->login($username, $password)) {
        echo "Login successful!";

        header('Location: ../../layout/layout.php');
        $_SESSION['username'] = [
            'username' => $username,
            'email' => $user['email'] ?? null,
            'password' => $user['password'] ?? null
        ];
    } else {
        echo "Invalid username or password.";
        header("Location: ../../index.php?error=invalid");
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
