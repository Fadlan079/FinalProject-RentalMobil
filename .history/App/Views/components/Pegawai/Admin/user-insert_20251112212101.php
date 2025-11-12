<h2 style="text-align:center;">Tambah Pegawai Baru</h2>

<form action="index.php?action=index.php" method="POST" 
      style="max-width:500px; margin:auto; border:1px solid #ccc; padding:20px; border-radius:10px; box-shadow:0 2px 5px rgba(0,0,0,0.1);">

    <label for="email"><b>Email</b></label><br>
    <input type="text" id="email" name="email" placeholder="Masukkan email unik" 
           required style="width:100%; padding:8px; margin:5px 0 15px 0; border:1px solid #aaa; border-radius:5px;">

    <label for="password"><b>Password</b></label><br>
    <input type="password" id="password" name="password" placeholder="Masukkan password" 
           required style="width:100%; padding:8px; margin:5px 0 15px 0; border:1px solid #aaa; border-radius:5px;">

    <label for="role"><b>Role Pegawai</b></label><br>
    <select id="role" name="role" required 
            style="width:100%; padding:8px; margin:5px 0 15px 0; border:1px solid #aaa; border-radius:5px;">
        <option value="">-- Pilih Role --</option>
        <option value="admin">Admin</option>
        <option value="cs">Customer Service</option>
    </select>

    <button type="submit" 
            style="background-color:#4CAF50; color:white; padding:10px 20px; border:none; border-radius:5px; cursor:pointer;">
        Simpan Pegawai
    </button>

    <a href="index.php?action=create-Pegawai" 
       style="display:inline-block; margin-left:10px; padding:10px 20px; background-color:#ccc; color:black; border-radius:5px; text-decoration:none;">
       Batal
    </a>
    
    <a href="index.php?action=index.php">kembali</a
</form>