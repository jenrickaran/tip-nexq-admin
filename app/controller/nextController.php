
<?php

require_once __DIR__ . '/../../config/dbConfig.php';
require_once __DIR__ . '/../model/next-customer.php';
require_once __DIR__ . '/../service/emailServices.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $serving = new NextCustomer($conn);

    // This now returns the NEXT waiting customer.
    $customer = $serving->getNextCustomer();

    if (!$customer) {
        echo json_encode([
            'success' => true,
            'ticketNo' => null,
            'notificationSent' => false,
            'message' => 'Queue advanced. No next waiting customer to notify.'
        ]);
        exit;
    }

    $ticketNumber = $customer['ticket_no'];
    $email = $customer['email'];
    $customerId = $customer['id'];

    // Email the next waiting customer.
    $emailSent = sendTurnNotification($ticketNumber, $email);

    if ($emailSent) {
        $serving->markNotificationSent($customerId);
    }

    echo json_encode([
        'success' => true,
        'ticketNo' => $ticketNumber,
        'notificationSent' => $emailSent,
        'message' => $emailSent
            ? "Next waiting ticket {$ticketNumber} notified."
            : "Next waiting ticket {$ticketNumber} found, but email failed."
    ]);
} catch (Throwable $e) {
    error_log('NEXT controller error: ' . $e->getMessage());

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'An internal error occurred.'
    ]);
}

exit;
