<?php
// App/Views/Pegawai/index.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nama = isset($_SESSION['user']['email']) ? htmlspecialchars($_SESSION['user']['email']) : 'Tamu';
?>

<h2>Selamat datang, <?= $nama; ?>!</h2>
