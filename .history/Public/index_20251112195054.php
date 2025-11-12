<?php
require_once __DIR__ . '/../App/Controllers/auth-controller.php';
require_once __DIR__ . '/../App/Controllers/pelanggan-controller.php';
require_once __DIR__ . '/../App/Controllers/pegawai-controller.php';

$Authcontroller = new AUTHController;
$Pelanggancontroller = new PELANGGANController;
$Pegawaicontroller = new PEGAWAIController;

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

switch ($action) {

    // AUTHENTICATION    
    case 'login':
        $Authcontroller->showlogin();
        break;
    case 'storelogin':
        $Authcontroller->login();
        break;      
    case 'signup':
        $Authcontroller->showsignup();
        break;   
    case 'storesignup':
        $Authcontroller->signup();
        break;
    case 'logout':
        $Authcontroller->logout();
        break;      
    
    // PELANGGAN
    case 'index':
        $Pelanggancontroller->index();
        break;
    case 'store-profile-pelanggan':
        $Pelanggancontroller->Storeprofile();
        break;
    case 'detail-mobil':
        $Pelanggancontroller->detailmobil($id);
        break;
    case 'store-transaksi':
        $Pelanggancontroller->Storetransaksi();
        break;
    case 'buat-transaksi':
        $Pelanggancontroller->buatTransaksi();
        break;
    case 'riwayat-transaksi':
        $Pelanggancontroller->riwayatTransaksi();
        break;

    //PEGAWAI
    case 'profile-pegawai':
        $Pegawaicontroller->Showprofile();
        break;    
    case 'store-profile-pegawai':
        $Pegawaicontroller->Storeprofile();
        break;
    case 'index':
        $controller->index();
        break;
    case 'listPegawai':
        $controller->listPegawai();
        break;
    case 'createPegawai':
        $Pegawaicontroller->createPegawai();    
    k;
    case 'storePegawai':
        $controller->storePegawai();
        break;
    case 'editPegawai':
        $controller->editPegawai();
        break;
    case 'updatePegawai':
        $controller->updatePegawai();
        break;
    case 'deletePegawai':
        $controller->deletePegawai();
        break;
    case 'profile':
        $controller->Showprofile();
        break; 
    
    // 404 Not Found    
    default:
        http_response_code(404);
        include __DIR__ . '/../App/Views/errors/404.php';
        break;     
}
?>