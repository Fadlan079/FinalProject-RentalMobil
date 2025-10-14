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

    public function getUserBy($column, $value) {
    try {
        $allowedColumns = ['nama', 'email']; // saat pemerikaan database hanya ada column nama dan email jika tidak ada maka akan dilempar error dengan pesan kolom tidak valid
        if (!in_array($column, $allowedColumns)) {
            throw new Exception("Kolom tidak valid");
        }

        $sql = "SELECT * FROM user WHERE $column = :value LIMIT 1";// mengambil semua data yang ada dari user dimana column alias nama/email dari allowed diatas dan value yaitu isi dari column nama dan email
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Terjadi kesalahan saat mengambil user: " . $e->getMessage();
        return false;
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

    public function Jumlahuser(){
        try{
            $sql = "SELECT COUNT(*) AS jumlahuser FROM user";
            $stmt = $this->pdo->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['jumlahuser'];
        }catch(PDOException $e){
                echo "Data Gagagl di tambahkan, silahkan coba lagi :" .$e->getMessage();
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