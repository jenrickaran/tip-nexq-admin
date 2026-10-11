```php
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

    // Invalid username or password
    if (!$user) {
        header('Location: ../../index.php?error=invalid');
        exit;
    }

    // Check account status before creating a session
    if ($user['status'] === 'inactive') {
        header('Location: ../../index.php?error=inactive');
        exit;
    }

    if ($user['status'] === 'suspended') {
        header('Location: ../../index.php?error=suspended');
        exit;
    }

    if ($user['status'] !== 'active') {
        header('Location: ../../index.php?error=invalid_status');
        exit;
    }

    // Regenerate session ID after successful authentication
    session_regenerate_id(true);

    $_SESSION['username'] = [
        'username' => $user['username'],
        'email'    => $user['email'],
        'role'     => $user['role']
    ];

    // Redirect according to role
    if ($user['role'] === 'superadmin') {
        header('Location: ../../layout/superadmin-layout.php');
    } else {
        header('Location: ../../layout/layout.php');
    }

    exit;
} catch (PDOException $e) {
    error_log($e->getMessage());
    header('Location: ../../index.php?error=server');
    exit;
}
?>
```