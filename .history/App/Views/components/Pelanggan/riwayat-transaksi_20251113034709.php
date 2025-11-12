<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Riwayat Transaksi - Cylc Rent Car</title>
  <link rel="stylesheet" href="output.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"/>
  <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
</head>
<body class="bg-neutral-100 text-neutral-900">

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Transaksi Kamu</h1>

    <!-- Tabs -->
    <div class="flex justify-center mb-6 space-x-4">
        <button id="tab-pesanan" class="px-6 py-2 bg-orange-500 text-white rounded-lg">Pesanan Berjalan</button>
        <button id="tab-riwayat" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg">Riwayat Transaksi</button>
    </div>

    <!-- Pesanan -->
    <div id="pesanan-list">
        <?php 
        $pesanan = array_filter($riwayat, fn($t) => $t['status'] == 'berjalan');
        if (empty($pesanan)): ?>
            <p class="text-center text-gray-500">Tidak ada pesanan berjalan.</p>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($pesanan as $tr): ?>
                    <div class="bg-white shadow-md rounded-xl p-4 flex flex-col md:flex-row items-center justify-between border border-gray-100">
                        <div class="flex items-center space-x-4">
                            <img src="../public/assets/uploads/<?= htmlspecialchars($tr['img'] ?? 'default.jpg') ?>" class="w-24 h-24 object-cover rounded-lg" alt="Mobil">
                            <div>
                                <h2 class="text-lg font-semibold"><?= htmlspecialchars($tr['merk'] ?? '-') ?></h2>
                                <p class="text-sm text-gray-600">No Plat: <?= htmlspecialchars($tr['noplat'] ?? '-') ?></p>
                                <p class="text-sm text-gray-600">Durasi: <?= htmlspecialchars($tr['durasi_sewa'] ?? 0) ?> hari</p>
                                <p class="text-sm text-gray-600">Total: Rp <?= number_format($tr['total_bayar'] ?? 0, 2) ?></p>
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

    <!-- Riwayat -->
    <div id="riwayat-list" class="hidden">
        <?php 
        $riwayatSelesai = array_filter($riwayat, fn($t) => $t['status'] == 'selesai');
        if (empty($riwayatSelesai)): ?>
            <p class="text-center text-gray-500">Belum ada transaksi selesai.</p>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($riwayatSelesai as $tr): ?>
                    <div class="bg-gray-50 shadow-sm rounded-xl p-4 flex flex-col md:flex-row items-center justify-between border border-gray-100">
                        <div class="flex items-center space-x-4">
                            <img src="../public/assets/uploads/<?= htmlspecialchars($tr['img'] ?? 'default.jpg') ?>" class="w-24 h-24 object-cover rounded-lg" alt="Mobil">
                            <div>
                                <h2 class="text-lg font-semibold"><?= htmlspecialchars($tr['merk'] ?? '-') ?></h2>
                                <p class="text-sm text-gray-600">No Plat: <?= htmlspecialchars($tr['noplat'] ?? '-') ?></p>
                                <p class="text-sm text-gray-600">Durasi: <?= htmlspecialchars($tr['durasi_sewa'] ?? 0) ?> hari</p>
                                <p class="text-sm text-gray-600">Total: Rp <?= number_format($tr['total_bayar'] ?? 0, 2) ?></p>
                                <span class="text-green-600 font-semibold">Selesai</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
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

function updateStatus(id, status) {
    if (!confirm('Tandai pesanan ini sebagai selesai?')) return;
    fetch('index.php?action=updatePesananAjax', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `id_transaksi=${id}&status=${status}`
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if (data.success) location.reload();
    });
}

function hapusPesanan(id) {
    if (!confirm('Yakin ingin membatalkan pesanan ini?')) return;
    fetch('index.php?action=deletePesananAjax', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `id_transaksi=${id}`
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if (data.success) location.reload();
    });
}
</script>

</body>
