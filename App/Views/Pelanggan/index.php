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
<body>
  <header>
    <nav id="nav" class="fixed lef-0 top-0 w-full p-3 shadow-md bg-neutral-900 text-neutral-50 flex justify-between items-center transform transition-all duration-300">
      <div>
        <h2>Cylc Rent Car</h2>
      </div>
      <button id="menuToggle"><i class="fa-solid fa-bars transition-transform duration-300"></i></button>
    </nav>
    <aside id="sidebar" class="fixed left-0 top-0 w-90 p-2 bg-neutral-900 h-full transform -translate-x-full transition-all duration-300">
      <div class="p-6 space-y-6">
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
            <a href="index.php?action=profile" class="p-4 border-2 border-orange-500 rounded-xl font-semibold">
              <i class="fa-solid fa-user"></i> Profil Saya
            </a>
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

    <section id="kenapa" class="h-screen p-2 bg-neutral-900"></section>

    <section id="daftar-mobil" class="h-screen p-2 bg-orange-500">
      <div class="grid grid-cols-4 gap-6">
        <div class=""></div>
      </div>
    </section>

    <section id="galeri" class="h-screen p-2 bg-neutral-50"></section>

    <section id="pelayanan" class="h-screen p-2 bg-neutral-900"></section>
  </main>
  <footer class="bg-neutral-900 text-gray-400 text-center py-4 text-sm">
    &copy; 2025 <span class="text-orange-500 font-semibold">Cylc Rent Car</span>. All rights reserved.
  </footer>

  <script>
    const toggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const closeBtn = document.getElementById('closeSidebar');

    toggle.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');

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