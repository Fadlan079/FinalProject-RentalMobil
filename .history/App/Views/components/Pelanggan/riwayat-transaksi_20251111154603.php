











<?php
// Riwayat Transaksi Pelanggan
?>
<div class="min-h-screen bg-neutral-100 p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h1 class="text-3xl font-bold text-neutral-800 mb-2">Riwayat Transaksi</h1>
            <p class="text-neutral-600">Pantau semua aktivitas penyewaan mobil Anda</p>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-md p-4">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-full">
                        <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-neutral-600">Total Transaksi</p>
                        <p class="text-2xl font-bold text-neutral-800"><?php echo $total_transaksi; ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-full">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-neutral-600">Selesai</p>
                        <p class="text-2xl font-bold text-neutral-800"><?php echo $status_count['selesai']; ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-neutral-600">Berjalan</p>
                        <p class="text-2xl font-bold text-neutral-800"><?php echo $status_count['berjalan']; ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-full">
                        <i class="fas fa-times-circle text-red-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-neutral-600">Dibatalkan</p>
                        <p class="text-2xl font-bold text-neutral-800"><?php echo $status_count['batal']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pembayaran -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-neutral-800">Total Pembayaran</h3>
                    <p class="text-neutral-600">Total yang telah Anda bayarkan</p>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-green-600">Rp <?php echo number_format($total_bayar, 0, ',', '.'); ?></p>
                </div>
            </div>
        </div>

        <!-- Daftar Transaksi -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6 border-b border-neutral-200">
                <h2 class="text-xl font-semibold text-neutral-800">Daftar Transaksi</h2>
            </div>

            <div class="p-6">
                <?php if (empty($riwayat)): ?>
                    <div class="text-center py-12">
                        <i class="fas fa-inbox text-6xl text-neutral-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-neutral-600 mb-2">Belum ada transaksi</h3>
                        <p class="text-neutral-500">Anda belum melakukan penyewaan mobil apapun</p>
                        <a href="index.php?action=index" class="mt-4 inline-block px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors">
                            Mulai Sewa Mobil
                        </a>
                    </div>
                <?php else: ?>
                    <div class="space-y-4">
                        <?php foreach ($riwayat as $transaksi): ?>
                            <div class="border border-neutral-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-2">
                                            <h3 class="text-lg font-semibold text-neutral-800 mr-3">
                                                <?php echo htmlspecialchars($transaksi['merk'] . ' ' . $transaksi['model'] . ' ' . $transaksi['tipe']); ?>
                                            </h3>
                                            <span class="px-3 py-1 text-xs font-medium rounded-full
                                                <?php
                                                switch($transaksi['status']) {
                                                    case 'selesai':
                                                        echo 'bg-green-100 text-green-800';
                                                        break;
                                                    case 'berjalan':
                                                        echo 'bg-yellow-100 text-yellow-800';
                                                        break;
                                                    case 'batal':
                                                        echo 'bg-red-100 text-red-800';
                                                        break;
                                                    default:
                                                        echo 'bg-neutral-100 text-neutral-800';
                                                }
                                                ?>">
                                                <?php echo ucfirst($transaksi['status']); ?>
                                            </span>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-neutral-600">
                                            <div>
                                                <i class="fas fa-calendar-alt mr-2"></i>
                                                <span class="font-medium">Tanggal Sewa:</span>
                                                <?php echo date('d/m/Y', strtotime($transaksi['tgl_sewa'])); ?>
                                            </div>
                                            <div>
                                                <i class="fas fa-calendar-check mr-2"></i>
                                                <span class="font-medium">Tanggal Kembali:</span>
                                                <?php echo date('d/m/Y', strtotime($transaksi['tgl_kembali'])); ?>
                                            </div>
                                            <div>
                                                <i class="fas fa-clock mr-2"></i>
                                                <span class="font-medium">Durasi:</span>
                                                <?php echo $transaksi['durasi_sewa']; ?> hari
                                            </div>
                                        </div>

                                        <div class="mt-2 text-sm text-neutral-600">
                                            <i class="fas fa-car mr-2"></i>
                                            <span class="font-medium">Plat Nomor:</span>
                                            <?php echo htmlspecialchars($transaksi['noplat']); ?>
                                        </div>
                                    </div>

                                    <div class="mt-4 lg:mt-0 lg:text-right">
                                        <div class="text-2xl font-bold text-green-600 mb-2">
                                            Rp <?php echo number_format($transaksi['total_bayar'], 0, ',', '.'); ?>
                                        </div>
                                        <div class="text-sm text-neutral-500">
                                            ID Transaksi: #<?php echo $transaksi['id_transaksi']; ?>
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
</div>
