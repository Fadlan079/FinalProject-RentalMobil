<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog Mobil - Cylc Rent Car</title>
    <link rel="stylesheet" href="../src/output.css">
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
                            <th class="px-3 py-3"><?= htmlspecialchars($row['id_mobil'])?></th>
                            <th class="px-3 py-3"><?= htmlspecialchars($row['merek'])?></th>
                            <th class="px-3 py-3"><?= htmlspecialchars($row['model'])?></th>
                            <th class="px-3 py-3"><?= htmlspecialchars($row['tahun'])?></th>
                            <th class="px-3 py-3 text-emerald-500"><?= htmlspecialchars($row['harga_sewa'])?></th>
                            <?php if($row['status'] == 'ready'):?>
                                <th class=""><span class="bg-gradient-to-br from-emerald-400 to-emerald-500 text-emerald-100 p-1 w-25 text-center inline-block rounded-full"><?= htmlspecialchars($row['status'])?></span></th>
                            <?php elseif($row['status'] == 'maintenance'):?>
                                <th class=""><span class="bg-gradient-to-br from-yellow-400 to-yellow-500 text-yellow-100 p-1 w-25 text-center inline-block rounded-full"><?= htmlspecialchars($row['status'])?></span></th>
                            <?php else:?>
                                <th class=""><span class="bg-gradient-to-br from-red-400 to-red-500 text-red-100 p-1 w-25 text-center inline-block rounded-full"><?= htmlspecialchars($row['status'])?></span></th>
                            <?php endif?>
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

<!-- <?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda - Cylc Rent Car</title>
  <link rel="stylesheet" href="../src/output.css">
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
    <header class="flex justify-between items-center mb-8">
      <div>
        <h2 class="text-2xl font-semibold">Dashboard</h2>
        <p class="text-neutral-500 text-sm">Selamat datang kembali, Admin!</p>
      </div>
      <button class="bg-orange-500 text-white px-4 py-2 rounded-xl shadow-xl hover:bg-orange-400 transition-all duration-300"><i class="fa-solid fa-plus"></i> Tambah Mobil</button>
    </header>

    <section class="grid grid-cols-4 gap-6 mb-8">
      <div class="relative overflow-hidden bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300 text-white">
        <div class="absolute opacity-20 -right-6 -bottom-6 text-8xl">
          <i class="fa-solid fa-car-side"></i>
        </div>
        <div class="p-6 relative z-10">
            <p class="text-sm uppercase tracking-wide text-orange-100">Total Mobil</p>
            <h3 class="text-4xl font-extrabold mt-2"><?= htmlspecialchars($jumlahmobil ?? 0) ?> Unit</h3>
            <p class="text-orange-100 text-sm mt-1">Mobil yang tersedia di garasi</p>  
        </div>
      </div>
      <div class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300 text-white">
        <div class="absolute opacity-20 -right-6 -bottom-6 text-8xl">
          <i class="fa-solid fa-users"></i>
        </div>
        <div class="p-6 relative z-10">
            <p class="text-sm uppercase tracking-wide text-blue-100">Pelanggan</p>
            <h3 class="text-4xl font-extrabold mt-2"><?= htmlspecialchars($jumlahuser ?? 0) ?> User</h3>
            <p class="text-blue-100 text-sm mt-1">Total Pelanggan yang sudah menyewa di Cylc</p>
        </div>
      </div>
      <div class="relative overflow-hidden bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300 text-white">
        <div class="absolute opacity-20 -right-6 -bottom-6 text-8xl">
          <i class="fa-solid fa-money-bill-trend-up"></i>
        </div>
        <div class="p-6 relative z-10">
            <p class="text-sm uppercase tracking-wide text-emerald-100">Pendapatan Bulan Ini</p>
            <h3 class="text-4xl font-extrabold mt-2">Rp <?= number_format($pendapatanbulanini ?? 0) ?></h3>
            <p class="text-emerald-100 text-sm mt-1">Total pendapatan yang di dapat bulan ini</p>
        </div>
      </div>
      <div class="relative overflow-hidden bg-gradient-to-br from-neutral-500 to-neutral-600 rounded-2xl shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300 text-white">
        <div class="absolute opacity-20 -right-6 -bottom-6 text-8xl">
          <i class="fa-solid fa-file-contract"></i>
        </div>
        <div class="p-6 relative z-10">
            <p class="text-sm uppercase tracking-wide text-neutral-100">Pelanggan</p>
            <h3 class="text-4xl font-extrabold mt-2"><?= htmlspecialchars($transaksiaktif ?? 0) ?> Transaksi Aktif</h3>
            <p class="text-neutral-100 text-sm mt-1">Transaksi dengan status "proses"</p>    
        </div>
      </div>
    </section>

    <section class="bg-white rounded-2xl shadow p-6">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Transaksi Terbaru</h3>
        <button class="text-sm text-orange-500 hover:underline">Lihat Semua</button>
      </div>

      <table class="w-full text-left border-collapse">
        <thead class="text-sm text-neutral-700 border-b">
            <tr>
                <th class="px-3 py-3">ID</th>
                <th class="px-3 py-3">Pelanggan</th>
                <th class="px-3 py-3">Mobil yang di sewa</th>
                <th class="px-3 py-3">Tgl Sewa</th>
                <th class="px-3 py-3">Tgl kembali</th>
                <th class="px-3 py-3">Total Bayar</th>
            </tr>
        </thead>
        <tbody class="text-sm">
        <?php if(!empty($datatransaksi)):?>
            <?php foreach($datatransaksi as $row):?>
                <tr class="border-b hover:bg-orange-400/20 text-neutral-400 transition-all duration-300 text-sm text-left">
                    <th class="px-3 py-3"><?= htmlspecialchars($row['id_transaksi'])?></th>
                    <th class="px-3 py-3"><?= htmlspecialchars($row['nama_pelanggan'])?></th>
                    <th class="px-3 py-3"><?= htmlspecialchars($row['mobil'])?></th>
                    <th class="px-3 py-3"><?= htmlspecialchars($row['tgl_sewa'])?></th>
                    <th class="px-3 py-3"><?= htmlspecialchars($row['tgl_kembali'])?></th>
                    <th class="px-3 py-3 text-emerald-500"><?= number_format($row['total_bayar'])?></th>
                </tr>
            <?php endforeach?>   
            <?php else:?>
                <tr>
                    <td colspan="12" class="py-6">
                        <div class="flex flex-col items-center justify-center text-center gap-5 italic text-neutral-300 text-xl">
                            <i class="fa-solid fa-file-contract text-4xl"></i>
                            <h2 class="text-4xl">Belum ada data yang di tambahkan</h2>
                            <p>Silahkan tambah data transaksi dengan menekan tombol "Tambah Transaksi"</p>
                        </div>
                    </td>
                </tr>
            <?php endif?> 
        </tbody>
      </table>
    </section>
  </main>
</body>
</html> -->