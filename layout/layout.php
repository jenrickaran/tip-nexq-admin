<?php
session_start();

$user = $_SESSION['username'] ?? null;

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

$pages = [
    'dashboard' => '../pages/dashboard.php',
    'issue-number' => '../pages/issue-number.php',
    'settings' => '../pages/settings.php'
];

$page = $_GET['page'] ?? 'dashboard';

if (!array_key_exists($page, $pages)) {
    $page = 'dashboard';
}

$showPageLoader = !isset($_SESSION['page_loaded']);

$_SESSION['page_loaded'] = true;
?>

<?php include 'head.php'; ?>

<body class="bg-zinc-900 text-white min-h-screen flex flex-col mt-4">

    <!-- Page Loading Spinner -->
    <?php if ($showPageLoader): ?>
        <div
            id="pageLoader"
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-zinc-900">
            <div class="flex flex-col items-center gap-4">
                <div
                    class="h-12 w-12 animate-spin rounded-full border-4 border-zinc-700 border-t-[#FED201]">
                </div>

                <p class="text-sm text-gray-400">
                    Loading...
                </p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Constrained Content -->
    <div class="w-full max-w-[1440px] mx-auto flex flex-col flex-1 lg:px-8 2xl:px-0">

        <?php include 'header.php'; ?>

        <main class="relative flex flex-1 mt-5 mb-5">

            <?php include 'navigation-bar.php'; ?>

            <section id="page-content" class="flex-1 min-w-0">
                <?php include $pages[$page]; ?>
            </section>

        </main>

    </div>

    <!-- Full-width Footer -->
    <?php include 'footer.php'; ?>

    <script>
        <?php include '../js/navigation-bar-script.js'; ?>
        <?php include '../js/date-and-time-footer.js'; ?>
        <?php include '../js/hamburger-menu.js'; ?>
        <?php if ($showPageLoader): ?>
            <?php include '../js/content-loader.js'; ?>
        <?php endif; ?>
        <?php include '../js/queue-overview-table-loader.js'; ?>
    </script>

</body>

</html>