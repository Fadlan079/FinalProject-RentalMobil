<?php
require_once __DIR__ . '/../../Config/Database.php';

class Transaksi {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function Store($id_mobil, $id_pelanggan, $id_pegawai, $tgl_sewa, $tgl_kembali, $durasi_sewa, $total_bayar, $status) {
        try {
            $sql = "INSERT INTO transaksi(id_mobil, id_pelanggan, id_pegawai, tgl_sewa, tgl_kembali, durasi_sewa, total_bayar, status) 
                    VALUES (:id_mobil, :id_pelanggan, :id_pegawai, :tgl_sewa, :tgl_kembali, :durasi_sewa, :total_bayar, :status)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id_mobil", $id_mobil);
            $stmt->bindParam(":id_pelanggan", $id_pelanggan);
            $stmt->bindValue(":id_pegawai", $id_pegawai, $id_pegawai === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
            $stmt->bindParam(":tgl_sewa", $tgl_sewa);
            $stmt->bindParam(":tgl_kembali", $tgl_kembali);
            $stmt->bindParam(":durasi_sewa", $durasi_sewa);
            $stmt->bindParam(":total_bayar", $total_bayar);
            $stmt->bindParam(":status", $status);
            return $stmt->execute();
        } catch(PDOException $e) {
            error_log("Store Transaksi Error: " . $e->getMessage());
            return false;
        }
    }

    public function getTransaksiByPelanggan($id_pelanggan) {
        try{
            $sql = "SELECT * FROM transaksi WHERE id_pelanggan = :id_pelanggan";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_pelanggan' => $id_pelanggan]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return false;
        }
    }

    public function getall($id_pelanggan) {
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
                        tm.merk,
                        tm.model,
                        tm.tipe,
                        p.nama as nama_pelanggan,
                        pg.nama as nama_pegawai
                    FROM transaksi t
                    INNER JOIN mobil m ON t.id_mobil = m.id_mobil
                    INNER JOIN tipemobil tm ON m.id_tipe = tm.id_tipe
                    INNER JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
                    LEFT JOIN pegawai pg ON t.id_pegawai = pg.id_pegawai 
                    WHERE t.id_pelanggan = :id_pelanggan
                    ORDER BY t.tgl_dibuat DESC";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_pelanggan' => $id_pelanggan]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);  
            
        } catch(PDOException $e) {
            error_log("Error getall transaksi: " . $e->getMessage());
            return [];
        }
    }

    public function getLastTransaksiByPelanggan($id_pelanggan) {
        try{
            $sql = "SELECT * FROM transaksi WHERE id_pelanggan = :id_pelanggan ORDER BY tgl_sewa DESC LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_pelanggan' => $id_pelanggan]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return false;
        }
    }

    public function updateStatusMobil($id_mobil, $status) {
        try{
            $sql = "UPDATE mobil SET status = :status WHERE id_mobil = :id_mobil";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":id_mobil", $id_mobil);
            return $stmt->execute();
        } catch(PDOException $e) {
            return false;
        }
    }

    public function updateTransaksi($id_transaksi, $tgl_kembali, $durasi_sewa, $total_bayar, $status) {
        try {
            $sql = "UPDATE transaksi 
                    SET tgl_kembali = :tgl_kembali, durasi_sewa = :durasi_sewa, total_bayar = :total_bayar, status = :status 
                    WHERE id_transaksi = :id_transaksi";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":tgl_kembali", $tgl_kembali);
            $stmt->bindParam(":durasi_sewa", $durasi_sewa);
            $stmt->bindParam(":total_bayar", $total_bayar);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Update Transaksi Error: " . $e->getMessage());
            return false;
        }
    }

    public function deleteTransaksi($id_transaksi) {
        try {
            $sql = "DELETE FROM transaksi WHERE id_transaksi = :id_transaksi";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Delete Transaksi Error: " . $e->getMessage());
            return false;
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
        } catch(PDOException $e) {
            return false;
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
        } catch(PDOException $e) {
            return false; 
        }
    }

    public function updateStatus($id_mobil, $status) {
    $stmt = $this->pdo->prepare("UPDATE mobil SET status = ? WHERE id_mobil = ?");
    return $stmt->execute([$status, $id_mobil]);
}


    // === METHOD BARU YANG DITAMBAHKAN ===

    public function updateStatusTransaksi($id_transaksi, $status) {
        try {
            $sql = "UPDATE transaksi SET status = :status WHERE id_transaksi = :id_transaksi";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Update Status Transaksi Error: " . $e->getMessage());
            return false;
        }
    }

    public function getTransaksiDetailById($id_transaksi) {
        try {
            $sql = "SELECT 
                        t.*,
                        m.img,
                        m.tahun,
                        m.warna,
                        m.noplat,
                        tm.merk,
                        tm.model,
                        tm.tipe,
                        p.nama as nama_pelanggan,
                        pg.nama as nama_pegawai
                    FROM transaksi t
                    INNER JOIN mobil m ON t.id_mobil = m.id_mobil
                    INNER JOIN tipemobil tm ON m.id_tipe = tm.id_tipe
                    INNER JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
                    LEFT JOIN pegawai pg ON t.id_pegawai = pg.id_pegawai 
                    WHERE t.id_transaksi = :id_transaksi";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_transaksi' => $id_transaksi]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get Transaksi Detail Error: " . $e->getMessage());
            return false;
        }
    }

    public function updateTransaksiFull($id_transaksi, $tgl_sewa, $tgl_kembali, $durasi_sewa, $total_bayar, $status) {
        try {
            $sql = "UPDATE transaksi 
                    SET tgl_sewa = :tgl_sewa, 
                        tgl_kembali = :tgl_kembali, 
                        durasi_sewa = :durasi_sewa, 
                        total_bayar = :total_bayar, 
                        status = :status 
                    WHERE id_transaksi = :id_transaksi";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":tgl_sewa", $tgl_sewa);
            $stmt->bindParam(":tgl_kembali", $tgl_kembali);
            $stmt->bindParam(":durasi_sewa", $durasi_sewa);
            $stmt->bindParam(":total_bayar", $total_bayar);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Update Transaksi Full Error: " . $e->getMessage());
            return false;
        }
    }

    public function checkMobilAvailability($id_mobil, $tgl_sewa, $tgl_kembali, $exclude_transaksi_id = null) {
        try {
            $sql = "SELECT COUNT(*) as count 
                    FROM transaksi 
                    WHERE id_mobil = :id_mobil 
                    AND status NOT IN ('batal', 'selesai')
                    AND ((tgl_sewa BETWEEN :tgl_sewa AND :tgl_kembali) 
                         OR (tgl_kembali BETWEEN :tgl_sewa AND :tgl_kembali)
                         OR (:tgl_sewa BETWEEN tgl_sewa AND tgl_kembali))";
            
            if ($exclude_transaksi_id) {
                $sql .= " AND id_transaksi != :exclude_transaksi_id";
            }
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id_mobil", $id_mobil);
            $stmt->bindParam(":tgl_sewa", $tgl_sewa);
            $stmt->bindParam(":tgl_kembali", $tgl_kembali);
            
            if ($exclude_transaksi_id) {
                $stmt->bindParam(":exclude_transaksi_id", $exclude_transaksi_id);
            }
            
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] == 0;
        } catch (PDOException $e) {
            error_log("Check Mobil Availability Error: " . $e->getMessage());
            return false;
        }
    }
}
?>