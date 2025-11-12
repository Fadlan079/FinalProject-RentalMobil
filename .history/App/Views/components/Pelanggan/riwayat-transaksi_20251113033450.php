<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Riwayat Transaksi - Cylc Rent Car</title>
  <link rel="stylesheet" href="output.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"/>
  <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
</head>
<body class="bg-neutral-100 text-neutral-900">
    <div class="relative">
        <div class="absolute z-0 -top-10 -left-20 w-72 h-72 bg-orange-500 rounded-full opacity-20 blur-3xl"></div>
        <div class="absolute z-0 bottom-0 right-0 w-96 h-96 bg-neutral-800 rounded-full opacity-25 blur-3xl"></div>

    <div class="relative z-10 max-w-6xl mx-auto mt-6 px-4">   
        <!-- Riwayat Transaksi -->
        <?php if(empty($riwayat)): ?>
            <div class="flex flex-col items-center justify-center min-h-[60vh] text-center px-4 space-y-5">
                <i class="fa-solid fa-clock-rotate-left text-6xl text-orange-500/80 animate-pulse"></i>
                <h2 class="text-2xl md:text-3xl font-semibold tracking-wide text-orange-500">Belum ada riwayat transaksi</h2>
                <div class="w-20 h-[2px] bg-orange-500 rounded-full"></div>
                <p class="text-neutral-400 text-base md:text-lg max-w-md leading-relaxed">
                    Riwayat transaksi akan muncul di sini setelah kamu melakukan pembelian atau peminjaman.
                </p>
                <a href="index.php?action=index" class="text-orange-500 hover:text-orange-400 font-medium tracking-wide transition-colors duration-300">
                    Lihat koleksi mobil
                </a>
            </div>
        <?php else: ?>
            <!-- Tombol Kembali Dashboard -->
        <div class="mb-6">
            <a href="index.php?action=index" class="inline-flex items-center gap-2 px-4 py-2 bg-orange-500 hover:bg-orange-400 text-neutral-100 font-medium rounded-lg shadow-md transition-colors duration-300">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Statistik Ringkas -->
        <div class="flex flex-wrap justify-between bg-neutral-900 text-neutral-100 p-4 rounded-xl shadow-md mb-6 border-t-4 border-orange-500">
            <div>Total Transaksi: <span class="font-semibold text-orange-500"><?= $total_transaksi ?? 0 ?></span></div>
            <div>Total Bayar: <span class="font-semibold text-orange-500">Rp  <?= number_format($total_bayar ?? 0,2) ?></span></div>
            <div>Selesai: <span class="text-green-600 font-semibold"><?= $status_count['selesai'] ?? 0 ?></span></div>
            <div>Berjalan: <span class="text-yellow-600 font-semibold"><?= $status_count['berjalan'] ?? 0 ?></span></div>
            <div>Batal: <span class="text-red-600 font-semibold"><?= $status_count['batal'] ?? 0 ?></span></div>
        </div>
            <?php foreach($riwayat as $tr): ?>
                
                <?php
                $today = new DateTime();
                $tgl_kembali = new DateTime($tr['tgl_kembali']);
                $sisa_hari = (int)$tgl_kembali->diff($today)->format('%r%a'); 
                $harga_per_hari = $tr['durasi_sewa'] > 0 ? $tr['total_bayar'] / $tr['durasi_sewa'] : $tr['total_bayar'];
                ?>
                <div class="flex flex-col lg:flex-row bg-neutral-900 text-neutral-100 shadow-lg rounded-xl mb-4 overflow-hidden border-l-4 border-orange-500 hover:shadow-2xl transition-shadow duration-300">
                    <?php
        $gambar_mobil = !empty($tr['img']) && file_exists('uploads/' . $tr['img']) ? $tr['img'] : 'default.svg';
        ?>
        <img src="uploads/<?= htmlspecialchars($gambar_mobil) ?>" 
            alt="Gambar <?= htmlspecialchars($tr['merk'] ?? 'Mobil') ?>" 
            class="w-full lg:w-48 object-cover"
            onerror="this.src='uploads/default.svg'">
                    <div class="p-4 flex-1">
                        <h2 class="font-semibold text-lg text-orange-500"><?= pathinfo($tr['img'], PATHINFO_FILENAME) ?> (<?= $tr['tahun'] ?>)</h2>
                        <p class="text-sm text-neutral-600">Warna: <span class="capitalize"><?= htmlspecialchars($tr['warna']) ?></span></p>
                        <p class="text-sm text-neutral-600">Nomor Plat: <?= htmlspecialchars($tr['noplat']) ?></p>
                        <p class="text-sm text-neutral-600">Durasi: <?= $tr['durasi_sewa'] ?> hari</p>
                        <p class="text-sm text-neutral-600">Harga / Hari: <span class="text-orange-500 font-medium">Rp <?= number_format($harga_per_hari,2) ?></span></p>
                        <p class="text-sm text-neutral-600">Tanggal Sewa: <?= date('d M Y', strtotime($tr['tgl_sewa'])) ?></p>
                        <p class="text-sm text-neutral-600">Tanggal Kembali: <?= date('d M Y', strtotime($tr['tgl_kembali'])) ?></p>
                        <p class="text-sm text-neutral-600">Pegawai: <?= htmlspecialchars($tr['nama_pegawai'] ?? '-') ?></p>

                        <!-- Info sisa hari / overdue -->
                        <?php if($tr['status'] == 'berjalan'): ?>
                            <?php if($sisa_hari < 0): ?>
                                <p class="text-red-600 font-semibold mt-1">Telat mengembalikan <?= abs($sisa_hari) ?> hari!</p>
                            <?php elseif($sisa_hari <= 3): ?>
                                <p class="text-orange-500 font-semibold mt-1">Jatuh tempo dalam <?= $sisa_hari ?> hari</p>
                            <?php else: ?>
                                <p class="text-green-600 font-semibold mt-1">Sisa hari: <?= $sisa_hari ?> hari</p>
                            <?php endif; ?>
                        <?php endif; ?>

                        <!-- Status -->
                        <p class="text-sm mt-1">
                            Status: 
                            <?php if($tr['status'] == 'selesai'): ?>
                                <span class="text-green-600 font-semibold">Selesai</span>
                            <?php elseif($tr['status'] == 'berjalan'): ?>
                                <span class="text-yellow-600 font-semibold">Berjalan</span>
                            <?php else: ?>
                                <span class="text-red-600 font-semibold">Batal</span>
                            <?php endif; ?>
                        </p>

                        <p class="text-sm text-neutral-500 mt-1">Transaksi dibuat: <?= date('d M Y H:i', strtotime($tr['tgl_dibuat'])) ?></p>
                    </div>
                    <div class="p-4 flex flex-col justify-center items-end space-y-2">
    <span class="text-xl font-semibold text-orange-500">Rp <?= number_format($tr['total_bayar'], 2) ?></span>

    <?php if ($tr['status'] == 'berjalan'): ?>
        <form method="POST" action="index.php?action=updatePesanan" class="inline">
            <input type="hidden" name="id_transaksi" value="<?= $tr['id_transaksi'] ?>">
            <input type="hidden" name="status" value="selesai">
            <button type="submit" class="bg-green-600 hover:bg-green-500 text-white px-3 py-1 rounded-md text-sm">
                Tandai Selesai
            </button>
        </form>

        <form method="POST" action="index.php?action=deletePesanan" class="inline" 
              onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
            <input type="hidden" name="id_transaksi" value="<?= $tr['id_transaksi'] ?>">
            <button type="submit" class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded-md text-sm">
                Batalkan
            </button>
        </form>
    <?php endif; ?>
</div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
    </div>

</body>