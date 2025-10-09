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

var_dump($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="src/output.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
    <form action="login.php" method="POST">
        <input type="text" name="nama" placeholder="Username...">
        <input type="text" name="email" placeholder="Email...">
        <input type="password" name="pass" placeholder="Password...">
        <input type="submit" value="Send ">
    </form>
</body>
</html>