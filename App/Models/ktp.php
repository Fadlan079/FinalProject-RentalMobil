<?php
require_once "database.php";

class Ktp{
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function Insertcustomer($nama, $sim, $alamat,$telepon) {
        $sql = "INSERT INTO customer (nama, sim ,alamat, telepon) VALUES (:nama, :sim, :alamat, :telepon)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":nama", $nama);
        $stmt->bindParam(":sim", $sim);
        $stmt->bindparam(":alamat", $alamat);
        $stmt->bindParam(":telepon", $telepon);
        return $stmt->execute();
    }

    public function Selectcustomer() {
        $sql = "SELECT * FROM customer";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Updatecustomer($id_customer, $nama, $sim,$alamat, $telepon) {
        $sql = "UPDATE customer SET nama=:nama, sim=:sim, alamat=:alamat, telepon=:telepon WHERE id_customer=:id_customer";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":nama", $nama);
        $stmt->bindParam(":sim", $sim);
        $stmt->bindparam(":alamat", $alamat);
        $stmt->bindparam(":telepon", $telepon);
        $stmt->bindParam(":id_customer", $id_customer);
        return $stmt->execute();
    }

    public function Deletecustomer($id_customer) {
        $sql = "DELETE FROM customer WHERE id_customer=:id_customer";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id_customer", $id);
        return $stmt->execute();
    }
}
?>