<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rent Car Cylc</title>
    <link rel="stylesheet" href="output.css">
</head>
<body>
  <form action="index.php?action=storelogin" method="post">
      <label>Email</label>
      <input name="email" type="text" placeholder="Example@gmail.com" required>
      <label>Password</label>
      <input name="password" type="password" placeholder="********" required>
      <input type="submit" value="Kirim">
      <a href="index.php?action=signup">Belum Punya Akun? SignUp</a>
  </form>
</body>
</html>