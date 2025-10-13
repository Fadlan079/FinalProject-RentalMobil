<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../App/Controllers/login.php");
    exit;
}

if ($_SESSION['user']['role'] !== 'admin') {
    header("Location: ../../index.php");
    exit;
}
?>