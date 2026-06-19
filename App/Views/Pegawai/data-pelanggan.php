<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$pageTitle  = 'Data Pelanggan';
$activePage = 'data-pelanggan';

ob_start(); ?>

<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
    <div>
        <h3 class="text-xl font-bold text-neutral-800">Daftar Pelanggan</h3>
        <p class="text-sm text-neutral-500"><?= count($data_pelanggan ?? []) ?> pelanggan terdaftar</p>
    </div>
    <form method="GET" action="" class="flex gap-2">
        <input type="hidden" name="action" value="data-pelanggan">
        <input type="text" name="keyword" value="<?= htmlspecialchars($keyword ?? '') ?>"
               placeholder="Cari email atau nama..."
               class="px-4 py-2.5 border border-neutral-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 bg-white min-w-64">
        <button type="submit" class="px-4 py-2.5 bg-orange-500 hover:bg-orange-600 text-white rounded-xl text-sm font-semibold transition">
            <i class="fa-solid fa-search"></i>
        </button>
    </form>
</div>

<!-- Stat Cards -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <?php
        $total   = count($data_pelanggan ?? []);
        $hasProf = 0;
        foreach (($data_pelanggan ?? []) as $pel) {
            if (!empty($pel['nama'])) $hasProf++;
        }
    ?>
    <div class="bg-white rounded-xl p-4 border border-neutral-200 shadow-sm">
        <p class="text-xs text-neutral-400 uppercase tracking-wider mb-1">Total</p>
        <p class="text-3xl font-extrabold text-neutral-800"><?= $total ?></p>
        <p class="text-xs text-neutral-400 mt-1">Akun terdaftar</p>
    </div>
    <div class="bg-white rounded-xl p-4 border border-neutral-200 shadow-sm">
        <p class="text-xs text-neutral-400 uppercase tracking-wider mb-1">Profil Lengkap</p>
        <p class="text-3xl font-extrabold text-green-600"><?= $hasProf ?></p>
        <p class="text-xs text-neutral-400 mt-1">Sudah isi profil</p>
    </div>
    <div class="bg-white rounded-xl p-4 border border-neutral-200 shadow-sm">
        <p class="text-xs text-neutral-400 uppercase tracking-wider mb-1">Belum Lengkap</p>
        <p class="text-3xl font-extrabold text-yellow-500"><?= $total - $hasProf ?></p>
        <p class="text-xs text-neutral-400 mt-1">Profil kosong</p>
    </div>
    <div class="bg-white rounded-xl p-4 border border-neutral-200 shadow-sm">
        <p class="text-xs text-neutral-400 uppercase tracking-wider mb-1">Baru Bulan Ini</p>
        <p class="text-3xl font-extrabold text-blue-600"><?= $newThisMonth ?? 0 ?></p>
        <p class="text-xs text-neutral-400 mt-1">Pendaftaran baru</p>
    </div>
</div>

<!-- Table -->
<div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-neutral-200">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-neutral-50 border-b border-neutral-200">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase">Pelanggan</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase">JK</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase">No. Telp</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase">Kota</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-neutral-500 uppercase">Status Profil</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-100">
                <?php if (!empty($data_pelanggan)): ?>
                    <?php foreach ($data_pelanggan as $pel): ?>
                    <tr class="hover:bg-orange-50/40 transition-colors">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white font-bold text-xs">
                                    <?= strtoupper(substr($pel['email'] ?? '?', 0, 1)) ?>
                                </div>
                                <div>
                                    <p class="font-medium text-neutral-800"><?= htmlspecialchars($pel['email'] ?? '-') ?></p>
                                    <p class="text-xs text-neutral-400">#<?= $pel['id_user'] ?? '' ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded text-xs font-medium <?= ($pel['jk'] === 'L') ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' ?>">
                                <?= ($pel['jk'] === 'L') ? 'Laki-laki' : 'Perempuan' ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-neutral-700"><?= htmlspecialchars($pel['nama'] ?? '-') ?></td>
                        <td class="px-4 py-3 text-neutral-600"><?= htmlspecialchars($pel['telp'] ?? '-') ?></td>
                        <td class="px-4 py-3 text-neutral-600"><?= htmlspecialchars($pel['kota'] ?? '-') ?></td>
                        <td class="px-4 py-3 text-center">
                            <?php if (!empty($pel['nama'])): ?>
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Lengkap</span>
                            <?php else: ?>
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Belum Diisi</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-neutral-400">
                            <i class="fa-solid fa-user text-4xl mb-3 block text-neutral-300"></i>
                            Tidak ada data pelanggan
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
