<?php
require_once __DIR__ . '/../Models/User.php';

$users1 = new User();

$datauser = $users1->Selectuser();

$jumlahuser = $users1->Jumlahuser();
?>