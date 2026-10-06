<?php

require_once '../config/dbConfig.php';
require_once '../app/model/serving.php';
require_once '../app/model/waiting.php';
require_once '../app/model/queue-overview.php';
require_once '../app/model/today-summary.php';
require_once '../app/model/average-wait-time.php';

//serving
$serving = new Serving($conn);
$currentServing = $serving->getAllServings();


//waiting
$waiting = new Waiting($conn);
$currentWaiting = $waiting->getAllWaiting();


//queue overview
$queueOverview = new QueueOverview($conn);
$queueList = $queueOverview->getWaitingQueue();

$averageWaitTime = new AverageWaitTime($conn);
$averageSeconds = $averageWaitTime->getAverageWaitTime();

//ticket number and current waiting
$ticketNo = $currentServing['ticket_no'] ?? '0';
$waitingCount = $currentWaiting['waiting_count'] ?? 0;
$averageMinutes = round($averageSeconds / 60, 1);



//today's summary to display
$todaySummary = new TodaySummary($conn);
$totalIssued = $todaySummary->getTotalIssued();
$totalServed = $todaySummary->getTotalServed();
$stillWaiting = $todaySummary->getStillWaiting();
?>

<?php include '../layout/head.php'; ?>


<div class="px-3 lg:px-8">
    <div class="flex items-center">
        <svg width="40px" height="40px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.875 7.375C14.875 8.68668 13.8117 9.75 12.5 9.75C11.1883 9.75 10.125 8.68668 10.125 7.375C10.125 6.06332 11.1883 5 12.5 5C13.8117 5 14.875 6.06332 14.875 7.375Z" stroke="#FED201" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.25 15.775C17.25 17.575 15.123 19.042 12.5 19.042C9.877 19.042 7.75 17.579 7.75 15.775C7.75 13.971 9.877 12.509 12.5 12.509C15.123 12.509 17.25 13.971 17.25 15.775Z" stroke="#FED201" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9 9.55301C19.9101 10.1315 19.5695 10.6588 19.0379 10.8872C18.5063 11.1157 17.8893 11 17.4765 10.5945C17.0638 10.189 16.9372 9.57418 17.1562 9.03861C17.3753 8.50305 17.8964 8.1531 18.475 8.15301C19.255 8.14635 19.8928 8.77301 19.9 9.55301V9.55301Z" stroke="#FED201" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.10001 9.55301C5.08986 10.1315 5.43054 10.6588 5.96214 10.8872C6.49375 11.1157 7.11072 11 7.52347 10.5945C7.93621 10.189 8.06278 9.57418 7.84376 9.03861C7.62475 8.50305 7.10363 8.1531 6.52501 8.15301C5.74501 8.14635 5.10716 8.77301 5.10001 9.55301Z" stroke="#FED201" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M19.2169 17.362C18.8043 17.325 18.4399 17.6295 18.403 18.0421C18.366 18.4547 18.6705 18.8191 19.0831 18.856L19.2169 17.362ZM22 15.775L22.7455 15.8567C22.7515 15.8023 22.7515 15.7474 22.7455 15.693L22 15.775ZM19.0831 12.695C18.6705 12.7319 18.366 13.0963 18.403 13.5089C18.4399 13.9215 18.8044 14.226 19.2169 14.189L19.0831 12.695ZM5.91689 18.856C6.32945 18.8191 6.63395 18.4547 6.59701 18.0421C6.56007 17.6295 6.19567 17.325 5.78311 17.362L5.91689 18.856ZM3 15.775L2.25449 15.693C2.24851 15.7474 2.2485 15.8023 2.25446 15.8567L3 15.775ZM5.78308 14.189C6.19564 14.226 6.56005 13.9215 6.59701 13.5089C6.63397 13.0963 6.32948 12.7319 5.91692 12.695L5.78308 14.189ZM19.0831 18.856C20.9169 19.0202 22.545 17.6869 22.7455 15.8567L21.2545 15.6933C21.1429 16.7115 20.2371 17.4533 19.2169 17.362L19.0831 18.856ZM22.7455 15.693C22.5444 13.8633 20.9165 12.5307 19.0831 12.695L19.2169 14.189C20.2369 14.0976 21.1426 14.839 21.2545 15.8569L22.7455 15.693ZM5.78311 17.362C4.76287 17.4533 3.85709 16.7115 3.74554 15.6933L2.25446 15.8567C2.45496 17.6869 4.08306 19.0202 5.91689 18.856L5.78311 17.362ZM3.74551 15.8569C3.85742 14.839 4.76309 14.0976 5.78308 14.189L5.91692 12.695C4.08354 12.5307 2.45564 13.8633 2.25449 15.693L3.74551 15.8569Z" fill="#FED201" />
        </svg>
        <h1 class="text-2xl text-[#FED201]">QUEUE DASHBOARD</h1>
    </div>

    <div class="flex gap-3 justify-center lg:flex-row flex-col">
        <div class="w-full lg:w-1/2 flex flex-col border-2 border-[#FED201] rounded-lg p-3 lg:p-10">
            <p class="text-3xl">NOW SERVING</p>
            <div class="flex items-end">
                <h1 class="text-7xl font-bold text-[#FED201]"><?php echo htmlspecialchars($ticketNo ?? '0'); ?></h1>
                <svg width="35px" height="35px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.875 7.375C14.875 8.68668 13.8117 9.75 12.5 9.75C11.1883 9.75 10.125 8.68668 10.125 7.375C10.125 6.06332 11.1883 5 12.5 5C13.8117 5 14.875 6.06332 14.875 7.375Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.25 15.775C17.25 17.575 15.123 19.042 12.5 19.042C9.877 19.042 7.75 17.579 7.75 15.775C7.75 13.971 9.877 12.509 12.5 12.509C15.123 12.509 17.25 13.971 17.25 15.775Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9 9.55301C19.9101 10.1315 19.5695 10.6588 19.0379 10.8872C18.5063 11.1157 17.8893 11 17.4765 10.5945C17.0638 10.189 16.9372 9.57418 17.1562 9.03861C17.3753 8.50305 17.8964 8.1531 18.475 8.15301C19.255 8.14635 19.8928 8.77301 19.9 9.55301V9.55301Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.10001 9.55301C5.08986 10.1315 5.43054 10.6588 5.96214 10.8872C6.49375 11.1157 7.11072 11 7.52347 10.5945C7.93621 10.189 8.06278 9.57418 7.84376 9.03861C7.62475 8.50305 7.10363 8.1531 6.52501 8.15301C5.74501 8.14635 5.10716 8.77301 5.10001 9.55301Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M19.2169 17.362C18.8043 17.325 18.4399 17.6295 18.403 18.0421C18.366 18.4547 18.6705 18.8191 19.0831 18.856L19.2169 17.362ZM22 15.775L22.7455 15.8567C22.7515 15.8023 22.7515 15.7474 22.7455 15.693L22 15.775ZM19.0831 12.695C18.6705 12.7319 18.366 13.0963 18.403 13.5089C18.4399 13.9215 18.8044 14.226 19.2169 14.189L19.0831 12.695ZM5.91689 18.856C6.32945 18.8191 6.63395 18.4547 6.59701 18.0421C6.56007 17.6295 6.19567 17.325 5.78311 17.362L5.91689 18.856ZM3 15.775L2.25449 15.693C2.24851 15.7474 2.2485 15.8023 2.25446 15.8567L3 15.775ZM5.78308 14.189C6.19564 14.226 6.56005 13.9215 6.59701 13.5089C6.63397 13.0963 6.32948 12.7319 5.91692 12.695L5.78308 14.189ZM19.0831 18.856C20.9169 19.0202 22.545 17.6869 22.7455 15.8567L21.2545 15.6933C21.1429 16.7115 20.2371 17.4533 19.2169 17.362L19.0831 18.856ZM22.7455 15.693C22.5444 13.8633 20.9165 12.5307 19.0831 12.695L19.2169 14.189C20.2369 14.0976 21.1426 14.839 21.2545 15.8569L22.7455 15.693ZM5.78311 17.362C4.76287 17.4533 3.85709 16.7115 3.74554 15.6933L2.25446 15.8567C2.45496 17.6869 4.08306 19.0202 5.91689 18.856L5.78311 17.362ZM3.74551 15.8569C3.85742 14.839 4.76309 14.0976 5.78308 14.189L5.91692 12.695C4.08354 12.5307 2.45564 13.8633 2.25449 15.693L3.74551 15.8569Z" fill="#808080" />
                </svg>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col border-2 border-[#FED201] rounded-lg p-3 lg:p-10">
            <p class="text-3xl">TOTAL WAITING</p>
            <div class="flex items-end">
                <h1 class="text-7xl font-bold text-[#FED201]"><?php echo htmlspecialchars($waitingCount ?? '0'); ?></h1>
                <svg width="35px" height="35px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.875 7.375C14.875 8.68668 13.8117 9.75 12.5 9.75C11.1883 9.75 10.125 8.68668 10.125 7.375C10.125 6.06332 11.1883 5 12.5 5C13.8117 5 14.875 6.06332 14.875 7.375Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.25 15.775C17.25 17.575 15.123 19.042 12.5 19.042C9.877 19.042 7.75 17.579 7.75 15.775C7.75 13.971 9.877 12.509 12.5 12.509C15.123 12.509 17.25 13.971 17.25 15.775Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9 9.55301C19.9101 10.1315 19.5695 10.6588 19.0379 10.8872C18.5063 11.1157 17.8893 11 17.4765 10.5945C17.0638 10.189 16.9372 9.57418 17.1562 9.03861C17.3753 8.50305 17.8964 8.1531 18.475 8.15301C19.255 8.14635 19.8928 8.77301 19.9 9.55301V9.55301Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.10001 9.55301C5.08986 10.1315 5.43054 10.6588 5.96214 10.8872C6.49375 11.1157 7.11072 11 7.52347 10.5945C7.93621 10.189 8.06278 9.57418 7.84376 9.03861C7.62475 8.50305 7.10363 8.1531 6.52501 8.15301C5.74501 8.14635 5.10716 8.77301 5.10001 9.55301Z" stroke="#808080" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M19.2169 17.362C18.8043 17.325 18.4399 17.6295 18.403 18.0421C18.366 18.4547 18.6705 18.8191 19.0831 18.856L19.2169 17.362ZM22 15.775L22.7455 15.8567C22.7515 15.8023 22.7515 15.7474 22.7455 15.693L22 15.775ZM19.0831 12.695C18.6705 12.7319 18.366 13.0963 18.403 13.5089C18.4399 13.9215 18.8044 14.226 19.2169 14.189L19.0831 12.695ZM5.91689 18.856C6.32945 18.8191 6.63395 18.4547 6.59701 18.0421C6.56007 17.6295 6.19567 17.325 5.78311 17.362L5.91689 18.856ZM3 15.775L2.25449 15.693C2.24851 15.7474 2.2485 15.8023 2.25446 15.8567L3 15.775ZM5.78308 14.189C6.19564 14.226 6.56005 13.9215 6.59701 13.5089C6.63397 13.0963 6.32948 12.7319 5.91692 12.695L5.78308 14.189ZM19.0831 18.856C20.9169 19.0202 22.545 17.6869 22.7455 15.8567L21.2545 15.6933C21.1429 16.7115 20.2371 17.4533 19.2169 17.362L19.0831 18.856ZM22.7455 15.693C22.5444 13.8633 20.9165 12.5307 19.0831 12.695L19.2169 14.189C20.2369 14.0976 21.1426 14.839 21.2545 15.8569L22.7455 15.693ZM5.78311 17.362C4.76287 17.4533 3.85709 16.7115 3.74554 15.6933L2.25446 15.8567C2.45496 17.6869 4.08306 19.0202 5.91689 18.856L5.78311 17.362ZM3.74551 15.8569C3.85742 14.839 4.76309 14.0976 5.78308 14.189L5.91692 12.695C4.08354 12.5307 2.45564 13.8633 2.25449 15.693L3.74551 15.8569Z" fill="#808080" />
                </svg>
            </div>
        </div>
    </div>

    <div class="lg:mt-10 mt-5">
        <form action="../app/controller/nextController.php" method="post" class="lg:flex lg:justify-end w-full">
            <button type="submit" class="bg-[#FED201] cursor-pointer py-2 px-6 rounded-lg flex-col flex w-full lg:w-auto">
                <div class="flex items-center gap-1 justify-center">
                    <svg fill="#000000" height="15px" width="15px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 512 512" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M500.203,236.907L30.869,2.24c-6.613-3.285-14.443-2.944-20.736,0.939C3.84,7.083,0,13.931,0,21.333v469.333
			                        c0,7.403,3.84,14.251,10.133,18.155c3.413,2.112,7.296,3.179,11.2,3.179c3.264,0,6.528-0.747,9.536-2.24l469.333-234.667
			                        C507.435,271.467,512,264.085,512,256S507.435,240.533,500.203,236.907z" />
                            </g>
                        </g>
                    </svg>
                    <h1 class="text-black font-bold">NEXT</h1>
                </div>
                <div>
                    <h1 class="text-black text-sm">CALL NEXT CUSTOMER</h1>
                </div>
            </button>
        </form>
    </div>

    <div class="flex gap-2 flex-col lg:flex-row lg:max-h-[344px]">
        <!--Queue Overview Table-->
        <?php $itemsPerPage = 3;
        $currentPage = isset($_GET['queue_page'])
            ? max(1, (int) $_GET['queue_page'])
            : 1;
        $totalItems = count($queueList);
        $totalPages = max(1, ceil($totalItems / $itemsPerPage));
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $itemsPerPage;
        $paginatedQueue = array_slice(
            $queueList,
            $offset,
            $itemsPerPage
        );
        ?>
        <div class="mt-6 flex w-full flex-col overflow-hidden rounded-lg border border-gray-200 lg:max-w-1/2">

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
                                        <?= date('h:i A', strtotime($queue['timestamp'])) ?>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    </tbody>

                </table>
            </div>

            <?php if ($totalPages > 1): ?>

                <div class="flex items-center justify-between border-t border-gray-200 px-2 py-4 lg:px-4 lg:py-3">

                    <!-- Previous -->
                    <div>
                        <?php if ($currentPage > 1): ?>

                            <a
                                href="?queue_page=<?= $currentPage - 1 ?>"
                                class="rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-600 transition hover:bg-gray-100">
                                Previous
                            </a>

                        <?php else: ?>

                            <span
                                class="cursor-not-allowed rounded-md border border-gray-200 px-3 py-2 text-sm text-gray-300">
                                Previous
                            </span>

                        <?php endif; ?>
                    </div>


                    <!-- ========================= -->
                    <!-- MOBILE PAGINATION -->
                    <!-- ========================= -->
                    <div class="flex items-center gap-1 md:hidden">

                        <?php
                        /*
         * Mobile:
         * Show maximum of 3 page numbers.
         */

                        $mobileStart = max(1, min(
                            $currentPage - 1,
                            $totalPages - 2
                        ));

                        $mobileEnd = min(
                            $totalPages,
                            $mobileStart + 2
                        );
                        ?>

                        <?php for ($page = $mobileStart; $page <= $mobileEnd; $page++): ?>

                            <a
                                href="?queue_page=<?= $page ?>"
                                class="rounded-md px-3 py-2 text-sm transition
                    <?= $page == $currentPage
                                ? 'bg-[#FED201] font-semibold text-black'
                                : 'text-gray-600 hover:bg-gray-100'
                    ?>">
                                <?= $page ?>
                            </a>

                        <?php endfor; ?>

                        <?php if ($mobileEnd < $totalPages): ?>

                            <span class="px-1 text-gray-500">
                                ...
                            </span>

                        <?php endif; ?>

                    </div>


                    <!-- ========================= -->
                    <!-- TABLET / DESKTOP -->
                    <!-- ========================= -->
                    <div class="hidden items-center gap-1 md:flex">

                        <?php
                        /*
         * Tablet/Desktop:
         * Show maximum of 5 page numbers.
         */

                        $desktopStart = max(1, min(
                            $currentPage - 2,
                            $totalPages - 4
                        ));

                        $desktopEnd = min(
                            $totalPages,
                            $desktopStart + 4
                        );
                        ?>

                        <?php for ($page = $desktopStart; $page <= $desktopEnd; $page++): ?>

                            <a
                                href="?queue_page=<?= $page ?>"
                                class="rounded-md px-3 py-2 text-sm transition
                    <?= $page == $currentPage
                                ? 'bg-[#FED201] font-semibold text-black'
                                : 'text-gray-600 hover:bg-gray-100'
                    ?>">
                                <?= $page ?>
                            </a>

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

                            <a
                                href="?queue_page=<?= $currentPage + 1 ?>"
                                class="rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-600 transition hover:bg-gray-100">
                                Next
                            </a>

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

        <div class="w-full lg:max-w-1/2 w-full lg:mt-6">
            <!-- Today's Summary -->
            <div class="border rounded-lg overflow-hidden">
                <h2 class="px-4 py-4 text-lg font-semibold text-[#FED201]">
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
                                <?= htmlspecialchars($averageMinutes) ?> min
                            </td>
                        </tr>

                    </tbody>

                </table>
            </div>

            <!-- Button OUTSIDE the table border -->
            <div class="mt-3 w-full">
                <form action="../app/controller/resetQueueController.php" method="POST">
                    <button
                        type="submit"
                        class="px-10 py-2 bg-transparent text-white rounded-lg border-2 border-[#FED201] w-full cursor-pointer">

                        <span class="flex gap-2 items-center justify-center">
                            <div>
                                <svg width="35px" height="35px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 2.99988C16.9706 2.99988 21 7.02931 21 11.9999C21 16.9704 16.9706 20.9999 12 20.9999C7.02944 20.9999 3 16.9704 3 11.9999C3 9.17261 4.30367 6.64983 6.34267 4.99988"
                                        stroke="#FED201"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2" />

                                    <path
                                        d="M3 4.49988H7V8.49988"
                                        stroke="#FED201"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2" />
                                </svg>
                            </div>

                            <div class="flex flex-col items-start">
                                <h1>RESET QUEUE</h1>
                                <h2>Start the queue over</h2>
                            </div>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>