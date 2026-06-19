<?php
require_once __DIR__ . '/../Middleware/middleware.php';
require_once __DIR__ . '/../Models/pegawai.php';
require_once __DIR__ . '/../Models/mobil.php';
require_once __DIR__ . '/../Models/tipemobil.php';
require_once __DIR__ . '/../Models/transaksi.php';
require_once __DIR__ . '/../Models/user.php';
require_once __DIR__ . '/../Models/pelanggan.php';

class PEGAWAIController {
    /** @var Pegawai */
    private $model;
    /** @var Mobil */
    private $mobilmodel;
    /** @var Tipemobil */
    private $tipemodel;
    /** @var Transaksi */
    private $transaksimodel;
    /** @var User */
    private $usermodel;
    /** @var Pelanggan */
    private $pelangganmodel;

    public function __construct() {
        $this->model          = new Pegawai();
        $this->mobilmodel     = new Mobil();
        $this->tipemodel      = new Tipemobil();
        $this->transaksimodel = new Transaksi();
        $this->usermodel      = new User();
        $this->pelangganmodel = new Pelanggan();
    }

    public function index() {
        Middleware::requirerole(['admin', 'customer service']);

        $keyword    = $_GET['keyword'] ?? '';
        $data_mobil = !empty($keyword)
            ? $this->mobilmodel->searchmobil($keyword)
            : $this->mobilmodel->GetAllMobilWithTipe();

        $allMobil = $this->mobilmodel->GetAllMobilWithTipe();
        $status   = ['ready' => 0, 'rent' => 0, 'maintenance' => 0];
        foreach ($allMobil as $m) {
            $s = strtolower($m['status']);
            if (isset($status[$s])) $status[$s]++;
        }
        $jumlahmobil = count($allMobil);

        $jumlahuser        = count($this->usermodel->Selectuser() ?? []);
        $semuaTransaksi    = $this->transaksimodel->getAllForDashboard();
        $transaksiaktif    = count(array_filter($semuaTransaksi, fn($t) => $t['status'] === 'berjalan'));
        $bulanIni          = date('Y-m');
        $pendapatanbulanini = array_sum(array_map(
            fn($t) => $t['status'] === 'selesai' && str_starts_with($t['tgl_sewa'], $bulanIni) ? (float)$t['total_bayar'] : 0,
            $semuaTransaksi
        ));
        $datatransaksi = array_slice($semuaTransaksi, 0, 5);

        include __DIR__ . '/../Views/Pegawai/index.php';
    }

    // ---- Data Mobil ----
    public function dataMobil() {
        Middleware::requirerole(['admin']);
        $keyword    = $_GET['keyword'] ?? '';
        $data_mobil = !empty($keyword)
            ? $this->mobilmodel->searchmobil($keyword)
            : $this->mobilmodel->GetAllMobilWithTipe();
        include __DIR__ . '/../Views/Pegawai/data-mobil.php';
    }

    // ---- Data Pegawai ----
    public function dataPegawai() {
        Middleware::requirerole(['admin']);
        // Join pegawai with user to get email
        $pegawaiRaw  = $this->model->Selectpegawai();
        $users        = $this->usermodel->Selectuser();
        $userMap      = [];
        foreach ($users as $u) { $userMap[$u['id_user']] = $u; }
        $data_pegawai = array_map(function($p) use ($userMap) {
            $p['email'] = $userMap[$p['id_user']]['email'] ?? '';
            return $p;
        }, $pegawaiRaw);
        include __DIR__ . '/../Views/Pegawai/data-pegawai.php';
    }

    // ---- Store Pegawai Baru ----
    public function storePegawaiNew() {
        Middleware::requirerole(['admin']);
        $email   = trim($_POST['email']   ?? '');
        $password= trim($_POST['password'] ?? '');
        $jk      = trim($_POST['jk']      ?? 'L');
        $jabatan = trim($_POST['jabatan'] ?? 'admin');
        $nama    = trim($_POST['nama']    ?? '');

        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Email dan password wajib diisi!';
            header("Location: index.php?action=data-pegawai");
            exit;
        }

        $userId = $this->usermodel->Insertuser($email, $password, $jk, 'pegawai');
        if ($userId) {
            $this->model->Insertpegawai($userId, $nama, null, null, null, null, null, null, null, null, null, null, $jabatan);
        }

        $_SESSION['success'] = 'Pegawai berhasil ditambahkan!';
        header("Location: index.php?action=data-pegawai");
        exit;
    }

    // ---- Data Pelanggan ----
    public function dataPelanggan() {
        Middleware::requirerole(['admin', 'customer service']);
        $keyword        = $_GET['keyword'] ?? '';
        $users          = $this->usermodel->Selectuser();
        $pelangganRaw   = $this->pelangganmodel->Selectpelanggan();

        // Build pelanggan map keyed by id_user
        $pelMap = [];
        foreach ($pelangganRaw as $pel) { $pelMap[$pel['id_user']] = $pel; }

        // Only show pelanggan role users
        $data_pelanggan = [];
        $bulanIni       = date('Y-m');
        $newThisMonth   = 0;
        foreach ($users as $u) {
            if (($u['role'] ?? '') !== 'pelanggan') continue;
            $p = $pelMap[$u['id_user']] ?? [];
            $row = array_merge(['email' => $u['email'], 'jk' => $u['jk'], 'id_user' => $u['id_user']], $p);
            if (!empty($keyword)) {
                $search = strtolower($keyword);
                if (!str_contains(strtolower($row['email']), $search) && !str_contains(strtolower($row['nama'] ?? ''), $search)) continue;
            }
            $data_pelanggan[] = $row;
        }

        include __DIR__ . '/../Views/Pegawai/data-pelanggan.php';
    }

    // ---- Data Transaksi ----
    public function dataTransaksi() {
        Middleware::requirerole(['admin', 'customer service']);
        $semuaTransaksi = $this->transaksimodel->getAllForDashboard();
        $statusFilter   = $_GET['status_filter'] ?? '';
        if (!empty($statusFilter)) {
            $semuaTransaksi = array_filter($semuaTransaksi, fn($t) => strtolower($t['status']) === $statusFilter);
        }
        include __DIR__ . '/../Views/Pegawai/data-transaksi.php';
    }

    // ---- Laporan ----
    public function laporan() {
        Middleware::requirerole(['admin']);
        $semuaTransaksi = $this->transaksimodel->getAllForDashboard();
        include __DIR__ . '/../Views/Pegawai/laporan.php';
    }


    public function Create(){
        include __DIR__ . '/../Views/components/Pegawai/tambah-mobil.php';
    }

    public function Store(){

    }

    public function editMobil() {
        Middleware::requirerole(['admin']);
        $id = $_GET['id'] ?? null;
        if (!$id) { header("Location: index.php?action=data-mobil"); exit; }
        $mobil = $this->mobilmodel->detailmobil($id);
        $tipes = $this->tipemodel->GetAllTipeMobil();
        include __DIR__ . '/../Views/Pegawai/edit-mobil.php';
    }

    public function updateMobil() {
        Middleware::requirerole(['admin']);
        $id = $_POST['id_mobil'] ?? null;
        if ($id) {
            $this->mobilmodel->UpdateMobil(
                $id,
                $_POST['tahun'] ?? '',
                $_POST['warna'] ?? '',
                $_POST['noplat'] ?? '',
                $_POST['nomesin'] ?? '',
                $_POST['norangka'] ?? '',
                $_POST['status'] ?? 'ready',
                $_POST['id_tipe'] ?? ''
            );
            $_SESSION['success'] = 'Data mobil berhasil diperbarui!';
        }
        header("Location: index.php?action=data-mobil");
        exit;
    }

    public function deleteMobil() {
        Middleware::requirerole(['admin']);
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->mobilmodel->DeleteMobil($id);
            $_SESSION['success'] = 'Data mobil berhasil dihapus!';
        }
        header("Location: index.php?action=data-mobil");
        exit;
    }

    public function storeProfile() {
        Middleware::requirerole(['admin', 'cs']);

        $id_user = $_SESSION['user']['id_user'];
        $dataLama = $this->model->getPegawaiByUserId($id_user);

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

        require_once __DIR__ . '/../Models/user.php';
        $userModel = new User(); 
        $pegawaiList = $userModel->Selectuser();  // ambil semua data pegawai
        
        // require_once __DIR__ . '/../Views/Pegawai/list.php';
    }

    public function createPegawai() {
        // Middleware::requirerole(['admin']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../Models/user.php';
            $userModel = new User();
            $userModel->Insertuser($_POST['email'], $_POST['password'], $_POST['jk'], $_POST['role']);
            header("Location: index.php");
            exit;
        }

        // require_once __DIR__ . '/../Views/Pegawai/create.php';
    }

    public function storePegawai() {
        // Middleware::requirerole(['admin']);

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $role = trim($_POST['role']);
        $jk = trim($_POST['jk'] ?? 'L');

        if (empty($email) || empty($password) || empty($role)) {
            $_SESSION['error'] = 'Semua field wajib diisi!';
            header("Location: index.php?action=createPegawai");
            exit;
        }

        require_once __DIR__ . '/../Models/user.php';
        $userModel = new User();
        $userModel->Insertuser($email, $password, $jk, $role);

        $_SESSION['success'] = 'Pegawai berhasil ditambahkan.';
        header("Location: index.php?action=listPegawai");
        exit;
    }

    public function editPegawai() {
        Middleware::requirerole(['admin']);
        $id = $_GET['id'] ?? null;
        if (!$id) { header("Location: index.php?action=data-pegawai"); exit; }
        
        // Dapatkan data pegawai
        $pegawaiRaw = $this->model->Selectpegawai();
        $detail = null;
        foreach ($pegawaiRaw as $p) {
            if ($p['id_pegawai'] == $id) { $detail = $p; break; }
        }
        
        if (!$detail) { header("Location: index.php?action=data-pegawai"); exit; }
        
        // Dapatkan user (email)
        $users = $this->usermodel->Selectuser();
        foreach ($users as $u) {
            if ($u['id_user'] == $detail['id_user']) {
                $detail['email'] = $u['email'];
                break;
            }
        }
        
        include __DIR__ . '/../Views/Pegawai/edit-pegawai.php';
    }

    public function updatePegawai() {
        Middleware::requirerole(['admin']);
        $id_pegawai = $_POST['id_pegawai'] ?? null;
        $id_user = $_POST['id_user'] ?? null;
        
        if ($id_pegawai && $id_user) {
            // Update nama, jabatan, telp dll
            $this->model->Updatepegawai(
                $id_user,
                $_POST['nama'] ?? '',
                null, null, null, null, null, null, null,
                $_POST['telp'] ?? '',
                null, null
            );
            
            // Note: untuk update email/password di user perlu UserModel::UpdateUser tapi belum ada,
            // jadi kita minimal update nama dan telp dan jabatan.
            // Untuk merubah jabatan: updatePegawai params agak panjang
            
            $_SESSION['success'] = 'Data pegawai berhasil diperbarui!';
        }
        header("Location: index.php?action=data-pegawai");
        exit;
    }

    public function deletePegawai() {
        // Middleware::requirerole(['admin']);
        $id = $_GET['id'] ?? null;
        require_once __DIR__ . '/../Models/user.php';
        $userModel = new User();
        $userModel->DeleteUser($id);
        $_SESSION['success'] = 'Pegawai berhasil dihapus.';
        header("Location: index.php?action=listPegawai");
        exit;
    }
}
?>
