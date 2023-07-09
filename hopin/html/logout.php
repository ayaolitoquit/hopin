<?php
session_start();

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if (isset($_POST['logout'])) {

    echo '<script>';
    echo 'if (confirm("Are you sure you want to log out?")) {';
    echo '  ' . 'window.location.href = "login.php";';
    echo '} else {';
    echo '  ' . 'window.history.back();';
    echo '}';
    echo '</script>';
    exit; 
}

header("Location: ".$_SERVER['HTTP_REFERER']);
exit;

?>
