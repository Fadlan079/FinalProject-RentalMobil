<?php
require_once "../Models/mobil.php";
$mobil = new Mobil();
$mobil->SelectMobil();

$datamobil = $mobil->SelectMobil();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mobil - Cylc Rent Car</title>
    <link rel="stylesheet" href="../../src/output.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body class="bg-neutral-100 text-neutral-800 font-sans">
    <aside class="fixed left-0 top-0 w-64 h-full bg-neutral-900 text-neutral-200 flex flex-col justify-between rounded-r-3xl shadow-lg">
        <div>
            <div class="p-6 flex items-center gap-3 border-b border-neutral-700">
            <div class="bg-orange-500 w-10 h-10 rounded-xl flex items-center justify-center text-white text-xl font-bold">C</div>
            <h1 class="text-lg font-semibold tracking-wide">Cylc Rent Car</h1>
            </div>

            <nav class="mt-6 flex flex-col gap-2">
            <a href="index.php" class="px-6 py-3 hover:bg-neutral-800 rounded-r-full transition-all duration-300"><i class="fa-solid fa-table-columns"></i> Dashboard</a>
            <a href="data-mobil.php" class="px-6 py-3 bg-orange-500/20 text-orange-400 font-semibold rounded-r-full"><i class="fa-solid fa-database"></i> Data Mobil</a>
            <a href="transaksi.php" class="px-6 py-3 hover:bg-neutral-800 rounded-r-full transition-all duration-300"><i class="fa-solid fa-file-contract"></i> Transaksi</a>
            <a href="#" class="px-6 py-3 hover:bg-neutral-800 rounded-r-full transition-all duration-300"><i class="fa-solid fa-repeat"></i> Pengembalian</a>
            <a href="#" class="px-6 py-3 hover:bg-neutral-800 rounded-r-full transition-all duration-300"><i class="fa-solid fa-bug"></i> Laporan</a>
            <a href="#" class="px-6 py-3 hover:bg-neutral-800 rounded-r-full transition-all duration-300"><i class="fa-solid fa-users"></i> Kelola User</a>
            <a href="#" class="px-6 py-3 hover:bg-neutral-800 rounded-r-full transition-all duration-300"><i class="fa-solid fa-circle-info"></i> Bantuan</a>
            </nav>
        </div>

        <div class="p-6 border-t border-neutral-700 flex items-center gap-3">
            <img src="" alt="profil" class="w-10 h-10 rounded-full bg-neutral-700"></img>
            <div>
            <p class="font-semibold text-sm">Admin Cylc</p>
            <p class="text-xs text-neutral-400">Super Admin</p>
            </div>
        </div>
    </aside>
    <main class="ml-64 p-8">
        <header class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-semibold">Data Mobil</h2>
        </div>
        <button class="bg-orange-500 text-white px-4 py-2 rounded-xl shadow-xl hover:bg-orange-400 transition-all duration-300"><i class="fa-solid fa-plus"></i> Tambah Mobil</button>
        </header>
        <section class="bg-white p-6 shadow-xl rounded-2xl">
            <div class="flex justify-between">
                <h2>Data Mobil</h2>
                <a href="" class="text-orange-500 hover:text-orange-400 transition-all duration-300">Lihat Semua</a>
            </div>
            <table class="w-full text-left border-collapse">
                <thead class="text-sm text-neutral-500 border-b">
                    <tr>
                        <th class="px-3 py-3">ID</th>
                        <th class="px-3 py-3">Kapasitaas</th>
                        <th class="px-3 py-3">Deskripsi</th>
                        <th class="px-3 py-3">Merek</th>
                        <th class="px-3 py-3">Harga sewa /Hari</th>
                        <th class="px-3 py-3">Transmisi</th>
                        <th class="px-3 py-3">Bahan Bakar</th>
                        <th class="px-3 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                <?php foreach($datamobil as $row):?>
                    <tr class="border-b hover:bg-orange-500/20 transition-all duration-300">
                        <th></th>
                        <th class="px-3 py-3"><?= htmlspecialchars($row['kapasitas'])?></th>
                        <th class="px-3 py-3"><?= htmlspecialchars($row['deskripsi'])?></th>
                        <th class="px-3 py-3"><?= htmlspecialchars($row['merk'])?></th>
                        <th class="px-3 py-3"><?= htmlspecialchars($row['harga_per_hari'])?></th>
                        <th class="px-3 py-3"><?= htmlspecialchars($row['transmisi'])?></th>
                        <th class="px-3 py-3"><?= htmlspecialchars($row['bhn_bkr'])?></th>
                        <th class="px-3 py-3">
                            <a href=""></a>
                            <a href=""></a>
                        </th>
                    </tr>
                <?php endforeach?>    
                </tbody>
            </table>
        </section>
    </main>
    
</body>
</html>