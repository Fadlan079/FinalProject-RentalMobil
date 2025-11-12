<?php
require_once __DIR__ . '/../Models/pegawai.php';
require_once __DIR__ . '/../Models/mobil.php';
require_once __DIR__ . '/../Middleware/middleware.php';

class PEGAWAIController {
    private $model;
    private $mobilmodel;

    public function __construct() {
        $this->model = new Pegawai();
        $this->mobilmodel = new Mobil();
    }

    public function index() {
        Middleware::requirerole('pegawai'); 
        $this->mobilmodel->getallmobil();
        include __DIR__ . '/../Views/Pegawai/index.php';
    }

    public function Getall(){
        
        include __DIR__ . "/../Views/Pegawai/index.php";
    }

    public function storeProfile() {
        Middleware::requirerole(['admin', 'cs']);

        $id_user = $_SESSION['user']['id_user'];
        $dataLama = $this->model->getpegawaibyiduser($id_user);

        if (empty($_POST['nama'])) {
            $_SESSION['error'] = 'Nama tidak boleh kosong!';
            header("Location: index.php?action=profile-pegawai");
            exit;
        }

        $fotoBaru = $dataLama['pp'];
        if (isset($_FILES['pp']) && $_FILES['pp']['error'] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['pp']['tmp_name'];
            $fileName = basename($_FILES['pp']['name']);
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

            if (in_array($fileExt, $allowed)) {
                $newName = 'pp_' . uniqid() . '.' . $fileExt;
                $uploadDir = __DIR__ . '/../../Public/uploads/';
                $uploadPath = $uploadDir . $newName;

                if (move_uploaded_file($tmpName, $uploadPath)) {
                    if (!empty($dataLama['pp']) && $dataLama['pp'] !== 'default.svg') {
                        $oldPath = $uploadDir . $dataLama['pp'];
                        if (file_exists($oldPath)) unlink($oldPath);
                    }
                    $fotoBaru = $newName;
                }
            }
        }

        $this->model->Updatepegawai(
            $id_user,
            $_POST['nama'],
            $_POST['tmpt_lhr'],
            !empty($_POST['tgl_lhr']) ? $_POST['tgl_lhr'] : null,
            $_POST['alamat'],
            $_POST['kelurahan'],
            $_POST['kecamatan'],
            $_POST['kabupaten'],
            $_POST['kp'],
            $_POST['telp'],
            $_POST['bio'],
            $fotoBaru
        );

        $_SESSION['success'] = 'Profil berhasil diperbarui.';
        header("Location: index.php?action=profile-pegawai");
        exit;
    }

    // ==========================
    // 🧾 CRUD PEGAWAI (Admin)
    // ==========================
    public function listPegawai()
{
        // Middleware::requireRole(['admin']); // hanya admin boleh lihat

        $pegawaiModel = new Pegawai(); // panggil model
        $pegawaiList = $this->model->Selectuser();  // ambil semua data pegawai
         require_once __DIR__ . '/../../App/Models/createuser.php';
}


    public function createPegawai() {
        // Middleware::requirerole(['admin']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->Insertuser($_POST['nama'], $_POST['kelas']);
            header("Location: index.php");
        }

        require_once __DIR__ . '/../../App/Models/createuser.php';
    }

    public function storePegawai() {
        // Middleware::requirerole(['admin']);

        $username = trim($_POST['email']);
        $password = trim($_POST['password']);
        $role = trim($_POST['role']);

        if (empty($email) || empty($password) || empty($role)) {
            $_SESSION['error'] = 'Semua field wajib diisi!';
            header("Location: index.php?action=createPegawai");
            exit;
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $this->model->Insertuser($email, $hashed, $role);

        $_SESSION['success'] = 'Pegawai berhasil ditambahkan.';
        header("Location: index.php?action=listPegawai");
        exit;
    }

    public function editPegawai() {
        // Middleware::requirerole(['admin']);
        $id = $_GET['id'] ?? null;
        $data = $this->model->Selectuser($id);
        require_once __DIR__ . '/../../App/Models/createuser.php';
    }

    public function deletePegawai() {
        // Middleware::requirerole(['admin']);
        $id = $_GET['id'] ?? null;
        $this->model->Deleteuser($id);
        $_SESSION['success'] = 'Pegawai berhasil dihapus.';
        header("Location: index.php?action=listPegawai");
        exit;
    }
}
?>
