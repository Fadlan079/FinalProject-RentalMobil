<?php 
require_once  "../Models/user.php";
$user = new User();

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    var_dump($_POST);
    $nama = $_POST['nama'];
    $pass = $_POST['pass'];
    $data = $user->Selectuser(null, $nama);

    if($data){
        if(password_verify($pass, $data['password'])){
            if($data['role'] == 'Admin'){    
                header("Location:admin/dashboard.php?success=1");
                exit;
            }else{
                header("Location:../../index.php?success=1");
                exit;
            }
        }else{
            echo "Password Salah!";
        }   
    }else{
        echo "User tidak ditemukan!";
    } 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link rel="stylesheet" href="../../src/output.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

  <form action="login.php" method="POST"
        class="bg-indigo-50 p-8 rounded-lg shadow-lg w-full max-w-sm">
    
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login</h2>
    
    <div class="mb-4">
      <input type="text" name="nama" placeholder="Username..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-500" />
    </div>

    <div class="mb-4">
      <input type="email" name="email" placeholder="Email..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-500" />
    </div>

    <div class="mb-6">
      <input type="password" name="pass" placeholder="Password..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-500" />
    </div>

    <input type="submit" value="Send"
           class="w-full bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-400 transition duration-200 focus:outline-none focus:ring-2 focus:ring-orange-600 cursor-pointer transition-allduration-3" />
  </form>
</body>
</html>
