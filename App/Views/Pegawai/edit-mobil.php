<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$pageTitle  = 'Edit Mobil';
$activePage = 'data-mobil';
$tipes      = $tipes ?? [];
$mobil      = $mobil ?? [];

ob_start(); 
?>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-sm border border-neutral-200 mt-5">
    <div class="flex items-center gap-3 mb-6">
        <a href="index.php?action=data-mobil" class="text-neutral-400 hover:text-orange-500 transition"><i class="fa-solid fa-arrow-left text-xl"></i></a>
        <h3 class="text-xl font-bold text-neutral-800">Edit Data Mobil</h3>
    </div>

    <form action="index.php?action=update-mobil" method="POST" class="space-y-4">
        <input type="hidden" name="id_mobil" value="<?= htmlspecialchars($mobil['id_mobil'] ?? '') ?>">
        
        <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1">Tipe Mobil</label>
            <select name="id_tipe" required class="w-full px-4 py-2.5 border border-neutral-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                <?php foreach($tipes as $t): ?>
                    <option value="<?= $t['id_tipe'] ?>" <?= ($t['id_tipe'] == ($mobil['id_tipe'] ?? '')) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($t['merk'] . ' ' . $t['model'] . ' ' . $t['tipe']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-neutral-700 mb-1">Tahun</label>
                <input type="number" name="tahun" value="<?= htmlspecialchars($mobil['tahun'] ?? '') ?>" required min="1900" max="2100"
                       class="w-full px-4 py-2.5 border border-neutral-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-neutral-700 mb-1">Warna</label>
                <input type="text" name="warna" value="<?= htmlspecialchars($mobil['warna'] ?? '') ?>" required
                       class="w-full px-4 py-2.5 border border-neutral-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-neutral-700 mb-1">No. Plat</label>
                <input type="text" name="noplat" value="<?= htmlspecialchars($mobil['noplat'] ?? '') ?>" required
                       class="w-full px-4 py-2.5 border border-neutral-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-neutral-700 mb-1">No. Mesin</label>
                <input type="text" name="nomesin" value="<?= htmlspecialchars($mobil['nomesin'] ?? '') ?>" required
                       class="w-full px-4 py-2.5 border border-neutral-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-neutral-700 mb-1">No. Rangka</label>
                <input type="text" name="norangka" value="<?= htmlspecialchars($mobil['norangka'] ?? '') ?>" required
                       class="w-full px-4 py-2.5 border border-neutral-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1">Status</label>
            <select name="status" required class="w-full px-4 py-2.5 border border-neutral-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                <option value="ready" <?= (($mobil['status'] ?? '') === 'ready') ? 'selected' : '' ?>>Ready</option>
                <option value="rent" <?= (($mobil['status'] ?? '') === 'rent') ? 'selected' : '' ?>>Rent</option>
                <option value="maintenance" <?= (($mobil['status'] ?? '') === 'maintenance') ? 'selected' : '' ?>>Maintenance</option>
            </select>
        </div>

        <div class="pt-4 flex gap-3">
            <a href="index.php?action=data-mobil" class="flex-1 text-center px-4 py-2.5 border border-neutral-300 rounded-xl text-sm font-semibold text-neutral-600 hover:bg-neutral-50 transition">Batal</a>
            <button type="submit" class="flex-1 px-4 py-2.5 bg-orange-500 hover:bg-orange-600 text-white rounded-xl text-sm font-semibold transition">Simpan Perubahan</button>
        </div>
    </form>
</div>

<?php
$pageContent = ob_get_clean();
include __DIR__ . '/layout.php';
?>
