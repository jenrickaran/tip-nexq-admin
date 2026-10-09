<?php

require_once '../config/dbConfig.php';
require_once '../app/model/queue-overview.php';

$queueOverview = new QueueOverview($conn);
$queueList = $queueOverview->getWaitingQueue();

$itemsPerPage = 3;

$currentPage = isset($_GET['queue_page'])
    ? max(1, (int) $_GET['queue_page'])
    : 1;

$totalItems = count($queueList);

$totalPages = max(
    1,
    (int) ceil($totalItems / $itemsPerPage)
);

$currentPage = min($currentPage, $totalPages);

$offset = ($currentPage - 1) * $itemsPerPage;

$paginatedQueue = array_slice(
    $queueList,
    $offset,
    $itemsPerPage
);
?>

<div class="lg:absolute flex w-full flex-col overflow-hidden rounded-lg border border-gray-200 h-full">

    <h2 class="px-4 py-4 text-lg font-semibold text-[#FED201]">
        Queue Overview
    </h2>

    <div class="flex-1">
        <table class="w-full text-left text-sm">

            <thead class="border-t border-gray-200">
                <tr>
                    <th class="px-4 py-3 font-normal">#</th>
                    <th class="px-4 py-3 font-normal">QUEUE NUMBER</th>
                    <th class="px-4 py-3 font-normal">STATUS</th>
                    <th class="px-4 py-3 font-normal">TIME ADDED</th>
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

                    <?php foreach ($paginatedQueue as $queue): ?>

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
                                <?= date(
                                    'h:i A',
                                    strtotime($queue['timestamp'])
                                ) ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

            </tbody>

        </table>
    </div>

    <?php if ($totalPages > 1): ?>

        <div
            class="flex items-center justify-between border-t border-gray-200 px-2 py-4 lg:px-4 lg:py-3">

            <!-- Previous -->
            <div>

                <?php if ($currentPage > 1): ?>

                    <button
                        type="button"
                        data-page="<?= $currentPage - 1 ?>"
                        class="queue-page-btn rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-600 transition hover:bg-gray-100">
                        Previous
                    </button>

                <?php else: ?>

                    <span
                        class="cursor-not-allowed rounded-md border border-gray-200 px-3 py-2 text-sm text-gray-300">
                        Previous
                    </span>

                <?php endif; ?>

            </div>


            <!-- Mobile -->
            <div class="flex items-center gap-1 md:hidden">

                <?php

                $mobileStart = max(
                    1,
                    min(
                        $currentPage - 1,
                        $totalPages - 2
                    )
                );

                $mobileEnd = min(
                    $totalPages,
                    $mobileStart + 2
                );

                ?>

                <?php for (
                    $page = $mobileStart;
                    $page <= $mobileEnd;
                    $page++
                ): ?>

                    <button
                        type="button"
                        data-page="<?= $page ?>"
                        class="queue-page-btn rounded-md px-3 py-2 text-sm transition
                        <?= $page == $currentPage
                            ? 'bg-[#FED201] font-semibold text-black'
                            : 'text-gray-600 hover:bg-gray-100'
                        ?>">
                        <?= $page ?>
                    </button>

                <?php endfor; ?>

                <?php if ($mobileEnd < $totalPages): ?>

                    <span class="px-1 text-gray-500">
                        ...
                    </span>

                <?php endif; ?>

            </div>


            <!-- Desktop -->
            <div class="hidden items-center gap-1 md:flex">

                <?php

                $desktopStart = max(
                    1,
                    min(
                        $currentPage - 2,
                        $totalPages - 4
                    )
                );

                $desktopEnd = min(
                    $totalPages,
                    $desktopStart + 4
                );

                ?>

                <?php for (
                    $page = $desktopStart;
                    $page <= $desktopEnd;
                    $page++
                ): ?>

                    <button
                        type="button"
                        data-page="<?= $page ?>"
                        class="queue-page-btn rounded-md px-3 py-2 text-sm transition
                        <?= $page == $currentPage
                            ? 'bg-[#FED201] font-semibold text-black'
                            : 'text-gray-600 hover:bg-gray-100'
                        ?>">
                        <?= $page ?>
                    </button>

                <?php endfor; ?>

                <?php if ($desktopEnd < $totalPages): ?>

                    <span class="px-1 text-gray-500">
                        ...
                    </span>

                <?php endif; ?>

            </div>


            <!-- Next -->
            <div>

                <?php if ($currentPage < $totalPages): ?>

                    <button
                        type="button"
                        data-page="<?= $currentPage + 1 ?>"
                        class="queue-page-btn rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-600 transition hover:bg-gray-100">
                        Next
                    </button>

                <?php else: ?>

                    <span
                        class="cursor-not-allowed rounded-md border border-gray-200 px-3 py-2 text-sm text-gray-300">
                        Next
                    </span>

                <?php endif; ?>

            </div>

        </div>

    <?php endif; ?>

</div>