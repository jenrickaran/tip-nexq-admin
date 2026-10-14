<?php
require_once '../config/dbConfig.php';
require_once '../app/model/total-users.php';

$users = new TotalUser($conn);
$totalUsers = $users->totalUsers();
$totalAdmins = $users->totalAdmins();
$totalActive = $users->totalActive();
?>

<div class="px-8">
    <h1 class="font-semibold text-4xl">Dashboard</h1>

    <!--boxes-->
    <div class="flex justify-between mt-5 mb-5">

        <div class="max-w-[350px] w-full flex flex-col gap-2 p-5 border-2 border-[#FED201] rounded-lg">
            <h2 class="text-2xl font-semibold">Total Users</h2>
            <div class="flex items-end gap-2">
                <h1 class="text-7xl text-[#FED201] font-bold"><?= htmlspecialchars($totalUsers) ?></h1>
                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="6" r="4" stroke="#808080" stroke-width="1.5" />
                    <path d="M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4" stroke="#808080" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4" stroke="#808080" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M17.1973 15C17.7078 15.5883 18 16.2714 18 17C18 19.2091 15.3137 21 12 21C8.68629 21 6 19.2091 6 17C6 14.7909 8.68629 13 12 13C12.3407 13 12.6748 13.0189 13 13.0553" stroke="#808080" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14" stroke="#808080" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14" stroke="#808080" stroke-width="1.5" stroke-linecap="round" />
                </svg>
            </div>
        </div>

        <div class="max-w-[350px] w-full flex flex-col gap-2 p-5 border-2 border-[#FED201] rounded-lg">
            <h2 class="text-2xl font-semibold">Total Admins</h2>
            <div class="flex items-end font-bold gap-2">
                <h1 class="text-7xl text-[#FED201] "><?= htmlspecialchars($totalAdmins) ?></h1>
                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="9" r="2" stroke="#808080" stroke-width="1.5" />
                    <path d="M16 15C16 16.1046 16 17 12 17C8 17 8 16.1046 8 15C8 13.8954 9.79086 13 12 13C14.2091 13 16 13.8954 16 15Z" stroke="#808080" stroke-width="1.5" />
                    <path d="M3 10.4167C3 7.21907 3 5.62028 3.37752 5.08241C3.75503 4.54454 5.25832 4.02996 8.26491 3.00079L8.83772 2.80472C10.405 2.26824 11.1886 2 12 2C12.8114 2 13.595 2.26824 15.1623 2.80472L15.7351 3.00079C18.7417 4.02996 20.245 4.54454 20.6225 5.08241C21 5.62028 21 7.21907 21 10.4167C21 10.8996 21 11.4234 21 11.9914C21 14.4963 20.1632 16.4284 19 17.9041M3.19284 14C4.05026 18.2984 7.57641 20.5129 9.89856 21.5273C10.62 21.8424 10.9807 22 12 22C13.0193 22 13.38 21.8424 14.1014 21.5273C14.6796 21.2747 15.3324 20.9478 16 20.5328" stroke="#808080" stroke-width="1.5" stroke-linecap="round" />
                </svg>
            </div>
        </div>

        <div class="max-w-[350px] w-full flex flex-col gap-2 p-5 border-2 border-[#FED201] rounded-lg">
            <h2 class="text-2xl font-semibold">Active sessions</h2>
            <div class="flex items-end gap-2">
                <h1 class="text-7xl text-[#FED201] font-bold"><?= htmlspecialchars($totalActive) ?></h1>
                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 3H7.8C6.11984 3 5.27976 3 4.63803 3.32698C4.07354 3.6146 3.6146 4.07354 3.32698 4.63803C3 5.27976 3 6.11984 3 7.8V16.2C3 17.8802 3 18.7202 3.32698 19.362C3.6146 19.9265 4.07354 20.3854 4.63803 20.673C5.27976 21 6.11984 21 7.8 21H16.2C17.8802 21 18.7202 21 19.362 20.673C19.9265 20.3854 20.3854 19.9265 20.673 19.362C21 18.7202 21 17.8802 21 16.2V13M12 8H16V12M15.5 3.5V2M19.4393 4.56066L20.5 3.5M20.5103 8.5H22.0103M3 13.3471C3.65194 13.4478 4.31987 13.5 5 13.5C9.38636 13.5 13.2653 11.3276 15.6197 8" stroke="#808080" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>
    </div>

    <!--Quick Actions & Recent Activity-->
    <div class="w-full flex">

        <!--Quick Actions-->
        <div class="w-full flex flex-col">
            <h1>Quick Actions</h1>

            <button onclick="window.location.href='?page=user'">
                <div>
                    <!--svg here-->

                    <div class="flex flex-col items-start">
                        <h1>Add Admin</h1>
                        <p>Create a new account</p>
                    </div>
                </div>
            </button>

            <button>
                <div>
                    <!--svg here-->

                    <div class="flex flex-col items-start">
                        <h1>Invite User</h1>
                        <p>Send an invitation to a user</p>
                    </div>
                </div>
            </button>

            <button>
                <div>
                    <!--svg here-->

                    <div class="flex flex-col items-start">
                        <h1>View Audit Log</h1>
                        <p>Check system activity log</p>
                    </div>
                </div>
            </button>

            <button>
                <div>
                    <!--svg here-->

                    <div class="flex flex-col items-start">
                        <h1>Suspend User</h1>
                        <p>Temporarily disabled an account</p>
                    </div>
                </div>
            </button>
        </div>
    </div>
</div>