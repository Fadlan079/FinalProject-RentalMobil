<div class="p-5 m-5 text-center">
    <h1 class="text-2xl font-semibold text-orange-500">Koleksi Mobil Kami</h1> 
    <p class="text-sm text-neutral-400">
        Temukan berbagai mobil yang tersedia untuk disewa. Pilih mobil favoritmu dan pesan sekarang!
    </p>
</div>

<form action="index.php" method="GET" class="max-w-6xl mx-auto flex flex-col lg:flex-row justify-between items-stretch lg:gap-3">
    <input type="hidden" name="page" value="1">
    <div class="hidden lg:flex justify-between items-center bg-neutral-800 text-orange-50 p-2 rounded-xl shadow-md m-auto text-sm">
        <div class="flex gap-4 items-center">
        
        <select name="harga" class="bg-neutral-800 p-1 rounded-lg focus:ring-2 focus:ring-orange-500 <?= $harga != 'semua' ? 'border-2 border-orange-500 bg-neutral-700' : '' ?>">
            <option value="semua" <?= $harga == 'semua' ? 'selected' : '' ?>>Harga (Semua)</option>
            <option value="lt1jt" <?= $harga == 'lt1jt' ? 'selected' : '' ?>>Kurang dari 1 juta</option>
            <option value="lt5jt" <?= $harga == 'lt5jt' ? 'selected' : '' ?>>Kurang dari 5 juta</option>
        </select>

        <select name="transmisi" class="bg-neutral-800 p-1 rounded-lg focus:ring-2 focus:ring-orange-500 <?= $transmisi != 'semua' ? 'border-2 border-orange-500 bg-neutral-700' : '' ?>">
            <option value="semua" <?= $transmisi == 'semua' ? 'selected' : '' ?>>Transmisi (Semua)</option>
            <option value="automatic" <?= $transmisi == 'automatic' ? 'selected' : '' ?>>Automatic</option>
            <option value="manual" <?= $transmisi == 'manual' ? 'selected' : '' ?>>Manual</option>
        </select>

        <select name="bhn_bkr" class="bg-neutral-800 p-1 rounded-lg focus:ring-2 focus:ring-orange-500 <?= $bhn_bkr != 'semua' ? 'border-2 border-orange-500 bg-neutral-700' : '' ?>">
            <option value="semua" <?= $bhn_bkr == 'semua' ? 'selected' : '' ?>>Bahan Bakar (Semua)</option>
            <option value="listrik" <?= $bhn_bkr == 'listrik' ? 'selected' : '' ?>>Listrik</option>
            <option value="bensin" <?= $bhn_bkr == 'bensin' ? 'selected' : '' ?>>Bensin</option>
        </select>

        <select name="kursi" class="bg-neutral-800 p-1 rounded-lg focus:ring-2 focus:ring-orange-500 <?= $kursi != 'semua' ? 'border-2 border-orange-500 bg-neutral-700' : '' ?>">
            <option value="semua" <?= $kursi == 'semua' ? 'selected' : '' ?>>Kapasitas (Semua)</option>
            <option value="2" <?= $kursi == '2' ? 'selected' : '' ?>>2 Orang</option>
            <option value="4-5" <?= $kursi == '4-5' ? 'selected' : '' ?>>4-5 Orang</option>
            <option value="6-8" <?= $kursi == '6-8' ? 'selected' : '' ?>>6-8 Orang</option>
        </select>

        </div>
        <button type="submit" class="bg-orange-500 p-1 mx-2 rounded-lg font-semibold hover:bg-orange-600 transition-all duration-300">
        Terapkan
        </button>
    </div>
    
    <!-- Search input dengan styling aktif -->
    <div class=" flex w-full lg:max-w-xl lg:m-auto m-2">
        <input type="text" name="q" placeholder="Cari Mobil" value="<?= htmlspecialchars($query) ?>"
        class="bg-neutral-800 px-4 py-2 rounded-l-xl text-orange-50 focus:outline-none focus:ring-2 focus:ring-orange-500 w-full <?= !empty($query) ? 'border-2 border-orange-500 bg-neutral-700' : '' ?>">
        <button type="submit" class="bg-orange-500 rounded-r-xl px-4 py-2"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <button id="typebtn" type="button" class="lg:hidden bg-orange-500 text-orange-50 font-semibold text-center rounded-xl shadow-lg p-2 m-2 w-full">
        <i class="fa-solid fa-sliders"></i> Types
    </button>



      <div id="typebar" class="fixed z-200 left-0 top-0 w-full p-8 space-y-6 bg-neutral-900 h-full overflow-y-auto scrollbar-hide transform -translate-x-full transition-all duration-300">
        <div class="flex justify-between items-center">
        <div class="text-neutral-100">
            <h2 class="font-semibold tracking-wide"><i class="fa-solid fa-filter text-orange-500"></i> Filter Mobil Sesuai kebutuhanmu</h2>
        </div>
        <button id="closetypebar" class="text-gray-500">
            <i class="fa-solid fa-xmark"></i>
        </button>
        </div>
        <div class="text-orange-50 flex flex-col gap-5 mt-5 mb-10">
        <div class="flex flex-col gap-3">
            <label for="" class="text-emerald-500 font-semibold"><i class="fa-solid fa-wallet"></i> Harga/Hari</label>
            <hr class="border-2 border-emerald-500 rounded-full w-full">
            <label for="">
            <input type="radio" name="harga" value="semua" <?= $harga == 'semua' ? 'selected' : '' ?>>
            Semua
            </label>
            <label for="">
            <input type="radio" name="harga" value="lt1jt" <?= $harga == 'lt1jt' ? 'selected' : '' ?>>
            Kurang dari 1000000
            </label>
            <label for="">
            <input type="radio" name="harga" value="lt5jt" <?= $harga == 'lt5jt' ? 'selected' : '' ?>>
            Kurang dari 5000000
            </label>
        </div>
        <div class="flex flex-col gap-3">
            <label for="" class="text-amber-500 font-semibold"><i class="fa-solid fa-tachometer-alt"></i> Transmisi</label>
            <hr class="border-2 border-amber-500 rounded-full w-full">
            <label for="">
            <input type="radio" name="transmisi" value="semua" <?= $transmisi == 'semua' ? 'selected' : '' ?>>
            Semua
            </label>
            <label for="">
            <input type="radio" name="transmisi" value="automatic" <?= $transmisi == 'automatic' ? 'selected' : '' ?>>
            Automatic
            </label>
            <label for="">
            <input type="radio" name="transmisi" value="manual" <?= $transmisi == 'manual' ? 'selected' : '' ?>>
            Manual
            </label>
        </div>
        <div class="flex flex-col gap-3">
            <label for="" class="text-sky-500 font-semibold"><i class="fas fa-gas-pump"></i> Bahan Bakar</label>
            <hr class="border-2 border-sky-500 rounded-full w-full">
            <label for="">
            <input type="radio" name="bhn_bkr" value="semua" <?= $bhn_bkr == 'semua' ? 'selected' : '' ?>>
            Semua
            </label>
            <label for="">
            <input type="radio" name="bhn_bkr" value="listrik" <?= $bhn_bkr == 'listrik' ? 'selected' : '' ?>>
            Listrik
            </label>
            <label for="">
            <input type="radio" name="bhn_bkr" value="bensin" <?= $bhn_bkr == 'bensin' ? 'selected' : '' ?>>
            Bensin
            </label>
        </div>
        <div class="flex flex-col gap-3">
            <label for="" class="text-rose-500 font-semibold"><i class="fa-solid fa-user-group"></i> Kapasitas</label>
            <hr class="border-2 border-rose-500 rounded-full w-full">
            <label for="">
            <input type="radio" name="kursi" value="semua" <?= $kursi == 'semua' ? 'selected' : '' ?>>
            Semua
            </label>
            <label for="">
            <input type="radio" name="kursi" value="2" <?= $kursi == '2' ? 'selected' : '' ?>>
            2 Orang
            </label>
            <label for="">
            <input type="radio" name="kursi" value="4-5" <?= $kursi == '' ? 'selected' : '' ?>>
            4-5 Orang
            </label>
            <label for="">
            <input type="radio" name="kursi" value="6-8">
            6-8 Orang
            </label>              
        </div>
        <button type="submit" class="p-2 bg-orange-500 rounded-xl font-semibold tracking-wide">Terapkan</button>
        </div>
    </div>
        
        <!-- Lanjutkan untuk bahan bakar dan kursi dengan pola yang sama -->
        
        <button type="submit" class="p-2 bg-orange-500 rounded-xl font-semibold tracking-wide hover:bg-orange-600 transition-all duration-300">
            Terapkan
        </button>
    </div>
</div>
</form>

<div class="grid grid-cols-1 lg:grid-cols-3 lg:grid-rows-3 gap-6 lg:p-5 m-4 p-3 lg:max-w-6xl lg:m-auto">
    <?php if(!empty($data)):?>
        <?php foreach($data as $row):?>
        <?php
            $imgPath = 'uploads/' . (!empty($row['img']) && file_exists(__DIR__ . '/../../../../Public/uploads/' . $row['img'])? $row['img'] : 'default.svg');
            ?>
        <div class="bg-neutral-800 border-t-4 border-orange-500 text-neutral-300 shadow-xl group relative tracking-wide">
            <div class="absolute -inset-4 opacity-0 group-hover:opacity-50 border-17 rounded-xl scale-95 group-hover:scale-100 border-orange-500 pointer-events-none transition-all duration-500 z-0"></div>
            <div class="z-10 relative">
            <img src="<?= $imgPath?>" alt="foto mobil"
            class="h-40 w-full object-cover">
            <div class="p-2 m-2 grid grid-cols-3 gap-2 text-xs">
                <div class="flex col-span-3 gap-3 font-semibold">
                <h2><?= htmlspecialchars(ucfirst($row['merk']))?></h2>
                <h2><?= htmlspecialchars(ucfirst($row['tipe']))?></h2>
                <h2><?= htmlspecialchars(ucfirst($row['model']))?></h2>
                </div>
                <h2><i class="fa-solid fa-droplet"></i> <?= htmlspecialchars(ucfirst($row['warna']))?></h2>
                <h2><i class="fa-solid fa-id-card"></i> <?= htmlspecialchars(strtoupper($row['noplat']))?></h2>
                <?php
                $icon = $row['transmisi'] == 'automatic' ? '<i class="fa-solid fa-tachometer-alt"></i>' : '<i class="fa-solid fa-gear"></i>';
                ?>
                <h2><?= $icon ?> <?= htmlspecialchars(ucfirst($row['transmisi']))?></h2>
                <span><i class="fa-solid fa-user-group"></i> <?= htmlspecialchars($row['kursi'])?> Seats</span>
                <span><i class="fa-solid fa-door-open"></i> <?= htmlspecialchars($row['pintu'])?> Doors</span>
                <span><i class="fa-solid fa-gas-pump"></i> <?= htmlspecialchars(ucfirst($row['bhn_bkr']))?></span>

                <div class="absolute top-2 right-2 px-2 py-1 text-xs rounded-full 
                <?= $row['status'] == 'ready' ? 'bg-emerald-500 text-emerald-50' : ($row['status']=='rent' ? 'bg-red-500 text-red-50' : 'bg-yellow-500 text-yellow-50') ?>">
                <?= htmlspecialchars(ucfirst($row['status'])) ?>
                </div>
                <h2 class="col-span-3 bg-orange-500/20 text-orange-500 p-2 rounded-xl shadow-lg font-semibold text-center">
                Rp <?= number_format($row['harga'], 0, ',', '.') ?>/hari
                </h2> 
                <button id="btnSewa" 
                        data-id="<?= $detail['id_mobil']; ?>"
                        data-nama="<?= htmlspecialchars($detail['merk'] . ' ' . $detail['model']); ?>"
                        data-harga="<?= $detail['harga_perhari']; ?>"
                        data-pelanggan="<?= $profile['id_pelanggan'] ?? ''; ?>"
                        class="col-span-3 p-2 bg-orange-500 rounded-xl shadow-lg font-semibold text-orange-50 text-center hover:bg-orange-600 transition-all duration-300">
                Sewa Sekarang
                </button>

            </div>
            </div>
        </div>
        <?php endforeach?>
    <?php else:?>
        <div class="col-span-3 text-center py-10 flex flex-col items-center justify-center gap-4">
            <i class="fa-solid fa-car text-7xl opacity-50 text-neutral--500"></i>
            <h2 class="text-2xl font-semibold text-neutral-700">Oops! Daftar mobil kosong</h2>
            <p class="text-neutral-500">Belum ada mobil yang tersedia saat ini. Silahkan cek lagi nanti.</p>
            <a href="index.php" class="mt-2 px-4 py-2 bg-orange-500 text-white rounded-xl hover:bg-orange-600 shadow-lg">Refresh</a>
        </div>
    <?php endif?> 
    </div>     
    <?php
    $q = isset($_GET['q']) ? trim($_GET['q']) : '';
    $harga = isset($_GET['harga']) ? trim($_GET['harga']) : '';
    $transmisi = isset($_GET['transmisi']) ? trim($_GET['transmisi']) : '';
    $bahan_bkr = isset($_GET['bahan_bkr']) ? trim($_GET['bahan_bkr']) : '';
    $kapasitas = isset($_GET['kapasitas']) ? trim($_GET['kapasitas']) : '';
    ?>

    <div class="flex justify-center mt-5 gap-2">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <?php
            $query = http_build_query([
                'page' => $i,
                'q' => $q,
                'harga' => $harga,
                'transmisi' => $transmisi,
                'bahan_bkr' => $bahan_bkr,
                'kapasitas' => $kapasitas
            ]);
        ?>
        <a href="?<?= $query ?>#daftar-mobil"
            class="px-3 py-1 rounded-lg <?= $i == $page ? 'bg-orange-500 text-white' : 'bg-neutral-800 text-neutral-300' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>
</div>
<?php include __DIR__ . "/detail-mobil.php" ?>