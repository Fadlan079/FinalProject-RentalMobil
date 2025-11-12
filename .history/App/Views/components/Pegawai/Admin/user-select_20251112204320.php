<?php
// Hanya admin yang boleh melihat daftar pegawai
// Middleware::requirerole(['admin']);

// Ambil semua data pegawai dari controller
$pegawaiList = $this->model->getAllPegawai(); 
?>

<h2 style="text-align:center;">Daftar Pegawai</h2>

<div style="max-width:900px; margin:auto; padding:20px;">

    <a href="index.php?action=listPegawai" 
       style="display:inline-block; background-color:#4CAF50; color:white; padding:10px 15px; border-radius:5px; text-decoration:none; margin-bottom:15px;">
       + Tambah Pegawai
    </a>

    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse;">
        <thead style="background-color:#f0f0f0;">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Foto Profil</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($pegawaiList)): ?>
            <?php $no = 1; foreach ($pegawaiList as $pgw): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($pgw['nama']) ?></td>
                    <td><?= htmlspecialchars($pgw['username']) ?></td>
                    <td><?= htmlspecialchars($pgw['role']) ?></td>
                    <td>
                        <img src="Public/uploads/<?= !empty($pgw['pp']) ? $pgw['pp'] : 'default.svg' ?>" 
                             alt="foto" width="50" height="50" style="border-radius:50%;">
                    </td>
                    <td>
                        <a href="index.php?action=edit-pegawai&id=<?= $pgw['id_user'] ?>" 
                           style="background-color:#ffc107; color:black; padding:5px 10px; border-radius:4px; text-decoration:none;">Edit</a>
                        <a href="index.php?action=delete-pegawai&id=<?= $pgw['id_user'] ?>" 
                           onclick="return confirm('Yakin ingin menghapus pegawai ini?');"
                           style="background-color:#f44336; color:white; padding:5px 10px; border-radius:4px; text-decoration:none;">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center; color:#666;">Belum ada data pegawai.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>