<?php
require_once __DIR__ . '/../Models/mobil.php';

$mobils1 = new Mobil();

$jumlahmobil = $mobils1->JumlahMobil();

$jumlahready = $mobils1->statusmobil('ready');

$jumlahrent = $mobils1->statusmobil('rent');

$jumlahmaintenance = $mobils1->statusmobil('maintenance');
?>