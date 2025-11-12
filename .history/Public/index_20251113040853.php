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
    case 'riwayat-transaksi':
        $Pelanggancontroller->riwayatTransaksi();
        break;
    case 'updatePesanan':
        $Pelanggancontroller->updatePesananAjax();
        break;
    case 'deletePesanan':
        $Pelanggancontroller->deletePesanan();
        break;


    //PEGAWAI
    case 'index-pegawai':
        $Pegawaicontroller->index();
        break;

    case 'listPegawai':
        $Pegawaicontroller->listPegawai();
        break;

    case 'createPegawai':
        $Pegawaicontroller->createPegawai();    
        break;

    case 'storePegawai':
        $Pegawaicontroller->storePegawai();
        break;
        
    // 404 Not Found    
    default:
        http_response_code(404);
        include __DIR__ . '/../App/Views/errors/404.php';
        break;     
    }
?>