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

    /**
     * @param string|array $role
     */
    public static function requirerole($role){
        self::requirelogin();
        if (is_array($role)) {
            if (!in_array($_SESSION['user']['role'], $role)) {
                header("Location: index.php?action=index");
                exit;
            }
        } else {
            if ($_SESSION['user']['role'] !== $role) {
                header("Location: index.php?action=index");
                exit;
            }
        }
    }
}
?>