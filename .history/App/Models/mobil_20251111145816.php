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

    public function detailmobil($id_mobil){
        try{
            $sql = "SELECT * FROM mobil JOIN tipemobil ON mobil.id_tipe = tipemobil.id_tipe WHERE id_mobil = :id_mobil";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_mobil' => $id_mobil]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Detail Mobil gagal di tampilkan :" .$e->getMessage();
        }
    }

    public function filterMobil($harga = null, $transmisi = null, $bhn_bkr = null, $kursi = null, $limit = null, $offset = null)
    {
        try {
            $sql = "SELECT DISTINCT 
                mobil.id_mobil,
                mobil.img,
                mobil.noplat,
                mobil.warna,
                mobil.status,
                tipemobil.merk,
                tipemobil.model,
                tipemobil.tipe,
                tipemobil.transmisi,
                tipemobil.harga,
                tipemobil.kursi,
                tipemobil.bhn_bkr,
                tipemobil.pintu
                FROM mobil 
                JOIN tipemobil ON mobil.id_tipe = tipemobil.id_tipe 
                WHERE 1=1";

            $params = [];

        // Filter Harga
        if (!empty($harga) && $harga != 'semua') {
            switch ($harga) {
                case 'lt1jt': $sql .= " AND tipemobil.harga < 1000000"; break;
                case 'lt5jt': $sql .= " AND tipemobil.harga < 5000000"; break;
                case 'gt5jt': $sql .= " AND tipemobil.harga >= 5000000"; break;
            }
        }

        // Filter Transmisi
        if (!empty($transmisi) && $transmisi != 'semua') {
            $sql .= " AND tipemobil.transmisi = ?";
            $params[] = $transmisi;
        }

        // Filter Bahan Bakar
        if (!empty($bhn_bkr) && $bhn_bkr != 'semua') {
            $sql .= " AND tipemobil.bhn_bkr = ?";
            $params[] = $bhn_bkr;
        }

        // Filter Kursi
        if (!empty($kursi) && $kursi != 'semua') {
            $sql .= " AND tipemobil.kursi = ?";
            $params[] = $kursi;
        }

        $sql .= " ORDER BY CASE 
                WHEN mobil.status = 'ready' THEN 1 
                WHEN mobil.status = 'rent' THEN 2 
                WHEN mobil.status = 'maintenance' THEN 3 
                END";

        // Tambahkan limit dan offset jika ada
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT ?, ?";
            $params[] = (int)$offset;
            $params[] = (int)$limit;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        echo "Filter Mobil Gagal: " . $e->getMessage();
        return [];
    }
    }

    public function countFilterMobil($harga = null, $transmisi = null, $bhn_bkr = null, $kursi = null) {
        try {
            $sql = "SELECT COUNT(DISTINCT mobil.id_mobil) AS total
                    FROM mobil 
                    JOIN tipemobil ON mobil.id_tipe = tipemobil.id_tipe 
                    WHERE 1=1";
            $params = [];
    
            // Filter Harga
            if (!empty($harga) && $harga != 'semua') {
                switch ($harga) {
                    case 'lt1jt': $sql .= " AND tipemobil.harga < 1000000"; break;
                    case 'lt5jt': $sql .= " AND tipemobil.harga < 5000000"; break;
                    case 'gt5jt': $sql .= " AND tipemobil.harga >= 5000000"; break;
                }
            }
    
            // Filter Transmisi
            if (!empty($transmisi) && $transmisi != 'semua') {
                $sql .= " AND transmisi = ?";
                $params[] = $transmisi;
            }
    
            // Filter Bahan Bakar
            if (!empty($bhn_bkr) && $bhn_bkr != 'semua') {
                $sql .= " AND bhn_bkr = ?";
                $params[] = $bhn_bkr;
            }
    
            // Filter Kursi
            if (!empty($kursi) && $kursi != 'semua') {
                $sql .= " AND kursi = ?";
                $params[] = $kursi;
            }
    
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchColumn();
        } catch(PDOException $e) {
            echo "Gagal Menghitung Filter: " . $e->getMessage();
            return 0;
        }
    }

    // Fungsi sederhana untuk escape string agar aman
    function esc($string) {
        return addslashes($string);
    }

    public function getMobilWithLimit($limit, $offset) {
        try{
            $stmt = $this->pdo->prepare("SELECT DISTINCT 
            mobil.id_mobil,
            mobil.img,
            mobil.noplat,
            mobil.warna,
            mobil.status,
            tipemobil.merk,
            tipemobil.model,
            tipemobil.tipe,
            tipemobil.transmisi,
            tipemobil.harga,
            tipemobil.kursi,
            tipemobil.bhn_bkr,
            tipemobil.pintu 
            FROM mobil JOIN tipemobil ON mobil.id_tipe = tipemobil.id_tipe 
            ORDER BY CASE 
            WHEN status = 'ready' THEN 1 
            WHEN status = 'rent' THEN 2 
            WHEN status = 'maintenance' THEN 3 
            END  
            LIMIT :offset, :limit");
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Gagal Di Temukan :" .$e->getMessage();
        }
    }

    public function countAllMobil() {
        try{
            return $this->pdo->query("SELECT COUNT(*) FROM mobil")->fetchColumn();
        }catch(PDOException $e){
            echo "Data Gagal Di Temukan :" .$e->getMessage();
        }   
    }

    public function searchmobil($keyword, $limit = null, $offset = null) {
        try {
            $sql = "SELECT DISTINCT mobil.id_mobil,
                        mobil.img,
                        mobil.noplat,
                        mobil.warna,
                        mobil.status,
                        tipemobil.merk,
                        tipemobil.model,
                        tipemobil.tipe,
                        tipemobil.transmisi,
                        tipemobil.harga,
                        tipemobil.kursi,
                        tipemobil.bhn_bkr,
                        tipemobil.pintu
                    FROM mobil
                    JOIN tipemobil ON mobil.id_tipe = tipemobil.id_tipe
                    WHERE CONCAT_WS(' ', merk, model, tipe, transmisi, warna, bhn_bkr, status) LIKE :keyword
                    ORDER BY CASE 
                        WHEN status = 'ready' THEN 1
                        WHEN status = 'rent' THEN 2
                        WHEN status = 'maintenance' THEN 3
                    END";

            if ($limit !== null && $offset !== null) {
                $sql .= " LIMIT :offset, :limit";
            }

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);

            if ($limit !== null && $offset !== null) {
                $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
                $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch(PDOException $e){
            echo "Data Gagal Di Temukan: " . $e->getMessage();
        }
    }

    public function countSearchMobil($keyword) {
        try {
            $sql = "SELECT COUNT(DISTINCT mobil.id_mobil) AS total
                    FROM mobil
                    JOIN tipemobil ON mobil.id_tipe = tipemobil.id_tipe
                    WHERE CONCAT_WS(' ', merk, model, tipe, transmisi, warna, bhn_bkr, status) LIKE :keyword";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
            $stmt->execute();
            return (int)$stmt->fetchColumn();
        } catch(PDOException $e){
            echo "Gagal Menghitung Data: " . $e->getMessage();
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
// Hanya satu kurung tutup class di sini

// $mobil = new Mobil();
// $mobil->InsertMobil(2008,'merah','2123','1233','1203','rent',1);
// $data = $mobil->SelectMobil();
// var_dump($data);
// $mobil->UpdateMobil(1,2008,'hitam','2928','8991','1239','ready',1);
// $mobil->DeleteMobil(2);
// $data = $mobil->searchmobil('listrik');
// $data = $mobil->getspesifikasimobil();
// $data = $mobil->detailmobil(38);
// var_dump($data);
?>