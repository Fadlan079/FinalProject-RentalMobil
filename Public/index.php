<?php
require_once __DIR__ . '/../App/Controllers/pelanggan-controller.php';
require_once __DIR__ . '/../App/Controllers/auth-controller.php';

$Authcontroller = new AUTHController;
$controller = new PELANGGANController;

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
    
    // Tampilan Pelanggan    
    case 'index':
        require_once __DIR__ . '/../App/Views/Pelanggan/index.php';
        break;

    // 404 Not Found    
    default:
        http_response_code(404);
        include __DIR__ . '/../App/Views/errors/404.php';
        break;
}
?>