<?php
session_start(); 
require_once "../Models/user.php";
$user = new User();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user->Insertuser(
        $nama = $_POST['nama'],
        $sim = $_FILES['sim'],
        $email = $_POST['email'],
        $pass = $_POST['password'],
        $ktp = $_FILES['ktp'],
        $tlp = $_POST['tlp']
    );

    if($data['role'] == 'admin'){
        header("Location: /FinalProject-RentalMobil/App/Views/index.php");
        exit;
    }else{
        header("Location:../../index.php?success=1");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../../src/output.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <form action="signup.php" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Sign Up</h2>
        <div class="mb-4">
        <input type="text" name="nama" placeholder="Username..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-500">
        </div>
        <div class="mb-4">
        <input type="file"  name="sim" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-500">
        </div>
        <div class="mb-4">
        <input type="text" name="email" placeholder="Email..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-500">
        </div>
        <div class="mb-4">
        <input type="password" name="password" placeholder="Password..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-500">
        </div>
        <div class="mb-4">
        <input type="file"  name="ktp" placeholder="Password..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-500">
        </div>
        <div class="mb-4">
        <input type="tel" name="tlp" placeholder="08xxxxxxx" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-500">
        </div>
        <div class="mb-6">
        <input type="submit" value="Send" class="w-full bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-400 transition duration-200 focus:outline-none focus:ring-2 focus:ring-orange-600 cursor-pointer transition-allduration-3">
        </div>
    </form>
</body>
</html>