<?php
session_start();
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['admin', 'cs'])) {
  header("Location: ../index.php?action=login");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Pegawai | Cylc Rent Car</title>
  <script src="https://kit.fontawesome.com/yourkitid.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.10/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-neutral-950 text-neutral-100 flex min-h-screen">

  <!-- SIDEBAR -->
  <aside id="sidebar" class="fixed lg:relative top-0 left-0 w-72 bg-neutral-900 h-full p-6 flex flex-col gap-6 transform -translate-x-full lg:translate-x-0 transition-all duration-300 z-40">
    <div class="flex justify-between items-center">
      <div class="flex gap-3 items-center">
        <img src="../../assets/logo-cylc.png" alt="logo" class="w-10 h-10 rounded-full">
        <h2 class="text-lg font-semibold">Cylc Rent Car</h2>
      </div>
      <button id="closeSidebar" class="text-neutral-400 lg:hidden"><i class="fa-solid fa-xmark text-xl"></i></button>
    </div>

    <nav class="flex flex-col gap-3 mt-6 text-neutral-300">
      <a href="#" class="nav-item flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-neutral-800 transition"><i class="fa-solid fa-chart-line text-orange-500"></i> <span>Dashboard</span></a>

      <?php if ($_SESSION['user']['role'] === 'admin'): ?>
        <a href="mobil-list.php" class="nav-item flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-neutral-800 transition"><i class="fa-solid fa-car text-orange-500"></i> <span>Data Mobil</span></a>
        <a href="pegawai-list.php" class="nav-item flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-neutral-800 transition"><i class="fa-solid fa-users text-orange-500"></i> <span>Data Pegawai</span></a>
        <a href="user-list.php" class="nav-item flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-neutral-800 transition"><i class="fa-solid fa-user text-orange-500"></i> <span>Data Pelanggan</span></a>
      <?php endif; ?>

      <?php if ($_SESSION['user']['role'] === 'cs'): ?>
        <a href="transaksi-list.php" class="nav-item flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-neutral-800 transition"><i class="fa-solid fa-money-check text-orange-500"></i> <span>Transaksi</span></a>
        <a href="pelayanan.php" class="nav-item flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-neutral-800 transition"><i class="fa-solid fa-headset text-orange-500"></i> <span>Layanan Pelanggan</span></a>
      <?php endif; ?>

      <button id="logoutBtn" class="flex items-center gap-3 px-4 py-2 mt-auto rounded-lg text-red-400 hover:bg-neutral-800 transition"><i class="fa-solid fa-door-open"></i> <span>Logout</span></button>
    </nav>
  </aside>

  <!-- MAIN CONTENT -->
  <div class="flex-1 flex flex-col">
    <!-- NAVBAR -->
    <header class="w-full bg-neutral-900 shadow-md p-4 flex justify-between items-center lg:pl-8">
      <div class="flex items-center gap-3">
        <button id="menuToggle" class="lg:hidden text-neutral-400"><i class="fa-solid fa-bars text-xl"></i></button>
        <h1 class="text-xl font-semibold">Dashboard Pegawai</h1>
      </div>
      <div class="flex items-center gap-3">
        <span class="text-sm text-neutral-400">Halo, <strong class="text-orange-400"><?= htmlspecialchars($_SESSION['user']['nama']); ?></strong></span>
        <i class="fa-solid fa-user-circle text-orange-500 text-2xl"></i>
      </div>
    </header>

    <!-- KONTEN DASHBOARD -->
    <main class="p-6 flex-1 overflow-y-auto">
      <div class="grid md:grid-cols-3 gap-6">
        <!-- Card contoh -->
        <div class="bg-neutral-900 p-6 rounded-xl shadow hover:shadow-lg transition">
          <h3 class="text-orange-400 text-lg font-semibold mb-2">Total Mobil</h3>
          <p class="text-3xl font-bold">24</p>
        </div>
        <div class="bg-neutral-900 p-6 rounded-xl shadow hover:shadow-lg transition">
          <h3 class="text-orange-400 text-lg font-semibold mb-2">Total Pelanggan</h3>
          <p class="text-3xl font-bold">57</p>
        </div>
        <div class="bg-neutral-900 p-6 rounded-xl shadow hover:shadow-lg transition">
          <h3 class="text-orange-400 text-lg font-semibold mb-2">Transaksi Bulan Ini</h3>
          <p class="text-3xl font-bold">13</p>
        </div>
      </div>

      <section class="mt-10">
        <h2 class="text-lg font-semibold mb-4 text-orange-400">Aktivitas Terbaru</h2>
        <div class="bg-neutral-900 rounded-xl p-4 text-sm text-neutral-300">
          <ul class="space-y-2">
            <li>🚗 Admin menambahkan mobil baru: Toyota Innova</li>
            <li>👩‍💼 CS memproses transaksi pelanggan #TRX1023</li>
            <li>🧾 Pelanggan baru mendaftar: Budi Santoso</li>
          </ul>
        </div>
      </section>
    </main>
  </div>

  <!-- INCLUDE LOGOUT MODAL -->
  <?php include __DIR__ . "/../../components/logout-modal.php"; ?>

  <script>
  const sidebar = document.getElementById('sidebar');
  const menuToggle = document.getElementById('menuToggle');
  const closeSidebar = document.getElementById('closeSidebar');
  const logoutBtn = document.getElementById('logoutBtn');

  menuToggle.addEventListener('click', () => sidebar.classList.toggle('-translate-x-full'));
  closeSidebar.addEventListener('click', () => sidebar.classList.add('-translate-x-full'));
  logoutBtn.addEventListener('click', (e) => {
    e.preventDefault();
    const modal = document.getElementById('logoutModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  });
  </script>
</body>
</html>
