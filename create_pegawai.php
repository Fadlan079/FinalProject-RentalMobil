<?php
require_once __DIR__ . '/App/Models/user.php';
require_once __DIR__ . '/App/Models/pegawai.php';

$userModel = new User();
$pegawaiModel = new Pegawai();

$email = 'pegawai@cylc.com';
$password = 'pegawai123';
$jk = 'L';
$role = 'pegawai';

// Check if user already exists
$existing = $userModel->getuserbyemail($email);
if ($existing) {
    echo "Pegawai user already exists with ID: " . $existing['id_user'] . "\n";
    $userId = $existing['id_user'];
} else {
    $userId = $userModel->Insertuser($email, $password, $jk, $role);
    if ($userId) {
        echo "Successfully created pegawai user with ID: $userId\n";
    } else {
        echo "Failed to create pegawai user.\n";
        exit;
    }
}

// Make sure pegawai record exists
$existingPegawai = $pegawaiModel->getPegawaiByUserId($userId);
if (!$existingPegawai) {
    // Insert dummy pegawai data
    $pegawaiModel->Insertpegawai(
        $userId,
        'Pegawai Cylc', // nama
        'Bandung', // tmpt_lhr
        '1990-01-01', // tgl_lhr
        'Jl. Pegawai No. 1', // alamat
        'Maleber', // kel
        'Andir', // kec
        'Bandung', // kota
        '40182', // KP
        '081234567890', // telp
        'Pegawai Andalan Cylc', // bio
        NULL, // pp
        'admin' // jabatan
    );
    echo "Successfully created pegawai record.\n";
} else {
    echo "Pegawai record already exists.\n";
}
?>
