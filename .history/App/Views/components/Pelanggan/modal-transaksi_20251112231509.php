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
      <p class="text-neutral-200 mt-2" id="namaMobil"></p>
      <p class="text-orange-400 font-semibold" id="hargaMobil"></p>
    </div>

    <!-- Form Transaksi -->
    <form id="formTransaksi" class="space-y-5">
      <input type="hidden" name="id_mobil" id="id_mobil">

      <!-- ID Pelanggan -->
      <div>
        <label class="block text-neutral-400 mb-1">Pelanggan</label>
        <select name="id_pelanggan" id="id_pelanggan" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
          <option value="">-- Pilih Pelanggan --</option>
          <option value="1">Fadlan Firdaus</option>
          <option value="2">Rizky Maulana</option>
          <option value="3">Andi Saputra</option>
        </select>
      </div>

      <!-- ID Pegawai -->
      <div>
        <label class="block text-neutral-400 mb-1">Pegawai</label>
        <select name="id_pegawai" id="id_pegawai" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
          <option value="">-- Pilih Pegawai --</option>
          <option value="1">Admin 1</option>
          <option value="2">Admin 2</option>
        </select>
      </div>

      <!-- Tanggal & Durasi -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-neutral-400 mb-1">Tanggal Sewa</label>
          <input type="datetime-local" name="tgl_sewa" id="tgl_sewa" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
        </div>
        <div>
          <label class="block text-neutral-400 mb-1">Tanggal Kembali</label>
          <input type="datetime-local" name="tgl_kembali" id="tgl_kembali" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
        </div>
      </div>

      <div>
        <label class="block text-neutral-400 mb-1">Durasi Sewa (hari)</label>
        <input type="number" name="durasi_sewa" id="durasi_sewa" min="1" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
      </div>

      <!-- Total Bayar -->
      <div>
        <label class="block text-neutral-400 mb-1">Total Bayar (Rp)</label>
        <input type="number" name="total_bayar" id="total_bayar" step="0.01" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none" readonly>
      </div>

      <!-- Status -->
      <div>
        <label class="block text-neutral-400 mb-1">Status</label>
        <select name="status" id="status" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
          <option value="berjalan">Berjalan</option>
          <option value="selesai">Selesai</option>
          <option value="batal">Batal</option>
        </select>
      </div>

      <!-- Tombol Submit -->
      <div class="flex justify-end pt-3">
        <button type="submit" class="bg-orange-500 hover:bg-orange-600 px-6 py-2 rounded-lg text-neutral-100 font-medium shadow-md transition-all">
          Simpan Transaksi
        </button>
      </div>
    </form>
  </div>
</div>
<script>
  const modalTransaksi = document.getElementById('modalTransaksi');
  const closeTransaksi = document.getElementById('closeTransaksi');
  const formTransaksi = document.getElementById('formTransaksi');
  const namaMobilEl = document.getElementById('namaMobil');
  const hargaMobilEl = document.getElementById('hargaMobil');
  const totalBayarEl = document.getElementById('total_bayar');
  const durasiEl = document.getElementById('durasi_sewa');

  // 1️⃣ Buka modal dan fetch data mobil
  function openModalTransaksi(idMobil) {
    fetch(`index.php?action=form-transaksi&id=${idMobil}`)
      .then(res => res.json())
      .then(data => {
        document.getElementById('id_mobil').value = data.id;
        namaMobilEl.textContent = `${data.merk} ${data.model}`;
        hargaMobilEl.textContent = `Harga per hari: Rp ${parseInt(data.harga).toLocaleString()}`;
        totalBayarEl.value = data.harga;

        modalTransaksi.classList.remove('hidden');
        modalTransaksi.classList.add('flex');
      })
      .catch(err => console.error(err));
  }

  // 2️⃣ Close modal
  closeTransaksi.addEventListener('click', () => {
    modalTransaksi.classList.add('hidden');
    modalTransaksi.classList.remove('flex');
    formTransaksi.reset();
    namaMobilEl.textContent = '';
    hargaMobilEl.textContent = '';
    totalBayarEl.value = '';
  });

  // 3️⃣ Hitung total bayar otomatis saat durasi diubah
  durasiEl.addEventListener('input', () => {
    const hargaPerHari = parseInt(hargaMobilEl.textContent.replace(/[^0-9]/g, '')) || 0;
    const durasi = parseInt(durasiEl.value) || 1;
    totalBayarEl.value = hargaPerHari * durasi;
  });

  // 4️⃣ Submit form transaksi via AJAX
  formTransaksi.addEventListener('submit', e => {
    e.preventDefault();
    const formData = new FormData(formTransaksi);

    const submitButton = formTransaksi.querySelector('button[type="submit"]');
    submitButton.disabled = true;
    const originalText = submitButton.innerHTML;
    submitButton.innerHTML = 'Menyimpan...';

    fetch('insertTransaksi.php', {
      method: 'POST',
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert(data.success);
          modalTransaksi.classList.add('hidden');
          formTransaksi.reset();
        } else {
          alert(data.error || 'Terjadi kesalahan saat menyimpan transaksi.');
        }
      })
      .catch(err => {
        console.error(err);
        alert('Terjadi kesalahan koneksi.');
      })
      .finally(() => {
        submitButton.disabled = false;
        submitButton.innerHTML = originalText;
      });
  });

  // 5️⃣ Integrasi tombol Sewa Sekarang di modal detail
  document.addEventListener('click', function(e) {
    if (e.target.closest('.btn-sewa')) {
      const idMobil = e.target.closest('.btn-sewa').dataset.id;
      openModalTransaksi(idMobil);
    }
  });
</script>
