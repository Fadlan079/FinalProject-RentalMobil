<?php
require_once "App/Models/mobil.php";

$mobils1 = new Mobil();

$datamobil = $mobils1->SelectMobil();
?>