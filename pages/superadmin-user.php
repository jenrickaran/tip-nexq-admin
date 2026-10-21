<?php
require_once '../config/dbConfig.php';
require_once '../app/model/user-overview.php';

$userOverview = new UserOverview($conn);
$users = $userOverview->getAllUsers();
?>

<div id="userManagementView" class="p-6">
    <!-- Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-white sm:text-3xl">User Management</h1>
            <p class="mt-1 text-sm text-zinc-400">Manage accounts, roles, and access</p>
        </div>
        <button
            id="addAccountBtn"
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#FED201] px-4 py-2.5 text-sm font-semibold text-zinc-900 transition hover:bg-[#e8c000] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#FED201] focus-visible:ring-offset-2 focus-visible:ring-offset-zinc-900">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add Account
        </button>
    </div>

    <!-- Table -->
    <div class="mt-6 overflow-hidden rounded-xl border border-zinc-800 bg-zinc-900/60 shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-800 text-sm">
                <thead class="bg-zinc-900">
                    <tr class="text-left text-xs font-semibold uppercase tracking-wider text-zinc-400">
                        <th class="whitespace-nowrap px-5 py-3.5">First Name</th>
                        <th class="whitespace-nowrap px-5 py-3.5">Middle Name</th>
                        <th class="whitespace-nowrap px-5 py-3.5">Last Name</th>
                        <th class="whitespace-nowrap px-5 py-3.5">Username</th>
                        <th class="whitespace-nowrap px-5 py-3.5">Email</th>
                        <th class="whitespace-nowrap px-5 py-3.5">Role</th>
                        <th class="whitespace-nowrap px-5 py-3.5">Status</th>
                        <th class="whitespace-nowrap px-5 py-3.5 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800/70">
                    <?php if (count($users) > 0): ?>
                        <?php foreach ($users as $user): ?>
                            <?php
                            $initials = strtoupper(
                                mb_substr($user['first_name'] ?? '', 0, 1) .
                                    mb_substr($user['last_name'] ?? '', 0, 1)
                            ) ?: '?';
                            ?>
                            <tr class="transition hover:bg-zinc-800/40">
                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-zinc-800 text-xs font-semibold text-[#FED201] ring-1 ring-zinc-700">
                                            <?= htmlspecialchars($initials) ?>
                                        </div>
                                        <span class="font-medium text-zinc-100"><?= htmlspecialchars($user['first_name']) ?></span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-5 py-3.5 text-zinc-400"><?= htmlspecialchars($user['middle_name'] ?: '—') ?></td>
                                <td class="whitespace-nowrap px-5 py-3.5 font-medium text-zinc-100"><?= htmlspecialchars($user['last_name']) ?></td>
                                <td class="whitespace-nowrap px-5 py-3.5 font-mono text-xs text-zinc-300"><?= htmlspecialchars($user['username']) ?></td>
                                <td class="whitespace-nowrap px-5 py-3.5 text-zinc-400"><?= htmlspecialchars($user['email']) ?></td>
                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <?php
                                    $role = htmlspecialchars($user['role']);
                                    $roleLower = strtolower($user['role']);
                                    $roleColor = 'bg-zinc-700/50 text-zinc-300 ring-zinc-600/40';
                                    if ($roleLower === 'admin') $roleColor = 'bg-blue-500/10 text-blue-400 ring-blue-500/20';
                                    elseif ($roleLower === 'staff') $roleColor = 'bg-purple-500/10 text-purple-400 ring-purple-500/20';
                                    ?>
                                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium ring-1 ring-inset <?= $roleColor ?>"><?= $role ?></span>
                                </td>
                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <?php
                                    $status = htmlspecialchars($user['status']);
                                    $statusLower = strtolower($user['status']);
                                    $statusColor = 'bg-zinc-700/50 text-zinc-300';
                                    $dotColor = 'bg-zinc-400';
                                    if ($statusLower === 'active') {
                                        $statusColor = 'bg-green-500/10 text-green-400';
                                        $dotColor = 'bg-green-400';
                                    } elseif ($statusLower === 'pending') {
                                        $statusColor = 'bg-yellow-500/10 text-yellow-400';
                                        $dotColor = 'bg-yellow-400';
                                    } elseif ($statusLower === 'inactive') {
                                        $statusColor = 'bg-red-500/10 text-red-400';
                                        $dotColor = 'bg-red-400';
                                    }
                                    ?>
                                    <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium <?= $statusColor ?>">
                                        <span class="h-1.5 w-1.5 rounded-full <?= $dotColor ?>"></span> <?= ucfirst($status) ?>
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-5 py-3.5 text-right">
                                    <div class="relative inline-block text-left">
                                        <button
                                            type="button"
                                            data-action-toggle
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                            class="rounded-md p-2 text-zinc-400 transition hover:bg-zinc-700/60 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-[#FED201]">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <circle cx="5" cy="12" r="2" />
                                                <circle cx="12" cy="12" r="2" />
                                                <circle cx="19" cy="12" r="2" />
                                            </svg>
                                            <span class="sr-only">Open actions</span>
                                        </button>

                                        <div
                                            data-action-menu
                                            class="absolute right-0 z-20 mt-1 hidden w-44 origin-top-right rounded-lg border border-zinc-700 bg-zinc-800 py-1 shadow-xl">
                                            <button
                                                type="button"
                                                data-action="reset"
                                                data-user-id="<?= (int) $user['id'] ?>"
                                                data-username="<?= htmlspecialchars($user['username']) ?>"
                                                class="flex w-full items-center px-4 py-2 text-left text-sm text-zinc-200 hover:bg-zinc-700/60">
                                                Reset Password
                                            </button>
                                            <div class="my-1 border-t border-zinc-700"></div>
                                            <button
                                                type="button"
                                                data-action="suspend"
                                                data-user-id="<?= (int) $user['id'] ?>"
                                                data-username="<?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?>"
                                                class="flex w-full items-center px-4 py-2 text-left text-sm text-red-400 hover:bg-red-500/10">
                                                Suspend
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="px-5 py-10 text-center text-zinc-500">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ============ RESET PASSWORD MODAL ============ -->
    <div id="resetPasswordModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4"
        role="dialog" aria-modal="true" aria-labelledby="resetModalTitle">

        <div class="w-full max-w-md rounded-2xl bg-white shadow-xl ring-1 ring-black/5">
            <!-- Header -->
            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                <h2 id="resetModalTitle" class="text-lg font-semibold text-gray-800">
                    Reset Password
                </h2>
                <button type="button" data-modal-close
                    class="rounded-md p-1 text-gray-400 transition hover:bg-gray-100 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <form id="resetPasswordForm" class="px-6 py-5">
                <input type="hidden" name="user_id" id="resetUserId" value="">

                <p class="mb-4 text-sm text-gray-600">
                    You are resetting the password for
                    <span id="resetUsername" class="font-semibold text-gray-800"></span>.
                </p>

                <!-- New Password -->
                <label for="newPassword" class="mb-1 block text-sm font-medium text-gray-700">
                    New Password
                </label>
                <div class="relative mb-4">
                    <input type="password" id="newPassword" name="new_password"
                        required minlength="6" autocomplete="new-password"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 pr-10 text-sm text-gray-800
                              focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        placeholder="Enter new password">
                    <button type="button" data-toggle-pw="newPassword"
                        class="absolute right-2 top-1/2 -translate-y-1/2 rounded p-1 text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.04 12.32a1 1 0 010-.64C3.42 7.51 7.36 4.5 12 4.5s8.58 3.01 9.96 7.18a1 1 0 010 .64C20.58 16.49 16.64 19.5 12 19.5s-8.58-3.01-9.96-7.18z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </button>
                </div>

                <!-- Confirm Password -->
                <label for="confirmPassword" class="mb-1 block text-sm font-medium text-gray-700">
                    Confirm Password
                </label>
                <div class="relative mb-5">
                    <input type="password" id="confirmPassword" name="confirm_password"
                        required minlength="6" autocomplete="new-password"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 pr-10 text-sm text-gray-800
                              focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        placeholder="Re-enter new password">
                    <button type="button" data-toggle-pw="confirmPassword"
                        class="absolute right-2 top-1/2 -translate-y-1/2 rounded p-1 text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.04 12.32a1 1 0 010-.64C3.42 7.51 7.36 4.5 12 4.5s8.58 3.01 9.96 7.18a1 1 0 010 .64C20.58 16.49 16.64 19.5 12 19.5s-8.58-3.01-9.96-7.18z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </button>
                </div>

                <!-- Inline feedback -->
                <div id="resetFeedback" class="mb-4 hidden rounded-lg px-3 py-2 text-sm"></div>

                <!-- Footer buttons -->
                <div class="flex justify-end gap-2 border-t border-gray-100 pt-4">
                    <button type="button" data-modal-close
                        class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700
                               transition hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" id="resetSubmitBtn"
                        class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white
                               transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500
                               disabled:cursor-not-allowed disabled:opacity-60">
                        Save New Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="hidden px-2 lg:px-0" id="addAccountForm">
    <form id="createUserForm" action="../app/controller/createUser.php" method="POST" novalidate
        class="mx-auto max-w-3xl">

        <!-- Page Header -->
        <div class="mb-6 text-center lg:text-left">
            <h1 class="text-2xl font-semibold text-white sm:text-3xl">Account Details</h1>
            <p class="mt-1 text-sm text-zinc-400">Fill in the information below to create a new account.</p>
        </div>

        <!-- Card -->
        <div class="rounded-xl border border-zinc-800 bg-zinc-900/60 p-6 shadow-sm sm:p-8">

            <!-- Section: Personal Information -->
            <div class="mb-8">
                <h2 class="mb-4 text-xs font-semibold uppercase tracking-wider text-zinc-400">Personal Information</h2>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <!-- First Name -->
                    <div>
                        <label for="first_name" class="mb-1.5 block text-sm font-medium text-zinc-300">First Name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="Enter first name" required
                            class="w-full rounded-lg border border-zinc-700 bg-zinc-800/60 px-3.5 py-2.5 text-sm text-white placeholder-zinc-500 transition focus:border-[#FED201] focus:outline-none focus:ring-2 focus:ring-[#FED201]/30">
                        <p class="error-msg mt-1 text-sm text-red-500" data-error-for="first_name"></p>
                    </div>

                    <!-- Middle Name -->
                    <div>
                        <label for="middle_name" class="mb-1.5 block text-sm font-medium text-zinc-300">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" placeholder="Enter middle name"
                            class="w-full rounded-lg border border-zinc-700 bg-zinc-800/60 px-3.5 py-2.5 text-sm text-white placeholder-zinc-500 transition focus:border-[#FED201] focus:outline-none focus:ring-2 focus:ring-[#FED201]/30">
                        <p class="error-msg mt-1 text-sm text-red-500" data-error-for="middle_name"></p>
                    </div>

                    <!-- Last Name -->
                    <div class="sm:col-span-2">
                        <label for="last_name" class="mb-1.5 block text-sm font-medium text-zinc-300">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Enter last name" required
                            class="w-full rounded-lg border border-zinc-700 bg-zinc-800/60 px-3.5 py-2.5 text-sm text-white placeholder-zinc-500 transition focus:border-[#FED201] focus:outline-none focus:ring-2 focus:ring-[#FED201]/30">
                        <p class="error-msg mt-1 text-sm text-red-500" data-error-for="last_name"></p>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="mb-8 border-t border-zinc-800"></div>

            <!-- Section: Account Credentials -->
            <div class="mb-8">
                <h2 class="mb-4 text-xs font-semibold uppercase tracking-wider text-zinc-400">Account Credentials</h2>
                <div class="grid grid-cols-1 gap-4">
                    <!-- Username -->
                    <div>
                        <label for="username" class="mb-1.5 block text-sm font-medium text-zinc-300">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter username" required
                            class="w-full rounded-lg border border-zinc-700 bg-zinc-800/60 px-3.5 py-2.5 text-sm text-white placeholder-zinc-500 transition focus:border-[#FED201] focus:outline-none focus:ring-2 focus:ring-[#FED201]/30">
                        <p class="error-msg mt-1 text-sm text-red-500" data-error-for="username"></p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-medium text-zinc-300">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter email address" required
                            class="w-full rounded-lg border border-zinc-700 bg-zinc-800/60 px-3.5 py-2.5 text-sm text-white placeholder-zinc-500 transition focus:border-[#FED201] focus:outline-none focus:ring-2 focus:ring-[#FED201]/30">
                        <p class="error-msg mt-1 text-sm text-red-500" data-error-for="email"></p>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-medium text-zinc-300">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter password" required
                            class="w-full rounded-lg border border-zinc-700 bg-zinc-800/60 px-3.5 py-2.5 text-sm text-white placeholder-zinc-500 transition focus:border-[#FED201] focus:outline-none focus:ring-2 focus:ring-[#FED201]/30">
                        <p class="error-msg mt-1 text-sm text-red-500" data-error-for="password"></p>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="mb-8 border-t border-zinc-800"></div>

            <!-- Section: Role & Status -->
            <div class="mb-6">
                <h2 class="mb-4 text-xs font-semibold uppercase tracking-wider text-zinc-400">Role &amp; Status</h2>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <!-- Role -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Role</label>
                        <div class="relative" data-select="role">
                            <!-- Trigger -->
                            <button type="button" data-select-trigger
                                aria-haspopup="listbox" aria-expanded="false"
                                class="group flex w-full items-center justify-between gap-2 rounded-lg border border-zinc-700 bg-zinc-800/60 py-2.5 pl-3.5 pr-3 text-left text-sm text-white transition hover:border-zinc-600 hover:bg-zinc-800 focus:border-[#FED201] focus:outline-none focus:ring-2 focus:ring-[#FED201]/30">
                                <span data-select-value class="truncate">Admin</span>
                                <svg class="h-4 w-4 shrink-0 text-zinc-400 transition-transform duration-200 group-aria-expanded:rotate-180"
                                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>

                            <!-- Popover list -->
                            <div data-select-menu role="listbox"
                                class="absolute left-0 right-0 z-30 mt-1 hidden max-h-60 overflow-auto rounded-lg border border-zinc-700 bg-zinc-800 p-1 shadow-xl shadow-black/40 ring-1 ring-black/30">
                                <button type="button" data-select-option="admin" role="option"
                                    class="group/opt relative flex w-full cursor-pointer select-none items-center gap-2 rounded-md px-2 py-1.5 text-left text-sm text-zinc-200 outline-none transition hover:bg-zinc-700/60 focus:bg-zinc-700/60 data-[selected=true]:bg-zinc-700/70 data-[selected=true]:text-white data-[active=true]:bg-zinc-700/60">
                                    <span>Admin</span>
                                    <svg class="ml-auto hidden h-4 w-4 text-[#FED201] group-data-[selected=true]/opt:block"
                                        fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                </button>
                                <button type="button" data-select-option="superadmin" role="option"
                                    class="group/opt relative flex w-full cursor-pointer select-none items-center gap-2 rounded-md px-2 py-1.5 text-left text-sm text-zinc-200 outline-none transition hover:bg-zinc-700/60 focus:bg-zinc-700/60 data-[selected=true]:bg-zinc-700/70 data-[selected=true]:text-white data-[active=true]:bg-zinc-700/60">
                                    <span>Super Admin</span>
                                    <svg class="ml-auto hidden h-4 w-4 text-[#FED201] group-data-[selected=true]/opt:block"
                                        fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Native select kept for form submission / JS compatibility -->
                            <select name="role" id="role" class="sr-only" tabindex="-1">
                                <option value="admin">Admin</option>
                                <option value="superadmin">Super Admin</option>
                            </select>
                        </div>
                        <p class="error-msg mt-1 text-sm text-red-500" data-error-for="role"></p>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-zinc-300">Status</label>
                        <div class="relative" data-select="status">
                            <!-- Trigger -->
                            <button type="button" data-select-trigger
                                aria-haspopup="listbox" aria-expanded="false"
                                class="group flex w-full items-center justify-between gap-2 rounded-lg border border-zinc-700 bg-zinc-800/60 py-2.5 pl-3.5 pr-3 text-left text-sm text-white transition hover:border-zinc-600 hover:bg-zinc-800 focus:border-[#FED201] focus:outline-none focus:ring-2 focus:ring-[#FED201]/30">
                                <span data-select-value class="truncate">Active</span>
                                <svg class="h-4 w-4 shrink-0 text-zinc-400 transition-transform duration-200 group-aria-expanded:rotate-180"
                                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>

                            <!-- Popover list -->
                            <div data-select-menu role="listbox"
                                class="absolute left-0 right-0 z-30 mt-1 hidden max-h-60 overflow-auto rounded-lg border border-zinc-700 bg-zinc-800 p-1 shadow-xl shadow-black/40 ring-1 ring-black/30">
                                <button type="button" data-select-option="active" role="option"
                                    class="group/opt relative flex w-full cursor-pointer select-none items-center gap-2 rounded-md px-2 py-1.5 text-left text-sm text-zinc-200 outline-none transition hover:bg-zinc-700/60 focus:bg-zinc-700/60 data-[selected=true]:bg-zinc-700/70 data-[selected=true]:text-white data-[active=true]:bg-zinc-700/60">
                                    <span>Active</span>
                                    <svg class="ml-auto hidden h-4 w-4 text-[#FED201] group-data-[selected=true]/opt:block"
                                        fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                </button>
                                <button type="button" data-select-option="inactive" role="option"
                                    class="group/opt relative flex w-full cursor-pointer select-none items-center gap-2 rounded-md px-2 py-1.5 text-left text-sm text-zinc-200 outline-none transition hover:bg-zinc-700/60 focus:bg-zinc-700/60 data-[selected=true]:bg-zinc-700/70 data-[selected=true]:text-white data-[active=true]:bg-zinc-700/60">
                                    <span>Inactive</span>
                                    <svg class="ml-auto hidden h-4 w-4 text-[#FED201] group-data-[selected=true]/opt:block"
                                        fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                </button>
                                <button type="button" data-select-option="suspended" role="option"
                                    class="group/opt relative flex w-full cursor-pointer select-none items-center gap-2 rounded-md px-2 py-1.5 text-left text-sm text-zinc-200 outline-none transition hover:bg-zinc-700/60 focus:bg-zinc-700/60 data-[selected=true]:bg-zinc-700/70 data-[selected=true]:text-white data-[active=true]:bg-zinc-700/60">
                                    <span>Suspended</span>
                                    <svg class="ml-auto hidden h-4 w-4 text-[#FED201] group-data-[selected=true]/opt:block"
                                        fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Native select kept for form submission / JS compatibility -->
                            <select name="status" id="status" class="sr-only" tabindex="-1">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>
                        <p class="error-msg mt-1 text-sm text-red-500" data-error-for="status"></p>
                    </div>

                </div>
            </div>

            <!-- Form Message -->
            <p id="formMessage" class="mt-4 text-sm"></p>

            <!-- Actions -->
            <div class="mt-6 flex flex-col-reverse gap-3 border-t border-zinc-800 pt-6 sm:flex-row sm:justify-end">
                <button type="button" onclick="window.location.href='?page=user'"
                    class="inline-flex items-center justify-center rounded-lg border border-zinc-700 bg-zinc-800 px-5 py-2.5 text-sm font-medium text-zinc-200 transition hover:bg-zinc-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-zinc-500">
                    Cancel
                </button>
                <button type="submit" id="createAccountBtn"
                    class="inline-flex items-center justify-center rounded-lg bg-[#FED201] px-5 py-2.5 text-sm font-semibold text-zinc-900 transition hover:bg-[#e8c000] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#FED201] focus-visible:ring-offset-2 focus-visible:ring-offset-zinc-900">
                    Create Account
                </button>
            </div>
        </div>
    </form>

    <!-- Success Modal -->
    <div
        id="successModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 px-4 backdrop-blur-sm">

        <div class="relative w-full max-w-sm rounded-2xl border border-zinc-800 bg-zinc-900 p-6 text-center shadow-2xl">

            <!-- Close X -->
            <button
                type="button"
                onclick="closeSuccessModal()"
                class="absolute right-3 top-3 rounded-md p-1 text-zinc-500 transition hover:bg-zinc-800 hover:text-zinc-200">

                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>

            </button>

            <!-- Success Icon -->
            <div class="mb-4 flex justify-center">
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-green-500/10 ring-1 ring-green-500/30">

                    <svg class="h-7 w-7 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>

                </div>
            </div>

            <!-- Title -->
            <h2 class="text-xl font-bold text-white">
                Account Created
            </h2>

            <!-- Message -->
            <p id="successModalMessage" class="mt-2 text-sm text-zinc-400">
                The account has been created successfully.
            </p>

            <!-- OK -->
            <button
                type="button"
                onclick="closeSuccessModal()"
                class="mt-5 w-full rounded-lg bg-[#FED201] py-3 font-bold text-zinc-900 transition hover:bg-[#e8c000] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#FED201] focus-visible:ring-offset-2 focus-visible:ring-offset-zinc-900">

                OK

            </button>

        </div>
    </div>
</div>