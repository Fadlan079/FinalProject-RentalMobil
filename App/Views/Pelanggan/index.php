<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Beranda - Cylc Rent Car</title>
  <link rel="stylesheet" href="output.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <style>
    html {
      scroll-behavior: smooth;
    }

    .scrollbar-hide::-webkit-scrollbar { display: none; }

    ::-webkit-scrollbar {
      width: 10px;
    }

    ::-webkit-scrollbar-track {
      background: #171717;
    }

    ::-webkit-scrollbar-thumb {
      background: #f97316;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #ea580c;
    }
  </style>
</head>
<body>
  <header>
    <nav id="nav" class="fixed left-0 top-0 z-100 w-full p-3 shadow-md bg-neutral-900 text-neutral-50 flex justify-between items-center transform transition-all duration-300">
      <div>
        <h2>Cylc Rent Car</h2>
      </div>
      <button id="menuToggle" class="lg:hidden" aria-label="Buka menu navigasi"><i class="fa-solid fa-bars transition-transform duration-300"></i></button>

      <div class="hidden lg:flex justify-between gap-3 items-center text-center">

        <?php if(isset($_SESSION['user'])):?>
          <a href="index.php?action=profile" class="p-2 border-2 border-orange-500 rounded-xl font-semibold">
            <i class="fa-solid fa-user"></i> Profil Saya
          </a>
          <a href="index.php?action=logout" class="p-2 bg-orange-500 rounded-xl font-semibold"><i class="fa-solid fa-door-open"></i> Logout</a>
        <?php else:?>
          <a href="index.php?action=login" class="p-2 text-sm border-2 border-orange-500 text-orange-500 rounded-xl"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
          <a href="index.php?action=signup" class="p-2 text-sm bg-orange-500 rounded-xl"><i class="fa-solid fa-pen-to-square"></i> Sign Up</a>
        <?php endif?>  

        <details class="relative inline-block cursor-pointer">
          <summary class="p-2 text-neutral-200 marker:content-none">
            <i class="fa-solid fa-bars transition-transform duration-300"></i>
          </summary>
          <ul class="absolute z-20 right-0 mt-2 px-5 py-5 w-45 text-sm bg-neutral-900 rounded-xl border border-neutral-800">
            <li><a href="#beranda" class="p-4"><i class="fa-solid fa-house text-orange-500"></i> <span>Beranda</span></a></li>
            <li><a href="#kenapa" class="p-4"><i class="fa-solid fa-circle-question text-orange-500"></i> <span>kenapa Harus Cylc?</span></a></li>
            <li><a href="#daftar-mobil" class="p-4"><i class="fa-solid fa-car-on text-orange-500"></i> <span>Daftar Mobil</span></a></li>
            <li><a href="#galeri" class="p-4"><i class="fa-solid fa-images text-orange-500"></i> <span>Galeri</span></a></li>
            <li><a href="#pelayanan" class="p-4"><i class="fa-solid fa-headset text-orange-500"></i> <span>pelayanan Pelanggan</span></a></li>
          </ul>
        </details>
      </div>

    </nav>
    <aside id="sidebar" class="fixed z-200 left-0 top-0 w-full p-8 space-y-6 bg-neutral-900 h-full transform -translate-x-full transition-all duration-300">
        <div class="flex justify-between items-center">
          <div class="text-neutral-100">
            <h2>Cylc Rent Car</h2>
          </div>
          <button id="closeSidebar" class="text-gray-500">
            <i class="fa-solid fa-xmark"></i>
          </button>
        </div>
        <nav class="text-orange-50 flex flex-col gap-5 mt-5">
          <a href="#beranda" class="p-4"><i class="fa-solid fa-house text-orange-500"></i> <span>Beranda</span></a>
          <a href="#kenapa" class="p-4"><i class="fa-solid fa-circle-question text-orange-500"></i> <span>kenapa Harus Cylc?</span></a>
          <a href="#daftar-mobil" class="p-4"><i class="fa-solid fa-car-on text-orange-500"></i> <span>Daftar Mobil</span></a>
          <a href="#galeri" class="p-4"><i class="fa-solid fa-images text-orange-500"></i> <span>Galeri</span></a>
          <a href="#pelayanan" class="p-4"><i class="fa-solid fa-headset text-orange-500"></i> <span>pelayanan Pelanggan</span></a>
          <?php if(isset($_SESSION['user'])):?>
            <?php if($_SESSION['user']['role'] == 'pelanggan'):?>
              <a href="index.php?action=profile-pelanggan" class="p-4 border-2 border-orange-500 rounded-xl font-semibold">
                <i class="fa-solid fa-user"></i> Profil Saya
              </a>
            <?php else:?>  
              <a href="index.php?action=profile-pegawai" class="p-4 border-2 border-orange-500 rounded-xl font-semibold">
                <i class="fa-solid fa-user"></i> Profil Saya
              </a>
            <?php endif?>    
            <a href="index.php?action=logout" class="p-4 bg-orange-500 rounded-xl font-semibold"><i class="fa-solid fa-door-open"></i> Logout</a>
          <?php else:?>
            <a href="index.php?action=login" class="p-4 border-2 border-orange-500 text-orange-500 rounded-xl font-semibold"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
            <a href="index.php?action=signup" class="p-4 bg-orange-500 rounded-xl font-semibold"><i class="fa-solid fa-pen-to-square"></i> Sign Up</a>
          <?php endif?>  
        </nav>
    </aside>
  </header>
  <main>
    <section id="beranda" class="h-screen p-2 bg-neutral-100"></section>

    <section id="kenapa" class="h-auto p-2 bg-neutral-900">
      <div class="p-5 m-5 text-center">
        <h1 class="text-2xl font-semibold text-orange-500">Kenapa Harus Pilih Cylc Rent Car?</h1> 
        <p class="text-sm text-neutral-400">
          Kami hadir untuk membuat proses sewa mobil lebih mudah, transparan, dan terpercaya
        </p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 m-5 p-5 text-center">
        <div class="bg-neutral-800 rounded-xl text-orange-400 border-l-4 border-orange-500 p-3 shadow-lg hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
          <i class="fa-solid fa-car text-5xl py-4"></i>
          <h2 class="font-semibold text-lg ">Pilihan Mobil Lengkap</h2>
          <p class="text-neutral-400 text-sm">Temukan mobil sesuai kebutuhan dan anggaran Anda tanpa perlu datang ke dealer.</p>
        </div>

        <div class="bg-neutral-800 rounded-xl text-cyan-400 border-l-4 border-cyan-500 p-3 shadow-lg hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
          <i class="fa-solid fa-ticket text-5xl py-4"></i>
          <h2 class="font-semibold text-lg">Pemesanan Praktis</h2>       
          <p class="text-neutral-400 text-sm">Pesan secara online, ambil mobil di waktu yang Anda tentukan. Cepat dan efisien.</p>
        </div>

        <div class="bg-neutral-800 rounded-xl text-violet-400 border-l-4 border-violet-500 p-3 shadow-lg hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
          <i class="fas fa-chart-line text-5xl py-4"></i>
          <h2 class="font-semibold text-lg">Pemantauan Transparan</h2>
          <p class="text-neutral-400 text-sm">Lacak durasi sewa, biaya, dan jatuh tempo langsung dari akun Anda.</p>
        </div>

        <div class="bg-neutral-800 rounded-xl text-emerald-400 border-l-4 border-emerald-500 p-3 shadow-lg hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
          <i class="fas fa-wallet text-5xl py-4"></i>
          <h2 class="font-semibold text-lg">Pembayaran Fleksibel</h2>   
          <p class="text-neutral-400 text-sm">Dukung transaksi online maupun langsung di tempat, aman dan terpercaya.</p>
        </div>

        <a href="#daftar-mobil" class="text-center lg:col-span-4 text-neutral-400 text-sm mt-6 mb-8">Siap berangkat tanpa repot? 
          <span class="text-orange-400 font-semibold">Pesan mobil Anda sekarang</span>
        </a>
      </div>
    </section>

    <section id="daftar-mobil" class="h-auto p-2 bg-neutral-100">
      <div class="p-5 m-5 text-center">
        <h1 class="text-2xl font-semibold text-orange-500">koleksi Mobil Kami</h1> 
        <p class="text-sm text-neutral-600">
          Temukan berbagai mobil yang tersedia untuk disewa. Pilih mobil favoritmu dan pesan sekarang!
        </p>
      </div>
      <div class="max-w-6xl mx-auto flex flex-col lg:flex-row justify-between items-stretch gap-4">
        <div class="hidden lg:flex justify-between items-center bg-neutral-900 text-orange-50 p-2 rounded-xl shadow-md mb-4">
          <div class="flex gap-4 items-center">
            <select name="harga" class="bg-neutral-800 p-2 rounded-lg focus:ring-2 focus:ring-orange-500">
              <option value="">Harga (Semua)</option>
              <option value="lt1000000">Kurang dari 1 juta</option>
              <option value="lt5000000">Kurang dari 5 juta</option>
            </select>

            <select name="transmisi" class="bg-neutral-800 p-2 rounded-lg focus:ring-2 focus:ring-orange-500">
              <option value="">Transmisi (Semua)</option>
              <option value="automatic">Automatic</option>
              <option value="manual">Manual</option>
            </select>

            <select name="bahan_bkr" class="bg-neutral-800 p-2 rounded-lg focus:ring-2 focus:ring-orange-500">
              <option value="">Bahan Bakar (Semua)</option>
              <option value="listrik">Listrik</option>
              <option value="bensin">Bensin</option>
            </select>

            <select name="kapasitas" class="bg-neutral-800 p-2 rounded-lg focus:ring-2 focus:ring-orange-500">
              <option value="">Kapasitas (Semua)</option>
              <option value="2">2 Orang</option>
              <option value="4-5">4-5 Orang</option>
              <option value="6-8">6-8 Orang</option>
            </select>
          </div>
          <button type="submit" class="bg-orange-500 p-2 rounded-lg font-semibold hover:bg-orange-600 transition-all duration-300">
            Terapkan
          </button>
        </div>
        <form action="index.php" method="get" class="m-2 flex w-full">
          <input type="hidden" name="page" value="1">
          <input type="text" name="q" placeholder="Cari Mobil"
          class="bg-neutral-800 px-4 py-2 lg:px-6 lg:py-4 rounded-l-4xl text-orange-50 focus:outline-none focus:ring-2 focus:ring-orange-500 w-full">
          <button type="submit" class="bg-orange-500 rounded-r-4xl px-4 py-2"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <button id="typebtn" type="button" class="lg:hidden bg-orange-500 text-orange-50 font-semibold text-center rounded-xl shadow-lg p-2 m-2 w-full"><i class="fa-solid fa-border-all"></i> Types</button>

        <div id="typebar" class="fixed z-200 left-0 top-0 w-full p-8 space-y-6 bg-neutral-900 h-full transform -translate-x-full transition-all duration-300">
          <div class="flex justify-between items-center">
            <div class="text-neutral-100">
              <h2 class="font-semibold tracking-wide"><i class="fa-solid fa-filter text-orange-500"></i> Filter Mobil Sesuai kebutuhanmu</h2>
            </div>
            <button id="closetypebar" class="text-gray-500">
              <i class="fa-solid fa-xmark"></i>
            </button>
          </div>

          <form action="" method="GET" class="text-orange-50 flex flex-col gap-5 mt-5">
            <div class="flex flex-col gap-3">
              <label for="" class="text-emerald-500 font-semibold"><i class="fa-solid fa-wallet"></i> Harga/Hari</label>
              <hr class="border-2 border-emerald-500 rounded-full w-full">
              <label for="">
                <input type="radio" name="harga" id="" checked>
                Semua
              </label>
              <label for="">
                <input type="radio" name="harga" id="">
                Kurang dari 1000000
              </label>
              <label for="">
                <input type="radio" name="harga" id="">
                Kurang dari 5000000
              </label>
            </div>
            <div class="flex flex-col gap-3">
              <label for="" class="text-amber-500 font-semibold"><i class="fa-solid fa-tachometer-alt"></i> Transmisi</label>
              <hr class="border-2 border-amber-500 rounded-full w-full">
              <label for="">
                <input type="radio" name="transmisi" id="" checked>
                Semua
              </label>
              <label for="">
                <input type="radio" name="transmisi" id="">
                Automatic
              </label>
              <label for="">
                <input type="radio" name="transmisi" id="">
                Manual
              </label>
            </div>
            <div class="flex flex-col gap-3">
              <label for="" class="text-sky-500 font-semibold"><i class="fas fa-gas-pump"></i> Bahan Bakar</label>
              <hr class="border-2 border-sky-500 rounded-full w-full">
              <label for="">
                <input type="radio" name="bahan_bkr" id="" checked>
                Semua
              </label>
              <label for="">
                <input type="radio" name="bahan_bkr" id="">
                Listrik
              </label>
              <label for="">
                <input type="radio" name="bahan_bkr" id="">
                Bensin
              </label>
            </div>
            <div class="flex flex-col gap-3">
              <label for="" class="text-rose-500 font-semibold"><i class="fa-solid fa-user-group"></i> Kapasitas</label>
              <hr class="border-2 border-rose-500 rounded-full w-full">
              <label for="">
                <input type="radio" name="kapasitas" id="" checked>
                Semua
              </label>
              <label for="">
                <input type="radio" name="kapasitas" id="">
                2 Orang
              </label>
              <label for="">
                <input type="radio" name="kapasitas" id="">
                4-5 Orang
              </label>
              <label for="">
                <input type="radio" name="kapasitas" id="">
                6-8 Orang
              </label>              
            </div>
            <button type="submit" class="p-2 bg-orange-500 rounded-xl font-semibold tracking-wide">Terapkan</button>
          </form>
       </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 lg:grid-rows-3 gap-6 p-5 m-5 lg:max-w-6xl lg:m-auto">
        <?php if(!empty($data)):?>
          <?php foreach($data as $row):?>
            <?php
              $imgPath = 'uploads/' . (!empty($row['img']) && file_exists(__DIR__ . '/../../../Public/uploads/' . $row['img'])? $row['img'] : 'default.svg');
              ?>
            <div class="bg-neutral-800 border-t-4 border-orange-500 text-neutral-300 shadow-xl group relative tracking-wide">
              <?php 
                $borderColor = $row['status'] == 'ready' ? 'emerald-500' : ($row['status'] == 'rent' ? 'red-500' : 'yellow-500'); 
              ?>
              <div class="absolute -inset-4 opacity-0 group-hover:opacity-20 border-17 rounded-xl scale-95 group-hover:scale-100 border-<?= $borderColor ?> pointer-events-none transition-all duration-500 z-0"></div>
              <div class="z-10 relative">
                <img src="<?= $imgPath?>" alt="foto mobil"
                class="h-40 w-full object-cover">
                <div class="p-3 m-2 grid grid-cols-3 gap-3 text-sm">
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

                  <div class="absolute top-2 right-2 px-2 py-1 text-xs rounded-full 
                    <?= $row['status'] == 'ready' ? 'bg-emerald-500 text-emerald-50' : ($row['status']=='rent' ? 'bg-red-500 text-red-50' : 'bg-yellow-500 text-yellow-50') ?>">
                    <?= htmlspecialchars(ucfirst($row['status'])) ?>
                  </div>
                  <h2 class="col-span-3 bg-orange-500/20 text-orange-500 p-2 rounded-xl shadow-lg font-semibold text-center">
                    Rp <?= number_format($row['harga'], 0, ',', '.') ?>/hari
                  </h2> 
                  <a href="index.php?action=detail-mobil" class="col-span-3 p-2 bg-orange-500 rounded-xl shadow-lg font-semibold text-orange-50 text-center hover:bg-orange-600 transition-all duration-300">Sewa Sekarang</a>
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
      <div class="flex justify-center mt-5 gap-2">
          <?php for($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>&q=<?= urlencode($query ?? '') ?>#daftar-mobil" 
              class="px-3 py-1 rounded-lg <?= $i == $page ? 'bg-orange-500 text-white' : 'bg-neutral-800 text-neutral-300' ?>">
              <?= $i ?>
            </a>
          <?php endfor; ?>
      </div>
    </section>

    <section id="galeri" class="h-screen p-2 bg-neutral-900"></section>

    <section id="pelayanan" class="h-screen p-2 bg-neutral-100"></section>
  </main>
  <footer class="bg-neutral-900 text-gray-400 text-center py-4 text-sm">
    &copy; 2025 <span class="text-orange-500 font-semibold">Cylc Rent Car</span>. All rights reserved.
  </footer>

  <script>
    const toggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const closeBtn = document.getElementById('closeSidebar');

    toggle.addEventListener('click', () => {
      sidebar.classList.remove('-translate-x-full');

      const icon = toggle.querySelector('i');
      icon.classList.remove('fa-bars');
      icon.classList.add('fa-xmark','rotate-180');

      document.body.classList.add('overflow-hidden');
    });

    function closeSidebar() {
      sidebar.classList.add('-translate-x-full');

      const icon = toggle.querySelector('i');
      icon.classList.add('fa-bars');
      icon.classList.remove('fa-xmark','rotate-180');

      document.body.classList.remove('overflow-hidden');
    }

    closeBtn.addEventListener('click', closeSidebar);

    document.querySelectorAll('#sidebar nav a').forEach(link => {
      link.addEventListener('click', () => {
        closeSidebar();
      });
    });


    const bottomnav = document.getElementById("nav");
      let lastscrollY = window.scrollY;

      window.addEventListener("scroll", () =>{
          if(window.scrollY > lastscrollY){
              bottomnav.classList.add("-translate-y-15");
          }else{
              bottomnav.classList.remove("-translate-y-15");
          }

          lastscrollY = window.scrollY;
      });

    const typebtn = document.getElementById('typebtn');
    const typebar = document.getElementById('typebar');
    const closetypebtn = document.getElementById('closetypebar');

    typebtn.addEventListener('click', () => {
      typebar.classList.remove('-translate-x-full');
      document.body.classList.add('overflow-hidden');
    });

    function closetypebar() {
      typebar.classList.add('-translate-x-full');
      document.body.classList.remove('overflow-hidden');
    }

    closetypebtn.addEventListener('click', closetypebar)
  </script>
</body>
</html>