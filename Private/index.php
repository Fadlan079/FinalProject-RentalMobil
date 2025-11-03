<?php
require_once __DIR__ . '/../App/Controllers/pegawai-controller.php';

$Pegawaicontroller = new PEGAWAIController();

$action = $_GET['action'] ?? 'index';

$id_mobil = $_GET['id'] ?? null;

switch ($action) {
    // 404 Not Found    
    default:
        http_response_code(404);
        include __DIR__ . '/../App/Views/errors/404.php';
        break;
}
?>