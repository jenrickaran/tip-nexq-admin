<?php
include 'head.php';

$pages = [
    'dashboard' => '../pages/superadmin-dashboard.php',
    'add-account' => '../pages/superadmin-add-account.php',
    'settings' => '../pages/settings.php'
];

$page = $_GET['page'] ?? 'dashboard';
?>

<body class="bg-zinc-900 text-white">
    <?php
    include 'header.php';
    ?>

    <main class="relative flex flex-1 mt-5 mb-5">

        <?php include 'superadmin-navigation-bar.php'; ?>

        <section id="page-content" class="flex-1 min-w-0">
            <?php include $pages[$page]; ?>
        </section>

    </main>

    <?php
    include 'superadmin-footer.php';
    ?>

    <script>
        <?php include '../js/date-and-time-footer.js'; ?>
    </script>
</body>