<?php
session_start();
require_once __DIR__ . '/../Models/user.php';

class AUTHController {
    private $model;

    public function __construct() {
        $this->model = new User();
    }

    public function showlogin() {
        require_once __DIR__ . '/../Views/Auth/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // 1️⃣ Validasi input kosong
            if (empty($email) || empty($password)) {
                $_SESSION['error'] = 'Email dan password tidak boleh kosong!';
                header("Location: ../../Public/?action=login");
                exit;
            }

            // 2️⃣ Ambil user dari database
            $users = $this->model->Selectuser();
            $foundUser = null;

            foreach ($users as $user) {
                if ($user['email'] === $email) {
                    $foundUser = $user;
                    break;
                }
            }

            // 3️⃣ Jika user tidak ditemukan
            if (!$foundUser) {
                $_SESSION['error'] = 'Email tidak ditemukan!';
                header("Location: ../../Public/?action=login");
                exit;
            }

            // 4️⃣ Verifikasi password
            if (!password_verify($password, $foundUser['password'])) {
                $_SESSION['error'] = 'Password salah!';
                header("Location: ../../Public/?action=login");
                exit;
            }

            // 5️⃣ Simpan ke session
            $_SESSION['user'] = [
                'id_user' => $foundUser['id_user'],
                'email'   => $foundUser['email'],
                'role'    => $foundUser['role'] ?? 'pelanggan',
            ];

            // 6️⃣ Redirect ke dashboard
            header("Location: ../Public/?action=index");
            exit;
        }
    }
    
    public function showsignup() {
        require_once __DIR__ . '/../Views/Auth/signup.php';
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $jk = trim($_POST['jk']);

            if (empty($email) || empty($password) || empty($jk)) {
                $_SESSION['error'] = 'Data Tidak Boleh Kosong!';
                header("Location: ../Views/Auth/signup.php");
                exit;
            }

            $users = $this->model->Selectuser();
            foreach ($users as $user) {
                if ($user['email'] === $email) {
                    $_SESSION['error'] = 'Email sudah terdaftar!';
                    header("Location: ../Views/Auth/signup.php");
                    exit;
                }
            }

            if ($this->model->Insertuser($email, $password,$jk)) {
                $_SESSION['success'] = 'Registrasi berhasil, silakan login.';
                header("Location: ../Public/?action=login");
                exit;
            } else {
                $_SESSION['error'] = 'Gagal mendaftar.';
                header("Location: ../Views/Auth/signup.php");
                exit;
            }
        }
    }

      
    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ../Views/Auth/login.php");
        exit;
    }

    // public function middleware(){
    //     session_start();
    //     if (!isset($_SESSION['user'])) {
    //         header("Location: ../../App/Controllers/login.php");
    //         exit;
    //     }

    //     if ($_SESSION['user']['role'] !== 'pegawai') {
    //         header("Location: ../../index.php");
    //         exit;
    //     }
    // }
}
?>