<?php
session_start();
require_once __DIR__ . '/../Models/user.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    // 🟢 Tampilkan form login
    public function showLogin() {
        require_once __DIR__ . '/../Views/auth/login.php';
    }

    // 🟢 Proses login
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
    $data = $user->getUserBy($column, $identifier);

    if ($data) {
        if (password_verify($password, $data['password'])) {
            $_SESSION['user'] = [
                'id_user' => $data['id_user'],
                'nama' => $data['nama'],
            ];

        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Nama/Email tidak ditemukan!');</script>";
        }
    }
 }

    // 🟢 Tampilkan form signup
    public function showSignup() {
        require_once __DIR__ . '/../Views/auth/signup.php';
    }

    // 🟢 Proses signup
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

            header("Location: ../../index.php?success=1");
            exit;
        }
    }

    // 🟢 Logout
    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ../Views/auth/login.php");
        exit;
    }
}
?>