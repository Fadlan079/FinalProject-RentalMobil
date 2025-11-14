<?php
require_once __DIR__ . '/../Models/pelanggan.php';
require_once __DIR__ . '/../Middleware/middleware.php';
require_once __DIR__ . '/../Models/mobil.php';
require_once __DIR__ . '/../Models/transaksi.php';

class PELANGGANController {
    private $model;
    private $mobilmodel;
    private $transaksimodel;

    public function __construct() {
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

        // Filter parameters
        $harga = $_GET['harga'] ?? '';
        $transmisi = $_GET['transmisi'] ?? '';
        $bhn_bkr = $_GET['bhn_bkr'] ?? '';
        $kursi = $_GET['kursi'] ?? '';

        $hasFilter = false;
        if (!empty($harga) && $harga !== 'semua') $hasFilter = true;
        if (!empty($transmisi) && $transmisi !== 'semua') $hasFilter = true;
        if (!empty($bhn_bkr) && $bhn_bkr !== 'semua') $hasFilter = true;
        if (!empty($kursi) && $kursi !== 'semua') $hasFilter = true;

        if (!empty($query)) {
            $data = $this->mobilmodel->searchMobil($query, $limit, $offset);
            $totalData = $this->mobilmodel->countSearchMobil($query);
        } elseif ($hasFilter) {
            $data = $this->mobilmodel->filterMobil($harga, $transmisi, $bhn_bkr, $kursi, $limit, $offset);
            $totalData = $this->mobilmodel->countFilterMobil($harga, $transmisi, $bhn_bkr, $kursi);
        } else {
            $data = $this->mobilmodel->getMobilWithLimit($offset, $limit);
            $totalData = $this->mobilmodel->countAllMobil();
        }

        $totalPages = ceil($totalData / $limit);
        include __DIR__ . '/../Views/Pelanggan/index.php';
    }

    public function Storeprofile() {
        Middleware::requirerole('pelanggan'); 

        $id_user = $_SESSION['user']['id_user'];
        $dataLama = $this->model->getpelangganbyiduser($id_user);

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

    public function detailmobil($id) {
        header('Content-Type: application/json'); 
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
    }

    public function Storetransaksi() {
        header('Content-Type: application/json');
        ob_clean();

        $id_mobil = $_POST['id_mobil'] ?? null;
        $id_pelanggan = $_POST['id_pelanggan'] ?? null; 
        $id_pegawai = $_POST['id_pegawai'] ?? null;
        $tgl_sewa = isset($_POST['tgl_sewa']) ? date('Y-m-d H:i:s', strtotime($_POST['tgl_sewa'])) : null;
        $tgl_kembali = isset($_POST['tgl_kembali']) ? date('Y-m-d H:i:s', strtotime($_POST['tgl_kembali'])) : null;
        $durasi_sewa = intval($_POST['durasi_sewa'] ?? 0);
        $total_bayar = floatval($_POST['total_bayar'] ?? 0);
        $status = 'berjalan';

        if (!$id_mobil || !$id_pelanggan || !$tgl_sewa || !$tgl_kembali || $durasi_sewa <= 0 || $total_bayar <= 0) {
            echo json_encode(['error' => 'Data transaksi tidak lengkap atau tidak valid']);
            return;
        }

        // Cek ketersediaan mobil
        $isAvailable = $this->transaksimodel->checkMobilAvailability($id_mobil, $tgl_sewa, $tgl_kembali);
        if (!$isAvailable) {
            echo json_encode(['error' => 'Mobil tidak tersedia pada tanggal yang dipilih']);
            return;
        }

        $insert = $this->transaksimodel->Store($id_mobil, $id_pelanggan, $id_pegawai, $tgl_sewa, $tgl_kembali, $durasi_sewa, $total_bayar, $status);

        if ($insert) {
            $this->transaksimodel->updateStatusMobil($id_mobil, 'rent'); 
            echo json_encode(['success' => 'Transaksi berhasil disimpan']);
        } else {
            echo json_encode(['error' => 'Gagal menyimpan transaksi']);
        }
        exit;
    }

    public function riwayatTransaksi() {
        Middleware::requirerole('pelanggan'); 

        $id_user = $_SESSION['user']['id_user'];
        $profile = $this->model->getpelangganbyiduser($id_user);
        $id_pelanggan = $profile['id_pelanggan'];

        $riwayat = $this->transaksimodel->getall($id_pelanggan);

        $total_transaksi = count($riwayat);
        $total_bayar = array_sum(array_column($riwayat, 'total_bayar'));

        $status_count = [
            'selesai'  => 0,
            'berjalan' => 0,
            'batal'    => 0
        ];

        foreach ($riwayat as $tr) {
            $status = strtolower($tr['status']);
            if (isset($status_count[$status])) {
                $status_count[$status]++;
            }
        }

        include __DIR__ . '/../Views/components/Pelanggan/riwayat-transaksi.php';
    }

    public function getPesananAjax() {
        Middleware::requirerole('pelanggan');
        $id_user = $_SESSION['user']['id_user'];
        $profile = $this->model->getpelangganbyiduser($id_user);
        $id_pelanggan = $profile['id_pelanggan'];
        $riwayat = $this->transaksimodel->getall($id_pelanggan);
        $pesanan = array_filter($riwayat, fn($tr) => $tr['status'] === 'berjalan');
        echo json_encode(array_values($pesanan));
        exit;
    }

    public function getRiwayatAjax() {
        Middleware::requirerole('pelanggan');
        $id_user = $_SESSION['user']['id_user'];
        $profile = $this->model->getpelangganbyiduser($id_user);
        $id_pelanggan = $profile['id_pelanggan'];
        $riwayat = $this->transaksimodel->getall($id_pelanggan);
        $riwayat_selesai = array_filter($riwayat, fn($tr) => $tr['status'] === 'selesai');
        echo json_encode(array_values($riwayat_selesai));
        exit;
    }

    public function updatePesananAjax() {
        Middleware::requirerole('pelanggan');
        header('Content-Type: application/json');

        $id_transaksi = $_POST['id_transaksi'] ?? null;
        $status = $_POST['status'] ?? null;

        if (!$id_transaksi || !$status) {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
            return;
        }

        $result = $this->transaksimodel->updateStatusTransaksi($id_transaksi, $status);

        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Status pesanan diperbarui' : 'Gagal memperbarui'
        ]);
    }

    // === METHOD BARU YANG DITAMBAHKAN ===

    public function updatePesananFullAjax() {
        Middleware::requirerole('pelanggan');
        header('Content-Type: application/json');

        $id_transaksi = $_POST['id_transaksi'] ?? null;
        $tgl_kembali = $_POST['tgl_kembali'] ?? null;
        $durasi_sewa = $_POST['durasi_sewa'] ?? null;
        $total_bayar = $_POST['total_bayar'] ?? null;

        if (!$id_transaksi || !$tgl_kembali || !$durasi_sewa || !$total_bayar) {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
            return;
        }

        // Format tanggal kembali dengan waktu
        $tgl_kembali_full = date('Y-m-d H:i:s', strtotime($tgl_kembali . ' 23:59:59'));

        // Dapatkan data transaksi lama untuk mendapatkan id_mobil dan tgl_sewa
        $transaksi_lama = $this->transaksimodel->getTransaksiDetailById($id_transaksi);
        if (!$transaksi_lama) {
            echo json_encode(['success' => false, 'message' => 'Transaksi tidak ditemukan']);
            return;
        }

        // Cek ketersediaan mobil (kecuali untuk transaksi ini)
        $isAvailable = $this->transaksimodel->checkMobilAvailability(
            $transaksi_lama['id_mobil'], 
            $transaksi_lama['tgl_sewa'], 
            $tgl_kembali_full, 
            $id_transaksi
        );

        if (!$isAvailable) {
            echo json_encode(['success' => false, 'message' => 'Mobil tidak tersedia pada tanggal yang dipilih']);
            return;
        }

        $result = $this->transaksimodel->updateTransaksi(
            $id_transaksi, 
            $tgl_kembali_full, 
            $durasi_sewa, 
            $total_bayar, 
            'berjalan'
        );

        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Pesanan berhasil diupdate' : 'Gagal mengupdate pesanan'
        ]);
    }

    public function getDetailPesananAjax() {
        Middleware::requirerole('pelanggan');
        header('Content-Type: application/json');

        $id_transaksi = $_GET['id_transaksi'] ?? null;
        
        if (!$id_transaksi) {
            echo json_encode(['success' => false, 'message' => 'ID transaksi tidak valid']);
            return;
        }

        $detail = $this->transaksimodel->getTransaksiDetailById($id_transaksi);
        
        if ($detail) {
            // Format tanggal untuk form input
            $detail['tgl_kembali_form'] = date('Y-m-d', strtotime($detail['tgl_kembali']));
            echo json_encode(['success' => true, 'data' => $detail]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
        }
    }

    public function deletePesananAjax() {
        Middleware::requirerole('pelanggan');
        header('Content-Type: application/json');
    
        $id_transaksi = $_POST['id_transaksi'] ?? null;
    
        if (!$id_transaksi) {
            echo json_encode(['success' => false, 'message' => 'ID tidak ditemukan']);
            return;
        }

        // Dapatkan data transaksi untuk mendapatkan id_mobil
        $transaksi = $this->transaksimodel->getTransaksiById($id_transaksi);
        if ($transaksi) {
            // Update status mobil kembali ke 'tersedia'
            $this->transaksimodel->updateStatusMobil($transaksi['id_mobil'], 'tersedia');
        }
    
        $result = $this->transaksimodel->deleteTransaksi($id_transaksi);
    
        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Pesanan dihapus' : 'Gagal menghapus'
        ]);
    }

    // Method untuk handle pembatalan pesanan (soft delete)
    public function batalkanPesananAjax() {
        Middleware::requirerole('pelanggan');
        header('Content-Type: application/json');
    
        $id_transaksi = $_POST['id_transaksi'] ?? null;
    
        if (!$id_transaksi) {
            echo json_encode(['success' => false, 'message' => 'ID tidak ditemukan']);
            return;
        }

        // Dapatkan data transaksi untuk mendapatkan id_mobil
        $transaksi = $this->transaksimodel->getTransaksiById($id_transaksi);
        if ($transaksi) {
            // Update status mobil kembali ke 'tersedia'
            $this->transaksimodel->updateStatusMobil($transaksi['id_mobil'], 'tersedia');
        }
    
        $result = $this->transaksimodel->updateStatusTransaksi($id_transaksi, 'batal');
        $result = $this->transaksimodel->updateStatusModel($id_transak, 'rent');
    
    
        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Pesanan dibatalkan' : 'Gagal membatalkan pesanan'
        ]);
    }
}
?>