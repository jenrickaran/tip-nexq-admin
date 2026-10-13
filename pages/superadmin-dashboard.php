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
    <div class="flex">

        <div>
            <div>
                <!--here is svg-->
                <h2>Total Users</h2>
            </div>
            <h1><?= htmlspecialchars($totalUsers) ?></h1>
        </div>

        <div>
            <div>
                <!--here is svg-->
                <h2>Total Admins</h2>
            </div>
            <h1><?= htmlspecialchars($totalAdmins) ?></h1>
        </div>

        <div>
            <div>
                <!--here is svg-->
                <h2>Active sessions</h2>
            </div>
            <h1><?= htmlspecialchars($totalActive) ?></h1>
        </div>

        <div>
            <div>
                <!--here is svg-->
                <h2>Failed Logins (24h)</h2>
            </div>
            <h1>numbers of total admin</h1>
        </div>

        <div>
            <div>
                <!--here is svg-->
                <h2>System Health</h2>
            </div>
            <h1>numbers of total admin</h1>
        </div>
    </div>

    <!--Quick Actions & Recent Activity-->
    <div class="w-full flex">

        <!--Quick Actions-->
        <div class="w-1/2 flex flex-col">
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

        <!--Recent Activity-->
        <div class="w-1/2 flex flex-col">
            <div class="flex">
                <h1>Recent Activity</h1>
                <a href="?page=audit-logs">View all</a>
            </div>


        </div>
    </div>
</div>