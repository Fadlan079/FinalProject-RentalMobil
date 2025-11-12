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
        <header class="flex justify-between items-center px-4 pb-6">
            <div>
                <h2 class="text-xl font-semibold">Data Mobil</h2>
                <p class="text-sm text-neutral-500">Lihat dan kelola seluruh data mobil.</p>
            </div>

            <div class="flex items-center gap-3">
                <form method="GET" action="data-mobil.php" class="relative">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-neutral-400"></i></button>
                    <input 
                        type="text" 
                        name="keyword"
                        placeholder="Cari mobil..." 
                        class="pl-9 pr-3 py-2 rounded-xl border border-neutral-300 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition-all duration-300"
                        value = "<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>"
                    >
                </form>
                <a href="index.php?action=insert" class="bg-orange-500 text-orange-100 p-2 rounded-xl font-semi-bold hover:bg-orange-600 transition-all duration-300">Tambah Mobil</a>
                <select class="py-2 px-3 border border-neutral-300 rounded-xl text-sm text-neutral-600 focus:ring-2 focus:outline-none focus:ring-orange-400 focus:border-orange-400 transition-all duration-300">
                    <option value="">Semua Status</option>
                    <option value="ready">Ready</option>
                    <option value="disewa">Disewa</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
        </header>
        <section class="p-6 grid grid-cols-3 gap-6">
            <div class="relative overflow-hidden bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300 text-white">
                <div class="absolute opacity-20 -right-6 -bottom-6 text-8xl">
                    <i class="fa-solid fa-check-to-slot"></i>
                </div>
                <div class="p-6 relative z-10">
                    <p class="text-sm uppercase tracking-wide text-emerald-100">Ready</p>
                    <h3 class="text-4xl font-extrabold mt-2"><?= htmlspecialchars($status['ready'] ?? 0) ?> Unit</h3>
                    <p class="text-emerald-100 text-sm mt-1">Mobil yang tersedia di garasi</p>  
                </div>
            </div>
            <div class="relative overflow-hidden bg-gradient-to-br from-red-500 to-red-600 rounded-2xl shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300 text-white">
                <div class="absolute opacity-30 -right-6 -bottom-6 text-8xl">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="p-6 relative z-10">
                    <p class="text-sm uppercase tracking-wide text-red-100">Rent</p>
                    <h3 class="text-4xl font-extrabold mt-2"><?= htmlspecialchars($status['rent'] ?? 0) ?> Unit</h3>
                    <p class="text-red-100 text-sm mt-1">Mobil yang sedang dalam proses penyewaan</p>  
                </div>
            </div>
                <div class="relative overflow-hidden bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300 text-white">
                    <div class="absolute opacity-20 -right-6 -bottom-6 text-8xl">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </div>
                <div class="p-6 relative z-10">
                    <p class="text-sm uppercase tracking-wide text-yellow-100">Maintenance</p>
                    <h3 class="text-4xl font-extrabold mt-2"><?= htmlspecialchars($status['maintenance'] ?? 0) ?> Unit</h3>
                    <p class="text-yellow-100 text-sm mt-1">Mobil yang sedang dalam proses pemeliharaan</p>  
                </div>
            </div>
        </section>
        <section class="bg-white p-6 shadow-xl rounded-2xl">
            <div class="flex justify-between text-xl font-semibold px-4 pb-4">
                <h2>Daftar Mobil</h2>
                <a href="" class="text-orange-500 hover:text-orange-400 hover:underline transition-all duration-300">Lihat Semua</a>
            </div>
            <table class="w-full text-left border-collapse">
                <thead class="text-sm text-neutral-500 border-b">
                    <tr>
                        <th class="px-3 py-3">ID</th>
                        <th class="px-3 py-3">Merek</th>
                        <th class="px-3 py-3">Model</th>
                        <th class="px-3 py-3">Tahun</th>
                        <th class="px-3 py-3">Harga Sewa/hari</th>
                        <th class="px-3 py-3">Status</th>
                        <th class="px-3 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                <?php if(!empty($data_mobil)):?>
                    <?php foreach ($data_mobil as $row): ?>
                        <tr class="border-b hover:bg-orange-400/20 text-neutral-400 transition-all duration-300 text-sm text-left">
                            <th class="px-3 py-3"><?= $row['id_mobil'])?></th>
                            <th class="px-3 py-3"><?= htmlspecialchars($row['merek'])?></th>
                            <th class="px-3 py-3"><?= htmlspecialchars($row['model'])?></th>
                            <th class="px-3 py-3"><?= htmlspecialchars($row['tahun'])?></th>
                            <th class="px-3 py-3 text-emerald-500"><?= $row['harga_hari']?></th>
                            <th class="px-3 py-3 flex gap-5 text-center">
                                <details class="relative  px-3 py-1 text-orange-600 font-medium rounded-lg  flex items-center justify-center gap-2 marker:content-none">
                                    <summary class="cursor-pointer">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </summary>
                                    <ul class="absolute left-10 w-30 bg-white shadow-lg border border-gray-100 rounded-xl overflow-hidden z-50">
                                        <li>
                                            <a href="index.php?action=update&id=<?= $row['id_mobil']?>" class="flex items-center gap-2 px-4 py-2 text-sm text-emerald-600 hover:bg-emerald-50 transition-all duration-300">
                                                <i class="fa-solid fa-pen"></i> Edit
                                            </a>
                                        </li>
                                         <li>
                                            <a href="index.php?action=delete&id=<?= $row['id_mobil']?>" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-all duration-300" onclick="return confirm('Yakin Ingin Menghapus Data dengan ID <?= $row['id_mobil']?> ?')">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </a>
                                         </li>
                                    </ul>
                                </details>
                            </th>
                        </tr>
                    <?php endforeach?>   
                    <?php else:?>
                        <tr>
                            <td colspan="12" class="py-6">
                                <div class="flex flex-col items-center justify-center text-center gap-5 italic text-neutral-300 text-xl">
                                    <i class="fa-solid fa-database text-4xl"></i>
                                    <h2 class="text-4xl">Belum ada data yang dapat ditampilkan</h2>
                                    <p>Silahkan tambah data mobil dengan menekan tombol "Tambah Mobil"</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif?> 
                </tbody>
            </table>
        </section>
    </main>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
    const allDetails = document.querySelectorAll("details");

    allDetails.forEach((targetDetail) => {
        targetDetail.addEventListener("toggle", () => {
        if (targetDetail.open) {
            allDetails.forEach((detail) => {
            if (detail !== targetDetail) detail.removeAttribute("open");
            });
        }
        });
    });
    });
    </script>
</body>
</html>