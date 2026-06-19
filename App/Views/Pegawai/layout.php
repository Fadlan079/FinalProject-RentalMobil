<?php
// layout.php - dipanggil dengan $pageTitle dan $pageContent
if (session_status() === PHP_SESSION_NONE) session_start();
$activePage = $activePage ?? '';
$userName = htmlspecialchars($_SESSION['user']['nama'] ?? 'Admin');
$userRole = ucfirst(htmlspecialchars($_SESSION['user']['role'] ?? ''));
$userInitial = strtoupper(substr($_SESSION['user']['nama'] ?? 'U', 0, 1));

$navItems = [
    ['icon'=>'fa-gauge',       'label'=>'Dashboard',       'action'=>'index-pegawai',    'roles'=>['admin','customer service']],
    ['icon'=>'fa-car',         'label'=>'Data Mobil',       'action'=>'data-mobil',       'roles'=>['admin']],
    ['icon'=>'fa-users-gear',  'label'=>'Data Pegawai',     'action'=>'data-pegawai',     'roles'=>['admin']],
    ['icon'=>'fa-user',        'label'=>'Data Pelanggan',   'action'=>'data-pelanggan',   'roles'=>['admin','customer service']],
    ['icon'=>'fa-file-invoice','label'=>'Transaksi',        'action'=>'data-transaksi',   'roles'=>['admin','customer service']],
    ['icon'=>'fa-chart-line',  'label'=>'Laporan',          'action'=>'laporan',          'roles'=>['admin']],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Dashboard') ?> - Cylc Rent Car</title>
    <link rel="stylesheet" href="output.css">
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"/>
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
                <?php foreach ($navItems as $item):
                    $role = $_SESSION['user']['role'] ?? '';
                    if (!in_array($role, $item['roles'])) continue;
                    $isActive = ($activePage === $item['action']);
                ?>
                <a href="index.php?action=<?= $item['action'] ?>"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 <?= $isActive ? 'bg-orange-500/20 text-orange-400 font-semibold' : 'hover:bg-neutral-800 text-neutral-300' ?>">
                    <i class="fa-solid <?= $item['icon'] ?> w-5 text-center <?= $isActive ? 'text-orange-400' : 'text-orange-500' ?>"></i>
                    <span><?= $item['label'] ?></span>
                </a>
                <?php endforeach; ?>
            </nav>
        </div>

        <!-- User info + logout -->
        <div class="p-4 border-t border-neutral-800">
            <div class="flex items-center gap-3 mb-3 px-2">
                <div class="w-9 h-9 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold text-sm"><?= $userInitial ?></div>
                <div>
                    <p class="text-sm font-semibold"><?= $userName ?></p>
                    <p class="text-xs text-neutral-400 capitalize"><?= $userRole ?></p>
                </div>
            </div>
            <a href="index.php?action=logout"
               class="w-full flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 transition text-white px-4 py-2 rounded-xl text-sm font-semibold">
                <i class="fa-solid fa-door-open"></i> Logout
            </a>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="flex-1 flex flex-col lg:ml-64 min-h-screen min-w-0">

        <!-- Topbar -->
        <header class="sticky top-0 z-40 bg-white border-b border-neutral-200 shadow-sm px-4 md:px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3 md:gap-4">
                <button id="menuToggle" class="lg:hidden text-neutral-500 hover:text-orange-500 transition">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <div>
                    <h2 class="text-base md:text-lg font-semibold text-neutral-800"><?= htmlspecialchars($pageTitle ?? 'Dashboard') ?></h2>
                    <p class="text-[10px] md:text-xs text-neutral-500">Selamat datang, <span class="text-orange-500 font-semibold"><?= $userName ?></span></p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-[10px] md:text-xs text-neutral-400 hidden sm:block"><?= date('l, d F Y') ?></span>
                <a href="index.php?action=index" class="text-[10px] md:text-xs text-orange-500 hover:underline flex items-center gap-1">
                    <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i> <span class="hidden sm:inline">Beranda</span>
                </a>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-4 md:p-6 flex-1 overflow-y-auto overflow-x-hidden bg-neutral-100">
            <?= $pageContent ?? '' ?>
        </main>
    </div>

    <!-- Overlay for mobile sidebar -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggle  = document.getElementById('menuToggle');
        toggle?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });
        overlay?.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>
</body>
</html>
