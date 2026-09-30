<?php

require_once '../config/dbConfig.php';
require_once '../app/model/serving.php';
require_once '../app/model/waiting.php';
require_once '../app/model/queue-overview.php';
require_once '../app/model/today-summary.php';

//serving
$serving = new Serving($conn);
$currentServing = $serving->getAllServings();


//waiting
$waiting = new Waiting($conn);
$currentWaiting = $waiting->getAllWaiting();


//queue overview
$queueOverview = new QueueOverview($conn);
$queueList = $queueOverview->getWaitingQueue();

//ticket number and current waiting
$ticketNo = $currentServing['ticket_no'] ?? 'No Ticket';
$waitingCount = $currentWaiting['waiting_count'] ?? 0;


//today's summary to display
$todaySummary = new TodaySummary($conn);
$totalIssued = $todaySummary->getTotalIssued();
$totalServed = $todaySummary->getTotalServed();
$stillWaiting = $todaySummary->getStillWaiting();
?>

<?php include '../layout/head.php'; ?>


<div>
    <div>
        <!--logo of user here-->
        <h1>QUEUE DASHBOARD</h1>
    </div>

    <div>
        <div>
            <p>NOW SERVING</p>
            <h1><?php echo htmlspecialchars($ticketNo ?? 'No Ticket'); ?></h1>
        </div>

        <div>
            <p>TOTAL WAITING</p>
            <h1><?php echo htmlspecialchars($waitingCount ?? '0'); ?></h1>
        </div>
    </div>

    <div>
        <form action="../app/controller/nextController.php" method="post">
            <button type="submit">NEXT</button>
        </form>
    </div>

    <!--Queue Overview Table-->
    <div class="mt-6 w-full overflow-x-auto rounded-lg border border-gray-200 bg-white">

        <h2 class="px-4 py-4 text-lg font-semibold">
            Queue Overview
        </h2>

        <table class="w-full text-left text-sm">

            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Ticket No.</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Queued At</th>
                </tr>
            </thead>

            <tbody>

                <?php if (empty($queueList)): ?>

                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                            No customers waiting.
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($queueList as $queue): ?>

                        <tr class="border-t border-gray-200">

                            <td class="px-4 py-3">
                                <?= htmlspecialchars($queue['id']) ?>
                            </td>

                            <td class="px-4 py-3 font-semibold">
                                <?= htmlspecialchars($queue['ticket_no']) ?>
                            </td>

                            <td class="px-4 py-3">
                                <?= htmlspecialchars($queue['status']) ?>
                            </td>

                            <td class="px-4 py-3">
                                <?= date('h:i A', strtotime($queue['timestamp'])) ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

            </tbody>

        </table>

    </div>


    <!--Today Summary Table-->
    <div class="mt-6 w-full rounded-lg border border-gray-200 bg-white">

        <h2 class="px-4 py-4 text-lg font-semibold">
            Today's Summary
        </h2>

        <table class="w-full text-left text-sm">

            <tbody>

                <tr class="border-t border-gray-200">
                    <td class="px-4 py-3">
                        Total Issued
                    </td>

                    <td class="px-4 py-3 text-right font-semibold">
                        <?= $totalIssued ?>
                    </td>
                </tr>

                <tr class="border-t border-gray-200">
                    <td class="px-4 py-3">
                        Total Served
                    </td>

                    <td class="px-4 py-3 text-right font-semibold">
                        <?= $totalServed ?>
                    </td>
                </tr>

                <tr class="border-t border-gray-200">
                    <td class="px-4 py-3">
                        Still Waiting
                    </td>

                    <td class="px-4 py-3 text-right font-semibold">
                        <?= $stillWaiting ?>
                    </td>
                </tr>

                <tr class="border-t border-gray-200">
                    <td class="px-4 py-3">
                        Average Wait Time
                    </td>

                    <td class="px-4 py-3 text-right font-semibold">
                        0 min
                    </td>
                </tr>

            </tbody>

        </table>

    </div>
</div>