<?php
$data = $data ?? [];
$page = $page ?? 1;
$totalPages = $totalPages ?? 1;
?>
<div class="grid grid-cols-1 lg:grid-cols-3 lg:grid-rows-3 gap-6 lg:p-5 m-4 p-3 lg:max-w-6xl lg:m-auto">
    <?php if(!empty($data)):?>
        <?php foreach($data as $row):?>
        <?php
            $uploadDir = __DIR__ . '/../../../../Public/uploads/';
            $imgFile = (!empty($row['img']) && file_exists($uploadDir . $row['img'])) ? $row['img'] : 'default.svg';
            $imgPath = 'Public/uploads/' . $imgFile;
            ?>
        <div class="bg-neutral-800 border-t-4 border-orange-500 text-neutral-300 shadow-xl group relative tracking-wide">
            <div class="absolute -inset-4 opacity-0 group-hover:opacity-50 border-17 rounded-xl scale-95 group-hover:scale-100 border-orange-500 pointer-events-none transition-all duration-500 z-0"></div>
            <div class="z-10 relative">
            <img src="<?= $imgPath?>" alt="foto mobil"
            class="h-40 w-full object-cover">
            <div class="p-3 m-2 grid grid-cols-3 gap-2 text-xs sm:text-sm">
                <div class="col-span-3 font-semibold text-base mb-1 truncate">
                    <?= htmlspecialchars(ucfirst($row['merk']))?> <?= htmlspecialchars(ucfirst($row['tipe']))?> <?= htmlspecialchars(ucfirst($row['model']))?>
                </div>
                <div class="flex items-center gap-1.5 truncate"><i class="fa-solid fa-droplet"></i> <span><?= htmlspecialchars(ucfirst($row['warna']))?></span></div>
                <div class="flex items-center gap-1.5 truncate"><i class="fa-solid fa-id-card"></i> <span><?= htmlspecialchars(strtoupper($row['noplat']))?></span></div>
                <?php
                $icon = $row['transmisi'] == 'automatic' ? '<i class="fa-solid fa-tachometer-alt"></i>' : '<i class="fa-solid fa-gear"></i>';
                ?>
                <div class="flex items-center gap-1.5 truncate"><?= $icon ?> <span><?= htmlspecialchars(ucfirst($row['transmisi']))?></span></div>
                <div class="flex items-center gap-1.5 truncate"><i class="fa-solid fa-user-group"></i> <span><?= htmlspecialchars($row['kursi'])?> Seats</span></div>
                <div class="flex items-center gap-1.5 truncate"><i class="fa-solid fa-door-open"></i> <span><?= htmlspecialchars($row['pintu'])?> Doors</span></div>
                <div class="flex items-center gap-1.5 truncate"><i class="fa-solid fa-gas-pump"></i> <span><?= htmlspecialchars(ucfirst($row['bhn_bkr']))?></span></div>

                <div class="absolute top-2 right-2 px-2 py-1 text-xs rounded-full shadow-md font-medium
                <?= $row['status'] == 'ready' ? 'bg-emerald-500 text-emerald-50' : ($row['status']=='rent' ? 'bg-red-500 text-red-50' : 'bg-yellow-500 text-yellow-50') ?>">
                <?= htmlspecialchars(ucfirst($row['status'])) ?>
                </div>
                
                <div class="col-span-3 mt-3 flex flex-col gap-2">
                    <h2 class="bg-orange-500/20 text-orange-500 p-2 rounded-xl shadow-sm font-semibold text-center text-sm">
                        Rp <?= number_format($row['harga'], 0, ',', '.') ?>/hari
                    </h2> 
                    <button 
                            data-id="<?= $row['id_mobil'] ?>"
                            <?= $row['status'] !== 'ready' ? 'disabled' : '' ?>
                            class="btn-detail w-full p-2 rounded-xl shadow-md font-semibold text-center transition-all duration-300 <?= $row['status'] !== 'ready' ? 'bg-neutral-600 text-neutral-400 cursor-not-allowed opacity-50' : 'bg-orange-500 text-orange-50 hover:bg-orange-600' ?>">
                            <?= $row['status'] !== 'ready' ? 'Tidak Tersedia' : 'Sewa Sekarang' ?>
                    </button>
                </div>
            </div>
            </div>
        </div>
        <?php endforeach?>
    <?php else:?>
        <div class="col-span-3 text-center py-10 flex flex-col items-center justify-center gap-4">
            <i class="fa-solid fa-car text-7xl opacity-50 text-neutral-500"></i>
            <h2 class="text-2xl font-semibold text-neutral-700">Oops! Daftar mobil kosong</h2>
            <p class="text-neutral-500">Belum ada mobil yang tersedia saat ini. Silahkan cek lagi nanti.</p>
            <button onclick="document.querySelector('#filterForm')?.reset(); document.querySelector('#filterForm').dispatchEvent(new Event('submit'));" class="mt-2 px-4 py-2 bg-orange-500 text-white rounded-xl hover:bg-orange-600 shadow-lg">Refresh</button>
        </div>
    <?php endif?> 
</div>     
<?php
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$harga = isset($_GET['harga']) ? trim($_GET['harga']) : '';
$transmisi = isset($_GET['transmisi']) ? trim($_GET['transmisi']) : '';
$bhn_bkr = isset($_GET['bhn_bkr']) ? trim($_GET['bhn_bkr']) : '';
$kursi = isset($_GET['kursi']) ? trim($_GET['kursi']) : '';
?>

<div class="flex justify-center mt-5 gap-2">
<?php for ($i = 1; $i <= $totalPages; $i++): ?>
    <?php
        $queryData = http_build_query([
            'page' => $i,
            'q' => $q,
            'harga' => $harga,
            'transmisi' => $transmisi,
            'bhn_bkr' => $bhn_bkr,
            'kursi' => $kursi
        ]);
    ?>
    <a href="?<?= $queryData ?>#daftar-mobil" data-page="<?= $i ?>"
        class="page-link px-3 py-1 rounded-lg <?= $i == $page ? 'bg-orange-500 text-white' : 'bg-neutral-800 text-neutral-300 hover:bg-neutral-700' ?>">
        <?= $i ?>
    </a>
<?php endfor; ?>
</div>
