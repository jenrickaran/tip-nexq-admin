<?php
include '../model/next-customer.php';

$serving = new NextCustomer($conn);

$servedTicket = $serving->getNextCustomer();

if ($servedTicket) {
    header("Location: ../../layout/layout.php?served=$servedTicket");
    exit;
}

header("Location: ../../layout/layout.php?error=no_waiting");
exit;
