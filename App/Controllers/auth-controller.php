<?php
session_start();
require_once __DIR__ . '/../Models/user.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function showLogin() {
        require_once __DIR__ . '/../Views/auth/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // Ambil input dari form login
    $identifier = trim($_POST['identifier']);
    $password = $_POST['password'];

    // Validasi form
    if (empty($identifier) || empty($password)) {
        echo "<script>alert('Harap isi semua field!');</script>";
        exit;
    }

    // untuk memfilter form nya jika user mengisi email/nama dalam form tersebut
    if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
        $column = "email";
    }elseif (preg_match('/^(\+62|62|0)8[1-9][0-9]{6,9}$/', $identifier)) {
        $column = "telp";
        // ini opsional jika dalam database menyimpan nomor telepon dalam bentuk +62
        $identifier = preg_replace('/^0/', '+62', $identifier);
    }else {
        $column = "nama";
    }

    // Ambil data user dari database
    $data = $user->getUserBy($column, $identifier,'pelanggan');

    if ($data) {
        if (password_verify($password, $data['password'])) {
            $_SESSION['user'] = [
                'id_user' => $data['id_user'],
                'nama' => $data['nama'],
            ];
            
            header("location:");
        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Nama/Email/Telepon tidak ditemukan!');</script>";
        }
    }
 

 // Ambil data user dari database
    $data = $user->getUserBy($column, $identifier,'pelanggan');

        if ($data && password_verify($password, $data['password'])) {
            $_SESSION['user'] = [
                'id_user' => $data['id_user'],
                'nama' => $data['nama'],
                'role'    => 'pelanggan',
            ];
            
            header("location:login.php");
            exit;

        }else {

        $data = $user->getUserBy($column, $identifier, 'pegawai');

        if ($data && password_verify($password, $data['password'])) {
            $_SESSION['user'] = [
                'id_user' => $data['id_pegawai'],
                'nama'    => $data['nama'],
                'role'    => 'pegawai',
            ];
            // Redirect pegawai
            header('Location: login.php');
            exit;

        } else {
            echo "<script>alert('Login gagal. Periksa kembali data Anda.');</script>";
        }
    }
}

    public function showSignup() {
        require_once __DIR__ . '/../Views/Auth/signup.php';
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->Insertuser(
                $_POST['nama'],
                $_FILES['sim'],
                $_POST['email'],
                $_POST['password'],
                $_FILES['ktp'],
                $_POST['tlp']
            );

            header("Location: ../Views/auth/signup.php");
            exit;
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ../Views/auth/login.php");
        exit;
    }

    public function middleware(){
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: ../../App/Controllers/login.php");
            exit;
        }

        if ($_SESSION['user']['role'] !== 'admin') {
            header("Location: ../../index.php");
            exit;
        }
    }
}
?>