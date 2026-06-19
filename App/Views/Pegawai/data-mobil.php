<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$pageTitle  = 'Data Mobil';
$activePage = 'data-mobil';

// Collect page content first
ob_start(); ?>

<?php $flash = $_SESSION['success'] ?? null; unset($_SESSION['success']); ?>
<?php if ($flash): ?>
<div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl flex items-center gap-2">
    <i class="fa-solid fa-check-circle"></i> <?= htmlspecialchars($flash) ?>
</div>
<?php endif; ?>

<!-- Header Bar -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
    <div>
        <h3 class="text-xl font-bold text-neutral-800">Daftar Mobil</h3>
        <p class="text-sm text-neutral-500"><?= count($data_mobil ?? []) ?> unit terdaftar</p>
    </div>
    <a href="index.php?action=insert-tipemobil"
       class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition-all shadow">
        <i class="fa-solid fa-plus"></i> Tambah Mobil
    </a>
</div>

<!-- Search -->
<form method="GET" action="" class="mb-5 flex gap-2">
    <input type="hidden" name="action" value="data-mobil">
    <input type="text" name="keyword" value="<?= htmlspecialchars($keyword ?? '') ?>"
           placeholder="Cari nama, merk, atau nomor plat..."
           class="flex-1 px-4 py-2.5 border border-neutral-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 bg-white">
    <button type="submit" class="px-4 py-2.5 bg-orange-500 hover:bg-orange-600 text-white rounded-xl text-sm font-semibold transition">
        <i class="fa-solid fa-search"></i>
    </button>
</form>

<!-- Table Card -->
<div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-neutral-200">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-neutral-50 border-b border-neutral-200">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider">Mobil</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider">No. Plat</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider">Tipe</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider">Transmisi</th>
                    <th class="px-4 py-3 text-right text-xs font-semibold text-neutral-500 uppercase tracking-wider">Harga/Hari</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-neutral-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-neutral-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-100">
                <?php if (!empty($data_mobil)): ?>
                    <?php foreach ($data_mobil as $m): ?>
                    <?php
                        $statusColor = match(strtolower($m['status'] ?? '')) {
                            'ready'       => 'bg-green-100 text-green-700',
                            'rent'        => 'bg-blue-100 text-blue-700',
                            'maintenance' => 'bg-yellow-100 text-yellow-700',
                            default       => 'bg-neutral-100 text-neutral-500'
                        };
                        $imgSrc = !empty($m['img']) ? 'Public/uploads/' . $m['img'] : 'assets/car-placeholder.png';
                    ?>
                    <tr class="hover:bg-orange-50/40 transition-colors">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <img src="<?= htmlspecialchars($imgSrc) ?>"
                                     alt="<?= htmlspecialchars($m['merk'] ?? '') ?>"
                                     class="w-14 h-10 object-cover rounded-lg bg-neutral-200">
                                <div>
                                    <p class="font-semibold text-neutral-800"><?= htmlspecialchars($m['merk'] ?? '') ?> <?= htmlspecialchars($m['model'] ?? '') ?></p>
                                    <p class="text-xs text-neutral-400"><?= htmlspecialchars($m['warna'] ?? '') ?> · <?= htmlspecialchars($m['tahun'] ?? '') ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 font-mono text-neutral-700"><?= htmlspecialchars($m['noplat'] ?? '-') ?></td>
                        <td class="px-4 py-3 text-neutral-600"><?= htmlspecialchars($m['tipe'] ?? '-') ?></td>
                        <td class="px-4 py-3 text-neutral-600 capitalize"><?= htmlspecialchars($m['transmisi'] ?? '-') ?></td>
                        <td class="px-4 py-3 text-right font-semibold text-orange-600">
                            Rp <?= number_format($m['harga'] ?? 0, 0, ',', '.') ?>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold <?= $statusColor ?> capitalize">
                                <?= htmlspecialchars($m['status'] ?? '-') ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="index.php?action=edit-mobil&id=<?= $m['id_mobil'] ?>"
                                   class="p-1.5 bg-blue-100 text-blue-600 hover:bg-blue-200 rounded-lg transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <a href="index.php?action=delete-mobil&id=<?= $m['id_mobil'] ?>"
                                   onclick="return confirm('Hapus mobil ini?')"
                                   class="p-1.5 bg-red-100 text-red-600 hover:bg-red-200 rounded-lg transition" title="Hapus">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="px-4 py-12 text-center text-neutral-400">
                            <i class="fa-solid fa-car text-4xl mb-3 block text-neutral-300"></i>
                            Tidak ada data mobil<?= !empty($keyword) ? ' untuk pencarian "<strong>'.htmlspecialchars($keyword).'</strong>"' : '' ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$pageContent = ob_get_clean();
include __DIR__ . '/layout.php';
?>
