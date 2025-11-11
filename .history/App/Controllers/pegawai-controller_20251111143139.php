<?php
require_once __DIR__ . '/../Models/pegawai.php';
require_once __DIR__ . '/../Middleware/middleware.php';

class PEGAWAIController{
    private $model;

    public function __construct(){
        $this->model = new Pegawai();
    }

    public function Showprofile(){
        Middleware::requirerole('pegawai');
        $id_user = $_SESSION['user']['id_user'];
        $data = $this->model->getpegawaibyiduser($id_user); 

        require_once __DIR__ . '/../../App/Views/Pegawai/profile-pegawai.php';
    }

    public function Storeprofile(){
        Middleware::requirerole('pegawai');

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
    
        $this->model->Updatepegawai(
            $id_user = $_SESSION['user']['id_user'],
            $nama = $_POST['nama'],
            $tmpt_lhr = $_POST['tmpt_lhr'],
            $tgl_lhr = !empty($_POST['tgl_lhr']) ? $_POST['tgl_lhr'] : null,
            $alamat = $_POST['alamat'],
            $kelurahan = $_POST['kelurahan'],
            $kecamatan = $_POST['kecamatan'],
            $kabupaten = $_POST['kabupaten'],
            $kp = $_POST['kp'],
            $telp = $_POST['telp'],
            $bio = $_POST['bio'],
            $fotoBaru
        );

       

        header("Location: index.php?action=profile-pegawai");
        exit;
    }
}
?>