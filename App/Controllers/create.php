<?php
require_once __DIR__ . '/../Models/mobil.php';

$mobil = new Mobil();

// ===== CREATE =====
if (isset($_POST['action']) && $_POST['action'] === 'create') {
    $nama_mobil = $_POST['nama_mobil'];
    $tipe = $_POST['tipe'];
    $status = $_POST['status'];
    $harga = $_POST['harga'];

    $mobil->addMobil($nama_mobil, $tipe, $status, $harga);

    header("Location: ../Views/data-mobil.php");
    exit;
}