<?php
require_once __DIR__ . '/../../Config/Database.php';

class User{
    private $pdo;

    public function __construct(){
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function Insertuser($email,$password,$jk,$role=Null){
        try{
            $hash = Password_hash($password,PASSWORD_DEFAULT);
            if ($role) {
                $sql = "INSERT INTO user (email, password,jk, role) VALUES (:email, :password,:jk, :role)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':role', $role);
            } else {
                $sql = "INSERT INTO user (email, password,jk) VALUES (:email, :password,:jk)";
                $stmt = $this->pdo->prepare($sql);
            }
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':password',$hash);
            $stmt->bindParam(':jk',$jk);
            return $stmt->execute();
        }catch(PDOException $e){
            die('Gagal Menambahkan Data :' .  $e->getMessage());
        }
    }

    public function Selectuser(){
        try{
            $sql = "SELECT * FROM user";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            die('Gagal Menampilkan Data :' .  $e->getMessage());
        }
    }

    public function getuserbyemail($email){
        try{
            $sql = "SELECT * FROM user WHERE email = :email";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['email' => $email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            die('Gagal Menampilkan Data :' .  $e->getMessage());
        }
    }

    public function updateUser($id, $email, $password = null, $jk, $role = null) {
    try {
        // Update dengan password baru (jika diisi)
        if ($password) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE user 
                    SET email = :email, password = :password, jk = :jk, role = :role 
                    WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':password', $hash);
        } else {
            // Jika password tidak diubah
            $sql = "UPDATE user 
                    SET email = :email, jk = :jk, role = :role 
                    WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
        }

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':jk', $jk);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    } catch (PDOException $e) {
        die('Gagal Mengupdate Data: ' . $e->getMessage());
    }
}

public function deleteUser($id) {
    try {
        $sql = "DELETE FROM user WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        die('Gagal Menghapus Data: ' . $e->getMessage());
    }
}

}


?>
// $user = new User();
// $user->Insertuser('test1@gmail.com','12345');
// $data = $user->Selectuser();
// var_dump($data);