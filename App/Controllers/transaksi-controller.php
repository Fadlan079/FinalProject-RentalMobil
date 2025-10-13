<?php
require_once "App/Models/transaksi.php";

$transaksi = new Transaksi();

$datatransaksi = $mobils1->SelectTransaksi();

$totalpendapatan= $mobils1->TotalPendapatan();

$transaksiaktif= $mobils1->TransaksiAktif();
?>