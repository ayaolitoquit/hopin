<?php
session_start();

if (!isset($_SESSION['USER_ID'])) {
    // User is not logged in, redirect to the login page
    header("Location: login.php");
    exit;
}

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
