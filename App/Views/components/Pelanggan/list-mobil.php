<?php
// Default values untuk mencegah undefined variable error
$harga     = $harga     ?? $_GET['harga']     ?? 'semua';
$transmisi = $transmisi ?? $_GET['transmisi'] ?? 'semua';
$bhn_bkr   = $bhn_bkr   ?? $_GET['bhn_bkr']   ?? 'semua';
$kursi     = $kursi     ?? $_GET['kursi']     ?? 'semua';
$query     = $query     ?? $_GET['q']         ?? '';
$page      = $page      ?? (int)($_GET['page'] ?? 1);
$totalPages = $totalPages ?? 1;
$data      = $data      ?? [];
?>
<div class="p-5 m-5 text-center">
    <h1 class="text-2xl font-semibold text-orange-500">Koleksi Mobil Kami</h1> 
    <p class="text-sm text-neutral-400">
        Temukan berbagai mobil yang tersedia untuk disewa. Pilih mobil favoritmu dan pesan sekarang!
    </p>
</div>

<form id="filterForm" action="index.php" method="GET" class="max-w-6xl mx-auto flex flex-col lg:flex-row justify-between items-stretch lg:gap-3">
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
    
    <div class=" flex w-full lg:max-w-xl lg:m-auto m-2">
        <input type="text" name="q" placeholder="Cari Mobil" value="<?= htmlspecialchars($query) ?>"
        class="bg-neutral-800 px-4 py-2 rounded-l-xl text-orange-50 focus:outline-none focus:ring-2 focus:ring-orange-500 w-full <?= !empty($query) ? 'border-2 border-orange-500 bg-neutral-700' : '' ?>">
        <button type="submit" class="bg-orange-500 rounded-r-xl px-4 py-2"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <button id="typebtn" type="button" class="lg:hidden bg-orange-500 text-orange-50 font-semibold text-center rounded-xl shadow-lg p-2 m-2 w-full">
        <i class="fa-solid fa-sliders"></i> Types
    </button>
</form>

<div id="typebar" class="fixed z-200 left-0 top-0 w-full sm:w-[400px] p-8 space-y-6 bg-neutral-900 h-full overflow-y-auto scrollbar-hide transform -translate-x-full transition-transform duration-300 ease-in-out">
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
      <label class="text-emerald-500 font-semibold"><i class="fa-solid fa-wallet"></i> Harga/Hari</label>
      <hr class="border-2 border-emerald-500 rounded-full w-full">
      <label><input type="radio" name="harga_mobile" value="semua" <?= $harga == 'semua' ? 'checked' : '' ?>> Semua</label>
      <label><input type="radio" name="harga_mobile" value="lt1jt" <?= $harga == 'lt1jt' ? 'checked' : '' ?>> Kurang dari 1000000</label>
      <label><input type="radio" name="harga_mobile" value="lt5jt" <?= $harga == 'lt5jt' ? 'checked' : '' ?>> Kurang dari 5000000</label>
    </div>

    <div class="flex flex-col gap-3">
      <label class="text-amber-500 font-semibold"><i class="fa-solid fa-tachometer-alt"></i> Transmisi</label>
      <hr class="border-2 border-amber-500 rounded-full w-full">
      <label><input type="radio" name="transmisi_mobile" value="semua" <?= $transmisi == 'semua' ? 'checked' : '' ?>> Semua</label>
      <label><input type="radio" name="transmisi_mobile" value="automatic" <?= $transmisi == 'automatic' ? 'checked' : '' ?>> Automatic</label>
      <label><input type="radio" name="transmisi_mobile" value="manual" <?= $transmisi == 'manual' ? 'checked' : '' ?>> Manual</label>
    </div>

    <div class="flex flex-col gap-3">
      <label class="text-sky-500 font-semibold"><i class="fas fa-gas-pump"></i> Bahan Bakar</label>
      <hr class="border-2 border-sky-500 rounded-full w-full">
      <label><input type="radio" name="bhn_bkr_mobile" value="semua" <?= $bhn_bkr == 'semua' ? 'checked' : '' ?>> Semua</label>
      <label><input type="radio" name="bhn_bkr_mobile" value="listrik" <?= $bhn_bkr == 'listrik' ? 'checked' : '' ?>> Listrik</label>
      <label><input type="radio" name="bhn_bkr_mobile" value="bensin" <?= $bhn_bkr == 'bensin' ? 'checked' : '' ?>> Bensin</label>
    </div>

    <div class="flex flex-col gap-3">
      <label class="text-rose-500 font-semibold"><i class="fa-solid fa-user-group"></i> Kapasitas</label>
      <hr class="border-2 border-rose-500 rounded-full w-full">
      <label><input type="radio" name="kursi_mobile" value="semua" <?= $kursi == 'semua' ? 'checked' : '' ?>> Semua</label>
      <label><input type="radio" name="kursi_mobile" value="2" <?= $kursi == '2' ? 'checked' : '' ?>> 2 Orang</label>
      <label><input type="radio" name="kursi_mobile" value="4-5" <?= $kursi == '4-5' ? 'checked' : '' ?>> 4-5 Orang</label>
      <label><input type="radio" name="kursi_mobile" value="6-8" <?= $kursi == '6-8' ? 'checked' : '' ?>> 6-8 Orang</label>
    </div>

    <button type="submit" class="p-2 bg-orange-500 rounded-xl font-semibold tracking-wide hover:bg-orange-600">Terapkan</button>
  </div>
</div>

<div id="grid-mobil-container">
    <?php include __DIR__ . "/grid-mobil.php"; ?>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const filterForm = document.getElementById("filterForm");
    const container = document.getElementById("grid-mobil-container");

    // Tangani submit form filter & pencarian
    if (filterForm) {
        filterForm.addEventListener("submit", function (e) {
            e.preventDefault();
            filterForm.querySelector('input[name="page"]').value = 1;
            fetchCars();
        });

        // Tangani perubahan dropdown filter supaya langsung update
        const selects = filterForm.querySelectorAll('select');
        selects.forEach(select => {
            select.addEventListener('change', () => {
                filterForm.querySelector('input[name="page"]').value = 1;
                fetchCars();
            });
        });

        // Tangani filter dari sidebar (mobile)
        const sidebarSubmitBtn = document.querySelector('#typebar button[type="submit"]');
        if (sidebarSubmitBtn) {
            sidebarSubmitBtn.addEventListener('click', function(e) {
                // Di handle oleh index.php, tapi kita cegah form biasa dan trigger fetchCars
                // Catatan: logika ini menimpa event listener di index.php jika perlu
                setTimeout(() => {
                    filterForm.querySelector('input[name="page"]').value = 1;
                    fetchCars();
                }, 50);
            });
        }
    }

    // Tangani klik pagination (event delegation)
    document.body.addEventListener("click", function (e) {
        const pageLink = e.target.closest(".page-link");
        if (pageLink) {
            e.preventDefault();
            const page = pageLink.getAttribute("data-page");
            if (filterForm) {
                filterForm.querySelector('input[name="page"]').value = page;
                fetchCars();
            }
        }
    });

    function fetchCars() {
        if (!filterForm || !container) return;

        const formData = new FormData(filterForm);
        const params = new URLSearchParams(formData);

        // Update URL di address bar tanpa reload
        const newUrl = window.location.pathname + '?' + params.toString() + '#daftar-mobil';
        window.history.pushState({path: newUrl}, '', newUrl);

        // Ubah action menjadi ajax endpoint
        params.append("action", "filter-mobil-ajax");

        container.innerHTML = '<div class="text-center py-20 text-orange-500"><i class="fa-solid fa-spinner fa-spin text-4xl"></i><p class="mt-3 text-neutral-400">Memuat data mobil...</p></div>';

        fetch("index.php?" + params.toString())
            .then(response => response.text())
            .then(html => {
                container.innerHTML = html;
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                container.innerHTML = '<div class="text-center py-10 text-red-500"><p>Terjadi kesalahan koneksi. Silahkan coba lagi.</p></div>';
            });
    }
});
</script>
<?php include __DIR__ . "/modal-detail-mobil.php" ?>