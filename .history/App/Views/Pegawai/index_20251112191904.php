<h1>Dashboard Admin</h1>
<p>Selamat datang, <?= htmlspecialchars($_SESSION['user']['email']); ?>!</p>

<div style="margin-top:20px;">
    <p>Jumlah Pegawai: <?= $dataPegawai ?? '-' ?></p>
    <p>Pegawai Aktif: <?= $dataAktif ?? '-' ?></p>
</div>

<a href="index.php?action=listPegawai">Kelola Pegawai</a>
