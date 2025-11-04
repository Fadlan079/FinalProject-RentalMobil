<?php
class Middleware{
    public static function requirelogin(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header("Location: ../Public/?action=login");
            exit;
        }
    }

    public static function requirerole($role){
        self::requirelogin();
        if ($_SESSION['user']['role'] !== $role) {
            header("Location: ../Public/?action=index");
            exit;
        }
    }
}
?>