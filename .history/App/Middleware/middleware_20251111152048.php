<?php
class Middleware{
    public static function requirelogin(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login");
            exit;
        }
    }

    public static function requireloginOptional(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user']);
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