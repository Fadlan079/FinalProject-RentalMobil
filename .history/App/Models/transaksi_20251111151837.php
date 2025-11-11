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
