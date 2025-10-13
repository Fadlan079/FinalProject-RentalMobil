<?php
require_once "database.php";

class User{
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }
  
    public function Insertuser($nama, $sim, $email, $password,  $ktp, $tlp, $role=null) {
        try {
            $sql = "INSERT INTO user (nama, sim, email, password, ktp, tlp) VALUES (:nama, :sim, :email, :password, :ktp, :tlp)";
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":sim", $sim);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":password", $hash);
            $stmt->bindparam(":ktp", $ktp);
            $stmt->bindparam(":tlp", $tlp);
            
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Data Gagagl di tambahkan, silahkan coba lagi :" .$e->getMessage();
        }
    }

    public function Selectuser($id_user = null, $nama = null){
        if($id_user !== null){
            try{
                $sql = "SELECT * FROM user WHERE id_user = :id_user";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['id_user' => $id_user]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
                
            }catch(PDOException $e){
                echo "Data Gagal di ambil, silahkan coba lagi :" . $e->getMessage();
            }
        }elseif($nama !== null){
            try{
                $sql = "SELECT * FROM user WHERE nama = :nama";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['nama' => $nama]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo "Data Gagal di ambil, silahkan coba lagi :" . $e->getMessage();
            }
        }else{
            try{
                $sql = "SELECT * FROM user";
                $stmt = $this->pdo->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo "Data Gagal di ambil, silahkan coba lagi :" . $e->getMessage();
            }
        }
    }

    public function Updateuser($id, $nama, $ktp, $sim, $alamat, $email, $password) {
        $sql = "UPDATE user SET nama=:nama, sim=:sim, email=:email, password=:password, ktp=:ktp, tlp=:tlp WHERE id_customer=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id_user", $id);
        $stmt->bindParam(":nama", $nama);
        $stmt->bindParam(":sim", $sim);
        $stmt->bindparam(":email", $email);
        $stmt->bindparam(":password", $password);
        $stmt->bindparam(":ktp", $ktp);
        $stmt->bindparam(":tlp", $tlp); 
        return $stmt->execute();
    }

    public function Deleteuser($id) {
        $sql = "DELETE FROM user WHERE id_user=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>