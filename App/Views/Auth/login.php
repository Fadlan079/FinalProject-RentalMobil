<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rent Car Cylc</title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body>
    <form action="login.php" method="POST"
        class="bg-indigo-50 p-8 rounded-lg shadow-lg w-full max-w-sm">
    
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login</h2>
    
    <div class="mb-4">
      <input type="text" name="identifier" placeholder="Nama / Email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-500" />
    </div>

    <div class="mb-6">
      <input type="password" name="password" placeholder="Password..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-500" />
    </div>

    <input type="submit" value="Send" class="w-full bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-400 transition duration-200 focus:outline-none focus:ring-2 focus:ring-orange-600 cursor-pointer transition-allduration-3" />
  </form>
</body>
</html>