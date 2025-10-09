<?php 
require_once "../Models/user.php";
$user = new User();

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $data = $user->Selectuser(null, $username);

    if($data){
        if(password_verify($password, $data['password'])){
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = $data['role'];

            if($data['role'] == 'admin' || $data['role'] == 'superadmin' || $data['role'] == 'owner'){    
                $_SESSION['users'] = [
                    'name' => $data['username'],
                    'role' => $data['role']
                ];
                header("Location:admin/dashboard.php?success=1");
                exit;
            }else{
                header("Location:index.php?success=1");
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