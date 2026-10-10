
<?php
session_start();
require_once '../model/user.php';

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

if (empty($username) || empty($password)) {
    header('Location: ../../index.php?error=empty');
    exit;
}

try {
    $userModel = new User($conn);
    $user = $userModel->login($username, $password);

    if ($user) {
        $_SESSION['username'] = [
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        if ($user['role'] === 'superadmin') {
            header('Location: ../../layout/superadmin-layout.php');
        } else {
            header('Location: ../../layout/layout.php');
        }

        exit;
    } else {
        header('Location: ../../index.php?error=invalid');
        exit;
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
    header('Location: ../../index.php?error=server');
    exit;
}
?>
