<?php foreach($riwayat as $tr): ?>
    <?php
    $today = new DateTime();
    $tgl_kembali = new DateTime($tr['tgl_kembali']);
    $sisa_hari = (int)$tgl_kembali->diff($today)->format('%r%a'); 
    $harga_per_hari = $tr['durasi_sewa'] > 0 ? $tr['total_bayar'] / $tr['durasi_sewa'] : $tr['total_bayar'];
    $gambar_mobil = !empty($tr['img']) && file_exists('uploads/' . $tr['img']) ? $tr['img'] : 'default.svg';
    ?>
    <div class="flex flex-col lg:flex-row bg-neutral-900 text-neutral-100 shadow-lg rounded-xl mb-4 overflow-hidden border-l-4 border-orange-500 hover:shadow-2xl transition-shadow duration-300">
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
        <!-- Bagian kanan: total & tombol -->
        <div class="p-4 flex flex-col justify-center items-end space-y-2">
            <span class="text-xl font-semibold text-orange-500">Rp <?= number_format($tr['total_bayar'], 2) ?></span>

            <!-- Tombol Update dan Delete -->
            <div class="flex gap-2 mt-3">
                <a href="update-transaksi.php?id=<?= $tr['id'] ?>" 
                   class="px-3 py-1 bg-blue-500 hover:bg-blue-400 text-white font-medium rounded-lg transition-colors duration-300">
                    <i class="fa-solid fa-pen-to-square"></i> Update
                </a>
                <a href="delete-transaksi.php?id=<?= $tr['id'] ?>" 
                   onclick="return confirm('Apakah anda yakin ingin menghapus transaksi ini?');"
                   class="px-3 py-1 bg-red-600 hover:bg-red-500 text-white font-medium rounded-lg transition-colors duration-300">
                    <i class="fa-solid fa-trash"></i> Delete
                </a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
