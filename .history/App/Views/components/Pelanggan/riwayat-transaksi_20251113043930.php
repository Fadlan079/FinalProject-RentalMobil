<?php
require_once 'Transaksi.php';

$transaksiModel = new Transaksi();
$id_pelanggan = $_SESSION['id_pelanggan'] ?? 0;

$riwayat = $transaksiModel->getall($id_pelanggan);

$total_transaksi = count($riwayat);
$total_bayar = array_sum(array_column($riwayat, 'total_bayar'));
$status_count = [
    'selesai' => count(array_filter($riwayat, fn($t)=>$t['status']=='selesai')),
    'berjalan'=> count(array_filter($riwayat, fn($t)=>$t['status']=='berjalan')),
    'batal'   => count(array_filter($riwayat, fn($t)=>$t['status']=='batal')),
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Riwayat Transaksi - Cylc Rent Car</title>
<link rel="stylesheet" href="output.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"/>
</head>
<body class="bg-neutral-100 text-neutral-900">

<div class="relative min-h-screen">
    <div class="relative z-10 max-w-6xl mx-auto mt-6 px-4">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Transaksi Kamu</h1>
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
            <div>Total Transaksi: <span class="font-semibold text-orange-500"><?= $total_transaksi ?></span></div>
            <div>Total Bayar: <span class="font-semibold text-orange-500">Rp <?= number_format($total_bayar,2) ?></span></div>
            <div>Selesai: <span class="text-green-600 font-semibold"><?= $status_count['selesai'] ?></span></div>
            <div>Berjalan: <span class="text-yellow-600 font-semibold"><?= $status_count['berjalan'] ?></span></div>
            <div>Batal: <span class="text-red-600 font-semibold"><?= $status_count['batal'] ?></span></div>
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
                            <p class="text-sm text-gray-600">No Plat: <?= htmlspecialchars($tr['noplat'] ?? '-') ?></p>
                            <p class="text-sm text-gray-600">Durasi: <?= $tr['durasi_sewa'] ?> hari</p>
                            <p class="text-sm text-gray-600">Harga / Hari: Rp <?= number_format($harga_per_hari,2) ?></p>
                            <p class="text-sm text-gray-600">Tanggal Kembali: <?= date('d M Y', strtotime($tr['tgl_kembali'])) ?></p>
                            <p class="text-sm text-gray-600">Pegawai: <?= htmlspecialchars($tr['nama_pegawai'] ?? '-') ?></p>
                            <p class="text-sm mt-1">Status: <span class="font-semibold text-yellow-600"><?= ucfirst($tr['status']) ?></span></p>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 flex flex-col space-y-2">
                        <button onclick="updateStatus(<?= $tr['id_transaksi'] ?>, 'selesai')" class="bg-green-600 text-white px-4 py-1 rounded-md hover:bg-green-500">Selesai</button>
                        <button onclick="hapusPesanan(<?= $tr['id_transaksi'] ?>)" class="bg-red-600 text-white px-4 py-1 rounded-md hover:bg-red-500">Batalkan</button>
                        <button onclick="editPesanan(<?= $tr['id_transaksi'] ?>)" class="bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-500">Edit</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        </div>

        <!-- Riwayat Transaksi -->
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
                            <p class="text-sm text-gray-600">No Plat: <?= htmlspecialchars($tr['noplat'] ?? '-') ?></p>
                            <p class="text-sm text-gray-600">Durasi: <?= $tr['durasi_sewa'] ?> hari</p>
                            <p class="text-sm text-gray-600">Harga / Hari: Rp <?= number_format($harga_per_hari,2) ?></p>
                            <p class="text-sm text-gray-600">Pegawai: <?= htmlspecialchars($tr['nama_pegawai'] ?? '-') ?></p>
                            <span class="<?= $tr['status']=='selesai'?'text-green-600':'text-red-600' ?> font-semibold"><?= ucfirst($tr['status']) ?></span>
                        </div>
                        <div class="mt-4 md:mt-0 flex flex-col items-end">
                            <span class="text-xl font-semibold text-orange-500">Rp <?= number_format($tr['total_bayar'], 2) ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-96">
        <h2 class="text-xl font-semibold mb-4">Edit Pesanan</h2>
        <form id="editForm">
            <input type="hidden" name="id_transaksi" id="edit_id">
            <div class="mb-2">
                <label>Tanggal Kembali</label>
                <input type="date" name="tgl_kembali" id="edit_tgl_kembali" class="w-full border rounded px-2 py-1">
            </div>
            <div class="mb-2">
                <label>Durasi Sewa (hari)</label>
                <input type="number" name="durasi_sewa" id="edit_durasi_sewa" class="w-full border rounded px-2 py-1">
            </div>
            <div class="mb-4">
                <label>Total Bayar</label>
                <input type="number" name="total_bayar" id="edit_total_bayar" class="w-full border rounded px-2 py-1">
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal()" class="px-4 py-1 rounded bg-gray-300 hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-1 rounded bg-blue-600 text-white hover:bg-blue-500">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
const riwayat = <?= json_encode($riwayat) ?>;

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
    }).then(res => res.json()).then(data => {
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
    }).then(res => res.json()).then(data => {
        alert(data.message);
        if(data.success) location.reload();
    });
}

// Modal Edit
function editPesanan(id){
    const tr = riwayat.find(t => t.id_transaksi == id);
    if(!tr) return alert('Data tidak ditemukan');

    document.getElementById('edit_id').value = tr.id_transaksi;
    document.getElementById('edit_tgl_kembali').value = tr.tgl_kembali;
    document.getElementById('edit_durasi_sewa').value = tr.durasi_sewa;
    document.getElementById('edit_total_bayar').value = tr.total_bayar;
    document.getElementById('editModal').classList.remove('hidden');
}
function closeModal(){
    document.getElementById('editModal').classList.add('hidden');
}
document.getElementById('editForm').addEventListener('submit', function(e){
    e.preventDefault();
    const formData = new FormData(this);
    fetch('index.php?action=editPesanan', {
        method: 'POST',
        body: new URLSearchParams(formData)
    }).then(res => res.json()).then(data => {
        alert(data.message);
        if(data.success) location.reload();
    });
});
</script>

</body>
</html>
