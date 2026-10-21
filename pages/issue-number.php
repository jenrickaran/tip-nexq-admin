<?php
require_once '../app/model/queue-overview.php';

$queueOverview = new QueueOverview($conn);
$queueList = $queueOverview->getWaitingQueue();
?>

<div class="px-3 lg:px-8">

    <!-- Section header -->
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <div>
            <h2 class="text-lg font-semibold text-white sm:text-xl">Issue Number</h2>
        </div>
        <!--<span class="inline-flex items-center gap-1.5 rounded-full bg-[#FED201]/10 px-3 py-1 text-xs font-medium text-[#FED201] ring-1 ring-inset ring-[#FED201]/20">
            <span class="h-1.5 w-1.5 rounded-full bg-[#FED201]"></span>
            <?= count($queueList) ?> in queue
        </span>-->
    </div>

    <!-- ============ DESKTOP TABLE (md and up) ============ -->
    <div class="hidden overflow-hidden rounded-xl border border-zinc-800 bg-zinc-900/60 shadow-sm md:block">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-zinc-900">
                    <tr class="text-xs font-semibold uppercase tracking-wider text-zinc-400">
                        <th class="whitespace-nowrap px-5 py-3.5">Issue Number</th>
                        <th class="whitespace-nowrap px-5 py-3.5">Email</th>
                        <th class="whitespace-nowrap px-5 py-3.5">Timestamp</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-zinc-800/70">
                    <?php if (empty($queueList)): ?>
                        <tr>
                            <td colspan="3" class="px-5 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-zinc-800 text-zinc-500 ring-1 ring-zinc-700">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h7.5M8.25 12h7.5m-7.5 5.25h4.5M3.75 6.75A2.25 2.25 0 0 1 6 4.5h12a2.25 2.25 0 0 1 2.25 2.25v10.5A2.25 2.25 0 0 1 18 19.5H6a2.25 2.25 0 0 1-2.25-2.25V6.75Z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-zinc-300">No queue yet</p>
                                        <p class="mt-0.5 text-xs text-zinc-500">No number has been issued yet.</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($queueList as $queue): ?>
                            <tr class="transition hover:bg-zinc-800/40">
                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <span class="inline-flex items-center gap-2 rounded-lg bg-[#FED201]/10 px-3 py-1 font-mono text-sm font-semibold text-[#FED201] ring-1 ring-inset ring-[#FED201]/20">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                                        </svg>
                                        <?= htmlspecialchars($queue['ticket_no'] ?? '') ?>
                                    </span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-zinc-800 text-xs font-semibold text-zinc-300 ring-1 ring-zinc-700">
                                            <?= htmlspecialchars(strtoupper(mb_substr($queue['email'] ?? '?', 0, 1))) ?>
                                        </div>
                                        <span class="truncate text-zinc-200"><?= htmlspecialchars($queue['email'] ?? '') ?></span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-5 py-3.5 text-zinc-400">
                                    <?php
                                    if (!empty($queue['timestamp'])) {
                                        echo htmlspecialchars(date('M d, Y h:i A', strtotime($queue['timestamp'])));
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ============ MOBILE CARDS (below md) ============ -->
    <div class="space-y-3 md:hidden">
        <?php if (empty($queueList)): ?>
            <div class="rounded-xl border border-zinc-800 bg-zinc-900/60 px-5 py-12 text-center">
                <div class="flex flex-col items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-zinc-800 text-zinc-500 ring-1 ring-zinc-700">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h7.5M8.25 12h7.5m-7.5 5.25h4.5M3.75 6.75A2.25 2.25 0 0 1 6 4.5h12a2.25 2.25 0 0 1 2.25 2.25v10.5A2.25 2.25 0 0 1 18 19.5H6a2.25 2.25 0 0 1-2.25-2.25V6.75Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-zinc-300">No queue yet</p>
                        <p class="mt-0.5 text-xs text-zinc-500">No number has been issued yet.</p>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($queueList as $queue): ?>
                <div class="rounded-xl border border-zinc-800 bg-zinc-900/60 p-4">

                    <!-- Ticket + email header -->
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex min-w-0 items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-zinc-800 text-sm font-semibold text-zinc-300 ring-1 ring-zinc-700">
                                <?= htmlspecialchars(strtoupper(mb_substr($queue['email'] ?? '?', 0, 1))) ?>
                            </div>
                            <div class="min-w-0">
                                <p class="truncate text-sm font-medium text-white"><?= htmlspecialchars($queue['email'] ?? '') ?></p>
                                <p class="text-xs text-zinc-500">Customer</p>
                            </div>
                        </div>

                        <span class="inline-flex shrink-0 items-center gap-1.5 rounded-lg bg-[#FED201]/10 px-2.5 py-1 font-mono text-xs font-semibold text-[#FED201] ring-1 ring-inset ring-[#FED201]/20">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                            </svg>
                            <?= htmlspecialchars($queue['ticket_no'] ?? '') ?>
                        </span>
                    </div>

                    <!-- Timestamp -->
                    <dl class="mt-3 border-t border-zinc-800 pt-3 text-xs">
                        <div class="flex items-center justify-between gap-3">
                            <dt class="text-zinc-500">Issued at</dt>
                            <dd class="text-zinc-300">
                                <?php
                                if (!empty($queue['timestamp'])) {
                                    echo htmlspecialchars(date('M d, Y h:i A', strtotime($queue['timestamp'])));
                                } else {
                                    echo 'N/A';
                                }
                                ?>
                            </dd>
                        </div>
                    </dl>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>