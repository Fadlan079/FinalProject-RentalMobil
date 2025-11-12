<?php
// Cek role user yang login
$role = $_SESSION['user']['role'] ?? 'guest';
?>

<aside id="sidebar" class="fixed left-0 top-0 h-full w-64 bg-neutral-900 text-neutral-100 shadow-lg flex flex-col justify-between transition-all duration-300 z-50">
  
  <!-- Logo dan nama -->
  <div class="p-5 border-b border-neutral-800 flex items-center gap-3">
    <img src="../../assets/logo-cylc.png" alt="Logo Cylc" class="w-10 h-10 rounded-full">
    <h2 class="text-lg font-semibold text-orange-500">Cylc Rent Car</h2>
  </div>

  <!-- Navigasi utama -->
  <nav class="flex-1 p-4 space-y-2">
    <a href="index.php" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-neutral-800 transition">
      <i class="fa-solid fa-gauge text-orange-400"></i>
      <span>Dashboard</span>
    </a>

    <?php if ($role === 'admin'): ?>
      <a href="mobil-list.php" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-neutral-800 transition">
        <i class="fa-solid fa-car text-orange-400"></i>
        <span>Data Mobil</span>
      </a>

      <a href="pegawai-list.php" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-neutral-800 transition">
        <i class="fa-solid fa-users-gear text-orange-400"></i>
        <span>Data Pegawai</span>
      </a>

      <a href="pelanggan-list.php" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-neutral-800 transition">
        <i class="fa-solid fa-user text-orange-400"></i>
        <span>Data Pelanggan</span>
      </a>

      <a href="laporan.php" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-neutral-800 transition">
        <i class="fa-solid fa-chart-line text-orange-400"></i>
        <span>Laporan</span>
      </a>

    <?php elseif ($role === 'cs'): ?>
      <a href="transaksi-list.php" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-neutral-800 transition">
        <i class="fa-solid fa-file-invoice text-orange-400"></i>
        <span>Transaksi</span>
      </a>

      <a href="pelayanan.php" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-neutral-800 transition">
        <i class="fa-solid fa-headset text-orange-400"></i>
        <span>Pelayanan</span>
      </a>

      <a href="konfirmasi-pembayaran.php" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-neutral-800 transition">
        <i class="fa-solid fa-money-bill text-orange-400"></i>
        <span>Konfirmasi Pembayaran</span>
      </a>
    <?php endif; ?>
  </nav>

  <!-- Bagian bawah (profil & logout) -->
  <div class="p-4 border-t border-neutral-800">
    <div class="flex items-center gap-3 mb-3">
      <i class="fa-solid fa-user text-orange-400"></i>
      <div>
        <p class="text-sm font-medium"><?= $_SESSION['user']['nama'] ?? 'Pegawai'; ?></p>
        <p class="text-xs text-neutral-400 capitalize"><?= $role; ?></p>
      </div>
    </div>

    <button id="logoutBtn" class="w-full bg-red-600 hover:bg-red-700 transition text-white px-4 py-2 rounded-lg flex items-center justify-center gap-2">
      <i class="fa-solid fa-door-open"></i>
      <span>Logout</span>
    </button>
  </div>

  <?php include __DIR__ . '/../logout-modal.php'; ?>
</aside>
