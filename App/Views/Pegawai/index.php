<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cylc Rent Car</title>
    <link rel="stylesheet" href="output.css">
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #171717; }
        ::-webkit-scrollbar-thumb { background: #f97316; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #ea580c; }
    </style>
</head>
<body class="bg-neutral-100 text-neutral-800 font-sans flex min-h-screen">

    <!-- ===== SIDEBAR ===== -->
    <aside id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-neutral-900 text-neutral-100 flex flex-col justify-between z-50 shadow-xl transition-transform duration-300 -translate-x-full lg:translate-x-0">
        <div>
            <!-- Logo -->
            <div class="p-5 border-b border-neutral-800 flex items-center gap-3">
                <div class="bg-orange-500 w-10 h-10 rounded-xl flex items-center justify-center text-white text-xl font-bold">C</div>
                <h1 class="text-lg font-semibold tracking-wide">Cylc Rent Car</h1>
            </div>

            <!-- Nav -->
            <nav class="mt-4 flex flex-col gap-1 px-3">
                <a href="index.php?action=index-pegawai"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-orange-500/20 text-orange-400 font-semibold">
                    <i class="fa-solid fa-gauge w-5 text-center"></i> <span>Dashboard</span>
                </a>

                <?php if (($_SESSION['user']['role'] ?? '') === 'admin'): ?>
                <a href="index.php?action=data-mobil"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl hover:bg-neutral-800 transition-all duration-200">
                    <i class="fa-solid fa-car w-5 text-center text-orange-400"></i> <span>Data Mobil</span>
                </a>
                <a href="index.php?action=data-pegawai"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl hover:bg-neutral-800 transition-all duration-200">
                    <i class="fa-solid fa-users-gear w-5 text-center text-orange-400"></i> <span>Data Pegawai</span>
                </a>
                <a href="index.php?action=data-pelanggan"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl hover:bg-neutral-800 transition-all duration-200">
                    <i class="fa-solid fa-user w-5 text-center text-orange-400"></i> <span>Data Pelanggan</span>
                </a>
                <a href="index.php?action=laporan"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl hover:bg-neutral-800 transition-all duration-200">
                    <i class="fa-solid fa-chart-line w-5 text-center text-orange-400"></i> <span>Laporan</span>
                </a>
                <?php endif; ?>

                <?php if (($_SESSION['user']['role'] ?? '') === 'customer service'): ?>
                <a href="index.php?action=data-transaksi"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl hover:bg-neutral-800 transition-all duration-200">
                    <i class="fa-solid fa-file-invoice w-5 text-center text-orange-400"></i> <span>Transaksi</span>
                </a>
                <a href="index.php?action=data-pelayanan"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl hover:bg-neutral-800 transition-all duration-200">
                    <i class="fa-solid fa-headset w-5 text-center text-orange-400"></i> <span>Pelayanan</span>
                </a>
                <?php endif; ?>
            </nav>
        </div>

        <!-- User info + logout -->
        <div class="p-4 border-t border-neutral-800">
            <div class="flex items-center gap-3 mb-3 px-2">
                <div class="w-9 h-9 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold text-sm">
                    <?= strtoupper(substr($_SESSION['user']['nama'] ?? 'U', 0, 1)) ?>
                </div>
                <div>
                    <p class="text-sm font-semibold"><?= htmlspecialchars($_SESSION['user']['nama'] ?? 'User') ?></p>
                    <p class="text-xs text-neutral-400 capitalize"><?= htmlspecialchars($_SESSION['user']['role'] ?? '') ?></p>
                </div>
            </div>
            <button id="logoutBtn" class="w-full flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 transition text-white px-4 py-2 rounded-xl text-sm font-semibold">
                <i class="fa-solid fa-door-open"></i> Logout
            </button>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="flex-1 flex flex-col lg:ml-64 min-h-screen min-w-0">

        <!-- Topbar -->
        <header class="sticky top-0 z-40 bg-white border-b border-neutral-200 shadow-sm px-4 md:px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <button id="menuToggle" class="lg:hidden text-neutral-500 hover:text-orange-500 transition">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <div>
                    <h2 class="text-lg font-semibold text-neutral-800">Dashboard</h2>
                    <p class="text-xs text-neutral-500">Selamat datang kembali, <span class="text-orange-500 font-semibold"><?= htmlspecialchars($_SESSION['user']['nama'] ?? 'Admin') ?></span></p>
                </div>
            </div>
            <span class="text-xs text-neutral-400 hidden md:block"><?= date('l, d F Y') ?></span>
        </header>

        <main class="p-4 md:p-6 flex-1 overflow-y-auto overflow-x-hidden bg-neutral-100">

            <!-- ===== STAT CARDS ===== -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Total Mobil -->
                <div class="relative overflow-hidden bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300 text-white">
                    <div class="absolute opacity-15 -right-4 -bottom-4 text-8xl">
                        <i class="fa-solid fa-car-side"></i>
                    </div>
                    <div class="p-5 relative z-10">
                        <p class="text-xs uppercase tracking-widest text-orange-100">Total Mobil</p>
                        <h3 class="text-4xl font-extrabold mt-1"><?= $jumlahmobil ?? 0 ?></h3>
                        <p class="text-orange-100 text-xs mt-1">Unit terdaftar di sistem</p>
                    </div>
                </div>
                <!-- Total User -->
                <div class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300 text-white">
                    <div class="absolute opacity-15 -right-4 -bottom-4 text-8xl">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="p-5 relative z-10">
                        <p class="text-xs uppercase tracking-widest text-blue-100">Total User</p>
                        <h3 class="text-4xl font-extrabold mt-1"><?= $jumlahuser ?? 0 ?></h3>
                        <p class="text-blue-100 text-xs mt-1">Akun terdaftar</p>
                    </div>
                </div>
                <!-- Pendapatan Bulan Ini -->
                <div class="relative overflow-hidden bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300 text-white">
                    <div class="absolute opacity-15 -right-4 -bottom-4 text-8xl">
                        <i class="fa-solid fa-money-bill-trend-up"></i>
                    </div>
                    <div class="p-5 relative z-10">
                        <p class="text-xs uppercase tracking-widest text-emerald-100">Pendapatan Bulan Ini</p>
                        <h3 class="text-2xl font-extrabold mt-1">Rp <?= number_format($pendapatanbulanini ?? 0, 0, ',', '.') ?></h3>
                        <p class="text-emerald-100 text-xs mt-1">Transaksi selesai <?= date('F Y') ?></p>
                    </div>
                </div>
                <!-- Transaksi Aktif -->
                <div class="relative overflow-hidden bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg hover:scale-105 hover:shadow-xl transition-all duration-300 text-white">
                    <div class="absolute opacity-15 -right-4 -bottom-4 text-8xl">
                        <i class="fa-solid fa-file-contract"></i>
                    </div>
                    <div class="p-5 relative z-10">
                        <p class="text-xs uppercase tracking-widest text-purple-100">Transaksi Aktif</p>
                        <h3 class="text-4xl font-extrabold mt-1"><?= $transaksiaktif ?? 0 ?></h3>
                        <p class="text-purple-100 text-xs mt-1">Sedang berjalan</p>
                    </div>
                </div>
            </section>

            <!-- ===== STATUS MOBIL + TABEL MOBIL ===== -->
            <div class="grid lg:grid-cols-3 gap-6 mb-6">
                <!-- Status Breakdown -->
                <div class="bg-white rounded-2xl shadow p-5 flex flex-col gap-4">
                    <h3 class="font-semibold text-neutral-700">Status Armada</h3>
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center justify-between p-3 bg-emerald-50 rounded-xl border border-emerald-100">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                                <span class="text-sm font-medium text-emerald-700">Ready</span>
                            </div>
                            <span class="font-bold text-emerald-600 text-xl"><?= $status['ready'] ?? 0 ?> <span class="text-xs font-normal">unit</span></span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-red-50 rounded-xl border border-red-100">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-red-500"></span>
                                <span class="text-sm font-medium text-red-700">Disewa</span>
                            </div>
                            <span class="font-bold text-red-600 text-xl"><?= $status['rent'] ?? 0 ?> <span class="text-xs font-normal">unit</span></span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-xl border border-yellow-100">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                                <span class="text-sm font-medium text-yellow-700">Maintenance</span>
                            </div>
                            <span class="font-bold text-yellow-600 text-xl"><?= $status['maintenance'] ?? 0 ?> <span class="text-xs font-normal">unit</span></span>
                        </div>
                    </div>
                </div>

                <!-- Tabel Transaksi Terbaru -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow p-5">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-neutral-700">Transaksi Terbaru</h3>
                        <span class="text-xs text-neutral-400">5 terakhir</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr class="border-b border-neutral-100 text-neutral-500 text-xs uppercase">
                                    <th class="py-2 px-2">ID</th>
                                    <th class="py-2 px-2">Pelanggan</th>
                                    <th class="py-2 px-2">Mobil</th>
                                    <th class="py-2 px-2">Total</th>
                                    <th class="py-2 px-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($datatransaksi)): ?>
                                <?php foreach ($datatransaksi as $tr): ?>
                                <tr class="border-b border-neutral-50 hover:bg-orange-50 transition-all duration-200">
                                    <td class="py-2 px-2 text-neutral-400">#<?= htmlspecialchars($tr['id_transaksi']) ?></td>
                                    <td class="py-2 px-2 font-medium"><?= htmlspecialchars($tr['nama_pelanggan']) ?></td>
                                    <td class="py-2 px-2 text-neutral-500"><?= htmlspecialchars($tr['mobil']) ?></td>
                                    <td class="py-2 px-2 text-emerald-600 font-semibold">Rp <?= number_format($tr['total_bayar'], 0, ',', '.') ?></td>
                                    <td class="py-2 px-2">
                                        <?php
                                        $statusClass = match(strtolower($tr['status'])) {
                                            'berjalan' => 'bg-blue-100 text-blue-700',
                                            'selesai'  => 'bg-emerald-100 text-emerald-700',
                                            'batal'    => 'bg-red-100 text-red-700',
                                            default    => 'bg-neutral-100 text-neutral-500'
                                        };
                                        ?>
                                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold <?= $statusClass ?>">
                                            <?= ucfirst(htmlspecialchars($tr['status'])) ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" class="py-8 text-center text-neutral-400 italic">Belum ada transaksi</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ===== TABEL DATA MOBIL ===== -->
            <div class="bg-white rounded-2xl shadow p-5">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-5">
                    <div>
                        <h3 class="font-semibold text-neutral-700">Daftar Mobil</h3>
                        <p class="text-xs text-neutral-400">Kelola seluruh armada kendaraan</p>
                    </div>
                    <div class="flex gap-2 w-full sm:w-auto">
                        <form method="GET" action="index.php" class="relative flex-1 sm:flex-none">
                            <input type="hidden" name="action" value="index-pegawai">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-neutral-400 text-xs"></i>
                            <input type="text" name="keyword" placeholder="Cari mobil..."
                                   value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>"
                                   class="pl-8 pr-3 py-2 text-sm rounded-xl border border-neutral-200 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition w-full sm:w-48">
                        </form>
                        <a href="index.php?action=insert" class="bg-orange-500 hover:bg-orange-600 text-white text-sm px-4 py-2 rounded-xl font-semibold transition-all duration-200 whitespace-nowrap">
                            <i class="fa-solid fa-plus"></i> Tambah
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="border-b-2 border-neutral-100 text-neutral-500 text-xs uppercase">
                                <th class="py-3 px-3">No</th>
                                <th class="py-3 px-3">Foto</th>
                                <th class="py-3 px-3">Merek / Model</th>
                                <th class="py-3 px-3">Tahun</th>
                                <th class="py-3 px-3">No Plat</th>
                                <th class="py-3 px-3">Harga/Hari</th>
                                <th class="py-3 px-3">Transmisi</th>
                                <th class="py-3 px-3">Status</th>
                                <th class="py-3 px-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($data_mobil)): ?>
                            <?php $no = 1; foreach ($data_mobil as $row): ?>
                            <?php
                            $uploadDir = __DIR__ . '/../../Public/uploads/';
                            $imgFile = (!empty($row['img']) && file_exists($uploadDir . $row['img'])) ? $row['img'] : 'default.svg';
                            $imgPath = 'Public/uploads/' . $imgFile;
                            ?>
                            <tr class="border-b border-neutral-50 hover:bg-orange-50 transition-all duration-200">
                                <td class="py-3 px-3 text-neutral-400"><?= $no++ ?></td>
                                <td class="py-3 px-3">
                                    <img src="<?= htmlspecialchars($imgPath) ?>" alt="foto"
                                         class="w-16 h-11 object-cover rounded-lg shadow">
                                </td>
                                <td class="py-3 px-3">
                                    <p class="font-semibold"><?= htmlspecialchars(ucfirst($row['merk'] ?? '')) ?> <?= htmlspecialchars(ucfirst($row['tipe'] ?? '')) ?></p>
                                    <p class="text-xs text-neutral-400"><?= htmlspecialchars($row['model'] ?? '') ?></p>
                                </td>
                                <td class="py-3 px-3"><?= htmlspecialchars($row['tahun'] ?? '-') ?></td>
                                <td class="py-3 px-3 font-mono text-xs"><?= htmlspecialchars(strtoupper($row['noplat'] ?? '')) ?></td>
                                <td class="py-3 px-3 text-emerald-600 font-semibold">Rp <?= number_format($row['harga'] ?? 0, 0, ',', '.') ?></td>
                                <td class="py-3 px-3 capitalize"><?= htmlspecialchars($row['transmisi'] ?? '-') ?></td>
                                <td class="py-3 px-3">
                                    <?php
                                    $stClass = match(strtolower($row['status'] ?? '')) {
                                        'ready'       => 'bg-emerald-100 text-emerald-700',
                                        'rent'        => 'bg-red-100 text-red-700',
                                        'maintenance' => 'bg-yellow-100 text-yellow-700',
                                        default       => 'bg-neutral-100 text-neutral-500'
                                    };
                                    ?>
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold <?= $stClass ?>">
                                        <?= ucfirst(htmlspecialchars($row['status'] ?? '')) ?>
                                    </span>
                                </td>
                                <td class="py-3 px-3">
                                    <details class="relative marker:content-none">
                                        <summary class="cursor-pointer text-orange-500 hover:text-orange-400 list-none">
                                            <i class="fa-solid fa-ellipsis-vertical px-2"></i>
                                        </summary>
                                        <ul class="absolute right-0 w-32 bg-white shadow-xl border border-neutral-100 rounded-xl overflow-hidden z-50 text-sm">
                                            <li>
                                                <a href="index.php?action=update&id=<?= $row['id_mobil'] ?>"
                                                   class="flex items-center gap-2 px-4 py-2.5 text-emerald-600 hover:bg-emerald-50 transition">
                                                    <i class="fa-solid fa-pen"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a href="index.php?action=delete&id=<?= $row['id_mobil'] ?>"
                                                   onclick="return confirm('Yakin hapus ID <?= $row['id_mobil'] ?>?')"
                                                   class="flex items-center gap-2 px-4 py-2.5 text-red-600 hover:bg-red-50 transition">
                                                    <i class="fa-solid fa-trash"></i> Hapus
                                                </a>
                                            </li>
                                        </ul>
                                    </details>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="py-12 text-center">
                                    <div class="flex flex-col items-center gap-3 text-neutral-400">
                                        <i class="fa-solid fa-car text-5xl opacity-30"></i>
                                        <p class="font-semibold">Belum ada data mobil</p>
                                        <a href="index.php?action=insert" class="text-orange-500 text-sm hover:underline">+ Tambah Mobil</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- Overlay sidebar mobile -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>

    <!-- Logout Modal -->
    <?php include __DIR__ . '/../components/logout-modal.php'; ?>

    <script>
        // Sidebar mobile toggle
        const sidebar    = document.getElementById('sidebar');
        const overlay    = document.getElementById('sidebarOverlay');
        const menuToggle = document.getElementById('menuToggle');

        menuToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });
        overlay?.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        // Close dropdown details on outside click
        document.addEventListener('click', (e) => {
            document.querySelectorAll('details[open]').forEach(d => {
                if (!d.contains(e.target)) d.removeAttribute('open');
            });
        });

        // Close only one details at a time
        document.querySelectorAll('details').forEach(d => {
            d.addEventListener('toggle', () => {
                if (d.open) {
                    document.querySelectorAll('details').forEach(other => {
                        if (other !== d) other.removeAttribute('open');
                    });
                }
            });
        });

        // Logout modal
        const logoutBtn = document.getElementById('logoutBtn');
        logoutBtn?.addEventListener('click', () => {
            const modal = document.getElementById('logoutModal');
            modal?.classList.remove('hidden');
            modal?.classList.add('flex');
        });
    </script>
</body>
</html>