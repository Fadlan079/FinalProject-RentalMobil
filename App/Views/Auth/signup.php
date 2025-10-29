<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp - Cylc Rent Car</title>
    <link rel="stylesheet" href="output.css">
</head>
<body>
    <form action="index.php?action=storesignup" method="post">
        <label>Email</label>
        <input name="email" type="email" placeholder="Example@gmail.com" required>
        <label>Password</label>
        <input name="password" type="password" placeholder="********" required>
        <br>
        <label>Jenis kelamin</label>
        <br>
        <select name="jk">
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
        <input type="submit" value="Kirim">
        <a href="index.php?action=login">Sudah Punya Akun? Login</a>
    </form>
</body>
</html>