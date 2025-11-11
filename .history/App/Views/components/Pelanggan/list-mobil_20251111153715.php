<?php
// File: Views/Pelanggan/index.php
?>
<div class="p-5 m-5 text-center">
    <h1 class="text-2xl font-semibold text-orange-500">Koleksi Mobil Kami</h1> 
    <p class="text-sm text-neutral-400">
        Temukan berbagai mobil yang tersedia untuk disewa. Pilih mobil favoritmu dan pesan sekarang!
    </p>
</div>

<form action="index.php" method="GET" class="max-w-6xl mx-auto flex flex-col lg:flex-row justify-between items-stretch lg:gap-3">
    <input type="hidden" name="action" value="index">
    <input type="hidden" name="page" value="1">
    
    <div class="hidden lg:flex justify-between items-center bg-neutral-800 text-orange-50 p-2 rounded-xl shadow-md m-auto text-sm">
        <div class="flex gap-4 items-center">
            <select name="harga" class="bg-neutral-800 p-1 rounded-lg focus:ring-2 focus:ring-orange-500" onchange="this.form.submit()">
                <option value="semua" <?= ($_GET['harga'] ?? '') == 'semua' ? 'selected' : '' ?>>Harga (Semua)</option>
                <option value="lt1jt" <?= ($_GET['harga'] ?? '') == 'lt1jt' ? 'selected' : '' ?>>Kurang dari 1 juta</option>
                <option value="lt5jt" <?= ($_GET['harga'] ?? '') == 'lt5jt' ? 'selected' : '' ?>>Kurang dari 5 juta</option>
                <option value="gt5jt" <?= ($_GET['harga'] ?? '') == 'gt5jt' ? 'selected' : '' ?>>Lebih dari 5 juta</option>
            </select>

            <select name="transmisi" class="bg-neutral-800 p-1 rounded-lg focus:ring-2 focus:ring-orange-500" onchange="this.form.submit()">
                <option value="semua" <?= ($_GET['transmisi'] ?? '') == 'semua' ? 'selected' : '' ?>>Transmisi (Semua)</option>
                <option value="automatic" <?= ($_GET['transmisi'] ?? '') == 'automatic' ? 'selected' : '' ?>>Automatic</option>
                <option value="manual" <?= ($_GET['transmisi'] ?? '') == 'manual' ? 'selected' : '' ?>>Manual</option>
            </select>

            <select name="bhn_bkr" class="bg-neutral-800 p-1 rounded-lg focus:ring-2 focus:ring-orange-500" onchange="this.form.submit()">
                <option value="semua" <?= ($_GET['bhn_bkr'] ?? '') == 'semua' ? 'selected' : '' ?>>Bahan Bakar (Semua)</option>
                <option value="listrik" <?= ($_GET['bhn_bkr'] ?? '') == 'listrik' ? 'selected' : '' ?>>Listrik</option>
                <option value="bensin" <?= ($_GET['bhn_bkr'] ?? '') == 'bensin' ? 'selected' : '' ?>>Bensin</option>
            </select>

            <select name="kursi" class="bg-neutral-800 p-1 rounded-lg focus:ring-2 focus:ring-orange-500" onchange="this.form.submit()">
                <option value="semua" <?= ($_GET['kursi'] ?? '') == 'semua' ? 'selected' : '' ?>>Kapasitas (Semua)</option>
                <option value="2" <?= ($_GET['kursi'] ?? '') == '2' ? 'selected' : '' ?>>2 Orang</option>
                <option value="4-5" <?= ($_GET['kursi'] ?? '') == '4-5' ? 'selected' : '' ?>>4-5 Orang</option>
                <option value="6-8" <?= ($_GET['kursi'] ?? '') == '6-8' ? 'selected' : '' ?>>6-8 Orang</option>
            </select>
        </div>
        <button type="submit" class="bg-orange-500 p-1 mx-2 rounded-lg font-semibold hover:bg-orange-600 transition-all duration-300">
            Terapkan
        </button>
    </div>
    
    <div class="flex w-full lg:max-w-xl lg:m-auto m-2">
        <input type="text" name="q" placeholder="Cari Mobil" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>"
            class="bg-neutral-800 px-4 py-2 rounded-l-xl text-orange-50 focus:outline-none focus:ring-2 focus:ring-orange-500 w-full">
        <button type="submit" class="bg-orange-500 rounded-r-xl px-4 py-2">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </div>
    
    <button id="typebtn" type="button" class="lg:hidden bg-orange-500 text-orange-50 font-semibold text-center rounded-xl shadow-lg p-2 m-2 w-full">
        <i class="fa-solid fa-sliders"></i> Types
    </button>

    <!-- Mobile Filter Menu -->
    <div id="typebar" class="fixed z-50 left-0 top-0 w-full p-8 space-y-6 bg-neutral-900 h-full overflow-y-auto transform -translate-x-full transition-all duration-300">
        <div class="flex justify-between items-center">
            <div class="text-neutral-100">
                <h2 class="font-semibold tracking-wide"><i class="fa-solid fa-filter text-orange-500"></i> Filter Mobil Sesuai kebutuhanmu</h2>
            </div>
            <button id="closetypebar" class="text-gray-500 text-2xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="text-orange-50 flex flex-col gap-5 mt-5 mb-10">
            <!-- Harga Filter -->
            <div class="flex flex-col gap-3">
                <label class="text-emerald-500 font-semibold"><i class="fa-solid fa-wallet"></i> Harga/Hari</label>
                <hr class="border-2 border-emerald-500 rounded-full w-full">
                <?php $currentHarga = $_GET['harga'] ?? 'semua'; ?>
                <label>
                    <input type="radio" name="harga" value="semua" <?= $currentHarga == 'semua' ? 'checked' : '' ?> onchange="this.form.submit()"> Semua
                </label>
                <label>
                    <input type="radio" name="harga" value="lt1jt" <?= $currentHarga == 'lt1jt' ? 'checked' : '' ?> onchange="this.form.submit()"> Kurang dari 1jt
                </label>
                <label>
                    <input type="radio" name="harga" value="lt5jt" <?= $currentHarga == 'lt5jt' ? 'checked' : '' ?> onchange="this.form.submit()"> Kurang dari 5jt
                </label>
                <label>
                    <input type="radio" name="harga" value="gt5jt" <?= $currentHarga == 'gt5jt' ? 'checked' : '' ?> onchange="this.form.submit()"> Lebih dari 5jt
                </label>
            </div>

            <!-- Transmisi Filter -->
            <div class="flex flex-col gap-3">
                <label class="text-amber-500 font-semibold"><i class="fa-solid fa-tachometer-alt"></i> Transmisi</label>
                <hr class="border-2 border-amber-500 rounded-full w-full">
                <?php $currentTransmisi = $_GET['transmisi'] ?? 'semua'; ?>
                <label>
                    <input type="radio" name="transmisi" value="semua" <?= $currentTransmisi == 'semua' ? 'checked' : '' ?> onchange="this.form.submit()"> Semua
                </label>
                <label>
                    <input type="radio" name="transmisi" value="automatic" <?= $currentTransmisi == 'automatic' ? 'checked' : '' ?> onchange="this.form.submit()"> Automatic
                </label>
                <label>
                    <input type="radio" name="transmisi" value="manual" <?= $currentTransmisi == 'manual' ? 'checked' : '' ?> onchange="this.form.submit()"> Manual
                </label>
            </div>

            <!-- Bahan Bakar Filter -->
            <div class="flex flex-col gap-3">
                <label class="text-sky-500 font-semibold"><i class="fas fa-gas-pump"></i> Bahan Bakar</label>
                <hr class="border-2 border-sky-500 rounded-full w-full">
                <?php $currentBhnBkr = $_GET['bhn_bkr'] ?? 'semua'; ?>
                <label>
                    <input type="radio" name="bhn_bkr" value="semua" <?= $currentBhnBkr == 'semua' ? 'checked' : '' ?> onchange="this.form.submit()"> Semua
                </label>
                <label>
                    <input type="radio" name="bhn_bkr" value="listrik" <?= $currentBhnBkr == 'listrik' ? 'checked' : '' ?> onchange="this.form.submit()"> Listrik
                </label>
                <label>
                    <input type="radio" name="bhn_bkr" value="bensin" <?= $currentBhnBkr == 'bensin' ? 'checked' : '' ?> onchange="this.form.submit()"> Bensin
                </label>
            </div>

            <!-- Kapasitas Filter -->
            <div class="flex flex-col gap-3">
                <label class="text-rose-500 font-semibold"><i class="fa-solid fa-user-group"></i> Kapasitas</label>
                <hr class="border-2 border-rose-500 rounded-full w-full">
                <?php $currentKursi = $_GET['kursi'] ?? 'semua'; ?>
                <label>
                    <input type="radio" name="kursi" value="semua" <?= $currentKursi == 'semua' ? 'checked' : '' ?> onchange="this.form.submit()"> Semua
                </label>
                <label>
                    <input type="radio" name="kursi" value="2" <?= $currentKursi == '2' ? 'checked' : '' ?> onchange="this.form.submit()"> 2 Orang
                </label>
                <label>
                    <input type="radio" name="kursi" value="4-5" <?= $currentKursi == '4-5' ? 'checked' : '' ?> onchange="this.form.submit()"> 4-5 Orang
                </label>
                <label>
                    <input type="radio" name="kursi" value="6-8" <?= $currentKursi == '6-8' ? 'checked' : '' ?> onchange="this.form.submit()"> 6-8 Orang
                </label>
            </div>
            
            <button type="submit" class="p-2 bg-orange-500 rounded-xl font-semibold tracking-wide">Terapkan</button>
        </div>
    </div>
</form>

<!-- Daftar Mobil -->
<div class="grid grid-cols-1 lg:grid-cols-3 lg:grid-rows-3 gap-6 lg:p-5 m-4 p-3 lg:max-w-6xl lg:m-auto" id="daftar-mobil">
    <?php if(!empty($data)): ?>
        <?php foreach($data as $row): ?>
        <?php
            $imgPath = 'uploads/' . (!empty($row['img']) && file_exists(__DIR__ . '/../../../../Public/uploads/' . $row['img']) ? $row['img'] : 'default.svg');
        ?>
        <div class="bg-neutral-800 border-t-4 border-orange-500 text-neutral-300 shadow-xl group relative tracking-wide">
            <div class="absolute -inset-4 opacity-0 group-hover:opacity-50 border-2 rounded-xl scale-95 group-hover:scale-100 border-orange-500 pointer-events-none transition-all duration-500 z-0"></div>
            <div class="z-10 relative">
                <img src="<?= $imgPath ?>" alt="foto mobil" class="h-40 w-full object-cover">
                <div class="p-2 m-2 grid grid-cols-3 gap-2 text-xs">
                    <div class="flex col-span-3 gap-3 font-semibold">
                        <h2><?= htmlspecialchars(ucfirst($row['merk'])) ?></h2>
                        <h2><?= htmlspecialchars(ucfirst($row['tipe'])) ?></h2>
                        <h2><?= htmlspecialchars(ucfirst($row['model'])) ?></h2>
                    </div>
                    <h2><i class="fa-solid fa-droplet"></i> <?= htmlspecialchars(ucfirst($row['warna'])) ?></h2>
                    <h2><i class="fa-solid fa-id-card"></i> <?= htmlspecialchars(strtoupper($row['noplat'])) ?></h2>
                    <?php
                    $icon = $row['transmisi'] == 'automatic' ? '<i class="fa-solid fa-tachometer-alt"></i>' : '<i class="fa-solid fa-gear"></i>';
                    ?>
                    <h2><?= $icon ?> <?= htmlspecialchars(ucfirst($row['transmisi'])) ?></h2>
                    <span><i class="fa-solid fa-user-group"></i> <?= htmlspecialchars($row['kursi']) ?> Seats</span>
                    <span><i class="fa-solid fa-door-open"></i> <?= htmlspecialchars($row['pintu']) ?> Doors</span>
                    <span><i class="fa-solid fa-gas-pump"></i> <?= htmlspecialchars(ucfirst($row['bhn_bkr'])) ?></span>

                    <div class="absolute top-2 right-2 px-2 py-1 text-xs rounded-full 
                        <?= $row['status'] == 'ready' ? 'bg-emerald-500 text-emerald-50' : ($row['status']=='rent' ? 'bg-red-500 text-red-50' : 'bg-yellow-500 text-yellow-50') ?>">
                        <?= htmlspecialchars(ucfirst($row['status'])) ?>
                    </div>
                    
                    <h2 class="col-span-3 bg-orange-500/20 text-orange-500 p-2 rounded-xl shadow-lg font-semibold text-center">
                        Rp <?= number_format($row['harga'], 0, ',', '.') ?>/hari
                    </h2> 

                    <a href="index.php?action=detail-mobil&id=<?= $row['id_mobil'] ?>"
                        class="sewa-btn col-span-3 p-2 bg-orange-500 rounded-xl shadow-lg font-semibold text-orange-50 text-center
                        hover:bg-orange-600 transition-all duration-300 block
                        <?= in_array($row['status'], ['rent', 'maintenance']) ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' ?>">
                        <?= in_array($row['status'], ['rent', 'maintenance']) ? 'Tidak Tersedia' : 'Sewa Sekarang' ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    <?php else: ?>
        <div class="col-span-3 text-center py-10 flex flex-col items-center justify-center gap-4">
            <i class="fa-solid fa-car text-7xl opacity-50 text-neutral-500"></i>
            <h2 class="text-2xl font-semibold text-neutral-700">Oops! Daftar mobil kosong</h2>
            <p class="text-neutral-500">Belum ada mobil yang tersedia saat ini. Silahkan cek lagi nanti.</p>
            <a href="index.php?action=index" class="mt-2 px-4 py-2 bg-orange-500 text-white rounded-xl hover:bg-orange-600 shadow-lg">Refresh</a>
        </div>
    <?php endif ?> 
</div>

<!-- Pagination -->
<?php if($totalPages > 1): ?>
<div class="flex justify-center mt-5 gap-2">
    <?php 
    $q = $_GET['q'] ?? '';
    $harga = $_GET['harga'] ?? '';
    $transmisi = $_GET['transmisi'] ?? '';
    $bhn_bkr = $_GET['bhn_bkr'] ?? '';
    $kursi = $_GET['kursi'] ?? '';
    
    for ($i = 1; $i <= $totalPages; $i++): 
        $queryParams = [
            'action' => 'index',
            'page' => $i,
            'q' => $q,
            'harga' => $harga,
            'transmisi' => $transmisi,
            'bhn_bkr' => $bhn_bkr,
            'kursi' => $kursi
        ];
        $queryString = http_build_query($queryParams);
    ?>
        <a href="?<?= $queryString ?>#daftar-mobil"
            class="px-3 py-1 rounded-lg <?= $i == $page ? 'bg-orange-500 text-white' : 'bg-neutral-800 text-neutral-300' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>
</div>
<?php endif; ?>

<!-- JavaScript untuk Mobile Filter -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeBtn = document.getElementById('typebtn');
    const typeBar = document.getElementById('typebar');
    const closeTypeBar = document.getElementById('closetypebar');

    if (typeBtn && typeBar && closeTypeBar) {
        typeBtn.addEventListener('click', function() {
            typeBar.classList.remove('-translate-x-full');
        });

        closeTypeBar.addEventListener('click', function() {
            typeBar.classList.add('-translate-x-full');
        });
    }

    // Handle sewa button clicks - now links, so no need for JS
});
</script>

<?php 
// Include modal detail mobil jika ada
if (file_exists(__DIR__ . '/detail-mobil.php')) {
    include __DIR__ . '/detail-mobil.php';
}
?>