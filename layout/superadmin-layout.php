<?php
session_start();

$user = $_SESSION['username'] ?? null;

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

include 'head.php';

$pages = [
    'dashboard' => '../pages/superadmin-dashboard.php',
    'user' => '../pages/superadmin-user.php',
    'settings' => '../pages/settings.php'
];

$page = $_GET['page'] ?? 'dashboard';
?>

<body class="bg-zinc-900 text-white min-h-screen">

    <div class="max-w-[1440px] flex flex-col mx-auto lg:px-8 2xl:px-0">
        <?php
        include 'superadmin-header.php';
        ?>

        <main class="relative flex flex-1 mt-5 mb-5">

            <?php include 'superadmin-navigation-bar.php'; ?>

            <section id="page-content-superadmin" class="flex-1 min-w-0">
                <?php include $pages[$page]; ?>
            </section>

        </main>
    </div>

    <?php
    include 'superadmin-footer.php';
    ?>

    <script>
        <?php include '../js/date-and-time-footer.js'; ?>
        <?php include '../js/add-account.js'; ?>
        <?php include '../js/error-add-account.js'; ?>
        <?php include '../js/success-add-account.js'; ?>
        <?php include '../js/user-overview.js'; ?>
        <?php include '../js/suspend-user.js'; ?>
    </script>
    <script src="../js/reset-password-modal.js"></script>
    <script src="../js/hamburger-menu-superadmin.js"></script>
    <script src="../js/navigation-bar-superadmin.js"></script>
</body>