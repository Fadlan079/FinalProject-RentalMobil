<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cylc Rent Car</title>
  <link rel="stylesheet" href="output.css">
  <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <style>
    html {
      scroll-behavior: smooth;
    }

    .scrollbar-hide::-webkit-scrollbar { display: none; }

    ::-webkit-scrollbar {
      width: 5px;
      transition: width 0.3s ease;
    }

    ::-webkit-scrollbar-track {
      background: #171717;
    }

    ::-webkit-scrollbar-thumb {
      background: #f97316;
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #ea580c;
      box-shadow: 0 0 0 2px #ea580c;
    }

  </style>
</head>
<body>
  <header>
    <?php include __DIR__ . "/../components/Pelanggan/header.php"?>
    <?php include __DIR__ . "/../components/Pelanggan/profile.php"?>
  </header>

  <main>
    <section id="beranda" class="h-auto p-2 bg-neutral-100">
      <?php include __DIR__ . "/../components/Pelanggan/beranda.php"?>
    </section>

    <section id="kenapa" class="h-auto p-2 bg-neutral-900">
      <?php include __DIR__ . "/../components/Pelanggan/why-cylc.php"?>
    </section>

    <section id="tentang" class="h-auto p-2 bg-neutral-100 text-neutral-900">
      <?php include __DIR__ . "/../components/Pelanggan/tentang-kami.php"?>
    </section>

    <section id="daftar-mobil" class="h-auto p-2 bg-neutral-900 border-t-2">
      <?php include __DIR__ . "/../components/Pelanggan/list-mobil.php"?>
    </section>

    <section id="pelayanan" class="h-auto bg-neutral-100">
      <?php include __DIR__ . "/../components/Pelanggan/pelayanan-pelanggan.php"?>
    </section>
  </main>

  <footer class="bg-neutral-900 text-neutral-50">
     <?php include __DIR__ . "/../components/Pelanggan/footer.php"?>
  </footer>
  <script>
    const profileMenu = document.getElementById('profileMenu');

    document.addEventListener('click', (e) => {
      if (profileMenu.hasAttribute('open') && !profileMenu.contains(e.target)) {
        profileMenu.removeAttribute('open');
      }
    });

    window.addEventListener('scroll', () => {
      if (profileMenu.hasAttribute('open')) {
        profileMenu.removeAttribute('open');
      }
    });
    const sections = document.querySelectorAll("section");
    const navLinks = document.querySelectorAll(".nav-link");

    window.addEventListener("scroll", () => {
      let current = "";

      sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (scrollY >= sectionTop - sectionHeight / 3) {
          current = section.getAttribute("id");
        }
      });

      navLinks.forEach(link => {
        link.classList.remove("text-orange-500");
        if (link.getAttribute("href") === `#${current}`) {
          link.classList.add("text-orange-500");
        }
      });
    });

    const sidebar = document.getElementById('sidebar');

    function handleGesture() {
      const deltaX = touchendX - touchstartX;
      const threshold = 50;

      if (Math.abs(deltaX) < threshold) return;

      if (deltaX > 0) {
        sidebarCtrl?.openPanel();
      } else {
        sidebarCtrl?.closePanel();
        typebarCtrl?.closePanel();
      }
    }
    let touchstartX = 0;
    let touchendX = 0;

    document.addEventListener('touchstart',(e) => {
      touchstartX = e.changedTouches[0].screenX;
    });

    document.addEventListener('touchend',(e) => {
      touchendX = e.changedTouches[0].screenX;
      handleGesture();
    });

  function setupToggle(openBtnId, panelId, closeBtnId, options = {}) {
    const openBtn = document.getElementById(openBtnId);
    const panel = document.getElementById(panelId);
    const closeBtn = document.getElementById(closeBtnId);

    if (!openBtn || !panel || !closeBtn) return;

    openBtn.addEventListener('click', () => {
      panel.classList.remove('-translate-x-full');
      document.documentElement.style.overflow = 'hidden';
    });

    closeBtn.addEventListener('click', () => {
      panel.classList.add('-translate-x-full');
      document.documentElement.style.overflow = '';
    });

    function openPanel() {
      panel.classList.remove('-translate-x-full');
      if (options.iconToggle) {
        const icon = openBtn.querySelector('i');
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-xmark', 'rotate-180');
      }
      document.body.classList.add('overflow-hidden');
    }

    function closePanel() {
      panel.classList.add('-translate-x-full');
      if (options.iconToggle) {
        const icon = openBtn.querySelector('i');
        icon.classList.add('fa-bars');
        icon.classList.remove('fa-xmark', 'rotate-180');
      }
      document.body.classList.remove('overflow-hidden');
    }

    openBtn.addEventListener('click', openPanel);
    closeBtn.addEventListener('click', closePanel);

    if (options.autoCloseLinks) {
      panel.querySelectorAll('a').forEach(link =>
        link.addEventListener('click', closePanel)
      );
    }

    return { openPanel, closePanel };
  }

  // === Sidebar ===
  const sidebarCtrl = setupToggle('menuToggle', 'sidebar', 'closeSidebar', {
    iconToggle: true,
    autoCloseLinks: true
  });

  // === Typebar ===
  const typebarCtrl = setupToggle('typebtn', 'typebar', 'closetypebar');

  const nav = document.getElementById("nav");
  let lastscrollY = window.scrollY;
  window.addEventListener("scroll", () => {
    nav.classList.toggle("-translate-y-15", window.scrollY > lastscrollY);
    lastscrollY = window.scrollY;
  });

  // === Sidebar profile ===
  const Profilesidebar = setupToggle('ProfileBtn', 'ProfileSidebar', 'CloseProfile');
  
  const ProfileNavsidebar = setupToggle('ProfileNavBtn', 'ProfileSidebar', 'CloseProfile');

  // === Sidebar Filter Submit ===
  const typebar = document.getElementById('typebar');
  const sidebarFilterBtn = document.querySelector('#typebar button[type="submit"]');
  const mainForm = document.querySelector('section#daftar-mobil form');

  sidebarFilterBtn.addEventListener('click', e => {
    e.preventDefault();
    typebar.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
      const mainInput = mainForm.querySelector(`[name="${radio.name}"]`);
      if (mainInput) mainInput.value = radio.value;
    });
    typebarCtrl.closePanel();
    mainForm.submit();
  });
</script>
</body>
</html>