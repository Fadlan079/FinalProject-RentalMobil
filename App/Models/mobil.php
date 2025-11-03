<?php
require_once __DIR__ . '/../../Config/Database.php';

class Mobil{
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function InsertMobil($tahun, $warna, $noplat, $nomesin,$norangka,$status, $id_tipe) {
        try{
            $sql = "INSERT INTO mobil(tahun, warna, noplat, nomesin,norangka,status,id_tipe) VALUES (:tahun, :warna, :noplat, :nomesin,:norangka,:status,:id_tipe)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":tahun", $tahun);
            $stmt->bindParam(":warna", $warna);
            $stmt->bindParam(":noplat", $noplat);
            $stmt->bindParam(":nomesin", $nomesin);
            $stmt->bindParam(":norangka", $norangka);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":id_tipe", $id_tipe);
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Data Gagal Di Tambahkan :" .$e->getMessage();
        }
    }

    public function getspesifikasimobil(){
        try{
            $sql = "SELECT DISTINCT mobil.id_mobil,mobil.img,mobil.noplat,mobil.warna,mobil.status,tipemobil.merk,tipemobil.model,tipemobil.tipe,tipemobil.transmisi,tipemobil.harga,tipemobil.kursi,tipemobil.pintu FROM mobil JOIN tipemobil ON mobil.id_tipe = tipemobil.id_tipe";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Spesifikasi Gagal Di Tampilkan :" .$e->getMessage();
        }
    }

    public function getMobilWithLimit($limit, $offset) {
        $stmt = $this->pdo->prepare("SELECT DISTINCT mobil.id_mobil,mobil.img,mobil.noplat,mobil.warna,mobil.status,tipemobil.merk,tipemobil.model,tipemobil.tipe,tipemobil.transmisi,tipemobil.harga,tipemobil.kursi,tipemobil.pintu FROM mobil JOIN tipemobil ON mobil.id_tipe = tipemobil.id_tipe LIMIT :offset, :limit");
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAllMobil() {
        return $this->pdo->query("SELECT COUNT(*) FROM mobil")->fetchColumn();
    }

    public function searchmobil($keyword, $limit = null, $offset = null){
        try{
            $sql = "SELECT DISTINCT mobil.id_mobil,mobil.img,mobil.noplat,mobil.warna,mobil.status,tipemobil.merk,tipemobil.model,tipemobil.tipe,tipemobil.transmisi,tipemobil.harga,tipemobil.kursi,tipemobil.pintu FROM mobil JOIN tipemobil ON mobil.id_tipe = tipemobil.id_tipe 
                WHERE merk  LIKE :keyword
                   OR kursi LIKE :keyword
                   OR pintu LIKE :keyword
                   OR transmisi LIKE :keyword
                   OR tipe LIKE :keyword
                   OR model LIKE :keyword
                   OR warna LIKE :keyword
                   OR status LIKE :keyword";
            if (is_numeric($keyword)) {
                $sql .= " OR harga BETWEEN :minharga AND :maxharga";
            }
            
            if ($limit !== null && $offset !== null) {
                $sql .= " GROUP BY mobil.id_mobil LIMIT $offset, $limit";
            } else {
                $sql .= " GROUP BY mobil.id_mobil";
            }

            $stmt = $this->pdo->prepare($sql);
            $search = "%" . $keyword . "%";
            $stmt->bindParam(':keyword',$search);
            if (is_numeric($keyword)) {
                $minharga = $keyword * 0.9;
                $maxharga = $keyword * 1.1;
                $stmt->bindParam(':minharga', $minharga);
                $stmt->bindParam(':maxharga', $maxharga);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Gagal Di Temukan :" .$e->getMessage();
        }
    }

    public function countSearchMobil($keyword) {
        try {
            $sql = "SELECT COUNT(DISTINCT mobil.id_mobil) AS total
                    FROM mobil 
                    JOIN tipemobil ON mobil.id_tipe = tipemobil.id_tipe 
                    WHERE merk LIKE :keyword
                    OR kursi LIKE :keyword
                    OR pintu LIKE :keyword
                    OR transmisi LIKE :keyword
                    OR tipe LIKE :keyword
                    OR model LIKE :keyword
                    OR warna LIKE :keyword
                    OR status LIKE :keyword";

            if (is_numeric($keyword)) {
                $sql .= " OR harga BETWEEN :minharga AND :maxharga";
            }

            $stmt = $this->pdo->prepare($sql);
            $search = "%" . $keyword . "%";
            $stmt->bindParam(':keyword', $search);

            if (is_numeric($keyword)) {
                $minharga = $keyword * 0.7;
                $maxharga = $keyword * 1.3;
                $stmt->bindParam(':minharga', $minharga);
                $stmt->bindParam(':maxharga', $maxharga);
            }

            $stmt->execute();
            return $stmt->fetchColumn();

        } catch(PDOException $e) {
            echo "Gagal Menghitung Data: " . $e->getMessage();
        }
    }

    public function SelectMobil() {
        try{
            $sql = "SELECT * FROM mobil";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Gagal Di Tampilkan :" .$e->getMessage();
        }
    }

    public function UpdateMobil($id_mobil,$tahun, $warna, $noplat, $nomesin, $norangka, $status, $id_tipe ){
        try{
            $sql = "UPDATE mobil SET tahun=:tahun,warna=:warna,noplat=:noplat,nomesin=:nomesin,norangka=:norangka,status=:status,id_tipe=:id_tipe WHERE id_mobil = :id_mobil";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id_mobil", $id_mobil);
            $stmt->bindParam(":tahun", $tahun);
            $stmt->bindParam(":warna", $warna);
            $stmt->bindParam(":noplat", $noplat);
            $stmt->bindParam(":nomesin", $nomesin);
            $stmt->bindParam(":norangka", $norangka);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":id_tipe", $id_tipe);
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Data Gagal diPerbarui :" .$e->getMessage();
        }
    }

    public function DeleteMobil($id_mobil) {
        try{
            $sql = "DELETE FROM mobil WHERE id_mobil = :id_mobil";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(['id_mobil' =>$id_mobil]);
        }catch(PDOException $e){
            echo "Data Gagal di Hapus :" .$e->getMessage();
        }
    }
}

// $mobil = new Mobil();
// $mobil->InsertMobil(2008,'merah','2123','1233','1203','rent',1);
// $data = $mobil->SelectMobil();
// var_dump($data);
// $mobil->UpdateMobil(1,2008,'hitam','2928','8991','1239','ready',1);
// $mobil->DeleteMobil(2);
// $data = $mobil->searchmobil('rent');
// $data = $mobil->getspesifikasimobil();
// $data = $mobil->searchmobil('Mc');
// var_dump($data);
?> 