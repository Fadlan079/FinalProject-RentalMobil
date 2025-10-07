<?php
require_once "database.php";

class User{
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }
  
    public function Insertuser($nama, $sim, $alamat,$ktp) {
        $sql = "INSERT INTO user (nama, sim ,alamat, ktp) VALUES (:nama, :sim, :alamat, :ktp)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":nama", $nama);
        $stmt->bindParam(":sim", $sim);
        $stmt->bindparam(":alamat", $alamat);
        $stmt->bindParam(":ktp", $ktp);
        return $stmt->execute();
    }

    public function Selectuser() {
        $sql = "SELECT * FROM user";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Updateuser($id, $nama, $sim,$alamat, $ktp) {
        $sql = "UPDATE user SET nama=:nama, sim=:sim, alamat=:alamat, ktp=:ktp WHERE id_customer=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id_user", $id);
        $stmt->bindParam(":nama", $nama);
        $stmt->bindParam(":sim", $sim);
        $stmt->bindparam(":alamat", $alamat);
        $stmt->bindparam(":ktp", $ktp);
        return $stmt->execute();
    }

    public function Deleteuser($id) {
        $sql = "DELETE FROM user WHERE id_customer=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>