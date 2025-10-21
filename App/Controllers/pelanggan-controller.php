<?php
require_once __DIR__ . '/../Models/pelanggan.php';

class PELANGGANController{
    private $model;

    public function __construct(){
        $this->model = new Pelanggan();
    }
    public function index(){
        include __DIR__ . "/../Views/pelanggan/pelanggan-select.php";
    }
}
?>