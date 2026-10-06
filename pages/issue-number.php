<?php
require_once '../app/model/queue-overview.php';

$queueOverview = new QueueOverview($conn);
$queueList = $queueOverview->getWaitingQueue();

?>

<div class="px-3 lg:px-8">
    <div class="border border-gray-300 rounded-lg overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-300">
                    <td class="px-4 py-3 font-semibold">
                        Issue Number
                    </td>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($queueList)): ?>
                    <tr>
                        <td class="px-4 py-6 text-center text-gray-500">
                            Not yet issue a number.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($queueList as $queue): ?>
                        <tr class="border-b border-gray-300 last:border-b-0">
                            <td class="px-4 py-3 font-semibold">
                                <?= htmlspecialchars($queue['ticket_no']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>