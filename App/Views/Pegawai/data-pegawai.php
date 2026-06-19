<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$pageTitle  = 'Data Pegawai';
$activePage = 'data-pegawai';

ob_start(); ?>

<?php $flash = $_SESSION['success'] ?? null; unset($_SESSION['success']); ?>
<?php if ($flash): ?>
<div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl flex items-center gap-2">
    <i class="fa-solid fa-check-circle"></i> <?= htmlspecialchars($flash) ?>
</div>
<?php endif; ?>

<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
    <div>
        <h3 class="text-xl font-bold text-neutral-800">Daftar Pegawai</h3>
        <p class="text-sm text-neutral-500"><?= count($data_pegawai ?? []) ?> pegawai terdaftar</p>
    </div>
    <button id="openAddModal"
       class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition-all shadow">
        <i class="fa-solid fa-user-plus"></i> Tambah Pegawai
    </button>
</div>

<!-- Table -->
<div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-neutral-200">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-neutral-50 border-b border-neutral-200">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase">Pegawai</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase">Jabatan</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase">Kontak</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase">Alamat</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-neutral-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-100">
                <?php if (!empty($data_pegawai)): ?>
                    <?php foreach ($data_pegawai as $p): ?>
                    <tr class="hover:bg-orange-50/40 transition-colors">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-sm">
                                    <?php if (!empty($p['pp'])): ?>
                                        <img src="Public/uploads/<?= htmlspecialchars($p['pp']) ?>" class="w-10 h-10 rounded-full object-cover" alt="">
                                    <?php else: ?>
                                        <?= strtoupper(substr($p['nama'] ?? 'P', 0, 1)) ?>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <p class="font-semibold text-neutral-800"><?= htmlspecialchars($p['nama'] ?? '-') ?></p>
                                    <p class="text-xs text-neutral-400"><?= htmlspecialchars($p['email'] ?? '') ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <?php $jabatan = ucfirst($p['jabatan'] ?? '-'); ?>
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold <?= ($jabatan === 'Admin') ? 'bg-purple-100 text-purple-700' : 'bg-sky-100 text-sky-700' ?>">
                                <?= htmlspecialchars($jabatan) ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-neutral-600"><?= htmlspecialchars($p['telp'] ?? '-') ?></td>
                        <td class="px-4 py-3 text-neutral-600 max-w-xs truncate"><?= htmlspecialchars(($p['kec'] ?? '') . ', ' . ($p['kota'] ?? '-')) ?></td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="index.php?action=edit-pegawai&id=<?= $p['id_pegawai'] ?>"
                                   class="p-1.5 bg-blue-100 text-blue-600 hover:bg-blue-200 rounded-lg transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <a href="index.php?action=delete-pegawai&id=<?= $p['id_pegawai'] ?>"
                                   onclick="return confirm('Hapus pegawai ini?')"
                                   class="p-1.5 bg-red-100 text-red-600 hover:bg-red-200 rounded-lg transition" title="Hapus">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center text-neutral-400">
                            <i class="fa-solid fa-users text-4xl mb-3 block text-neutral-300"></i>
                            Belum ada data pegawai
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Pegawai Modal -->
<div id="addModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 p-6">
        <div class="flex justify-between items-center mb-5">
            <h4 class="text-lg font-bold text-neutral-800">Tambah Pegawai Baru</h4>
            <button id="closeAddModal" class="text-neutral-400 hover:text-neutral-700"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>
        <form action="index.php?action=store-pegawai" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-neutral-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" required placeholder="Nama pegawai"
                       class="w-full px-4 py-2.5 border border-neutral-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-neutral-700 mb-1">Email</label>
                <input type="email" name="email" required placeholder="email@example.com"
                       class="w-full px-4 py-2.5 border border-neutral-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-neutral-700 mb-1">Password</label>
                <input type="password" name="password" required placeholder="Minimal 6 karakter"
                       class="w-full px-4 py-2.5 border border-neutral-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-1">Jenis Kelamin</label>
                    <select name="jk" class="w-full px-4 py-2.5 border border-neutral-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-1">Jabatan</label>
                    <select name="jabatan" class="w-full px-4 py-2.5 border border-neutral-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                        <option value="admin">Admin</option>
                        <option value="customer service">Customer Service</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" id="cancelAddModal" class="flex-1 px-4 py-2.5 border border-neutral-300 rounded-xl text-sm text-neutral-600 hover:bg-neutral-50 transition">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2.5 bg-orange-500 hover:bg-orange-600 text-white rounded-xl text-sm font-semibold transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('addModal');
    document.getElementById('openAddModal')?.addEventListener('click', () => modal.classList.remove('hidden'));
    document.getElementById('closeAddModal')?.addEventListener('click', () => modal.classList.add('hidden'));
    document.getElementById('cancelAddModal')?.addEventListener('click', () => modal.classList.add('hidden'));
    modal?.addEventListener('click', (e) => { if (e.target === modal) modal.classList.add('hidden'); });
</script>

<?php
$pageContent = ob_get_clean();
include __DIR__ . '/layout.php';
?>
