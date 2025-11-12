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

        // =========================
        // CEK ROLE DAN INSERT DATA JIKA BELUM ADA
        // =========================
        if ($foundUser['role'] === 'pelanggan') {
            $existingPelanggan = $this->pelangganmodel->getPelangganByUserId($foundUser['id_user']);
            if (!$existingPelanggan) {
                $this->pelangganmodel->Insertpelanggan(
                    $foundUser['id_user'],
                    NULL, // nama
                    NULL, // nik
                    NULL, // alamat
                    NULL, // kelurahan
                    NULL, // kecamatan
                    NULL, // kota
                    NULL, // kp
                    NULL, // telp
                    NULL, // bio
                    NULL  // pp
                );
            }
        } elseif ($foundUser['role'] === 'pegawai') {
            $existingPegawai = $this->pegawaimodel->getPegawaiByUserId($foundUser['id_user']);
            if (!$existingPegawai) {
                $this->pegawaimodel->Insertpegawai(
                    $foundUser['id_user'],
                    NULL, // nik
                    NULL, // alamat
                    NULL, // jabatan
                    NULL, // telp
                    NULL  // tambahan lain
                    NULL, // nama
                    NULL, // nik
                    NULL, // alamat
                    NULL, // jabatan
                    NULL, // telp
                    NULL  // tambahan lain
                );
            }
        }

        // =========================
        // SET SESSION
        // =========================
        $_SESSION['user'] = [
            'id_user' => $foundUser['id_user'],
            'email'   => $foundUser['email'],
            'role'    => $foundUser['role'] ?? 'pelanggan',
        ];

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

        // Data tambahan pelanggan
        $nama = trim($_POST['nama']);
        $nik = trim($_POST['nik']);
        $alamat = trim($_POST['alamat']);
        $kota = trim($_POST['kota']);
        $telp = trim($_POST['telp']);

        if (empty($email) || empty($password) || empty($jk) || empty($nama) || empty($nik) || empty($alamat) || empty($kota) || empty($telp)) {
            $_SESSION['error'] = 'Data Tidak Boleh Kosong!';
            header("Location: ../Views/Auth/signup.php");
            exit;
        }

        // Cek email sudah terdaftar
        $users = $this->model->Selectuser();
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $_SESSION['error'] = 'Email sudah terdaftar!';
                header("Location: ../Views/Auth/signup.php");
                exit;
            }
        }

        // Insert ke tabel user
        $insertedUserId = $this->model->Insertuser($email, $password, $jk);

        if ($insertedUserId) {
            // Insert ke tabel pelanggan dengan data input user, sisanya NULL
            $this->pelangganmodel->Insertpelanggan(
                $insertedUserId,
                $nama,
                $nik,
                $alamat,
                NULL,  // kelurahan
                NULL,  // kecamatan
                $kota,
                NULL,  // kp
                $telp,
                NULL,  // bio
                NULL   // pp
            );

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