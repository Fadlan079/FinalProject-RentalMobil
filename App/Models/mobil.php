<?php
require_once "database.php";
class Mobil {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
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
            $sql = "SELECT COUNT(*) FROM mobil";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
                echo "Data Gagagl di tambahkan, silahkan coba lagi :" .$e->getMessage();
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