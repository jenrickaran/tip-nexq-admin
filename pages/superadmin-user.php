<?php
require_once '../config/dbConfig.php';
require_once '../app/model/user-overview.php';

$userOverview = new UserOverview($conn);
$users = $userOverview->getAllUsers();
?>

<div id="userManagementView" class="p-6">
    <!-- Header -->
    <div class="flex items-center justify-between gap-4">
        <h1 class="font-semibold text-4xl">User Management</h1>
        <button
            id="addAccountBtn"
            class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Add Account
        </button>
    </div>

    <!-- Table -->
    <div class="mt-6 overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr class="text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                    <th class="whitespace-nowrap px-4 py-3">First Name</th>
                    <th class="whitespace-nowrap px-4 py-3">Middle Name</th>
                    <th class="whitespace-nowrap px-4 py-3">Last Name</th>
                    <th class="whitespace-nowrap px-4 py-3">Username</th>
                    <th class="whitespace-nowrap px-4 py-3">Email</th>
                    <th class="whitespace-nowrap px-4 py-3">Role</th>
                    <th class="whitespace-nowrap px-4 py-3">Status</th>
                    <th class="whitespace-nowrap px-4 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if (count($users) > 0): ?>
                    <?php foreach ($users as $user): ?>
                        <tr class="transition hover:bg-gray-50">
                            <td class="whitespace-nowrap px-4 py-3 text-gray-800"><?= htmlspecialchars($user['first_name']) ?></td>
                            <td class="whitespace-nowrap px-4 py-3 text-gray-600"><?= htmlspecialchars($user['middle_name'] ?: '—') ?></td>
                            <td class="whitespace-nowrap px-4 py-3 text-gray-800"><?= htmlspecialchars($user['last_name']) ?></td>
                            <td class="whitespace-nowrap px-4 py-3 text-gray-600"><?= htmlspecialchars($user['username']) ?></td>
                            <td class="whitespace-nowrap px-4 py-3 text-gray-600"><?= htmlspecialchars($user['email']) ?></td>
                            <td class="whitespace-nowrap px-4 py-3">
                                <?php
                                $role = htmlspecialchars($user['role']);
                                $roleColor = 'bg-gray-100 text-gray-700';
                                if (strtolower($role) === 'admin') $roleColor = 'bg-blue-50 text-blue-700';
                                elseif (strtolower($role) === 'staff') $roleColor = 'bg-purple-50 text-purple-700';
                                ?>
                                <span class="rounded-full px-2.5 py-1 text-xs font-medium <?= $roleColor ?>"><?= $role ?></span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3">
                                <?php
                                $status = htmlspecialchars($user['status']);
                                $statusColor = 'bg-gray-100 text-gray-700';
                                $dotColor = 'bg-gray-500';
                                if (strtolower($status) === 'active') {
                                    $statusColor = 'bg-green-50 text-green-700';
                                    $dotColor = 'bg-green-500';
                                } elseif (strtolower($status) === 'pending') {
                                    $statusColor = 'bg-yellow-50 text-yellow-700';
                                    $dotColor = 'bg-yellow-500';
                                } elseif (strtolower($status) === 'inactive') {
                                    $statusColor = 'bg-red-50 text-red-700';
                                    $dotColor = 'bg-red-500';
                                }
                                ?>
                                <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium <?= $statusColor ?>">
                                    <span class="h-1.5 w-1.5 rounded-full <?= $dotColor ?>"></span> <?= ucfirst($status) ?>
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 text-right">
                                <div class="relative inline-block text-left">
                                    <button
                                        type="button"
                                        data-action-toggle
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        class="rounded-md p-2 text-gray-500 transition hover:bg-gray-100 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                            <circle cx="5" cy="12" r="2" />
                                            <circle cx="12" cy="12" r="2" />
                                            <circle cx="19" cy="12" r="2" />
                                        </svg>
                                        <span class="sr-only">Open actions</span>
                                    </button>

                                    <div
                                        data-action-menu
                                        class="absolute right-0 z-20 mt-1 hidden w-40 origin-top-right rounded-lg border border-gray-200 bg-white py-1 shadow-lg">
                                        <button type="button" data-action="view" class="flex w-full items-center px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-50">View</button>
                                        <button type="button" data-action="edit" class="flex w-full items-center px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-50">Edit</button>
                                        <button
                                            type="button"
                                            data-action="reset"
                                            data-user-id="<?= (int) $user['id'] ?>"
                                            data-username="<?= htmlspecialchars($user['username']) ?>"
                                            class="flex w-full items-center px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-50">
                                            Reset Password
                                        </button>
                                        <div class="my-1 border-t border-gray-100"></div>
                                        <button type="button" data-action="delete" class="flex w-full items-center px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50">Delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
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



<div class="hidden" id="addAccountForm">
    <form id="createUserForm" action="../app/controller/createUser.php" method="POST" novalidate>
        <h1>Account Details</h1>

        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" placeholder="Enter first name" required>
        <p class="error-msg text-red-500 text-sm" data-error-for="first_name"></p>

        <label for="middle_name">Middle Name</label>
        <input type="text" id="middle_name" name="middle_name" placeholder="Enter middle name">
        <p class="error-msg text-red-500 text-sm" data-error-for="middle_name"></p>

        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" placeholder="Enter last name" required>
        <p class="error-msg text-red-500 text-sm" data-error-for="last_name"></p>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter username" required>
        <p class="error-msg text-red-500 text-sm" data-error-for="username"></p>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter email address" required>
        <p class="error-msg text-red-500 text-sm" data-error-for="email"></p>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter password" required>
        <p class="error-msg text-red-500 text-sm" data-error-for="password"></p>

        <label for="role">Role</label>
        <select name="role" id="role">
            <option value="admin">Admin</option>
            <option value="superadmin">Super Admin</option>
        </select>
        <p class="error-msg text-red-500 text-sm" data-error-for="role"></p>

        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            <option value="suspended">Suspended</option>
        </select>
        <p class="error-msg text-red-500 text-sm" data-error-for="status"></p>

        <div>
            <button type="button" onclick="window.location.href='?page=user'">Cancel</button>
            <button type="submit" id="createAccountBtn">Create Account</button>
        </div>

        <p id="formMessage" class="text-sm"></p>
    </form>

    <!-- Success Modal -->
    <div
        id="successModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">

        <div
            class="relative bg-white rounded-xl shadow-xl w-full max-w-sm p-6 text-center">

            <!-- Close X -->
            <button
                type="button"
                onclick="closeSuccessModal()"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 transition">

                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>

            </button>

            <!-- Success Icon -->
            <div class="flex justify-center mb-4">
                <div class="flex items-center justify-center w-14 h-14 rounded-full bg-green-100">

                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>

                </div>
            </div>

            <!-- Title -->
            <h2 class="text-xl font-bold text-gray-800">
                Account Created
            </h2>

            <!-- Message -->
            <p id="successModalMessage" class="text-gray-600 mt-2">
                The account has been created successfully.
            </p>

            <!-- OK -->
            <button
                type="button"
                onclick="closeSuccessModal()"
                class="mt-5 w-full bg-[#fdd201] text-black font-bold py-3 rounded-lg hover:bg-[#e8c000] transition">

                OK

            </button>

        </div>
    </div>
</div>