<?php
// Pastikan session sudah started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../../Models/transaksi.php';

$transaksiModel = new Transaksi();
$id_user = $_SESSION['user']['id_user'] ?? 0;

// Dapatkan profile pelanggan untuk mendapatkan id_pelanggan
require_once __DIR__ . '/../../../Models/pelanggan.php';
$pelangganModel = new Pelanggan();
$profile = $pelangganModel->getpelangganbyiduser($id_user);
$id_pelanggan = $profile['id_pelanggan'] ?? 0;

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
            <p class="text-center text-neutral-500">Tidak ada pesanan berjalan.</p>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach($pesanan as $tr):
                    $today = new DateTime();
                    $tgl_kembali = new DateTime($tr['tgl_kembali']);
                    $sisa_hari = (int)$tgl_kembali->diff($today)->format('%r%a');
                    $harga_per_hari = $tr['durasi_sewa'] > 0 ? $tr['total_bayar'] / $tr['durasi_sewa'] : $tr['total_bayar'];
                    // Perbaikan path gambar
                    $gambar_path = __DIR__ . '/../../../../Public/uploads/' . ($tr['img'] ?? 'default.jpg');
                    $gambar = (!empty($tr['img']) && file_exists($gambar_path)) ? $tr['img'] : 'default.jpg';
                ?>
                <div class="bg-neutral-900  shadow-md rounded-xl p-4 flex flex-col md:flex-row items-center justify-between border-t-5 border-orange-500 hover:shadow-lg transition-shadow duration-300">
                    <div class="flex items-center space-x-4">
                        <img src="../Public/uploads/<?= htmlspecialchars($gambar) ?>"  
                             class="w-24 h-24 object-cover rounded-lg" alt="Mobil">
                        <div>
                            <h2 class="text-lg font-semibold"><?= htmlspecialchars($tr['merk'] ?? '-') ?> (<?= $tr['tahun'] ?>)</h2>
                            <p class="text-sm text-gray-600">Model / Tipe: <?= htmlspecialchars($tr['model'] ?? '-') ?> / <?= htmlspecialchars($tr['tipe'] ?? '-') ?></p>
                            <p class="text-sm text-gray-600">No Plat: <?= htmlspecialchars($tr['noplat'] ?? '-') ?></p>
                            <p class="text-sm text-gray-600">Durasi: <?= $tr['durasi_sewa'] ?> hari</p>
                            <p class="text-sm text-gray-600">Harga / Hari: Rp <?= number_format($harga_per_hari,2) ?></p>
                            <p class="text-sm text-gray-600">Tanggal Sewa: <?= date('d M Y', strtotime($tr['tgl_sewa'])) ?></p>
                            <p class="text-sm text-gray-600">Tanggal Kembali: <?= date('d M Y', strtotime($tr['tgl_kembali'])) ?></p>
                            <p class="text-sm text-gray-600">Pegawai: <?= htmlspecialchars($tr['nama_pegawai'] ?? 'Belum ditugaskan') ?></p>
                            <p class="text-sm mt-1 text-gray-600">Status: <span class="font-semibold text-yellow-600"><?= ucfirst($tr['status']) ?></span></p>
                            <?php if ($sisa_hari >= 0): ?>
                                <p class="text-sm <?= $sisa_hari < 3 ? 'text-red-600 font-semibold' : 'text-green-600' ?>">
                                    Sisa waktu: <?= $sisa_hari ?> hari
                                </p>
                            <?php else: ?>
                                <p class="text-sm text-red-600 font-semibold">
                                    Telat: <?= abs($sisa_hari) ?> hari
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 flex flex-col space-y-2">
                        <button onclick="updateStatus(<?= $tr['id_transaksi'] ?>, 'selesai')" 
                                class="bg-green-600 text-white px-4 py-1 rounded-md hover:bg-green-500 transition-colors">
                            Selesai
                        </button>
                        <button onclick="batalkanPesanan(<?= $tr['id_transaksi'] ?>)" 
                                class="bg-red-600 text-white px-4 py-1 rounded-md hover:bg-red-500 transition-colors">
                            Batalkan
                        </button>
                        <button onclick="editPesanan(<?= $tr['id_transaksi'] ?>)" 
                                class="bg-blue-600 text-white px-4 py-1 rounded-md hover:bg-blue-500 transition-colors">
                            Edit
                        </button>
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
                    // Perbaikan path gambar
                    $gambar_path = __DIR__ . '/../../../../Public/uploads/' . ($tr['img'] ?? 'default.jpg');
                    $gambar = (!empty($tr['img']) && file_exists($gambar_path)) ? $tr['img'] : 'default.jpg';
                ?>
                <div class="bg-neutral-900 shadow-sm rounded-xl p-4 border-t-5 border-orange-500 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center space-x-4">
                        <img src="../Public/uploads/<?= htmlspecialchars($gambar) ?>" 
                             class="w-24 h-24 object-cover rounded-lg" alt="Mobil">
                        <div class="flex-1">
                            <h2 class="text-lg font-semibold"><?= htmlspecialchars($tr['merk'] ?? '-') ?> (<?= $tr['tahun'] ?>)</h2>
                            <p class="text-sm text-gray-600">Model / Tipe: <?= htmlspecialchars($tr['model'] ?? '-') ?> / <?= htmlspecialchars($tr['tipe'] ?? '-') ?></p>
                            <p class="text-sm text-gray-600">No Plat: <?= htmlspecialchars($tr['noplat'] ?? '-') ?></p>
                            <p class="text-sm text-gray-600">Durasi: <?= $tr['durasi_sewa'] ?> hari</p>
                            <p class="text-sm text-gray-600">Tanggal Sewa: <?= date('d M Y', strtotime($tr['tgl_sewa'])) ?></p>
                            <p class="text-sm text-gray-600">Tanggal Kembali: <?= date('d M Y', strtotime($tr['tgl_kembali'])) ?></p>
                            <p class="text-sm text-gray-600">Pegawai: <?= htmlspecialchars($tr['nama_pegawai'] ?? 'Belum ditugaskan') ?></p>
                            <div class="flex justify-between items-center mt-2">
                                <span class="<?= $tr['status']=='selesai'?'text-green-600':'text-red-600' ?> font-semibold">
                                    <?= ucfirst($tr['status']) ?>
                                </span>
                                <span class="text-xl font-semibold text-orange-500">
                                    Rp <?= number_format($tr['total_bayar'], 2) ?>
                                </span>
                            </div>
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
<div id="editModal" class="hidden fixed inset-0 bg-neutral-900/50 backdrop-blur-lg flex items-center justify-center z-50">
    <div class="bg-neutral-900 border-t-5 border-orange-500 text-neutral-100 p-6 rounded-lg w-96 max-w-full mx-4">
        <h2 class="text-xl font-semibold mb-4">Edit Pesanan</h2>
        <form id="editForm">
            <input type="hidden" name="id_transaksi" id="edit_id">
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Tanggal Kembali</label>
                <input type="date" name="tgl_kembali" id="edit_tgl_kembali" 
                       class="w-full rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500"
                       min="<?= date('Y-m-d') ?>">
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Durasi Sewa (hari)</label>
                <input type="number" name="durasi_sewa" id="edit_durasi_sewa" min="1" 
                       class="w-full rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Total Bayar</label>
                <input type="number" name="total_bayar" id="edit_total_bayar" min="0" step="0.01"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal()" 
                        class="px-4 py-2 rounded bg-neutral-500 hover:bg-neutral-600 transition-colors">
                    Batal
                </button>
                <button type="submit" 
                        class="px-4 py-2 rounded bg-orange-500 text-neutral-100 hover:bg-orange-600 transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Tabs
document.getElementById('tab-pesanan').addEventListener('click', () => {
    document.getElementById('pesanan-list').classList.remove('hidden');
    document.getElementById('riwayat-list').classList.add('hidden');
    document.getElementById('tab-pesanan').classList.add('bg-orange-500', 'text-white');
    document.getElementById('tab-pesanan').classList.remove('bg-gray-200', 'text-gray-800');
    document.getElementById('tab-riwayat').classList.remove('bg-orange-500', 'text-white');
    document.getElementById('tab-riwayat').classList.add('bg-gray-200', 'text-gray-800');
});

document.getElementById('tab-riwayat').addEventListener('click', () => {
    document.getElementById('pesanan-list').classList.add('hidden');
    document.getElementById('riwayat-list').classList.remove('hidden');
    document.getElementById('tab-riwayat').classList.add('bg-orange-500', 'text-white');
    document.getElementById('tab-riwayat').classList.remove('bg-gray-200', 'text-gray-800');
    document.getElementById('tab-pesanan').classList.remove('bg-orange-500', 'text-white');
    document.getElementById('tab-pesanan').classList.add('bg-gray-200', 'text-gray-800');
});

// AJAX Update Status
function updateStatus(id, status){
    if(!confirm('Tandai pesanan ini sebagai selesai?')) return;
    
    fetch('index.php?action=updatePesanan', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id_transaksi=${id}&status=${status}`
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if(data.success) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memperbarui status');
    });
}

// AJAX Batalkan Pesanan (soft delete)
function batalkanPesanan(id){
    if(!confirm('Yakin ingin membatalkan pesanan ini?')) return;
    
    fetch('index.php?action=batalkanPesanan', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id_transaksi=${id}`
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if(data.success) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat membatalkan pesanan');
    });
}

// Modal Edit
async function editPesanan(id){
    try {
        // Ambil data detail dari server
        const response = await fetch(`index.php?action=getDetailPesanan&id_transaksi=${id}`);
        const result = await response.json();
        
        if (result.success) {
            const tr = result.data;
            document.getElementById('edit_id').value = tr.id_transaksi;
            document.getElementById('edit_tgl_kembali').value = tr.tgl_kembali_form;
            document.getElementById('edit_durasi_sewa').value = tr.durasi_sewa;
            document.getElementById('edit_total_bayar').value = tr.total_bayar;
            document.getElementById('editModal').classList.remove('hidden');
        } else {
            alert(result.message || 'Data tidak ditemukan');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memuat data');
    }
}

function closeModal(){
    document.getElementById('editModal').classList.add('hidden');
}

// Handle form submit untuk edit
document.getElementById('editForm').addEventListener('submit', function(e){
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = new URLSearchParams(formData);
    
    fetch('index.php?action=updatePesananFull', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: data
    })
    .then(res => res.json())
    .then(result => {
        alert(result.message);
        if(result.success) {
            closeModal();
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupdate pesanan');
    });
});

// Close modal ketika klik di luar
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Close modal dengan ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});
</script>

</body>
</html>