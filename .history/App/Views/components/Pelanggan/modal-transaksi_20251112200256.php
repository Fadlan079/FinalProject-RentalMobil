<!-- ===================== MODAL TRANSAKSI ===================== -->
<div id="modalTransaksi" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm">
  <div class="relative bg-neutral-900 text-neutral-100 rounded-2xl shadow-2xl w-full max-w-2xl p-6 border border-neutral-800">

    <!-- Tombol Close -->
    <button id="closeTransaksi" class="absolute top-4 right-4 text-orange-500 hover:text-orange-400 text-xl">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- Header -->
    <div class="mb-6 border-b border-neutral-700 pb-3">
      <h2 class="text-2xl font-semibold text-orange-500 flex items-center gap-2">
        <i class="fa-solid fa-receipt"></i> Form Transaksi
      </h2>
      <p class="text-neutral-400 text-sm">Lengkapi data penyewaan mobil di bawah ini.</p>
    </div>

    <!-- Form Transaksi -->
    <form id="formTransaksi" class="space-y-5">

      <!-- ID Mobil (hidden, diisi via JS saat pilih mobil) -->
      <input type="hidden" name="id_mobil" id="id_mobil">

      <!-- ID Pelanggan -->
      <div>
        <label class="block text-neutral-400 mb-1">Pelanggan</label>
        <select name="id_pelanggan" id="id_pelanggan"
          class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
          <option value="">-- Pilih Pelanggan --</option>
          <option value="1">Fadlan Firdaus</option>
          <option value="2">Rizky Maulana</option>
          <option value="3">Andi Saputra</option>
        </select>
      </div>

      <!-- ID Pegawai -->
      <div>
        <label class="block text-neutral-400 mb-1">Pegawai</label>
        <select name="id_pegawai" id="id_pegawai"
          class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
          <option value="">-- Pilih Pegawai --</option>
          <option value="1">Admin 1</option>
          <option value="2">Admin 2</option>
        </select>
      </div>

      <!-- Tanggal & Durasi -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-neutral-400 mb-1">Tanggal Sewa</label>
          <input type="datetime-local" name="tgl_sewa" id="tgl_sewa"
            class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
        </div>
        <div>
          <label class="block text-neutral-400 mb-1">Tanggal Kembali</label>
          <input type="datetime-local" name="tgl_kembali" id="tgl_kembali"
            class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
        </div>
      </div>

      <div>
        <label class="block text-neutral-400 mb-1">Durasi Sewa (hari)</label>
        <input type="number" name="durasi_sewa" id="durasi_sewa" min="1"
          class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
      </div>

      <!-- Total Bayar -->
      <div>
        <label class="block text-neutral-400 mb-1">Total Bayar (Rp)</label>
        <input type="number" name="total_bayar" id="total_bayar" step="0.01"
          class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
      </div>

      <!-- Status -->
      <div>
        <label class="block text-neutral-400 mb-1">Status</label>
        <select name="status" id="status"
          class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
          <option value="berjalan">Berjalan</option>
          <option value="selesai">Selesai</option>
          <option value="batal">Batal</option>
        </select>
      </div>

      <!-- Tombol Submit -->
      <div class="flex justify-end pt-3">
        <button type="submit"
          class="bg-orange-500 hover:bg-orange-600 px-6 py-2 rounded-lg text-neutral-100 font-medium shadow-md transition-all">
          Simpan Transaksi
        </button>
      </div>
    </form>
  </div>
</div>

<!-- ===================== SCRIPT HANDLER ===================== -->
<script>
  const modalTransaksi = document.getElementById('modalTransaksi');
  const closeTransaksi = document.getElementById('closeTransaksi');

  // contoh fungsi buka modal (misalnya dari tombol di modal detail)
  function openModalTransaksi(idMobil) {
    document.getElementById('id_mobil').value = idMobil;
    modalTransaksi.classList.remove('hidden');
    modalTransaksi.classList.add('flex');
  }

  // tombol close
  closeTransaksi.addEventListener('click', () => {
    modalTransaksi.classList.add('hidden');
    modalTransaksi.classList.remove('flex');
  });

  // submit form transaksi
  document.getElementById('formTransaksi').addEventListener('submit', e => {
    e.preventDefault();

    const formData = new FormData(e.target);

    fetch('insertTransaksi.php', {
      method: 'POST',
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        alert(data.message || 'Transaksi berhasil disimpan!');
        modalTransaksi.classList.add('hidden');
      })
      .catch(err => console.error(err));
  });
</script>
