<?php
session_start();
require_once '../../config/dbConfig.php';

header('Content-Type: application/json');

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

// Collect
$first_name  = trim($_POST['first_name']  ?? '');
$middle_name = trim($_POST['middle_name'] ?? '');
$last_name   = trim($_POST['last_name']   ?? '');
$username    = trim($_POST['username']    ?? '');
$email       = trim($_POST['email']       ?? '');
$password    = $_POST['password']         ?? '';
$role        = $_POST['role']             ?? 'admin';
$status      = $_POST['status']           ?? 'inactive';

$errors = []; // field => message

// Validate each field and attach error to its name
if ($first_name === '')  $errors['first_name'] = 'First name is required.';
if ($last_name === '')   $errors['last_name']  = 'Last name is required.';
if ($username === '')    $errors['username']   = 'Username is required.';

if ($email === '') {
    $errors['email'] = 'Email is required.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Invalid email address.';
}

if ($password === '') {
    $errors['password'] = 'Password is required.';
} elseif (strlen($password) < 8) {
    $errors['password'] = 'Password must be at least 8 characters.';
}

if (!in_array($role, ['admin', 'superadmin'], true)) {
    $errors['role'] = 'Invalid role selected.';
}
if (!in_array($status, ['active', 'inactive', 'suspended'], true)) {
    $errors['status'] = 'Invalid status selected.';
}

// Return early if validation failed
if ($errors) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

try {
    // Duplicate check — map to the specific field
    $checkSql = $conn->prepare(
        "SELECT username, email FROM users
         WHERE username = :username OR email = :email
         LIMIT 1"
    );
    $checkSql->execute([':username' => $username, ':email' => $email]);
    $existing = $checkSql->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        if (strcasecmp($existing['username'], $username) === 0) {
            $errors['username'] = 'Username is already taken.';
        }
        if (strcasecmp($existing['email'], $email) === 0) {
            $errors['email'] = 'Email is already registered.';
        }
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users
                (first_name, middle_name, last_name, username, email, password, role, status)
            VALUES
                (:first_name, :middle_name, :last_name, :username, :email, :password, :role, :status)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':first_name'  => $first_name,
        ':middle_name' => $middle_name !== '' ? $middle_name : null,
        ':last_name'   => $last_name,
        ':username'    => $username,
        ':email'       => $email,
        ':password'    => $hashedPassword,
        ':role'        => $role,
        ':status'      => $status,
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Account created successfully.'
    ]);
    exit;
} catch (PDOException $e) {
    error_log('Create user error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while creating the account.'
    ]);
    exit;
}
