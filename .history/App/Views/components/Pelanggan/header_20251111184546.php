<nav id="nav" class="fixed left-0 top-0 z-100 w-full p-3 shadow-md bg-neutral-900 text-neutral-50 flex lg:px-6 justify-between items-center transform transition-all duration-300">
    <div>
    <h2>Cylc Rent Car</h2>
    </div>
    <button id="menuToggle" class="lg:hidden" aria-label="Buka menu navigasi"><i class="fa-solid fa-bars transition-transform duration-300"></i></button>

    <div id="navbar" class="hidden lg:flex justify-between gap-6 items-center text-center">
        <div class="text-sm flex gap-4 text-neutral-400">
            <a  href="#beranda" class="nav-link"><i class="fa-solid fa-house"></i> <span>Beranda</span></a>
            <a href="#kenapa" class="nav-link"><i class="fa-solid fa-circle-question"></i> <span>Mengapa Cylc?</span></a>
            <a href="#tentang" class="nav-link"><i class="fa-solid fa-building"></i> <span>Tentang Kami</span></a>
            <a href="#daftar-mobil" class="nav-link"><i class="fa-solid fa-car-on"></i> <span>koleksi Mobil</span></a>
            <a href="#pelayanan" class="nav-link"><i class="fa-solid fa-headset"></i> <span>pelayanan Pelanggan</span></a>
        </div>
        <div class="relative">
            <?php if (isset($_SESSION['user'])): ?>
                <details id="profileMenu" class="relative group">
                    <summary class="flex items-center gap-2 p-2 rounded-full bg-neutral-800 cursor-pointer hover:bg-neutral-700 transition-all">
                        <i class="fa-solid fa-user text-orange-500 text-lg"></i>
                    </summary>

                    <ul class="absolute right-0 mt-3 w-44 bg-neutral-800 border border-neutral-700 rounded-xl shadow-lg py-2 overflow-hidden transition-all duration-200">
                        <li>
                            <button type="button" id="ProfileNavBtn" class="w-full flex items-center gap-2 px-4 py-2 text-neutral-100 hover:bg-neutral-700 transition-all">
                            <i class="fa-solid fa-id-badge text-orange-400"></i>
                            <span>Profil Saya</span>
                            </button>  
                        </li>
                        <li>
                            <a href="index.php?action=riwayat-transaksi" class="flex items-center gap-2 px-4 py-2  hover:bg-neutral-700 transition-all">
                                <i class="fa-solid fa-clock-rotate-left text-orange-400"></i>
                                <span>Riwayat</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?action=logout" class="flex items-center gap-2 px-4 py-2 text-red-400 hover:bg-neutral-700 transition-all">
                                <i class="fa-solid fa-door-open"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </details>
            <?php else: ?>
                <a href="index.php?action=login" class="p-2 px-4 text-sm border-2 border-orange-500 text-orange-500 rounded-xl font-semibold hover:bg-orange-500 hover:text-white transition-all">
                <i class="fa-solid fa-right-to-bracket"></i> Login
                </a>
            <?php endif; ?>
        </div>
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
        <a href="#tentang" class="p-4"><i class="fa-solid fa-building text-orange-500"></i> <span>Tentang Kami</span></a>
        <a href="#daftar-mobil" class="p-4"><i class="fa-solid fa-car-on text-orange-500"></i> <span>Daftar Mobil</span></a>
        <a href="#pelayanan" class="p-4"><i class="fa-solid fa-headset text-orange-500"></i> <span>pelayanan Pelanggan</span></a>
        <a href="#pelayanan" class="p-4"><i class="fa-solid fa-headset text-orange-500"></i> <span>pelayanan Pelanggan</span></a>
        <?php if(isset($_SESSION['user'])):?>
            <button type="button" id="ProfileBtn" class="p-4 border-2 border-orange-500 rounded-xl font-semibold">
            <i class="fa-solid fa-id-badge text-orange-400"></i> Profil Saya
            </button>  
            
        <a href="index.php?action=logout" class="p-4 bg-red-500 text-red-50 rounded-xl font-semibold text-center"><i class="fa-solid fa-door-open"></i> Logout</a>
        <?php else:?>
        <a href="index.php?action=login" class="p-4 border-2 border-orange-500 text-orange-500 rounded-xl font-semibold"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
        <a href="index.php?action=signup" class="p-4 bg-orange-500 rounded-xl font-semibold"><i class="fa-solid fa-pen-to-square"></i> Sign Up</a>
        <?php endif?>  
    </nav>
</aside>
<?php include __DIR__ . "/../logout-modal.php" ?>  