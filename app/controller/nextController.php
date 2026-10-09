<?php

require_once '../../config/dbConfig.php';
require_once '../model/next-customer.php';

$serving = new NextCustomer($conn);

$servedTicket = $serving->getNextCustomer();

header('Content-Type: application/json');

if ($servedTicket) {
    echo json_encode([
        'success' => true,
        'ticketNo' => $servedTicket
    ]);
    exit;
}

echo json_encode([
    'success' => false,
    'message' => 'No waiting customers.'
]);

exit;
