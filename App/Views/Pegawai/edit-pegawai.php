<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$pageTitle  = 'Edit Pegawai';
$activePage = 'data-pegawai';
$detail     = $detail ?? [];

ob_start(); 
?>

<div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-sm border border-neutral-200 mt-5">
    <div class="flex items-center gap-3 mb-6">
        <a href="index.php?action=data-pegawai" class="text-neutral-400 hover:text-orange-500 transition"><i class="fa-solid fa-arrow-left text-xl"></i></a>
        <h3 class="text-xl font-bold text-neutral-800">Edit Data Pegawai</h3>
    </div>

    <form action="index.php?action=update-pegawai" method="POST" class="space-y-4">
        <input type="hidden" name="id_pegawai" value="<?= htmlspecialchars($detail['id_pegawai'] ?? '') ?>">
        <input type="hidden" name="id_user" value="<?= htmlspecialchars($detail['id_user'] ?? '') ?>">
        
        <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1">Email (Readonly)</label>
            <input type="email" value="<?= htmlspecialchars($detail['email'] ?? '') ?>" disabled
                   class="w-full px-4 py-2.5 border border-neutral-300 rounded-xl text-sm bg-neutral-100 text-neutral-500 cursor-not-allowed">
            <p class="text-[10px] text-neutral-400 mt-1">Email terkait akun pengguna tidak dapat diubah di sini.</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1">Nama Lengkap</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($detail['nama'] ?? '') ?>" required
                   class="w-full px-4 py-2.5 border border-neutral-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
        </div>

        <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1">Nomor Telepon</label>
            <input type="text" name="telp" value="<?= htmlspecialchars($detail['telp'] ?? '') ?>"
                   class="w-full px-4 py-2.5 border border-neutral-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
        </div>

        <div>
            <label class="block text-sm font-medium text-neutral-700 mb-1">Jabatan / Role</label>
            <input type="text" value="<?= htmlspecialchars(ucfirst($detail['jabatan'] ?? '')) ?>" disabled
                   class="w-full px-4 py-2.5 border border-neutral-300 rounded-xl text-sm bg-neutral-100 text-neutral-500 cursor-not-allowed">
            <p class="text-[10px] text-neutral-400 mt-1">Jabatan saat ini hanya bisa diubah oleh Super Admin.</p>
        </div>

        <div class="pt-4 flex gap-3">
            <a href="index.php?action=data-pegawai" class="flex-1 text-center px-4 py-2.5 border border-neutral-300 rounded-xl text-sm font-semibold text-neutral-600 hover:bg-neutral-50 transition">Batal</a>
            <button type="submit" class="flex-1 px-4 py-2.5 bg-orange-500 hover:bg-orange-600 text-white rounded-xl text-sm font-semibold transition">Simpan Perubahan</button>
        </div>
    </form>
</div>

<?php
$pageContent = ob_get_clean();
include __DIR__ . '/layout.php';
?>
