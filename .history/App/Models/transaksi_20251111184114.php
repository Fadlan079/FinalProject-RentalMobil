<?php
require_once __DIR__ . '/../../Config/Database.php';

class Transaksi{
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function Store($id_mobil, $id_pelanggan, $id_pegawai, $tgl_sewa, $tgl_kembali, $durasi_sewa, $total_bayar, $status) {
        try{
            $sql = "INSERT INTO transaksi(id_mobil, id_pelanggan, id_pegawai, tgl_sewa, tgl_kembali, durasi_sewa, total_bayar, status) VALUES (:id_mobil, :id_pelanggan, :id_pegawai, :tgl_sewa, :tgl_kembali, :durasi_sewa, :total_bayar, :status)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id_mobil", $id_mobil);
            $stmt->bindParam(":id_pelanggan", $id_pelanggan);
            $stmt->bindParam(":id_pegawai", $id_pegawai);
            $stmt->bindParam(":tgl_sewa", $tgl_sewa);
            $stmt->bindParam(":tgl_kembali", $tgl_kembali);
            $stmt->bindParam(":durasi_sewa", $durasi_sewa);
            $stmt->bindParam(":total_bayar", $total_bayar);
            $stmt->bindParam(":status", $status);
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Data Gagal Di Tambahkan :" .$e->getMessage();
        }
    }

    public function getTransaksiByPelanggan($id_pelanggan) {
        try{
            $sql = "SELECT * FROM transaksi WHERE id_pelanggan = :id_pelanggan";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_pelanggan' => $id_pelanggan]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Gagal Di Temukan :" .$e->getMessage();
        }
    }

    public function getall($id_pelanggan){
        try{
            $sql = "SELECT 
                    t.id_transaksi,
                    t.tgl_sewa,
                    t.tgl_kembali,
                    t.durasi_sewa,
                    t.total_bayar,
                    t.status,
                    t.tgl_dibuat,
                    m.img,
                    m.tahun,
                    m.warna,
                    m.noplat,
                    p.nama as nama_pelanggan,
                    pg.nama as nama_pegawai
                    FROM transaksi t
                    INNER JOIN mobil m ON t.id_mobil = m.id_mobil
                    INNER JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
                    LEFT JOIN pegawai pg ON t.id_pegawai = pg.id_pegawai 
                    WHERE t.id_pelanggan = :id_pelanggan
                    ORDER BY t.tgl_dibuat DESC";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_pelanggan' => $id_pelanggan]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);  
            
        }catch(PDOException $e){
            error_log("Error getall transaksi: " . $e->getMessage());
            return [];
        }
    }

    public function getLastTransaksiByPelanggan($id_pelanggan) {
        try{
            $sql = "SELECT * FROM transaksi WHERE id_pelanggan = :id_pelanggan ORDER BY tgl_sewa DESC LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_pelanggan' => $]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Gagal Di Temukan :" .$e->getMessage();
        }
    }

    public function updateStatusMobil($id_mobil, $status) {
        try{
            $sql = "UPDATE mobil SET status = :status WHERE id_mobil = :id_mobil";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":id_mobil", $id_mobil);
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Status Mobil Gagal Di Update :" .$e->getMessage();
        }
    }

    public function updateStatusTransaksi($id_transaksi, $status) {
        try{
            $sql = "UPDATE transaksi SET status = :status WHERE id_transaksi = :id_transaksi";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Status Transaksi Gagal Di Update :" .$e->getMessage();
        }
    }

    public function getAllTransaksi() {
        try{
            $sql = "SELECT transaksi.*, pelanggan.nama, mobil.noplat, tipemobil.merk, tipemobil.model, tipemobil.tipe
                    FROM transaksi
                    JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
                    JOIN mobil ON transaksi.id_mobil = mobil.id_mobil
                    JOIN tipemobil ON mobil.id_tipe = tipemobil.id_tipe
                    ORDER BY transaksi.tgl_sewa DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Gagal Di Temukan :" .$e->getMessage();
        }
    }

    public function getTransaksiById($id_transaksi) {
        try{
            $sql = "SELECT transaksi.*, pelanggan.nama, mobil.noplat, tipemobil.merk, tipemobil.model, tipemobil.tipe
                    FROM transaksi
                    JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
                    JOIN mobil ON transaksi.id_mobil = mobil.id_mobil
                    JOIN tipemobil ON mobil.id_tipe = tipemobil.id_tipe
                    WHERE transaksi.id_transaksi = :id_transaksi";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_transaksi' => $id_transaksi]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Gagal Di Temukan :" .$e->getMessage();
        }
    }
}
?>
