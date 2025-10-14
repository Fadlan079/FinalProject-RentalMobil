<?php
require_once "database.php";
class Transaksi {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    // 🔹 INSERT
    public function InsertTransaksi($nama_pelanggan, $mobil, $tgl_sewa, $tgl_kembali, $total_bayar, $status, $denda) {
        try{
            $sql = "INSERT INTO transaksi (nama_pelanggan, mobil, tgl_sewa, tgl_kembali, total_bayar, status, denda) VALUES (:nama_pelanggan, :mobil, :tgl_sewa, :tgl_kembali, :total_bayar, :status, :denda)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":nama_pelanggan", $nama_pelanggan);
            $stmt->bindParam(":mobil", $mobil);
            $stmt->bindParam(":tgl_sewa", $tgl_sewa);
            $stmt->bindParam(":tgl_kembali", $tgl_kembali);
            $stmt->bindParam(":total_bayar", $total_bayar);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":denda", $denda);
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Data Gagal di tambahkan, silahkan coba lagi :" .$e->getMessage();
        }
    }

    // 🔹 SELECT
    public function SelectTransaksi() {
    try{
        $sql = "SELECT * FROM transaksi";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
            echo "Data Gagal di tambahkan, silahkan coba lagi :" .$e->getMessage();
        }
    }

    public function pendapatanbulanini() {
    try{
        $sql = "SELECT SUM(total_bayar) AS pendapatanbulanini FROM transaksi WHERE MONTH(tgl_dibuat) = MONTH(CURRENT_DATE()) AND YEAR(tgl_dibuat) = YEAR(CURRENT_DATE())";
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['pendapatanbulanini'];
    }catch(PDOException $e){
            echo "Data Gagal di tambahkan, silahkan coba lagi :" .$e->getMessage();
        }
    }

    public function TransaksiAktif(){
        try{
            $sql = "SELECT COUNT(*) AS transaksiaktif FROM transaksi WHERE status = 'proses' ";
            $stmt = $this->pdo->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['transaksiaktif'];
        }catch(PDOException $e){
                echo "Data Gagagl di tambahkan, silahkan coba lagi :" .$e->getMessage();
            }
        }
    
    // 🔹 UPDATE
    public function UpdateTransaksi($id, $nama_pelanggan, $mobil, $tgl_sewa, $tgl_kembali, $total_bayar, $status, $denda) {
    try{
            $sql = "UPDATE transaksi SET 
                        nama_pelanggan = :nama_pelanggan,
                        mobil = :mobil,
                        tgl_sewa = :tgl_sewa,
                        tgl_kembali = :tgl_kembali,
                        total_bayar = :total_bayar,
                        status = :status,
                        denda = :denda
                    WHERE id_transaksi = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":nama_pelanggan", $nama_pelanggan);
            $stmt->bindParam(":mobil", $mobil);
            $stmt->bindParam(":tgl_sewa", $tgl_sewa);
            $stmt->bindParam(":tgl_kembali", $tgl_kembali);
            $stmt->bindParam(":total_bayar", $total_bayar);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":denda", $denda);
            return $stmt->execute();
    }catch(PDOException $e){
            echo "Data Gagal di tambahkan, silahkan coba lagi :" .$e->getMessage();
        }
    }

    // 🔹 DELETE
    public function DeleteTransaksi($id) {
    try{
        $sql = "DELETE FROM transaksi WHERE id_transaksi = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }catch(PDOException $e){
            echo "Data Gagal di tambahkan, silahkan coba lagi :" .$e->getMessage();
        }
    }
}

?>