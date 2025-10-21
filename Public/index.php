<?php
require_once __DIR__ . '/../App/Controllers/pelanggan-controller.php';

$controller = new PELANGGANController;

$action = $_GET['action'] ?? 'index';

$id = $_GET['id'] ?? null;

switch ($action) {
        
    default:
        $controller->index();
        break;
}
?>