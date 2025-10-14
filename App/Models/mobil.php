<?php
require_once "database.php";
class Mobil {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function searchmobil($keyword){
        try{
            $sql = "SELECT * FROM mobil 
                WHERE merek LIKE :keyword
                   OR model LIKE :keyword
                   OR warna LIKE :keyword
                   OR bahan_bakar LIKE :keyword
                   OR transmisi LIKE :keyword
                   OR status LIKE :keyword
                   OR tahun LIKE :keyword
                   OR kapasitas LIKE :keyword
                   OR bagasi LIKE :keyword
                   OR harga_hari <= :keyword";
            $stmt = $this->pdo->prepare($sql);
            $search = "%" . $keyword . "%";
            $stmt->bindParam(':keyword',$search);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Gagagl di tambahkan, silahkan coba lagi :" .$e->getMessage();
        }
    }

    public function InsertMobil($kapasitas, $deskripsi, $merk, $harga_per_hari, $transmisi, $bhn_bkr) {
        try{
            $sql = "INSERT INTO mobil (kapasitas, deskripsi, merk, harga_per_hari, transmisi, bhn_bkr) VALUES (:kapasitas, :deskripsi, :merk, :harga_per_hari, :transmisi, :bhn_bkr)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":kapasitas", $kapasitas);
            $stmt->bindParam(":deskripsi", $deskripsi);
            $stmt->bindParam(":merk", $merk);
            $stmt->bindParam(":harga_per_hari", $harga_per_hari);
            $stmt->bindParam(":transmisi", $transmisi);
            $stmt->bindParam(":bhn_bkr", $bhn_bkr);
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Data Gagagl di tambahkan, silahkan coba lagi :" .$e->getMessage();
        }
    }

    public function SelectMobil() {
        try{
            $sql = "SELECT * FROM mobil";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
                echo "Data Gagagl di tambahkan, silahkan coba lagi :" .$e->getMessage();
            }
        }

    public function JumlahMobil(){
        try{
            $sql = "SELECT COUNT(*) AS jumlahmobil FROM mobil";
            $stmt = $this->pdo->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['jumlahmobil'];
        }catch(PDOException $e){
                echo "Data Gagal di tambahkan, silahkan coba lagi :" .$e->getMessage();
            }
        }

    public function statusmobil($status){
        if($status == 'ready'){
            try{
                $sql = "SELECT COUNT(*)  AS jumlahready FROM mobil WHERE status = 'ready' ";
                $stmt = $this->pdo->query($sql);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['jumlahready'];
            }catch(PDOException $e){
                    echo "Data Gagal di tambahkan, silahkan coba lagi :" .$e->getMessage();
            }
        }elseif($status == 'rent'){
            try{
                $sql = "SELECT COUNT(*)  AS jumlahrent FROM mobil WHERE status = 'rent' ";
                $stmt = $this->pdo->query($sql);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['jumlahrent'];
            }catch(PDOException $e){
                    echo "Data Gagal di tambahkan, silahkan coba lagi :" .$e->getMessage();
            }
        }else{
            try{
                $sql = "SELECT COUNT(*)  AS jumlahmaintenance FROM mobil WHERE status = 'maintenance' ";
                $stmt = $this->pdo->query($sql);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['jumlahmaintenance'];
            }catch(PDOException $e){
                    echo "Data Gagagl di tambahkan, silahkan coba lagi :" .$e->getMessage();
            }
        }
    }    

    public function UpdateMobil($id, $kapasitas, $deskripsi, $merk, $harga_per_hari, $transmisi, $bhn_bkr) {
        try{
                $sql = "UPDATE mobil SET 
                            kapasitas = :kapasitas,
                            deskripsi = :deskripsi,
                            merk = :merk,
                            harga_per_hari = :harga_per_hari,
                            transmisi = :transmisi,
                            bhn_bkr = :bhn_bkr
                        WHERE id_mobil = :id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":kapasitas", $kapasitas);
                $stmt->bindParam(":deskripsi", $deskripsi);
                $stmt->bindParam(":merk", $merk);
                $stmt->bindParam(":harga_per_hari", $harga_per_hari);
                $stmt->bindParam(":transmisi", $transmisi);
                $stmt->bindParam(":bhn_bkr", $bhn_bkr);
                return $stmt->execute();
        }catch(PDOException $e){
                echo "Data Gagagl di tambahkan, silahkan coba lagi :" .$e->getMessage();
            }
    }

    // 🔹 DELETE
    public function DeleteMobil($id) {
        try{
            $sql = "DELETE FROM mobil WHERE id_mobil = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        }catch(PDOException $e){
                echo "Data Gagagl di tambahkan, silahkan coba lagi :" .$e->getMessage();
            }
    }
}

?>