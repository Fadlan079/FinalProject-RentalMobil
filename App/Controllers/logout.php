.<?php
session_start();
session_unset();
session_destroy();

header("Location: ../../App/Controllers/login.php");
exit;
?>