<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$pageTitle  = 'Transaksi';
$activePage = 'data-transaksi';

ob_start(); ?>

<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
    <div>
        <h3 class="text-xl font-bold text-neutral-800">Manajemen Transaksi</h3>
        <p class="text-sm text-neutral-500"><?= count($semuaTransaksi ?? []) ?> transaksi total</p>
    </div>
    <div class="flex gap-2">
        <form method="GET" action="" class="flex gap-2">
            <input type="hidden" name="action" value="data-transaksi">
            <select name="status_filter" onchange="this.form.submit()"
                    class="px-4 py-2.5 border border-neutral-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 bg-white">
                <option value="">Semua Status</option>
                <option value="berjalan" <?= (($_GET['status_filter'] ?? '') === 'berjalan') ? 'selected' : '' ?>>Berjalan</option>
                <option value="selesai"  <?= (($_GET['status_filter'] ?? '') === 'selesai')  ? 'selected' : '' ?>>Selesai</option>
                <option value="batal"    <?= (($_GET['status_filter'] ?? '') === 'batal')    ? 'selected' : '' ?>>Batal</option>
            </select>
        </form>
    </div>
</div>

<!-- Table -->
<div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-neutral-200">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-neutral-50 border-b border-neutral-200">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase">#</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase">Pelanggan</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase">Mobil</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase">Tgl Sewa</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase">Tgl Kembali</th>
                    <th class="px-4 py-3 text-right text-xs font-semibold text-neutral-500 uppercase">Total</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-neutral-500 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-100">
                <?php if (!empty($semuaTransaksi)): ?>
                    <?php foreach ($semuaTransaksi as $t): ?>
                    <?php
                        $statusColor = match(strtolower($t['status'] ?? '')) {
                            'berjalan' => 'bg-blue-100 text-blue-700',
                            'selesai'  => 'bg-green-100 text-green-700',
                            'batal'    => 'bg-red-100 text-red-700',
                            default    => 'bg-neutral-100 text-neutral-500'
                        };
                    ?>
                    <tr class="hover:bg-orange-50/40 transition-colors">
                        <td class="px-4 py-3 text-neutral-400 font-mono">#<?= $t['id_transaksi'] ?></td>
                        <td class="px-4 py-3 font-medium text-neutral-800"><?= htmlspecialchars($t['nama_pelanggan'] ?? $t['email_pelanggan'] ?? '-') ?></td>
                        <td class="px-4 py-3 text-neutral-600"><?= htmlspecialchars($t['nama_mobil'] ?? '-') ?></td>
                        <td class="px-4 py-3 text-neutral-600"><?= htmlspecialchars($t['tgl_sewa'] ?? '-') ?></td>
                        <td class="px-4 py-3 text-neutral-600"><?= htmlspecialchars($t['tgl_kembali'] ?? '-') ?></td>
                        <td class="px-4 py-3 text-right font-semibold text-orange-600">
                            Rp <?= number_format($t['total_bayar'] ?? 0, 0, ',', '.') ?>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold <?= $statusColor ?> capitalize">
                                <?= htmlspecialchars($t['status'] ?? '-') ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="px-4 py-12 text-center text-neutral-400">
                            <i class="fa-solid fa-file-invoice text-4xl mb-3 block text-neutral-300"></i>
                            Tidak ada data transaksi
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
