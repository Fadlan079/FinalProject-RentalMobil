<?php
require_once __DIR__ . '/../Models/pegawai.php';
require_once __DIR__ . '/../Middleware/middleware.php';

class PEGAWAIController {
    private $model;

    public function __construct() {
        $this->model = new Pegawai();
    }

    // =====================================================
    // 🏠 LOGIKA DASHBOARD (Hanya arahkan ke view sesuai role)
    // =====================================================
    public function dashboard() {
        Middleware::requirerole(['admin', 'cs']); 

        $role = $_SESSION['user']['role'] ?? null;

        if ($role === 'admin') {
            $dataPegawai = $this->model->countPegawai(); // contoh logika tambahan
            $dataAktif = $this->model->countActivePegawai();
            require_once __DIR__ . '/../../App/Views/Pegawai/Admin/dashboard.php';
        } elseif ($role === 'cs') {
            $profile = $this->model->getpegawaibyiduser($_SESSION['user']['id_user']);
            require_once __DIR__ . '/../../App/Views/Pegawai/CS/dashboard.php';
        } else {
            http_response_code(403);
            echo "<h1 style='color:red; text-align:center;'>Akses Ditolak</h1>";
        }
    }

    // ==========================
    // 👤 PROFIL PEGAWAI
    // ==========================
    public function showProfile() {
        Middleware::requirerole(['admin', 'cs']);
        $id_user = $_SESSION['user']['id_user'];
        $data = $this->model->getpegawaibyiduser($id_user); 
        require_once __DIR__ . '/../../App/Views/Pegawai/profile-pegawai.php';
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
        Middleware::requireRole(['admin']); // hanya admin boleh lihat

        $pegawaiModel = new Pegawai(); // panggil model
         // ambil semua data pegawai
 // ambil semua data pegawai
         require_once __DIR__ . '/../../App/Views/components/Pegawai/Admin/list-pegawai.php';
}


    public function createPegawai() {
        // Middleware::requirerole(['admin']);
        require_once __DIR__ . '/../../App/Views/components/Pegawai/Admin/user-insert.php';
    }

    public function storePegawai() {
        Middleware::requirerole(['admin']);

        $nama = trim($_POST['nama']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $role = trim($_POST['role']);

        if (empty($nama) || empty($username) || empty($password) || empty($role)) {
            $_SESSION['error'] = 'Semua field wajib diisi!';
            header("Location: index.php?action=createPegawai");
            exit;
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $this->model->Insertpegawai($nama, $username, $hashed, $role);

        $_SESSION['success'] = 'Pegawai berhasil ditambahkan.';
        header("Location: index.php?action=listPegawai");
        exit;
    }

    public function editPegawai() {
        Middleware::requirerole(['admin']);
        $id = $_GET['id'] ?? null;
        $data = $this->model->getpegawaibyiduser($id);
        require_once __DIR__ . '/../../App/Views/Pegawai/Admin/pegawai-update.php';
    }

    public function updatePegawai() {
        Middleware::requirerole(['admin']);

        $id = $_POST['id_user'];
        $nama = trim($_POST['nama']);
        $username = trim($_POST['username']);
        $role = trim($_POST['role']);
        $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

        $this->model->updatePegawai($id, $nama, $username, $role, $password);
        $_SESSION['success'] = 'Data pegawai berhasil diperbarui.';
        header("Location: index.php?action=listPegawai");
        exit;
    }

    public function deletePegawai() {
        Middleware::requirerole(['admin']);
        $id = $_GET['id'] ?? null;
        $this->model->Deletepegawai($id);
        $_SESSION['success'] = 'Pegawai berhasil dihapus.';
        header("Location: index.php?action=listPegawai");
        exit;
    }
}
?>
