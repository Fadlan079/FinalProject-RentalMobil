<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cylc Rent Car</title>
    <link rel="stylesheet" href="output.css">
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
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
            <a href="data-mobil.php" class="px-6 py-3 bg-orange-500/20 text-orange-400 font-semibold rounded-r-full"><i class="fa-solid fa-database"></i> Data Mobil</a>
            <a href="transaksi.php" class="px-6 py-3 hover:bg-neutral-800 rounded-r-full transition-all duration-300"><i class="fa-solid fa-file-contract"></i> Transaksi</a>
            <a href="pengembalian.php" class="px-6 py-3 hover:bg-neutral-800 rounded-r-full transition-all duration-300"><i class="fa-solid fa-repeat"></i> Pengembalian</a>
            <a href="laporan.php" class="px-6 py-3 hover:bg-neutral-800 rounded-r-full transition-all duration-300"><i class="fa-solid fa-bug"></i> Laporan</a>
            <a href="kelola-user.php" class="px-6 py-3 hover:bg-neutral-800 rounded-r-full transition-all duration-300"><i class="fa-solid fa-users"></i> Kelola User</a>
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
        <h2>Data Mobil</h2>
        <p>Menampilkan informasi lengkap setiap unit mobil yang tersedia dalam sistem.</p>
        <a href="index.php?action=insert-mobil" class="p-2 my-5 inline-block rounded-xl shadow-lg bg-orange-500 hover:bg-orange-600 text-orange-50 font-semibold transition-all duration-300">Tambah Mobil</a>
        <table class="min-w-full border border-neutral-800 rounded-xl overflow-hidden shadow-lg">
            <thead class="bg-neutral-900 text-neutral-300">
                <tr>
                    <th class="px-4 py-3 border border-neutral-800 font-semibold">#</th>
                    <th class="px-4 py-3 border border-neutral-800 font-semibold">ID</th>
                    <th class="px-4 py-3 border border-neutral-800 font-semibold">Image</th>
                    <th class="px-4 py-3 border border-neutral-800 font-semibold">Tahun</th>
                    <th class="px-4 py-3 border border-neutral-800 font-semibold">Warna</th>
                    <th class="px-4 py-3 border border-neutral-800 font-semibold">Status</th>
                    <th class="px-4 py-3 border border-neutral-800 font-semibold">No Plat</th>
                    <th class="px-4 py-3 border border-neutral-800 font-semibold">No Mesin</th>
                    <th class="px-4 py-3 border border-neutral-800 font-semibold">No Rangka</th>
                </tr>
            </thead>

            <tbody class="bg-neutral-950 text-neutral-200">
                <?php $no = 1?>
                <?php foreach($dataMobil as $dm): ?>
                <tr class="hover:bg-orange-500/20 transition duration-200">
                    <td class="px-4 py-3 border border-neutral-800 text-center"><?=  $no++ ?></td>
                    <td class="px-4 py-3 border border-neutral-800 text-center"><?= htmlspecialchars($dm['id_mobil']) ?></td>

                    <td class="px-4 py-3 border border-neutral-800 text-center">
                        <img src="uploads/<?= htmlspecialchars($dm['img']) ?>" 
                            alt="gambar mobil"
                            class="w-20 h-14 object-cover rounded-lg shadow-md">
                    </td>

                    <td class="px-4 py-3 border border-neutral-800 text-center"><?= htmlspecialchars($dm['tahun']) ?></td>
                    <td class="px-4 py-3 border border-neutral-800 text-center"><?= htmlspecialchars($dm['warna']) ?></td>

                    <td class="px-4 py-3 border border-neutral-800 text-center">
                        <span class="
                            px-3 py-1 rounded-full text-white text-xs font-semibold tracking-wide shadow
                            <?= 
                                $dm['status'] === 'ready'
                                    ? 'bg-green-600'
                                    : ($dm['status'] === 'maintenance'
                                        ? 'bg-yellow-500 text-neutral-900'
                                        : 'bg-red-600')
                            ?>
                        ">
                            <?= htmlspecialchars(ucfirst($dm['status'])) ?>
                        </span>
                    </td>

                    <td class="px-4 py-3 border border-neutral-800 text-center"><?= htmlspecialchars($dm['noplat']) ?></td>
                    <td class="px-4 py-3 border border-neutral-800 text-center"><?= htmlspecialchars($dm['nomesin']) ?></td>
                    <td class="px-4 py-3 border border-neutral-800 text-center"><?= htmlspecialchars($dm['norangka']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </main>
</body>
</html>