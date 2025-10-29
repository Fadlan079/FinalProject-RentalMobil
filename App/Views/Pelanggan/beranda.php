<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Beranda - Cylc Rent Car</title>
  <link rel="stylesheet" href="output.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
  </style>
</head>

<body class="bg-neutral-50 text-neutral-900 font-sans">

  <!-- NAVBAR -->
  <header class="fixed top-0 left-0 right-0 bg-neutral-900 text-neutral-200 z-50 shadow-md">
    <div class="flex items-center justify-between px-6 py-4">
      <div class="flex items-center gap-2">
        <div class="bg-orange-500 w-10 h-10 rounded-xl flex items-center justify-center text-white font-bold text-lg">C</div>
        <h1 class="text-lg font-semibold">Cylc Rent Car</h1>
      </div>

      <button id="menu-btn" class="text-2xl text-neutral-100 md:hidden">
        <i class="fa-solid fa-bars"></i>
      </button>

      <nav class="hidden fixed left-0 top-0 h-full w-32 gap-6 text-sm font-medium">
        <a href="#" class="hover:text-orange-400 transition">Beranda</a>
        <a href="#" class="hover:text-orange-400 transition">Tentang</a>
        <a href="#" class="hover:text-orange-400 transition">Mobil</a>
        <a href="#" class="hover:text-orange-400 transition">Kontak</a>
        <a href="#" class="bg-orange-500 px-4 py-2 rounded-xl hover:bg-orange-600 transition">Login</a>
      </nav>
    </div>

    <!-- Mobile menu -->
    <div id="menu" class="hidden flex-col bg-neutral-800 border-t border-neutral-700 md:hidden">
      <a href="#" class="px-6 py-3 hover:bg-neutral-700">Beranda</a>
      <a href="#" class="px-6 py-3 hover:bg-neutral-700">Tentang</a>
      <a href="#" class="px-6 py-3 hover:bg-neutral-700">Mobil</a>
      <a href="#" class="px-6 py-3 hover:bg-neutral-700">Kontak</a>
      <a href="#" class="px-6 py-3 text-orange-400 font-semibold hover:bg-neutral-700">Login</a>
    </div>
  </header>

  <!-- HERO SLIDER -->
  <section class="mt-20 overflow-x-scroll scrollbar-hide flex gap-4 snap-x px-4">
    <img src="https://picsum.photos/1200/400?random=1" class="rounded-2xl snap-center w-[90%] flex-shrink-0 object-cover shadow-lg" alt="Banner 1">
    <img src="https://picsum.photos/1200/400?random=2" class="rounded-2xl snap-center w-[90%] flex-shrink-0 object-cover shadow-lg" alt="Banner 2">
    <img src="https://picsum.photos/1200/400?random=3" class="rounded-2xl snap-center w-[90%] flex-shrink-0 object-cover shadow-lg" alt="Banner 3">
  </section>

  <!-- KENAPA PILIH -->
  <section class="mt-16 px-6">
    <h2 class="text-2xl font-bold text-orange-500 mb-6 text-center">Kenapa Pilih Cylc Rent Car?</h2>

    <div class="grid md:grid-cols-3 gap-6">
      <div class="bg-neutral-800 rounded-2xl p-6 shadow-lg hover:scale-105 transition-all duration-300" data-aos="fade-up">
        <i class="fa-solid fa-car text-orange-500 text-3xl mb-3"></i>
        <h3 class="text-lg font-semibold mb-1">Armada Lengkap & Terawat</h3>
        <p class="text-sm text-neutral-400">Semua mobil kami rutin diservis dan dalam kondisi prima setiap saat.</p>
      </div>

      <div class="bg-neutral-800 rounded-2xl p-6 shadow-lg hover:scale-105 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
        <i class="fa-solid fa-wallet text-orange-500 text-3xl mb-3"></i>
        <h3 class="text-lg font-semibold mb-1">Harga Bersaing</h3>
        <p class="text-sm text-neutral-400">Nikmati tarif sewa terjangkau tanpa biaya tersembunyi.</p>
      </div>

      <div class="bg-neutral-800 rounded-2xl p-6 shadow-lg hover:scale-105 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
        <i class="fa-solid fa-clock text-orange-500 text-3xl mb-3"></i>
        <h3 class="text-lg font-semibold mb-1">Layanan 24 Jam</h3>
        <p class="text-sm text-neutral-400">Tim support kami siap membantu Anda kapan pun dibutuhkan.</p>
      </div>
    </div>
  </section>

  <!-- SHOWCASE MOBIL -->
  <section class="mt-20 px-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-3">
      <h2 class="text-2xl font-bold text-orange-500">Daftar Mobil</h2>
      <div class="relative w-full md:w-1/3">
        <input type="text" placeholder="Cari mobil..." class="w-full bg-neutral-800 border border-neutral-700 text-neutral-200 rounded-full pl-9 pr-3 py-2 text-sm focus:ring-2 focus:ring-orange-500 focus:outline-none">
        <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-neutral-400"></i>
      </div>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="bg-neutral-800 rounded-2xl overflow-hidden shadow-lg hover:scale-105 transition duration-300" data-aos="fade-up">
        <img src="https://picsum.photos/600/400?random=4" alt="Avanza" class="w-full h-48 object-cover">
        <div class="p-5">
          <h3 class="text-lg font-semibold text-orange-400">Toyota Avanza</h3>
          <p class="text-sm text-neutral-400">MPV | 7 Kursi</p>
          <div class="flex justify-between items-center mt-3">
            <span class="text-orange-400 font-semibold">Rp 500.000 / hari</span>
            <button class="bg-orange-500 px-4 py-1.5 rounded-full text-sm hover:bg-orange-600 transition">Sewa</button>
          </div>
        </div>
      </div>

      <div class="bg-neutral-800 rounded-2xl overflow-hidden shadow-lg hover:scale-105 transition duration-300" data-aos="fade-up" data-aos-delay="100">
        <img src="https://picsum.photos/600/400?random=5" alt="Honda Brio" class="w-full h-48 object-cover">
        <div class="p-5">
          <h3 class="text-lg font-semibold text-orange-400">Honda Brio</h3>
          <p class="text-sm text-neutral-400">City Car | 5 Kursi</p>
          <div class="flex justify-between items-center mt-3">
            <span class="text-orange-400 font-semibold">Rp 400.000 / hari</span>
            <button class="bg-orange-500 px-4 py-1.5 rounded-full text-sm hover:bg-orange-600 transition">Sewa</button>
          </div>
        </div>
      </div>

      <div class="bg-neutral-800 rounded-2xl overflow-hidden shadow-lg hover:scale-105 transition duration-300" data-aos="fade-up" data-aos-delay="200">
        <img src="https://picsum.photos/600/400?random=6" alt="Innova" class="w-full h-48 object-cover">
        <div class="p-5">
          <h3 class="text-lg font-semibold text-orange-400">Toyota Innova</h3>
          <p class="text-sm text-neutral-400">MPV Premium | 7 Kursi</p>
          <div class="flex justify-between items-center mt-3">
            <span class="text-orange-400 font-semibold">Rp 700.000 / hari</span>
            <button class="bg-orange-500 px-4 py-1.5 rounded-full text-sm hover:bg-orange-600 transition">Sewa</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="mt-20 py-8 text-center text-sm text-neutral-500 border-t border-neutral-800">
    © 2025 Cylc Rent Car — Nyaman, Cepat, Terpercaya
  </footer>

  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>AOS.init();</script>
  <script>
    const menuBtn = document.getElementById('menu-btn');
    const menu = document.getElementById('menu');
    menuBtn.addEventListener('click', () => {
      menu.classList.toggle('hidden');
      menu.classList.toggle('flex');
    });
  </script>
</body>
</html>
