<h2>Edit Data Siswa</h2>
<form method="POST">
    <label>Nama:</label><br>
    <input type="text" name="nama" value="<?= htmlspecialchars($detail['nama']); ?>" required><br><br>

    <label>Kelas:</label><br>
    <input type="text" name="kelas" value="<?= htmlspecialchars($detail['kelas']); ?>" required><br><br>

    <button type="submit">Perbarui</button>
</form>

<a href="index.php?>action=index">Kembali</a>
