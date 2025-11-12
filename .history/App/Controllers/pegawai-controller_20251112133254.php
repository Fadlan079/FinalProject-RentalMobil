<?php
require_once __DIR__ . '/../Models/pegawai.php';
require_once __DIR__ . '/../Middleware/middleware.php';

class PEGAWAIController {
    private $model;

    public function __construct() {
        $this->model = new Pegawai();
    }

    // Dashboard utama — bedakan tampilan berdasarkan role
    public function index() {
        Middleware::requirerole(['admin', 'cs']); // pastikan hanya pegawai boleh masuk
        
        $role = $_SESSION['user']['role'] ?? null;

        if ($role === 'admin') {
            require_once __DIR__ . '/../../App/Views/Pegawai/Admin/index.php';
        } elseif ($role === 'cs') {
            require_once __DIR__ . '/../../App/Views/Pegawai/CS/index.php';
        } else {
            http_response_code(403);
            echo "<h1 style='color:red; text-align:center;'>Akses Ditolak</h1>";
        }
    }

    // Menampilkan profil pegawai (semua role bisa)
    public function Showprofile() {
        Middleware::requirerole(['admin', 'cs']);
        $id_user = $_SESSION['user']['id_user'];
        $data = $this->model->getpegawaibyiduser($id_user); 

        require_once __DIR__ . '/../../App/Views/Pegawai/profile-pegawai.php';
    }

    // Menyimpan pembaruan profil + upload foto
    public function Storeprofile() {
        Middleware::requirerole(['admin', 'cs']);

        $id_user = $_SESSION['user']['id_user'];
        $dataLama = $this->model->getpegawaibyiduser($id_user);

        // 🟩 handle upload foto
        $fotoBaru = $dataLama['pp']; // default: pakai foto lama
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
                    // 🟩 hapus foto lama kalau bukan default.svg
                    if (!empty($dataLama['pp']) && $dataLama['pp'] !== 'default.svg') {
                        $oldPath = $uploadDir . $dataLama['pp'];
                        if (file_exists($oldPath)) unlink($oldPath);
                    }
                    $fotoBaru = $newName;
                }
            }
        }

        // 🟩 simpan data baru ke database
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

        header("Location: index.php?action=profile-pegawai");
        exit;
    }
    // Crud Section Start
    public function listPegawai() {
        Middleware::requirerole(['admin']);
        $data = $this->model->getAllPegawai();
        require_once __DIR__ . '/../../App/Views/Pegawai/Admin/pegawai-index.php';
    }

    // Form tambah pegawai
    public function createeuser() {
        Middleware::requirerole(['admin']);
        require_once __DIR__ . '/../../App/Views/Pegawai/Admin/pegawai-create.php';
    }

    // Simpan pegawai baru
    public function storePegawai() {
        Middleware::requirerole(['admin']);

        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];

        $this->model->insertPegawai($nama, $username, $password, $role);
        header("Location: index.php?action=store");
        exit;
    }

    // Form edit pegawai
    public function editPegawai() {
        Middleware::requirerole(['admin']);
        $id = $_GET['id'];
        $data = $this->model->getPegawaiById($id);
        require_once __DIR__ . '/../../App/Views/Pegawai/Admin/pegawai-edit.php';
    }

    // Update pegawai
    public function updatePegawai() {
        Middleware::requirerole(['admin']);

        $id = $_POST['id_user'];
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $role = $_POST['role'];
        $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

        $this->model->updateDataPegawai($id, $nama, $username, $role, $password);
        header("Location: index.php?action=list-pegawai");
        exit;
    }

    // Hapus pegawai
    public function deletePegawai() {
        Middleware::requirerole(['admin']);
        $id = $_GET['id'];
        $this->model->deletePegawai($id);
        header("Location: index.php?action=list-pegawai");
        exit;
    }
}
?>