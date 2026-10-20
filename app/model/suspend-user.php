<?php
session_start();

require_once '../../config/dbConfig.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed.'
    ]);
    exit;
}

$userId = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);

if (!$userId || $userId <= 0) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid user ID.'
    ]);
    exit;
}

try {
    // Replace $conn with the PDO connection variable in your dbConfig.php.
    $stmt = $conn->prepare(
        "UPDATE users SET status = :status WHERE id = :id"
    );

    $stmt->execute([
        ':status' => 'suspended',
        ':id' => $userId
    ]);

    if ($stmt->rowCount() === 0) {
        // Check whether the user exists or already has this status.
        $check = $conn->prepare(
            "SELECT id, status FROM users WHERE id = :id"
        );
        $check->execute([':id' => $userId]);
        $user = $check->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            http_response_code(404);
            echo json_encode([
                'success' => false,
                'message' => 'User not found.'
            ]);
            exit;
        }
    }

    echo json_encode([
        'success' => true,
        'message' => 'User suspended successfully.'
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Failed to suspend user.'
    ]);
}
