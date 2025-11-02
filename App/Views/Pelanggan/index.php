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
    <nav id="nav" class="fixed lef-0 top-0 z-100 w-full p-3 shadow-md bg-neutral-900 text-neutral-50 flex justify-between items-center transform transition-all duration-300">
      <div>
        <h2>Cylc Rent Car</h2>
      </div>
      <button id="menuToggle" class="lg:hidden"><i class="fa-solid fa-bars transition-transform duration-300"></i></button>

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
    <aside id="sidebar" class="fixed left-0 top-0 w-full p-8 space-y-6 bg-neutral-900 h-full transform -translate-x-full transition-all duration-300">
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
    <section id="beranda" class="h-screen p-2 bg-neutral-50"></section>

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

    <section id="daftar-mobil" class="h-auto p-2 bg-neutral-50">
      <div class="p-5 m-5 text-center">
        <h1 class="text-2xl font-semibold text-neutral-900">Kenapa Harus Pilih Cylc Rent Car?</h1> 
        <p class="text-sm text-neutral-600">
          Kami hadir untuk membuat proses sewa mobil lebih mudah, transparan, dan terpercaya
        </p>
      </div>
      <div class="max-w-6xl m-auto flex justify-between">
        <div>
          <button>Filter</button>
        </div>
        <form action="index.php" method="get">
          <input type="text" name="q" placeholder="Cari Mobil ">
          <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 lg:grid-rows-3 gap-6 p-5 m-5 lg:max-w-6xl lg:m-auto">
        <?php foreach($data as $row):?>
          <?php
              $foto = $row['img'] ?? '';
              $uploadDir = __DIR__ . '/../../Public/uploads/';
              $imgPath = 'uploads/' . $foto;

              if (empty($foto) || !file_exists($uploadDir . $foto)) {
                  $imgPath = 'uploads/default.svg';
              }
            ?>
          <div class="bg-neutral-800 rounded-xl text-neutral-50 shadow-xl">
            <img src="<?= $imgPath?>" alt="foto mobil"
            class="rounded-xl h-40 w-full object-cover">
            <div class="p-2 m-2 grid grid-cols-3 gap-3 text-sm">
              <h2 class="col-span-3"><?= htmlspecialchars($row['merk'])?></h2>

              <h2><?= htmlspecialchars($row['model'])?></h2>
              <h2><?= htmlspecialchars($row['warna'])?></h2>
              <h2><?= htmlspecialchars($row['noplat'])?></h2>

              <h2 class="col-span-3"><?= htmlspecialchars($row['status'])?></h2>
            </div>
          </div>
          <?php endforeach?>
      </div>
      <div class="flex justify-center mt-5 gap-2">
          <?php for($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?> #daftar-mobil" 
              class="px-3 py-1 rounded-lg <?= $i == $page ? 'bg-orange-500 text-white' : 'bg-neutral-800 text-neutral-300' ?>">
              <?= $i ?>
            </a>
          <?php endfor; ?>
      </div>
    </section>

    <section id="galeri" class="h-screen p-2 bg-neutral-900"></section>

    <section id="pelayanan" class="h-screen p-2 bg-neutral-50"></section>
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
      icon.classList.toggle('fa-bars');
      icon.classList.toggle('fa-xmark');
      icon.classList.toggle('rotate-180'); 

      document.body.classList.toggle('overflow-hidden');
    });

    function closeSidebar() {
      sidebar.classList.add('-translate-x-full');

      const icon = toggle.querySelector('i');
      icon.classList.toggle('fa-bars');
      icon.classList.toggle('fa-xmark');
      icon.classList.toggle('rotate-180'); 

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
  </script>
</body>
</html>