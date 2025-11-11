<?php
require_once __DIR__ . '/../Models/pelanggan.php';
require_once __DIR__ . '/../Middleware/middleware.php';
require_once __DIR__ . '/../Models/mobil.php';

class PELANGGANController{
    private $model;
    private $mobilmodel;

    public function __construct(){
        $this->model = new Pelanggan();   
        $this->mobilmodel = new Mobil(); 
    }

    public function index() {
        Middleware::requirerole('pelanggan');  
        $id_user = $_SESSION['user']['id_user'];
        $profile = $this->model->getpelangganbyiduser($id_user); 

        $query = $_GET['q'] ?? '';
        $limit = 9;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $harga = $_GET['harga'] ?? null;
        $transmisi = $_GET['transmisi'] ?? null;
        $bhn_bkr = $_GET['bhn_bkr'] ?? null;
        $kursi = $_GET['kursi'] ?? null;

        $hasFilter = !empty($harga) || !empty($transmisi) || !empty($bhn_bkr) || !empty($kursi);

        if ($hasFilter) {
            $data = $this->mobilmodel->filterMobil($harga, $transmisi, $bhn_bkr, $kursi, $limit, $offset);
            $totalData = $this->mobilmodel->countFilterMobil($harga, $transmisi, $bhn_bkr, $kursi);
            $totalPages = ceil($totalData / $limit);
        } elseif (!empty($query)) {
            $data = $this->mobilmodel->searchmobil($query, $limit, $offset);
            $totalData = $this->mobilmodel->countSearchMobil($query);
            $totalPages = ceil($totalData / $limit);
        } else {
            $data = $this->mobilmodel->getMobilWithLimit($limit, $offset);
            $totalData = $this->mobilmodel->countAllMobil();
            $totalPages = ceil($totalData / $limit);
        }

        include __DIR__ . '/../../App/Views/Pelanggan/index.php';
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
            $id_user = $_SESSION['user']['id_user'],
            $nama = $_POST['nama'],
            $nik = $_POST['nik'],
            $alamat = $_POST['alamat'],
            $kelurahan = $_POST['kelurahan'],
            $kecamatan = $_POST['kecamatan'],
            $kabkota = $_POST['kota'],
            $kp = $_POST['kp'],
            $telp = $_POST['telp'],
            $bio = $_POST['bio'],
            $fotoBaru
        );

        header("Location: index.php?action=index");
        exit;
    }

    public function detailmobil($id){
        $detail = $this->mobilmodel->detailmobil($id);
        require_once __DIR__ . "/../Views/components/Pelanggan/detail-mobil.php";
    }
}
?>