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


?>

<?php include 'head.php'; ?>

<body class="bg-zinc-900 text-white max-w-[1440px] mx-auto pt-5 min-h-screen flex flex-col">
    <?php include 'head.php'; ?>

    <?php include 'header.php'; ?>

    <main class="flex flex-1 mt-5">

        <?php include 'navigation-bar.php'; ?>

        <section id="page-content" class="flex-1">
            <?php include $pages[$page]; ?>
        </section>

    </main>

    <?php include 'footer.php'; ?>

    <script>
        <?php include '../js/navigation-bar-script.js'; ?>
        <?php include '../js/date-and-time-footer.js'; ?>
    </script>
</body>

</html>