<?php
require_once __DIR__ . '/../../Config/Database.php';

class Mobil{
    /** @var \PDO */
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    /**
     * @param string $img
     * @param int $tahun
     * @param string $warna
     * @param string $status
     * @param string $noplat
     * @param string $nomesin
     * @param string $norangka
     * @param int $id_tipe
     * @return bool
     */
    public function InsertMobil($img ,$tahun, $warna,$status,$noplat, $nomesin,$norangka, $id_tipe) {
        try{
            $sql = "INSERT INTO mobil(img,tahun, warna, noplat, nomesin,norangka,status,id_tipe) VALUES (:img,:tahun, :warna, :noplat, :nomesin,:norangka,:status,:id_tipe)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":img", $img);
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
            return false;
        }
    }

    public function GetAllMobil(){
        try{
            $sql = "SELECT * FROM mobil";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Gagal Di Tampilkan :" .$e->getMessage();
        }
    }

    public function GetAllMobilWithTipe(){
        try{
            $sql = "SELECT mobil.*, tipemobil.merk, tipemobil.model, tipemobil.tipe,
                    tipemobil.transmisi, tipemobil.harga, tipemobil.kursi,
                    tipemobil.bhn_bkr, tipemobil.pintu
                    FROM mobil
                    JOIN tipemobil ON mobil.id_tipe = tipemobil.id_tipe
                    ORDER BY mobil.id_mobil DESC";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Gagal Di Tampilkan :" .$e->getMessage();
            return [];
        }
    }

    /**
     * @param int|string $id_mobil
     * @return mixed
     */
    public function detailmobil($id_mobil){
        try{
            $sql = "SELECT * FROM mobil 
            JOIN tipemobil ON mobil.id_tipe = tipemobil.id_tipe 
            WHERE id_mobil = :id_mobil";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_mobil' => $id_mobil]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Detail Mobil gagal di tampilkan :" .$e->getMessage();
        }
    }

    public function filterMobil($keyword = '', $harga = null, $transmisi = null, $bhn_bkr = null, $kursi = null, $limit = null, $offset = null)
    {
        try{
            $sql = 'SELECT DISTINCT
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
            WHERE 1=1';
            $params = [];

            // Filter Keyword
            if (!empty($keyword)) {
                $sql .= " AND CONCAT_WS(' ', tipemobil.merk, tipemobil.model, tipemobil.tipe, tipemobil.transmisi, mobil.warna, tipemobil.bhn_bkr, mobil.status) LIKE :keyword";
                $params[':keyword'] = "%$keyword%";
            }
    
            // 🔧 PERBAIKAN: Filter harga dengan kondisi yang benar
            if (!empty($harga) && $harga != 'semua') {
                if ($harga === 'lt1jt') {
                    $sql .= " AND tipemobil.harga < 1000000";
                } elseif ($harga === 'lt5jt') {
                    $sql .= " AND tipemobil.harga < 5000000";
                } elseif ($harga === 'gt5jt') {
                    $sql .= " AND tipemobil.harga > 5000000";
                }
            }
    
            // Filter Transmisi
            if (!empty($transmisi) && $transmisi != 'semua') {
                $sql .= " AND tipemobil.transmisi = :transmisi";
                $params[':transmisi'] = $transmisi;
            }
    
            // Filter Bahan Bakar
            if (!empty($bhn_bkr) && $bhn_bkr != 'semua') {
                $sql .= " AND tipemobil.bhn_bkr = :bhn_bkr";
                $params[':bhn_bkr'] = $bhn_bkr;
            }
    
            // Filter Kursi
            if (!empty($kursi) && $kursi != 'semua') {
                if ($kursi === '2') {
                    $sql .= " AND tipemobil.kursi = 2";
                } 
                elseif ($kursi === '4-5') {
                    $sql .= " AND tipemobil.kursi IN (4, 5)";
                }
                elseif ($kursi === '6-8') {
                    $sql .= " AND tipemobil.kursi IN (6, 7, 8)";
                }
            }
    
            $sql .= " ORDER BY
            CASE
                WHEN mobil.status = 'ready' THEN 1
                WHEN mobil.status = 'rent' THEN 2
                WHEN mobil.status = 'maintenance' THEN 3
            END";
    
            if ($limit !== null && $offset !== null) {
                $sql .= " LIMIT :offset, :limit";
                $params[':offset'] = (int)$offset;
                $params[':limit'] = (int)$limit;
            }
    
            $stmt = $this->pdo->prepare($sql);
            
            // Binding semua parameter
            foreach ($params as $key => $value) {
                if (strpos($key, ':offset') !== false || strpos($key, ':limit') !== false) {
                    $stmt->bindValue($key, $value, PDO::PARAM_INT);
                } else {
                    $stmt->bindValue($key, $value);
                }
            }
    
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            echo "Data Gagal Di Temukan :" .$e->getMessage();
            return [];
        }
    }

    public function countFilterMobil($keyword = '', $harga = null, $transmisi = null, $bhn_bkr = null, $kursi = null) {
        try {
            $sql = "SELECT COUNT(DISTINCT mobil.id_mobil) AS total
                    FROM mobil
                    JOIN tipemobil ON mobil.id_tipe = tipemobil.id_tipe
                    WHERE 1=1";
            $params = [];
    
            if (!empty($keyword)) {
                $sql .= " AND CONCAT_WS(' ', tipemobil.merk, tipemobil.model, tipemobil.tipe, tipemobil.transmisi, mobil.warna, tipemobil.bhn_bkr, mobil.status) LIKE :keyword";
                $params[':keyword'] = "%$keyword%";
            }

            // 🔧 SAMA SEPERTI DI filterMobil()
            if (!empty($harga) && $harga != 'semua') {
                if ($harga === 'lt1jt') {
                    $sql .= " AND tipemobil.harga < 1000000";
                } elseif ($harga === 'lt5jt') {
                    $sql .= " AND tipemobil.harga < 5000000";
                } elseif ($harga === 'gt5jt') {
                    $sql .= " AND tipemobil.harga > 5000000";
                }
            }
    
            if (!empty($transmisi) && $transmisi != 'semua') {
                $sql .= " AND tipemobil.transmisi = :transmisi";
                $params[':transmisi'] = $transmisi;
            }
    
            if (!empty($bhn_bkr) && $bhn_bkr != 'semua') {
                $sql .= " AND tipemobil.bhn_bkr = :bhn_bkr";
                $params[':bhn_bkr'] = $bhn_bkr;
            }
    
            if (!empty($kursi) && $kursi != 'semua') {
                if ($kursi === '2') {
                    $sql .= " AND tipemobil.kursi = 2";
                } 
                elseif ($kursi === '4-5') {
                    $sql .= " AND tipemobil.kursi IN (4, 5)";
                }
                elseif ($kursi === '6-8') {
                    $sql .= " AND tipemobil.kursi IN (6, 7, 8)";
                }
            }
    
            $stmt = $this->pdo->prepare($sql);
            
            // Binding parameters
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch(PDOException $e) {
            echo "Gagal Menghitung Filter: " . $e->getMessage();
            return 0;
        }
    }

    /**
     * @param int|string $id_mobil
     * @param string $status
     * @return bool
     */
    public function updateStatus($id_mobil, $status) {
    $stmt = $this->pdo->prepare("UPDATE mobil SET status = ? WHERE id_mobil = ?");
    return $stmt->execute([$status, $id_mobil]);
}


    /**
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getMobilWithLimit($offset,$limit) {
        try{
            $sql ="SELECT
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
            LIMIT :offset, :limit";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Gagal Di Temukan :" .$e->getMessage();
            return [];
        }
    }

    public function countAllMobil() {
        try{
            return $this->pdo->query("SELECT COUNT(*) FROM mobil")->fetchColumn();
        }catch(PDOException $e){
            echo "Data Gagal Di Temukan :" .$e->getMessage();
        }   
    }

    /**
     * @param string $keyword
     * @param int|null $limit
     * @param int|null $offset
     * @return array
     */
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
            return [];
        }
    }

    /**
     * @param string $keyword
     * @return int
     */
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
            return 0;
        }
    }

    /**
     * @param int|string $id_mobil
     * @param int $tahun
     * @param string $warna
     * @param string $noplat
     * @param string $nomesin
     * @param string $norangka
     * @param string $status
     * @param int $id_tipe
     * @return bool
     */
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
            return false;
        }
    }

    /**
     * @param int|string $id_mobil
     * @return bool
     */
    public function DeleteMobil($id_mobil) {
        try{
            $sql = "DELETE FROM mobil WHERE id_mobil = :id_mobil";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(['id_mobil' =>$id_mobil]);
        }catch(PDOException $e){
            echo "Data Gagal di Hapus :" .$e->getMessage();
            return false;
        }
    }
}

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