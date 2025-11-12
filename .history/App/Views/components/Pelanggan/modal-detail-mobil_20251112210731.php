<div id="modalDetail" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm hidden">
  <div class="relative bg-neutral-900 text-neutral-100 rounded-2xl shadow-2xl w-full max-w-3xl p-6 border border-neutral-800">
    
    <!-- Close Button -->
    <button id="closeModal" class="absolute top-4 right-4 text-orange-500 hover:text-orange-400 text-xl">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- Konten modal akan diisi via JS -->
<div id="modalContent" class="flex flex-col items-center justify-center py-8">
  <i class="fas fa-spinner fa-spin text-orange-500 text-4xl mb-4"></i>
  <p class="text-neutral-400 text-center text-lg font-semibold">Memuat data...</p>
</div>

</div>

<script>
  // Tombol close modal
  document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('modalDetail').classList.add('hidden');
  });

  // 2️⃣ Attach AJAX fetch ke tombol detail
  document.querySelectorAll('.btn-detail').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id;
      lihatDetail(id); // panggil AJAX
    });
  });


  function lihatDetail(id) {
    const modal = document.getElementById('modalDetail');
    const content = document.getElementById('modalContent');

    // Tampilkan modal dulu (loading)
    modal.classList.remove('hidden');
    content.innerHTML = `<p class="text-neutral-400 text-center">Memuat data...</p>`;

    fetch(`index.php?action=detail-mobil&id=${id}`)
      .then(res => res.json())
      .then(data => {
        if (data.error) {
          content.innerHTML = `<p class="text-red-500 text-center">${data.error}</p>`;
          return;
        }

        // Isi modal dengan data JSON
        content.innerHTML = `
          <!-- Header -->
          <div class="flex items-center gap-5 border-b border-neutral-700 pb-4 mb-5">
            <img src="https://via.placeholder.com/150" alt="Mobil" class="w-36 h-24 object-cover rounded-lg shadow-md border border-neutral-700">
            <div>
              <h2 class="text-2xl font-semibold text-orange-500">${data.merk} ${data.model}</h2>
              <p class="text-neutral-400">${data.tahun ?? '2023'} • ${data.status ?? 'Ready'} • ${data.bhn_bkr}</p>
            </div>
          </div>

          <!-- Body -->
          <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
            <div><p class="text-neutral-400">Merk</p><p class="font-medium">${data.merk}</p></div>
            <div><p class="text-neutral-400">Model</p><p class="font-medium">${data.model}</p></div>
            <div><p class="text-neutral-400">Tipe</p><p class="font-medium">${data.tipe}</p></div>
            <div><p class="text-neutral-400">Jenis</p><p class="font-medium">${data.jenis}</p></div>
            <div><p class="text-neutral-400">Silinder</p><p class="font-medium">${data.silinder} cc</p></div>
            <div><p class="text-neutral-400">Bahan Bakar</p><p class="font-medium">${data.bhn_bkr}</p></div>
            <div><p class="text-neutral-400">Transmisi</p><p class="font-medium">${data.transmisi}</p></div>
            <div><p class="text-neutral-400">Pintu</p><p class="font-medium">${data.pintu}</p></div>
            <div><p class="text-neutral-400">Kursi</p><p class="font-medium">${data.kursi}</p></div>
            <div class="col-span-2 md:col-span-3"><p class="text-neutral-400">Harga</p><p class="text-orange-500 font-bold text-lg">Rp ${parseInt(data.harga).toLocaleString()}</p></div>
          </div>

          <!-- Footer -->
          <div class="mt-6 flex justify-end">
            <button class="bg-orange-500 hover:bg-orange-600 text-neutral-100 px-5 py-2 rounded-lg font-medium shadow-md transition-all">
              Sewa Sekarang
            </button>
          </div>
        `;
      })
      .catch(err => {
        content.innerHTML = `<p class="text-red-500 text-center">Terjadi kesalahan: ${err}</p>`;
        console.error(err);
      });
  }
</script>