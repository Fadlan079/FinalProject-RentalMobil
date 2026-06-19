<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$pageTitle  = 'Laporan';
$activePage = 'laporan';

// Compute report data from $semuaTransaksi / $allMobil / $data_pelanggan
$txAll      = $semuaTransaksi ?? [];
$totalTx    = count($txAll);
$txBerjalan = count(array_filter($txAll, fn($t) => strtolower($t['status'] ?? '') === 'berjalan'));
$txSelesai  = count(array_filter($txAll, fn($t) => strtolower($t['status'] ?? '') === 'selesai'));
$txBatal    = count(array_filter($txAll, fn($t) => strtolower($t['status'] ?? '') === 'batal'));

$totalPendapatan = array_sum(array_map(
    fn($t) => strtolower($t['status'] ?? '') === 'selesai' ? (float)($t['total_bayar'] ?? 0) : 0,
    $txAll
));

// Monthly revenue (last 6 months)
$monthlyRevenue = [];
for ($i = 5; $i >= 0; $i--) {
    $month = date('Y-m', strtotime("-$i months"));
    $label = date('M Y', strtotime("-$i months"));
    $rev   = array_sum(array_map(
        fn($t) => strtolower($t['status'] ?? '') === 'selesai' && str_starts_with($t['tgl_sewa'] ?? '', $month) ? (float)($t['total_bayar'] ?? 0) : 0,
        $txAll
    ));
    $monthlyRevenue[] = ['label' => $label, 'value' => $rev];
}
$maxRevenue = max(1, ...array_column($monthlyRevenue, 'value'));

// Top 5 mobil
$mobilCount = [];
foreach ($txAll as $t) {
    $key = $t['nama_mobil'] ?? 'Unknown';
    $mobilCount[$key] = ($mobilCount[$key] ?? 0) + 1;
}
arsort($mobilCount);
$topMobil = array_slice($mobilCount, 0, 5, true);

ob_start(); ?>

<!-- Summary Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl p-5 border border-neutral-200 shadow-sm">
        <p class="text-xs text-neutral-400 uppercase tracking-wider mb-1">Total Transaksi</p>
        <p class="text-4xl font-extrabold text-neutral-800"><?= $totalTx ?></p>
    </div>
    <div class="bg-white rounded-2xl p-5 border border-neutral-200 shadow-sm">
        <p class="text-xs text-neutral-400 uppercase tracking-wider mb-1">Transaksi Selesai</p>
        <p class="text-4xl font-extrabold text-green-600"><?= $txSelesai ?></p>
    </div>
    <div class="bg-white rounded-2xl p-5 border border-neutral-200 shadow-sm">
        <p class="text-xs text-neutral-400 uppercase tracking-wider mb-1">Sedang Berjalan</p>
        <p class="text-4xl font-extrabold text-blue-600"><?= $txBerjalan ?></p>
    </div>
    <div class="bg-white rounded-2xl p-5 border border-neutral-200 shadow-sm">
        <p class="text-xs text-neutral-400 uppercase tracking-wider mb-1">Total Pendapatan</p>
        <p class="text-2xl font-extrabold text-orange-500">Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <!-- Bar Chart Pendapatan per Bulan -->
    <div class="lg:col-span-2 bg-white rounded-2xl p-6 border border-neutral-200 shadow-sm">
        <h4 class="text-base font-bold text-neutral-800 mb-5">Pendapatan 6 Bulan Terakhir</h4>
        <div class="flex items-end gap-3 h-48">
            <?php foreach ($monthlyRevenue as $mr):
                $pct = $maxRevenue > 0 ? ($mr['value'] / $maxRevenue) * 100 : 0;
                $isCurrentMonth = (str_starts_with(date('Y-m'), date('Y-m', strtotime($mr['label']))));
            ?>
            <div class="flex-1 flex flex-col items-center gap-1">
                <span class="text-xs text-neutral-500 text-center"><?= $mr['value'] > 0 ? 'Rp '.number_format($mr['value']/1000000,1).'jt' : '-' ?></span>
                <div class="w-full rounded-t-lg transition-all duration-500 <?= $isCurrentMonth ? 'bg-orange-500' : 'bg-orange-200' ?>"
                     style="height: <?= max(4, $pct * 1.68) ?>px"></div>
                <span class="text-xs text-neutral-400 text-center leading-tight"><?= htmlspecialchars($mr['label']) ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Donut-style Status -->
    <div class="bg-white rounded-2xl p-6 border border-neutral-200 shadow-sm">
        <h4 class="text-base font-bold text-neutral-800 mb-5">Status Transaksi</h4>
        <div class="space-y-4">
            <?php
            $items = [
                ['label' => 'Selesai',  'count' => $txSelesai,  'color' => 'bg-green-500', 'textColor' => 'text-green-600'],
                ['label' => 'Berjalan', 'count' => $txBerjalan, 'color' => 'bg-blue-500',  'textColor' => 'text-blue-600'],
                ['label' => 'Batal',    'count' => $txBatal,    'color' => 'bg-red-400',   'textColor' => 'text-red-500'],
            ];
            foreach ($items as $item):
                $pct = $totalTx > 0 ? round($item['count'] / $totalTx * 100) : 0;
            ?>
            <div>
                <div class="flex justify-between items-center mb-1">
                    <span class="text-sm text-neutral-600"><?= $item['label'] ?></span>
                    <span class="text-sm font-semibold <?= $item['textColor'] ?>"><?= $item['count'] ?> (<?= $pct ?>%)</span>
                </div>
                <div class="w-full bg-neutral-100 rounded-full h-2">
                    <div class="<?= $item['color'] ?> h-2 rounded-full transition-all duration-700" style="width: <?= $pct ?>%"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-6 pt-4 border-t border-neutral-100">
            <p class="text-xs text-neutral-400 uppercase tracking-wider mb-2">Tingkat Keberhasilan</p>
            <p class="text-3xl font-extrabold text-green-600">
                <?= $totalTx > 0 ? round($txSelesai / $totalTx * 100) : 0 ?>%
            </p>
        </div>
    </div>
</div>

<!-- Top Mobil -->
<div class="bg-white rounded-2xl p-6 border border-neutral-200 shadow-sm">
    <h4 class="text-base font-bold text-neutral-800 mb-5">5 Mobil Terpopuler</h4>
    <div class="space-y-4">
        <?php $maxCount = max(1, ...array_values($topMobil + [0])); ?>
        <?php $rank = 1; foreach ($topMobil as $name => $count):
            $pct = round($count / $maxCount * 100);
        ?>
        <div class="flex items-center gap-4">
            <span class="w-6 h-6 rounded-full text-xs font-bold flex items-center justify-center
                <?= $rank === 1 ? 'bg-yellow-400 text-yellow-900' : ($rank === 2 ? 'bg-neutral-300 text-neutral-700' : ($rank === 3 ? 'bg-orange-300 text-orange-900' : 'bg-neutral-100 text-neutral-500')) ?>">
                <?= $rank ?>
            </span>
            <div class="flex-1">
                <div class="flex justify-between items-center mb-1">
                    <span class="text-sm font-medium text-neutral-700"><?= htmlspecialchars($name) ?></span>
                    <span class="text-sm font-semibold text-orange-600"><?= $count ?>x</span>
                </div>
                <div class="w-full bg-neutral-100 rounded-full h-2">
                    <div class="bg-orange-400 h-2 rounded-full" style="width: <?= $pct ?>%"></div>
                </div>
            </div>
        </div>
        <?php $rank++; endforeach; ?>
        <?php if (empty($topMobil)): ?>
            <p class="text-center text-neutral-400 py-6">Belum ada data transaksi</p>
        <?php endif; ?>
    </div>
</div>

<?php
$pageContent = ob_get_clean();
include __DIR__ . '/layout.php';
?>
