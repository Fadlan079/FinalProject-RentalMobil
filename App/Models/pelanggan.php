<?php
require_once __DIR__ . '/../../Config/Database.php';

class Pelanggan{
    private $pdo;

    public function __construct(){
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function Insertpelanggan($nama,$nik,$alamat,$kelurahan,$kecamatan,$kabkota,$kp,$email,$telp,$password){
        try{
            $hash = Password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO pelanggan(nama,nik,alamat,kelurahan,kecamatan,kabkota,kp,email,telp,password) VALUES(:nama,:nik,:alamat,:kelurahan,:kecamatan,:kabkota,:kp,:email,:telp,:password)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nama',$nama);
            $stmt->bindParam(':nik',$nik);
            $stmt->bindParam(':alamat',$alamat);
            $stmt->bindParam(':kelurahan',$kelurahan);
            $stmt->bindParam(':kecamatan',$kecamatan);
            $stmt->bindParam(':kabkota',$kabkota);
            $stmt->bindParam(':kp',$kp);
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':telp',$telp);
            $stmt->bindParam(':password',$hash);
            return $stmt->execute();
        }catch(PDOException $e){
            die('Gagal Menambahkan Data :' .  $e->getMessage());
        }
    }

    public function Selectpelanggan(){
        try{
            $sql = "SELECT * FROM pelanggan";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            die('Gagal Menampilkan Data :' .  $e->getMessage());
        }
    }
}

$pelanggan = new Pelanggan();
// $pelanggan->Insertpelanggan('fadlan','1234567','jl.aws','gunung kelua','samarinda ulu','samarinda','12345','fadlan@gmail.com','082210732928','fadlan123');
// $data = $pelanggan->Selectpelanggan();
// var_dump($data);
?>