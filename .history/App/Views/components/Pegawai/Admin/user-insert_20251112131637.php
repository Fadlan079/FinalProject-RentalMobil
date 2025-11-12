<h2>Daftar Pegawai</h2>
<a href="index.php?action=create-pegawai">+ Tambah Pegawai</a>
<table border="1" cellpadding="6">
    <tr>
        <th>ID</th><th>Nama</th><th>Username</th><th>Role</th><th>Aksi</th>
    </tr>
    <?php foreach ($data as $row): ?>
    <tr>
        <td><?= $row['id_user'] ?></td>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= htmlspecialchars($row['role']) ?></td>
        <td>
            <a href="index.php?action=edit-pegawai&id=<?= $row['id_user'] ?>">Edit</a> |
            <a href="index.php?action=delete-pegawai&id=<?= $row['id_user'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>