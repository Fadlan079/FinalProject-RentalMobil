<?php
session_start();
require_once __DIR__ . '/../Models/user.php';
require_once __DIR__ . '/../Models/pelanggan.php';
require_once __DIR__ . '/../Models/pegawai.php';

class AUTHController {
    private $model;
    private $pelangganmodel;
    private $pegawaimodel;

    public function __construct() {
        $this->model = new User();
        $this->pelangganmodel = new Pelanggan();
        $this->pegawaimodel = new Pegawai();
    }

    public function showlogin() {
        require_once __DIR__ . '/../Views/Auth/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (empty($email) || empty($password)) {
                $_SESSION['error'] = 'Email dan password tidak boleh kosong!';
                header("Location: ../Public/?action=login");
                exit;
            }

            $foundUser = $this->model->getuserbyemail($email);

            if (!$foundUser) {
                $_SESSION['error'] = 'Email tidak ditemukan!';
                header("Location: ../Public/?action=login");
                exit;
            }

            if (!password_verify($password, $foundUser['password'])) {
                $_SESSION['error'] = 'Password salah!';
                header("Location: ../Public/?action=login");
                exit;
            }

            $_SESSION['user'] = [
                'id_user' => $foundUser['id_user'],
                'email'   => $foundUser['email'],
                'role'    => $foundUser['role'] ?? 'pelanggan',
            ];
            
            // Insert Data kosong ke table Pelanggan/Pegawai
            if ($foundUser['role'] === 'pelanggan') {
                if (!$this->pelangganmodel->getpelangganbyiduser($foundUser['id_user'])) {
                    $this->pelangganmodel->Insertpelanggan($foundUser['id_user'], '', '', '', '', '', '', '', '', '', '');
                }
            } elseif ($foundUser['role'] === 'pegawai') {
                if (!$this->pegawaimodel->getpegawaibyiduser($foundUser['id_user'])) {
                    $this->pegawaimodel->Insertpegawai($foundUser['id_user'], '', '', Null , '', '', '', '','','','','');
                }
            }

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
        header("Location: ../Public/?action=index");
        exit;
    }
}
?>