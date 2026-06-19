<?php
require_once __DIR__ . '/Config/Database.php';
$db = new Database();
$pdo = $db->getConnection();
$stmt = $pdo->query("SHOW COLUMNS FROM pegawai WHERE Field = 'jabatan'");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo "Jabatan ENUM: " . $row['Type'] . "\n";
?>
