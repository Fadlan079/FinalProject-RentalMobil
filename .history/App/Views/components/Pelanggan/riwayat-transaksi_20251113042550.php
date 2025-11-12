<?php
// Pastikan variabel dari controller sudah ada: $riwayat, $total_transaksi, $total_bayar, $status_count
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - Cylc Rent Car</title>
    <link rel="stylesheet" href="output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"/>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
</head>
<body class="bg-neutral-100 text-neutral-900">

<div class="relative min-h-screen">
    <!-- Background dekoratif -->
    <div class="absolute z-0 -top-10 -left-20 w-72 h-72 bg-orange-500 rounded-full opacity-20 blur-3xl"></div>
    <div class="absolute z-0 bottom-0 right-0 w-96 h-96 bg-neutral-800 rounded-full opacity-25 blur-3xl"></div>

    <div class="relative z-10 max-w-6xl mx-auto mt-6 px-4">
        <!-- Header -->
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Transaksi Kamu</h1>

        <!-- Tombol Kembali -->
        <div class="mb-4">
            <a href="index.php?action=index" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md inline-flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Tabs -->
        <div class="flex justify-center mb-6 space-x-4">
            <button id="tab-pesanan" class="px-6 py-2 bg-orange-500 text-white rounded-lg font-medium">Pesanan Berjalan</button>
            <button id="tab-riwayat" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg font-medium">Riwayat Transaksi</button>
        </div>

        <!-- Statistik Ringkas -->
        <div class="flex flex-wrap justify-between bg-neutral-900 text-neutral-100 p-4 rounded-xl shadow-md mb-6 border-t-4 border-orange-500">
            <div>Total Transaksi: <span class="font-semibold text-orange-500"><?= $total_transaksi ?? 0 ?></span></div>
            <div>Total Bayar: <span class="font-semibold text-orange-500">Rp <?= number_format($total_bayar ?? 0, 2) ?></span></div>
            <div>Selesai: <span class="text-green-600 font-semibold"><?= $status_count['selesai'] ?? 0 ?></span></div>
            <div>Berjalan: <span class="text-yellow-600 font-semibold"><?= $status_count['berjalan'] ?? 0 ?></span></div>
            <div>Batal: <span class="text-red-600 font-semibold"><?= $status_count['batal'] ?? 0 ?></span></div>
        </div>

        <!-- Pesanan Berjalan -->
        <div id="pesanan-list">
            <?php 
            $pesanan = array_filter($riwayat, fn($t) => $t['status'] === 'berjalan');
            if(empty($pesanan)): ?>
                <p class="text-center text-gray-500">Tidak ada pesanan berjalan.</p>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach($pesanan as $tr): 
                        $today = new DateTime();
                        $tgl_kembali = new DateTime($tr['tgl_kembali']);
                        $sisa_hari = (int)$tgl_kembali->diff($today)->format('%r%a');
                        $harga_per_hari = $tr['durasi_sewa'] > 0 ? $tr['total_bayar'] / $tr['durasi_sewa'] : $tr['total_bayar'];
                        $gambar = !empty($tr['img']) && file_exists('../public/assets/uploads/'.$tr['img']) ? $tr['img'] : 'default.jpg';
                    ?>
                    <div class="bg-white shadow-md rounded-xl p-4 flex flex-col md:flex-row items-center justify-between border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-center space-x-4">
                            <img src="../public/assets/uploads/<?= htmlspecialchars($gambar) ?>" class="w-24 h-24 object-cover rounded-lg" alt="Mobil">
                            <div>
                                <h2 class="text-lg font-semibold"><?= htmlspecialchars($tr['merk'] ?? '-') ?> (<?= $tr['tahun'] ?>)</h2>
                                <p class="text-sm text-gray-600">Model / Tipe: <?= htmlspecialchars($tr['model'] ?? '-') ?> / <?= htmlspecialchars($tr['tipe'] ?? '-') ?></p>
                                <p class="text-sm text-gray-600">Warna: <span class="capitalize"><?= htmlspecialchars($tr['warna'] ?? '-') ?></span></p>
                                <p class="text-sm text-gray-600">No Plat: <?= htmlspecialchars($tr['noplat'] ?? '-') ?></p>
                                <p class="text-sm text-gray-600">Durasi: <?= $tr['durasi_sewa'] ?> hari</p>
                                <p class="text-sm text-gray-600">Harga / Hari: <span class="text-orange-500 font-medium">Rp <?= number_format($harga_per_hari,2) ?></span></p>
                                <p class="text-sm text-gray-600">Tanggal Sewa: <?= date('d M Y', strtotime($tr['tgl_sewa'])) ?></p>
                                <p class="text-sm text-gray-600">Tanggal Kembali: <?= date('d M Y', strtotime($tr['tgl_kembali'])) ?></p>
                                <p class="text-sm text-gray-600">Pegawai: <?= htmlspecialchars($tr['nama_pegawai'] ?? '-') ?></p>

                                <!-- Info sisa hari / overdue -->
                                <?php if($sisa_hari < 0): ?>
                                    <p class="text-red-600 font-semibold mt-1">Telat mengembalikan <?= abs($sisa_hari) ?> hari!</p>
                                <?php elseif($sisa_hari <= 3): ?>
                                    <p class="text-orange-500 font-semibold mt-1">Jatuh tempo dalam <?= $sisa_hari ?> hari</p>
                                <?php else: ?>
                                    <p class="text-green-600 font-semibold mt-1">Sisa hari: <?= $sisa_hari ?> hari</p>
                                <?php endif; ?>

                                <!-- Status -->
                                <p class="text-sm mt-1">Status: 
                                    <span class="font-semibold <?= $tr['status']=='berjalan'?'text-yellow-600':'text-gray-600' ?>">
                                        <?= ucfirst($tr['status']) ?>
                                    </span>
                                </p>
                                <p class="text-xs text-gray-400 mt-1">Transaksi dibuat: <?= date('d M Y H:i', strtotime($tr['tgl_dibuat'])) ?></p>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0 flex flex-col space-y-2">
                            <button onclick="updateStatus(<?= $tr['id_transaksi'] ?>, 'selesai')" class="bg-green-600 text-white px-4 py-1 rounded-md hover:bg-green-500">Selesai</button>
                            <button onclick="hapusPesanan(<?= $tr['id_transaksi'] ?>)" class="bg-red-600 text-white px-4 py-1 rounded-md hover:bg-red-500">Batalkan</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Riwayat Transaksi Selesai/Batal -->
        <div id="riwayat-list" class="hidden">
            <?php 
            $riwayatSelesai = array_filter($riwayat, fn($t) => in_array($t['status'], ['selesai','batal']));
            if(empty($riwayatSelesai)): ?>
                <p class="text-center text-gray-500">Belum ada transaksi selesai.</p>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach($riwayatSelesai as $tr): 
                        $gambar = !empty($tr['img']) && file_exists('../public/assets/uploads/'.$tr['img']) ? $tr['img'] : 'default.jpg';
                        $harga_per_hari = $tr['durasi_sewa'] > 0 ? $tr['total_bayar'] / $tr['durasi_sewa'] : $tr['total_bayar'];
                    ?>
                    <div class="bg-gray-50 shadow-sm rounded-xl p-4 flex flex-col md:flex-row items-center justify-between border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center space-x-4">
                            <img src="../public/assets/uploads/<?= htmlspecialchars($gambar) ?>" class="w-24 h-24 object-cover rounded-lg" alt="Mobil">
                            <div>
                                <h2 class="text-lg font-semibold"><?= htmlspecialchars($tr['merk'] ?? '-') ?> (<?= $tr['tahun'] ?>)</h2>
                                <p class="text-sm text-gray-600">Model / Tipe: <?= htmlspecialchars($tr['model'] ?? '-') ?> / <?= htmlspecialchars($tr['tipe'] ?? '-') ?></p>
                                <p class="text-sm text-gray-600">Warna: <span class="capitalize"><?= htmlspecialchars($tr['warna'] ?? '-') ?></span></p>
                                <p class="text-sm text-gray-600">No Plat: <?= htmlspecialchars($tr['noplat'] ?? '-') ?></p>
                                <p class="text-sm text-gray-600">Durasi: <?= $tr['durasi_sewa'] ?> hari</p>
                                <p class="text-sm text-gray-600">Harga / Hari: <span class="text-orange-500 font-medium">Rp <?= number_format($harga_per_hari,2) ?></span></p>
                                <p class="text-sm text-gray-600">Tanggal Sewa: <?= date('d M Y', strtotime($tr['tgl_sewa'])) ?></p>
                                <p class="text-sm text-gray-600">Tanggal Kembali: <?= date('d M Y', strtotime($tr['tgl_kembali'])) ?></p>
                                <p class="text-sm text-gray-600">Pegawai: <?= htmlspecialchars($tr['nama_pegawai'] ?? '-') ?></p>
                                <span class="<?= $tr['status']=='selesai'?'text-green-600':'text-red-600' ?> font-semibold"><?= ucfirst($tr['status']) ?></span>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0 flex flex-col items-end">
                            <span class="text-xl font-semibold text-orange-500">Rp <?= number_format($tr['total_bayar'], 2) ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Tabs
document.getElementById('tab-pesanan').addEventListener('click', () => {
    document.getElementById('pesanan-list').classList.remove('hidden');
    document.getElementById('riwayat-list').classList.add('hidden');
    document.getElementById('tab-pesanan').classList.add('bg-orange-500', 'text-white');
    document.getElementById('tab-riwayat').classList.remove('bg-orange-500', 'text-white');
});
document.getElementById('tab-riwayat').addEventListener('click', () => {
    document.getElementById('pesanan-list').classList.add('hidden');
    document.getElementById('riwayat-list').classList.remove('hidden');
    document.getElementById('tab-riwayat').classList.add('bg-orange-500', 'text-white');
    document.getElementById('tab-pesanan').classList.remove('bg-orange-500', 'text-white');
});

// AJAX Update Status
function updateStatus(id, status){
    if(!confirm('Tandai pesanan ini sebagai selesai?')) return;

    fetch('index.php?action=updatePesanan', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `id_transaksi=${id}&status=${status}`
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if(data.success) location.reload();
    });
}

// AJAX Delete Pesanan
function hapusPesanan(id){
    if(!confirm('Yakin ingin membatalkan pesanan ini?')) return;

    fetch('index.php?action=deletePesanan', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `id_transaksi=${id}`
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if(data.success) location.reload();
    });
}
</script>
</body>
</html>
