<?php
require_once __DIR__ . '/../Models/transaksi.php';

$transaksi = new Transaksi();

$datatransaksi = $transaksi->SelectTransaksi();

$pendapatanbulanini = $transaksi->pendapatanbulanini();

$transaksiaktif= $transaksi->TransaksiAktif();
?>