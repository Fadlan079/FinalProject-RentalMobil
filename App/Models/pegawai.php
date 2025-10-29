<?php
require_once __DIR__ . '/../../Config/Database.php';

class Pegawai{
    private $pdo;

    public function __construct(){
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function Insertpegawai($id_user,$nama,$tmpt_lhr,$tgl_lhr,$alamat,$kel,$kec,$kab,$KP,$telp){
        try{
            $sql = "INSERT INTO pegawai(id_user,nama,tmpt_lhr,tgl_lhr,alamat,kel,kec,kab,KP,telp) VALUES(:id_user,:nama,:tmpt_lhr,:tgl_lhr,:alamat,:kel,:kec,:kab,:KP,:telp)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_user',$id_user);
            $stmt->bindParam(':nama',$nama);
            $stmt->bindParam(':tmpt_lhr',$tmpt_lhr);
            $stmt->bindParam(':tgl_lhr',$tgl_lhr);
            $stmt->bindParam(':alamat',$alamat);
            $stmt->bindParam(':kel',$kel);
            $stmt->bindParam(':kec',$kec);
            $stmt->bindParam(':kab',$kab);
            $stmt->bindParam(':KP',$KP);
            $stmt->bindParam(':telp',$telp);
            return $stmt->execute();
        }catch(PDOException $e){
            die('Gagal Menambahkan Data :' .  $e->getMessage());
        }
    }

    public function Selectpegawai(){
        try{
            $sql = "SELECT * FROM pegawai";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            die('Gagal Menampilkan Data :' .  $e->getMessage());
        }
    }

    public function Updatepegawai($id_pegawai,$id_user,$nama,$tmpt_lhr,$tgl_lhr,$alamat,$kel,$kec,$kab,$KP,$telp){
        try{
            $sql = "UPDATE pegawai SET id_user=:id_user,nama=:nama,tmpt_lhr=:tmpt_lhr,tgl_lhr=:tgl_lhr,alamat=:alamat,kel=:kel,kec=:kec,kab=:kab,KP=:KP,telp=:telp WHERE id_pegawai=:id_pegawai LIMIT = 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_pegawai',$id_pegawai);
            $stmt->bindParam(':id_user',$id_user);
            $stmt->bindParam(':nama',$nama);
            $stmt->bindParam(':tmpt_lhr',$tmpt_lhr);
            $stmt->bindParam(':tgl_lhr',$tgl_lhr);
            $stmt->bindParam(':alamat',$alamat);
            $stmt->bindParam(':kel',$kel);
            $stmt->bindParam(':kec',$kec);
            $stmt->bindParam(':kab',$kab);
            $stmt->bindParam(':KP',$KP);
            $stmt->bindParam(':telp',$telp);
            return $stmt->execute();
        }catch(PDOException $e){
            die('Gagal Memperbarui Data :' .  $e->getMessage());
        }
    }

    public function Deletepegawai($id_pegawai){
        try{
            $sql = "DELETE FROM pegawai WHERE id_pegawai = :id_pegawai LIMIT = 1";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(['id_pegawai' => $id_pegawai]);
        }catch(PDOException $e){
            die('Gagal Menghapus Data :' .  $e->getMessage());
        }
    }
}

// $pegawai = new Pegawai();
// $pegawai->Insertpegawai(1,'','',Null,'','','','','','');
// $pegawai->Updatepegawai(1,2,'Test1','Samarinda','2008-09-11','Jl Tanah Hitam','Gunung kelua','Samarinda Ulu','Samarinda',12346,'0822100732927');
// $pegawai->Deletepegawai(2);
// $data = $pegawai->Selectpegawai();
// var_dump($data);
?>