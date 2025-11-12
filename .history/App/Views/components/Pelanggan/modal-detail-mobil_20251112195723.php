<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<!-- Overlay -->
<div id="modalDetail" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm hidden">
  
  <!-- Modal box -->
  <div class="relative bg-neutral-900 text-neutral-100 rounded-2xl shadow-2xl w-full max-w-3xl p-6 border border-neutral-800">
    
    <!-- Close Button -->
    <button id="closeModal" class="absolute top-4 right-4 text-orange-500 hover:text-orange-400 text-xl">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- Header -->
    <div class="flex items-center gap-5 border-b border-neutral-700 pb-4 mb-5">
      <img src="https://via.placeholder.com/150" alt="Mobil" class="w-36 h-24 object-cover rounded-lg shadow-md border border-neutral-700">
      <div>
        <h2 class="text-2xl font-semibold text-orange-500">Toyota Supra</h2>
        <p class="text-neutral-400">2023 • Ready • Bensin</p>
      </div>
    </div>

    <!-- Body -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
      <div>
        <p class="text-neutral-400">Merk</p>
        <p class="font-medium">Toyota</p>
      </div>
      <div>
        <p class="text-neutral-400">Model</p>
        <p class="font-medium">Supra MK5</p>
      </div>
      <div>
        <p class="text-neutral-400">Tipe</p>
        <p class="font-medium">Sport</p>
      </div>
      <div>
        <p class="text-neutral-400">Jenis</p>
        <p class="font-medium">Coupe</p>
      </div>
      <div>
        <p class="text-neutral-400">Silinder</p>
        <p class="font-medium">2998 cc</p>
      </div>
      <div>
        <p class="text-neutral-400">Bahan Bakar</p>
        <p class="font-medium">Bensin</p>
      </div>
      <div>
        <p class="text-neutral-400">Transmisi</p>
        <p class="font-medium">Otomatis</p>
      </div>
      <div>
        <p class="text-neutral-400">Pintu</p>
        <p class="font-medium">2</p>
      </div>
      <div>
        <p class="text-neutral-400">Kursi</p>
        <p class="font-medium">2</p>
      </div>
      <div class="col-span-2 md:col-span-3">
        <p class="text-neutral-400">Harga</p>
        <p class="text-orange-500 font-bold text-lg">Rp 1.500.000.000</p>
      </div>
    </div>

    <!-- Footer -->
    <div class="mt-6 flex justify-end">
      <button class="bg-orange-500 hover:bg-orange-600 text-neutral-100 px-5 py-2 rounded-lg font-medium shadow-md transition-all">
        Sewa Sekarang
      </button>
    </div>
  </div>
</div>