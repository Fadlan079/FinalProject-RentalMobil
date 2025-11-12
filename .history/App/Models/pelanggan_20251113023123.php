<?php
require_once __DIR__ . '/../../Config/Database.php';

class Pelanggan{
    private $pdo;

    public function __construct(){
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function Insertpelanggan($id_user,$nama,$nik,$alamat,$kelurahan,$kecamatan,$kota,$kp,$telp,$bio,$pp){
        try{
            $sql = "INSERT INTO pelanggan(id_user,nama,nik,alamat,kelurahan,kecamatan,kota,kp,telp,bio,pp) VALUES(:id_user,:nama,:nik,:alamat,:kelurahan,:kecamatan,:kota,:kp,:telp,:bio,:pp)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_user',$id_user);
            $stmt->bindParam(':nama',$nama);
            $stmt->bindParam(':nik',$nik);
            $stmt->bindParam(':alamat',$alamat);
            $stmt->bindParam(':kelurahan',$kelurahan);
            $stmt->bindParam(':kecamatan',$kecamatan);
            $stmt->bindParam(':kota',$kota);
            $stmt->bindParam(':kp',$kp);
            $stmt->bindParam(':telp',$telp);
            $stmt->bindParam(':bio',$bio);
            $stmt->bindParam(':pp',$pp);
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

    public function getpelangganbyiduser($id_user){
        try{
            $sql = "SELECT * FROM pelanggan WHERE id_user = :id_user";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_user'=>$id_user]);
            $pelanggan = $stmt->fetch(PDO::FETCH_ASSOC);
            return $pelanggan ?: false;
        }catch(PDOException $e){
            die('Gagal Menampilkan Data Dengan ID User :' .  $e->getMessage());
        }
    }

    public function Updatepelanggan($id_user,$nama,$nik,$alamat,$kelurahan,$kecamatan,$kota,$kp,$telp,$bio,$pp){
        try{
            $sql = "UPDATE pelanggan SET nama=:nama,nik=:nik,alamat=:alamat,kelurahan=:kelurahan,kecamatan=:kecamatan,kota=:kota,kp=:kp,telp=:telp,bio=:bio,pp=:pp WHERE id_user=:id_user";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_user',$id_user);
            $stmt->bindParam(':nama',$nama);
            $stmt->bindParam(':nik',$nik);
            $stmt->bindParam(':alamat',$alamat);
            $stmt->bindParam(':kelurahan',$kelurahan);
            $stmt->bindParam(':kecamatan',$kecamatan);
            $stmt->bindParam(':kota',$kota);
            $stmt->bindParam(':kp',$kp);
            $stmt->bindParam(':telp',$telp);
            $stmt->bindParam(':bio',$bio);
            $stmt->bindParam(':pp',$pp);
            return $stmt->execute();
        }catch(PDOException $e){
            die('Gagal Memperbarui Data :' .  $e->getMessage());
        }
    }

    public function Deletepelanggan($id_pelanggan){
        try{
            $sql = "DELETE FROM pelanggan WHERE id_pelanggan = :id_pelanggan";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(['id_pelanggan' => $id_pelanggan]);
        }catch(PDOException $e){
            die('Gagal Menghapus Data :' .  $e->getMessage());
        }
    }
}

// $pelanggan = new Pelanggan();
// $pelanggan->Insertpelanggan(1,'','','','','','','','','','','');
// $pelanggan->Updatepelanggan(3,1,'Fadlan',1234,'Jl Aw Syahrani','Gunung kelua','Samarinda Ulu','Samarinda',12345,'0822100732928','testing','testing.jpg');
// $pelanggan->Deletepelanggan(2);
// $data = $pelanggan->Selectpelanggan();
// $data = $pelanggan->getpelangganbyiduser(1);
// var_dump($data);
?>