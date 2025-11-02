<?php
require_once __DIR__ . '/../../Config/Database.php';

class Tipemobil{
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function Inserttipemobil($merk, $tipe, $model, $jenis, $silinder, $bhn_bkr) {
        try{
            $sql = "INSERT INTO tipemobil(merk, tipe, model, jenis, silinder, bhn_bkr) VALUES (:merk, :tipe, :model, :jenis, :silinder, :bhn_bkr)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":merk", $merk);
            $stmt->bindParam(":tipe", $tipe);
            $stmt->bindParam(":model", $model);
            $stmt->bindParam(":jenis", $jenis);
            $stmt->bindParam(":silinder", $silinder);
            $stmt->bindParam(":bhn_bkr", $bhn_bkr);
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Data Gagal Di Tambahkan :" .$e->getMessage();
        }
    }

    public function Selecttipemobil() {
        try{
            $sql = "SELECT * FROM tipemobil";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Gagal Di Tampilkan :" .$e->getMessage();
        }
    }

    public function Updatetipemobil($id_tipe,$merk, $tipe, $model, $jenis, $silinder, $bhn_bkr){
        try{
            $sql = "UPDATE tipemobil SET merk=:merk,tipe=:tipe,model=:model,jenis=:jenis,silinder=:silinder,bhn_bkr=:bhn_bkr WHERE id_tipe = :id_tipe";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id_tipe", $id_tipe);
            $stmt->bindParam(":merk", $merk);
            $stmt->bindParam(":tipe", $tipe);
            $stmt->bindParam(":model", $model);
            $stmt->bindParam(":jenis", $jenis);
            $stmt->bindParam(":silinder", $silinder);
            $stmt->bindParam(":bhn_bkr", $bhn_bkr);
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Data Gagal diPerbarui :" .$e->getMessage();
        }
    }

    public function Deletetipemobil($id_tipe) {
        try{
            $sql = "DELETE FROM tipemobil WHERE id_tipe = :id_tipe";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(['id_tipe' =>$id_tipe]);
        }catch(PDOException $e){
            echo "Data Gagal di Hapus :" .$e->getMessage();
        }
    }
}

// $tipemobil = new Tipemobil();
// $tipemobil->Inserttipemobil('test2','testing2','test2','testing',2,'pertamax');
// $tipemobil->Updatetipemobil(1,'Test1','Testing1','Test1','Test',4,'solar');
// $tipemobil->Deletetipemobil(2);
// $data = $tipemobil->searchmobil('pertamax');
// var_dump($data);
// $data = $tipemobil->Selecttipemobil();
// var_dump($data);
?>