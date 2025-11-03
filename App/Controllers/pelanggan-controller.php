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
        $query = $_GET['q'] ?? '';
        $limit = 9;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

    if (!empty($query)) {
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


    public function Showprofile(){
        Middleware::requirerole('pelanggan');  
        $id_user = $_SESSION['user']['id_user'];
        $data = $this->model->getpelangganbyiduser($id_user); 

        require_once __DIR__ . '/../../App/Views/Pelanggan/profile-pelanggan.php';
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
            $kabkota = $_POST['kabkota'],
            $kp = $_POST['kp'],
            $telp = $_POST['telp'],
            $bio = $_POST['bio'],
            $fotoBaru
        );

        header("Location: index.php?action=profile-pelanggan");
        exit;
    }

    public function detailmobil(){
        include __DIR__ . '/../Views/Pelanggan/detil-mobil.php';
    }
}
?>