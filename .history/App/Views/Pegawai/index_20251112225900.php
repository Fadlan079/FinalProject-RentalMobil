<h2>Daftar Siswa</h2>
<a href="index.php?action=createuser.php">Tambah Siswa</a>
<table border="1" cellpadding="6">
    <tr><th>ID</th><th>Nama</th><th>Kelas</th><th>Aksi</th></tr>
    <?php foreach ($data as $row): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['p']; ?></td>
            <td>
                <a href="index.php?action=updateuser.php=<?= $row['id']; ?>">Edit</a> | 
                <a href="index.php?action=deleteuser.php=<?= $row['id']; ?>" onclick="return confirm('Yakin?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>