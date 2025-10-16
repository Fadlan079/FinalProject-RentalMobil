<?php
require_once __DIR__ . '/../Models/pelanggan.php';

class PELANGGANController{
    private $Model;

    public function __construct(){
        $this->Model = new Pelanggan();
    }
    public function index(){
        include __DIR__ . "/../Views/Customer/user-select.php";
    }
}
?>