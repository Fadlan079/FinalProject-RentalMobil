<?php
require_once __DIR__ . '/../Models/mobil.php';

class MOBILController{
    private $model;

    public function __construct() {
        $this->model = new Mobil();
    }

    // public function index(){
    //     $data_mobil =  $this->Model->SelectMobil();
    //     include __DIR__ . "/../Views/Admin/mobil-select.php";
    // }

    // public function Insert(){
    //     if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //         $this->Model->InsertMobil(
    //             $_POST['merek'],
    //             $_POST['model'],
    //             $_POST['tahun'],
    //             $_POST['harga_sewa'],
    //             $_POST['status']
    //         );

    //         header("Location: index.php");
    //         exit;
    //     }
    //     include __DIR__ . '/../Views/Admin/mobil-insert.php';
    // }

    // public function edit($id_mobil){
    //     if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //         $this->Model->UpdateMobil(
    //             $id_mobil,
    //             $_POST['merek'],
    //             $_POST['model'],
    //             $_POST['tahun'],
    //             $_POST['harga_sewa'],
    //             $_POST['status'] 
    //         );

    //         header("Location: index.php");
    //         exit;
    //     }else{
    //         $mobil = $this->Model->SelectMobil();
    //     }

    //     $filtered = array_filter($mobil, fn($s) => $s['id_mobil'] == $id_mobil);
    //     $detail = array_values($filtered)[0];
    //     include __DIR__ . '/../Views/Admin/mobil-update.php';
    // }

    // public function delete($id_mobil){
    //     $this->Model->DeleteMobil($id_mobil);

    //     header("Location: index.php");
    // }
}
?>