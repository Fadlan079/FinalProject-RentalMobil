<?php
require_once __DIR__ . '/../App/Controllers/mobil-controller.php';

$controller = new MOBILController();

$action = $_GET['action'] ?? 'index';

$id_mobil = $_GET['id'] ?? null;

switch ($action) {

    case 'insert':
        $controller->Insert();
        break;

    case 'update':
        $controller->edit($id_mobil);
        break;

    case 'delete':  
        $controller->delete($id_mobil);
        break;

        
    default:
        $controller->index();
        break;
}
?>