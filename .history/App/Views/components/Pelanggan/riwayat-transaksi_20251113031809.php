<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pesanan & Riwayat - Cylc Rent Car</title>
  <link rel="stylesheet" href="output.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"/>
  <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
</head>
<body class="bg-neutral-100 text-neutral-900">

<div class="relative">
  <div class="absolute z-0 -top-10 -left-20 w-72 h-72 bg-orange-500 rounded-full opacity-20 blur-3xl"></div>
  <div class="absolute z-0 bottom-0 right-0 w-96 h-96 bg-neutral-800 rounded-full opacity-25 blur-3xl"></div>

  <div class="relative z-10 max-w-6xl mx-auto mt-6 px-4">

    <!-- Tombol kembali -->
    <div class="mb-6">
      <a href="index.php?action=index" class="inline-flex items-center gap-2 px-4 py-2 bg-orange-500 hover:bg-orange-400 text-neutral-100 font-medium rounded-lg shadow-md transition-colors duration-300">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
      </a>
    </div>

    <?php
      // Pisahkan data berdasarkan status
    $pesanan = array_filter($riwayat ?? [], function($tr) {
        return $tr['status'] === 'berjalan';
    });
    
    $riwayat_selesai = array_filter($riwayat ?? [], function($tr) {
        return in_array($tr['status'], ['selesai', 'batal']);
    });
    
    ?>

    <?php if(empty($riwayat)): ?>
      <div class="flex flex-col items-center justify-center min-h-[60vh] text-center px-4 space-y-5">
        <i class="fa-solid fa-clock-rotate-left text-6xl text-orange-500/80 animate-pulse"></i>
        <h2 class="text-2xl md:text-3xl font-semibold tracking-wide text-orange-500">Belum ada transaksi</h2>
        <div class="w-20 h-[2px] bg-orange-500 rounded-full"></div>
        <p class="text-neutral-400 text-base md:text-lg max-w-md leading-relaxed">
          Pesanan atau riwayat transaksi akan muncul di sini setelah kamu melakukan penyewaan.
        </p>
        <a href="index.php?action=index" class="text-orange-500 hover:text-orange-400 font-medium tracking-wide transition-colors duration-300">
          Lihat koleksi mobil
        </a>
      </div>
    <?php else: ?>

    <!-- Tabs -->
    <div class="flex mb-6 bg-neutral-200 rounded-xl p-1 w-fit">
      <button id="tab-pesanan" class="tab-button active-tab flex items-center gap-2 px-4 py-2 rounded-lg font-medium text-neutral-800 bg-white shadow-md transition-all duration-300">
        <i class="fa-solid fa-car-side text-orange-500"></i> Pesanan
      </button>
      <button id="tab-riwayat" class="tab-button flex items-center gap-2 px-4 py-2 rounded-lg font-medium text-neutral-600 hover:text-neutral-900 transition-all duration-300">
        <i class="fa-solid fa-clock-rotate-left text-orange-500"></i> Riwayat
      </button>
    </div>

    <!-- ======== PESANAN (BERJALAN) ======== -->
    <div id="content-pesanan" class="tab-content">
      <?php if(empty($pesanan)): ?>
        <p class="text-neutral-400 italic">Belum ada pesanan berjalan.</p>
      <?php else: ?>
        <?php foreach($pesanan as $tr): ?>
          <?php
            $today = new DateTime();
            $tgl_kembali = new DateTime($tr['tgl_kembali']);
            $sisa_hari = (int)$tgl_kembali->diff($today)->format('%r%a');
            $gambar_mobil = !empty($tr['img']) && file_exists('uploads/' . $tr['img']) ? $tr['img'] : 'default.svg';
          ?>
          <div class="flex flex-col lg:flex-row bg-neutral-900 text-neutral-100 shadow-lg rounded-xl mb-4 overflow-hidden border-l-4 border-yellow-500 hover:shadow-2xl transition-shadow duration-300">
            <img src="uploads/<?= htmlspecialchars($gambar_mobil) ?>" alt="<?= htmlspecialchars($tr['merk']) ?>" class="w-full lg:w-48 object-cover" onerror="this.src='uploads/default.svg'">
            <div class="p-4 flex-1">
              <h2 class="font-semibold text-lg text-orange-500"><?= htmlspecialchars($tr['merk']) ?> (<?= $tr['tahun'] ?>)</h2>
              <p class="text-sm text-neutral-400">Plat: <?= htmlspecialchars($tr['noplat']) ?> • Durasi: <?= $tr['durasi_sewa'] ?> hari</p>
              <p class="text-sm text-neutral-400">Tanggal Kembali: <?= date('d M Y', strtotime($tr['tgl_kembali'])) ?></p>
              <?php if($sisa_hari < 0): ?>
                <p class="text-red-600 font-semibold mt-1">Telat <?= abs($sisa_hari) ?> hari!</p>
              <?php elseif($sisa_hari <= 3): ?>
                <p class="text-orange-500 font-semibold mt-1">Jatuh tempo dalam <?= $sisa_hari ?> hari</p>
              <?php else: ?>
                <p class="text-green-600 font-semibold mt-1">Sisa waktu: <?= $sisa_hari ?> hari</p>
              <?php endif; ?>
            </div>
            <div class="p-4 flex flex-col justify-center items-end">
              <span class="text-lg font-semibold text-orange-500">Rp <?= number_format($tr['total_bayar'], 2) ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- ======== RIWAYAT (SELESAI / BATAL) ======== -->
    <div id="content-riwayat" class="tab-content hidden">
      <?php if(empty($riwayat_selesai)): ?>
        <p class="text-neutral-400 italic">Belum ada riwayat transaksi selesai atau dibatalkan.</p>
      <?php else: ?>
        <?php foreach($riwayat_selesai as $tr): ?>
          <?php
            $warna = $tr['status'] == 'selesai' ? 'green' : 'red';
            $gambar_mobil = !empty($tr['img']) && file_exists('uploads/' . $tr['img']) ? $tr['img'] : 'default.svg';
          ?>
          <div class="flex flex-col lg:flex-row bg-neutral-900 text-neutral-100 shadow-lg rounded-xl mb-4 overflow-hidden border-l-4 border-<?= $warna ?>-500 hover:shadow-2xl transition-shadow duration-300">
            <img src="uploads/<?= htmlspecialchars($gambar_mobil) ?>" alt="<?= htmlspecialchars($tr['merk']) ?>" class="w-full lg:w-48 object-cover" onerror="this.src='uploads/default.svg'">
            <div class="p-4 flex-1">
              <h2 class="font-semibold text-lg text-orange-500"><?= htmlspecialchars($tr['merk']) ?> (<?= $tr['tahun'] ?>)</h2>
              <p class="text-sm text-neutral-400">Plat: <?= htmlspecialchars($tr['noplat']) ?> • Durasi: <?= $tr['durasi_sewa'] ?> hari</p>
              <p class="text-sm text-neutral-400">Tanggal: <?= date('d M Y', strtotime($tr['tgl_sewa'])) ?> - <?= date('d M Y', strtotime($tr['tgl_kembali'])) ?></p>
              <p class="text-sm text-neutral-400">Status: 
                <span class="font-semibold text-<?= $warna ?>-500 capitalize"><?= $tr['status'] ?></span>
              </p>
            </div>
            <div class="p-4 flex flex-col justify-center items-end">
              <span class="text-lg font-semibold text-orange-500">Rp <?= number_format($tr['total_bayar'], 2) ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <?php endif; ?>
  </div>
</div>

<!-- Script untuk switch tab -->
<script>
  const tabPesanan = document.getElementById('tab-pesanan');
  const tabRiwayat = document.getElementById('tab-riwayat');
  const contentPesanan = document.getElementById('content-pesanan');
  const contentRiwayat = document.getElementById('content-riwayat');

  tabPesanan.addEventListener('click', () => {
    tabPesanan.classList.add('active-tab', 'bg-white', 'text-neutral-900', 'shadow-md');
    tabRiwayat.classList.remove('active-tab', 'bg-white', 'text-neutral-900', 'shadow-md');
    contentPesanan.classList.remove('hidden');
    contentRiwayat.classList.add('hidden');
  });

  tabRiwayat.addEventListener('click', () => {
    tabRiwayat.classList.add('active-tab', 'bg-white', 'text-neutral-900', 'shadow-md');
    tabPesanan.classList.remove('active-tab', 'bg-white', 'text-neutral-900', 'shadow-md');
    contentRiwayat.classList.remove('hidden');
    contentPesanan.classList.add('hidden');
  });
</script>

</body>
