<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nama = $_SESSION['user']['email'] ?? 'Tamu';
?>

<h2>Selamat datang, <?= htmlspecialchars($nama); ?>!</h2>

<div class="stats">
    <p>Jumlah Pegawai: <?= $jumlahPegawai ?? '-' ?></p>
    <p>Pegawai Aktif: <?= $pegawaiAktif ?? '-' ?></p>
</div>

<a href="index.php?action=createpegawai" class="btn btn-primary">
    Kelola Pegawai
</a>


