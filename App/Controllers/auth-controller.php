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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $identifier = trim($_POST['identifier']);
            $password = $_POST['password'];

            if (empty($identifier) || empty($password)) {
                echo "<script>alert('Harap isi semua field!');</script>";
                return;
            }

            $column = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'nama';
            $data = $this->userModel->getUserBy($column, $identifier);

            if ($data && password_verify($password, $data['password'])) {
                $_SESSION['user'] = [
                    'id_user' => $data['id_user'],
                    'nama' => $data['nama'],
                    'role' => $data['role'] ?? 'user'
                ];

                if ($data['role'] === 'admin') {
                    header("Location: ../Views/index.php");
                } else {
                    header("Location: ../../index.php");
                }
                exit;
            } else {
                echo "<script>alert('User atau password salah!');</script>";
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