<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mobil</title>
    <link rel="stylesheet" href="output.css">
</head>
<body>
    <div class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-xl mt-10">
    <!-- Bagian 1: Foto dan Identitas -->
    <div class="flex flex-col md:flex-row gap-6">
        <div class="flex-shrink-0">
            <img src="uploads/<?= htmlspecialchars($detail['img']) ?>" 
                 alt="Foto Mobil" 
                 class="w-80 h-56 object-cover rounded-lg border">
        </div>

        <div class="flex-1">
            <h2 class="text-3xl font-semibold mb-3"><?= htmlspecialchars($detail['merk']) ?> <?= htmlspecialchars($detail['tipe']) ?></h2>
            <p><strong>Model:</strong> <?= htmlspecialchars($detail['model']) ?></p>
            <p><strong>Tahun:</strong> <?= htmlspecialchars($detail['tahun']) ?></p>
            <p><strong>Warna:</strong> <?= htmlspecialchars($detail['warna']) ?></p>
            <p><strong>Status:</strong> 
                <span class="px-2 py-1 rounded text-white 
                    <?= $detail['status'] == 'ready' ? 'bg-green-500' : ($detail['status'] == 'rebut' ? 'bg-red-500' : 'bg-gray-400') ?>">
                    <?= htmlspecialchars($detail['status']) ?>
                </span>
            </p>
            <p class="text-xl mt-3 font-bold text-orange-600">Rp<?= number_format($detail['harga'], 0, ',', '.') ?> / hari</p>
        </div>
    </div>

    <!-- Garis pemisah -->
    <hr class="my-6 border-gray-300">

    <!-- Bagian 2: Spesifikasi Teknis -->
    <div>
        <h3 class="text-xl font-semibold mb-4">Spesifikasi Teknis</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
            <p><strong>No. Plat:</strong> <?= htmlspecialchars($detail['noplat']) ?></p>
            <p><strong>No. Mesin:</strong> <?= htmlspecialchars($detail['nomesin']) ?></p>
            <p><strong>No. Rangka:</strong> <?= htmlspecialchars($detail['norangka']) ?></p>
            <p><strong>Silinder:</strong> <?= htmlspecialchars($detail['silinder']) ?> cc</p>
            <p><strong>Bahan Bakar:</strong> <?= htmlspecialchars($detail['bhn_bkr']) ?></p>
            <p><strong>Transmisi:</strong> <?= htmlspecialchars($detail['transmisi']) ?></p>
            <p><strong>Pintu:</strong> <?= htmlspecialchars($detail['pintu']) ?></p>
            <p><strong>Kursi:</strong> <?= htmlspecialchars($detail['kursi']) ?></p>
        </div>
    </div>

    <!-- Garis pemisah -->
    <hr class="my-6 border-gray-300">

    <!-- Bagian 3: Form Sewa -->
    <div>
        <h3 class="text-xl font-semibold mb-4">Form Sewa</h3>
        <?php if ($detail['status'] == 'ready'): ?>
            <form action="index.php?action=sewaMobil" method="POST" class="space-y-4">
                <input type="hidden" name="id_mobil" value="<?= $detail['id_mobil'] ?>">
                <label class="block">
                    <span class="text-gray-700">Tanggal Sewa</span>
                    <input type="date" name="tgl_sewa" class="border rounded px-3 py-2 w-full" required>
                </label>
                <label class="block">
                    <span class="text-gray-700">Tanggal Kembali</span>
                    <input type="date" name="tgl_kembali" class="border rounded px-3 py-2 w-full" required>
                </label>
                <button type="submit" 
                        class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition">
                        Sewa Sekarang
                </button>
            </form>
        <?php else: ?>
            <div class="text-red-500 font-semibold">Mobil ini tidak tersedia untuk disewa saat ini.</div>
        <?php endif; ?>
    </div>

    <div class="mt-6">
        <a href="index.php?action=index" 
           class="inline-block bg-gray-300 text-black px-4 py-2 rounded-lg hover:bg-gray-400">
           Kembali ke Daftar Mobil
        </a>
    </div>
</div>

</body>
</html>