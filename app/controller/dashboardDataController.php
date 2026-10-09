<?php

require_once '../../config/dbConfig.php';
require_once '../model/serving.php';
require_once '../model/waiting.php';
require_once '../model/today-summary.php';
require_once '../model/average-wait-time.php';

$serving = new Serving($conn);
$currentServing = $serving->getAllServings();

$waiting = new Waiting($conn);
$currentWaiting = $waiting->getAllWaiting();

$todaySummary = new TodaySummary($conn);

$averageWaitTime = new AverageWaitTime($conn);
$averageSeconds = $averageWaitTime->getAverageWaitTime();

$averageMinutes = round($averageSeconds / 60, 1);

header('Content-Type: application/json');

echo json_encode([
    'ticketNo' => $currentServing['ticket_no'] ?? '0',
    'waitingCount' => $currentWaiting['waiting_count'] ?? 0,
    'totalIssued' => $todaySummary->getTotalIssued(),
    'totalServed' => $todaySummary->getTotalServed(),
    'stillWaiting' => $todaySummary->getStillWaiting(),
    'averageMinutes' => $averageMinutes
]);

exit;
