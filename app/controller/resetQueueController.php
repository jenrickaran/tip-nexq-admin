<?php

require_once '../../config/dbConfig.php';

$sql = "DELETE FROM email
        WHERE DATE(timestamp) = CURDATE()
        AND status = 'WAITING'";

$stmt = $conn->prepare($sql);
$stmt->execute();

header("Location: ../../layout/layout.php");
exit;
