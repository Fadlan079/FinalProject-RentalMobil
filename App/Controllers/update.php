<?php
require_once __DIR__ . '/../Models/mobil.php';

$mobil = new Mobil();

// ===== CREATE =====
if (isset($_POST['action']) && $_POST['action'] === 'create') {
    $kapasitas = $_POST['kapasitas'];
    $merek = $_POST['merek'];
    $harga_hari = $_POST['harga_hari'];
    $transmisi = $_POST['transmisi'];
    $bahan_bakar = $_POST['bahan_bakar'];
    $model = $_POST['model'];
    $tahun = $_POST['tahun'];
    $status = $_POST['status'];
    $bagasi = $_POST['bagasi'];
    $warna = $_POST['warna'];

    $mobil->InsertMobil($kapasitas, $merek, $harga_hari, $transmisi, $bahan_bakar, $model, $tahun, $status, $bagasi, $warna);

    header("Location: ../Views/data-mobil.php");
    exit;
}

// ===== UPDATE =====
if (isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = $_POST['id'];
    $kapasitas = $_POST['kapasitas'];
    $merek = $_POST['merek'];
    $harga_hari = $_POST['harga_hari'];
    $transmisi = $_POST['transmisi'];
    $bahan_bakar = $_POST['bahan_bakar'];
    $model = $_POST['model'];
    $tahun = $_POST['tahun'];
    $status = $_POST['status'];
    $bagasi = $_POST['bagasi'];
    $warna = $_POST['warna'];

    $mobil->UpdateMobil($id, $kapasitas, $merek, $harga_hari, $transmisi, $bahan_bakar, $model, $tahun, $status, $bagasi, $warna);

    header("Location: ../Views/data-mobil.php");
    exit;
}

// ===== DELETE =====
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mobil->DeleteMobil($id);

    header("Location: ../Views/data-mobil.php");
    exit;
}
?>
