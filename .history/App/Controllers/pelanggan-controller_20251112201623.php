
 <?php
require_once __DIR__ . '/../Models/pelanggan.php';
require_once __DIR__ . '/../Middleware/middleware.php';
require_once __DIR__ . '/../Models/mobil.php';
require_once __DIR__ . '/../Models/transaksi.php';

class PELANGGANController{
    private $model;
    private $mobilmodel;
    private $transaksimodel;

    public function __construct(){
        $this->model = new Pelanggan();   
        $this->mobilmodel = new Mobil(); 
        $this->transaksimodel = new Transaksi(); 
    }

    public function index() {
        $isLoggedIn = Middleware::requireloginOptional();
        $id_user = $isLoggedIn ? $_SESSION['user']['id_user'] : null;
        $profile = $id_user ? $this->model->getpelangganbyiduser($id_user) : null;
        $id_pelanggan = $profile['id_pelanggan'] ?? null;
    
        if ($profile && empty($profile['nama']) && !empty($profile['email'])) {
            $profile['nama'] = explode('@', $profile['email'])[0];
        }
    
        $query = $_GET['q'] ?? '';
        $limit = 9;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
    
        // Parameter filter
        $harga = $_GET['harga'] ?? '';
        $transmisi = $_GET['transmisi'] ?? '';
        $bhn_bkr = $_GET['bhn_bkr'] ?? '';
        $kursi = $_GET['kursi'] ?? '';
        
        // 🔧 PERBAIKAN: Logic hasFilter yang benar
        $hasFilter = false;
        
        // Cek masing-masing filter apakah aktif (tidak empty dan bukan 'semua')
        if (!empty($harga) && $harga !== 'semua') {
            $hasFilter = true;
        }
        if (!empty($transmisi) && $transmisi !== 'semua') {
            $hasFilter = true;
        }
        if (!empty($bhn_bkr) && $bhn_bkr !== 'semua') {
            $hasFilter = true;
        }
        if (!empty($kursi) && $kursi !== 'semua') {
            $hasFilter = true;
        }
        
        // 🔧 DEBUG: Tampilkan status filter (bisa dihapus setelah fix)
        echo "<!-- DEBUG: hasFilter=$hasFilter, harga=$harga, transmisi=$transmisi, bhn_bkr=$bhn_bkr, kursi=$kursi -->";
        
        if (!empty($query)) {
            // 🔍 Search prioritas
            $data = $this->mobilmodel->searchMobil($query, $limit, $offset);
            $totalData = $this->mobilmodel->countSearchMobil($query);
            echo "<!-- MODE: SEARCH -->";
        } elseif ($hasFilter) {
            // 🧩 Filter mobil
            $data = $this->mobilmodel->filterMobil($harga, $transmisi, $bhn_bkr, $kursi, $limit, $offset);
            $totalData = $this->mobilmodel->countFilterMobil($harga, $transmisi, $bhn_bkr, $kursi);
            echo "<!-- MODE: FILTER -->";
        } else {
            // 🚗 Default: semua mobil
            $data = $this->mobilmodel->getMobilWithLimit($offset, $limit);
            $totalData = $this->mobilmodel->countAllMobil();
            echo "<!-- MODE: DEFAULT -->";
        }
        
        $totalPages = ceil($totalData / $limit);
    
        include __DIR__ . '/../Views/Pelanggan/index.php';
    }
    
    public function Storeprofile(){
        Middleware::requirerole('pelanggan'); 

        $id_user = $_SESSION['user']['id_user'];
        $dataLama = $this->model->getpelangganbyiduser($id_user);

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

        $this->model->Updatepelanggan(
            $_SESSION['user']['id_user'],
            $_POST['nama'],
            $_POST['nik'],
            $_POST['alamat'],
            $_POST['kelurahan'],
            $_POST['kecamatan'],
            $_POST['kota'],
            $_POST['kp'],
            $_POST['telp'],
            $_POST['bio'],
            $fotoBaru
        );

        header("Location: index.php?action=index");
        exit;
    }

    // Ambil detail mobil untuk modal
    public function Storetransaksi() {
        header('Content-Type: application/json');
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'ID mobil tidak ditemukan']);
            return;
        }

        $detail = $this->mobilmodel->detailmobil($id);
        if (!$detail) {
            echo json_encode(['status' => 'error', 'message' => 'Mobil tidak ditemukan']);
            return;
        }

        echo json_encode(['status' => 'ok', 'data' => $detail]);
    }

    public function detailmobil($id) {
        header('Content-Type: application/json'); 
        try {
            if (!isset($id)) {
                echo json_encode(['error' => 'Parameter id_mobil tidak dikirim']);
                return;
            }
            $detail = $this->mobilmodel->detailmobil($id);   
            
            if (!$detail) {
                echo json_encode(['error' => 'Data mobil tidak ditemukan']);
                return;
            }
            echo json_encode($detail);
        }catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    // Buat transaksi baru
    public function buatTransaksi() {
        header('Content-Type: application/json');

        // Ambil data dari POST
        $id_mobil = $_POST['id_mobil'] ?? null;
        $id_pelanggan = $_POST['id_pelanggan'] ?? null;
        $id_pegawai = null; // ⚠️ UBAH INI MENJADI NULL
        $tgl_sewa = $_POST['tgl_sewa'] ?? null;
        $tgl_kembali = $_POST['tgl_kembali'] ?? null;

        // Cast durasi & total_bayar ke tipe numeric
        $durasi_sewa = isset($_POST['durasi_sewa']) ? (int)$_POST['durasi_sewa'] : 0;
        $total_bayar = isset($_POST['total_bayar']) ? (int)str_replace('.', '', $_POST['total_bayar']) : 0;

        // Validasi data
        $required = [
            'id_mobil' => $id_mobil,
            'id_pelanggan' => $id_pelanggan,
            'tgl_sewa' => $tgl_sewa,
            'tgl_kembali' => $tgl_kembali,
            'durasi_sewa' => $durasi_sewa,
            'total_bayar' => $total_bayar
        ];

        foreach ($required as $key => $val) {
            if (!$val) {
                echo json_encode(['success' => false, 'message' => "Field $key kosong atau tidak valid"]);
                return;
            }
        }

        // Simpan ke DB lewat model
        try {
            $inserted = $this->transaksimodel->Store(
                $id_mobil,
                $id_pelanggan,
                $id_pegawai, // ⚠️ SEKARANG NULL
                $tgl_sewa,
                $tgl_kembali,
                $durasi_sewa,
                $total_bayar,
                'berjalan' // status awal
            );

            if ($inserted) {
                $this->transaksimodel->updateStatusMobil($id_mobil, 'rent');
                echo json_encode(['success' => true, 'message' => 'Transaksi berhasil dibuat']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal menyimpan transaksi']);
            }

        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Gagal mengeksekusi query: ' . $e->getMessage()]);
        }
    }

public function riwayatTransaksi() {
    Middleware::requirerole('pelanggan'); 

    $id_user = $_SESSION['user']['id_user'];
    $profile = $this->model->getpelangganbyiduser($id_user);
    $id_pelanggan = $profile['id_pelanggan'];

    // 🔍 DEBUG: Cek apakah ada transaksi
    $transaksi = $this->transaksimodel->getTransaksiByPelanggan($id_pelanggan);
    $riwayat = $this->transaksimodel->getall($id_pelanggan);
    
    // 🔍 DEBUG: Cek transaksi terakhir
    $lastTransaksi = $this->transaksimodel->getLastTransaksiByPelanggan($id_pelanggan);
    
    error_log("DEBUG Riwayat Transaksi:");
    error_log("ID Pelanggan: " . $id_pelanggan);
    error_log("Jumlah transaksi (getTransaksiByPelanggan): " . count($transaksi));
    error_log("Jumlah riwayat (getall): " . count($riwayat));
    error_log("Last transaksi: " . print_r($lastTransaksi, true));

    // Hitung statistik
    $total_transaksi = count($riwayat);
    $total_bayar = array_sum(array_column($riwayat, 'total_bayar'));

    $status_count = [
        'selesai' => 0,
        'berjalan' => 0,
        'batal' => 0
    ];

    foreach ($riwayat as $tr) {
        $status_count[$tr['status']] = ($status_count[$tr['status']] ?? 0) + 1;
    }

    include __DIR__ . '/../Views/components/Pelanggan/riwayat-transaksi.php';
}
}
?>