<?php
header('Content-Type: application/json; charset=utf-8');

require_once '../../config/dbConfig.php';
require_once '../model/user-overview.php';

// Accept POST only
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$userId        = isset($_POST['user_id']) ? (int) $_POST['user_id'] : 0;
$newPassword   = $_POST['new_password'] ?? '';
$confirmPass   = $_POST['confirm_password'] ?? '';

// Validation
if ($userId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid user.']);
    exit;
}
if (strlen($newPassword) < 6) {
    echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters.']);
    exit;
}
if ($newPassword !== $confirmPass) {
    echo json_encode(['success' => false, 'message' => 'Passwords do not match.']);
    exit;
}

try {
    $userOverview = new UserOverview($conn);
    $ok = $userOverview->updatePassword($userId, $newPassword);

    if ($ok) {
        echo json_encode(['success' => true, 'message' => 'Password updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update password.']);
    }
} catch (Throwable $e) {
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
