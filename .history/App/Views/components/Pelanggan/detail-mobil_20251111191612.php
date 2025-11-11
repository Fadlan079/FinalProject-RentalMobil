<!-- Modal Sewa -->
<div id="modalSewa" class="fixed inset-0 bg-neutral-900/70 flex items-center justify-center z-50 hidden">
  <div class="bg-neutral-900 border border-orange-500 rounded-2xl p-6 w-full max-w-lg text-neutral-100 shadow-2xl relative">
    
    <button id="closeModal" class="absolute top-3 right-3 text-orange-500 hover:text-orange-400">
      ✕
    </button>
    
    <h2 class="text-2xl font-semibold mb-4 text-orange-500">Form Sewa Mobil</h2>
    
    <form id="formSewa" method="POST">
      <div class="space-y-3">
        <div>
          <label class="block text-sm">Nama Mobil</label>
          <input type="text" id="nama_mobil" name="nama_mobil" readonly
                 class="w-full bg-neutral-800 text-neutral-100 rounded p-2 border border-neutral-700">
        </div>
        
        <div>
          <label class="block text-sm">Tanggal Mulai</label>
          <input type="date" id="tgl_mulai" name="tgl_mulai"
                 class="w-full bg-neutral-800 text-neutral-100 rounded p-2 border border-neutral-700">
        </div>
        
        <div>
          <label class="block text-sm">Tanggal Selesai</label>
          <input type="date" id="tgl_selesai" name="tgl_selesai"
                 class="w-full bg-neutral-800 text-neutral-100 rounded p-2 border border-neutral-700">
        </div>

        <div>
          <label class="block text-sm">Lama Sewa (hari)</label>
          <input type="number" id="lama_sewa" name="lama_sewa" readonly
                 class="w-full bg-neutral-800 text-neutral-100 rounded p-2 border border-neutral-700">
        </div>

        <div>
          <label class="block text-sm">Total Bayar</label>
          <input type="text" id="total_bayar" name="total_bayar" readonly
                 class="w-full bg-neutral-800 text-neutral-100 rounded p-2 border border-neutral-700">
        </div>

        <button type="submit"
                class="w-full bg-orange-600 hover:bg-orange-500 text-neutral-100 rounded-lg p-2 mt-4">
          Konfirmasi Sewa
        </button>
      </div>
    </form>
  </div>
</div>
⚙️ 2. Tambah Tombol “Sewa Sekarang” + Script AJAX
Pastikan di bagian bawah detail-mobil.php (tempat info mobil ditampilkan), kamu punya tombol ini:

<button id="btnSewa" 
        data-id="<?= $mobil['id_mobil']; ?>" 
        data-nama="<?= htmlspecialchars($mobil['nama_mobil']); ?>" 
        data-harga="<?= $mobil['harga_perhari']; ?>"
        class="bg-orange-600 hover:bg-orange-500 text-neutral-100 px-4 py-2 rounded-lg">
  Sewa Sekarang
</button>
Lalu tambahkan script JavaScript di bawah (sebelum </body>):

<script>
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('modalSewa');
  const btnSewa = document.getElementById('btnSewa');
  const closeModal = document.getElementById('closeModal');
  const form = document.getElementById('formSewa');

  const namaMobil = document.getElementById('nama_mobil');
  const tglMulai = document.getElementById('tgl_mulai');
  const tglSelesai = document.getElementById('tgl_selesai');
  const lamaSewa = document.getElementById('lama_sewa');
  const totalBayar = document.getElementById('total_bayar');

  let hargaPerHari = 0;

  // Saat klik tombol "Sewa Sekarang"
  btnSewa.addEventListener('click', () => {
    hargaPerHari = parseInt(btnSewa.dataset.harga);
    namaMobil.value = btnSewa.dataset.nama;

    modal.classList.remove('hidden');
  });

  // Tutup modal
  closeModal.addEventListener('click', () => {
    modal.classList.add('hidden');
  });

  // Hitung otomatis lama sewa dan total bayar
  function hitungTotal() {
    const start = new Date(tglMulai.value);
    const end = new Date(tglSelesai.value);
    if (start && end && end >= start) {
      const diff = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
      lamaSewa.value = diff;
      totalBayar.value = 'Rp ' + (diff * hargaPerHari).toLocaleString('id-ID');
    } else {
      lamaSewa.value = '';
      totalBayar.value = '';
    }
  }

  tglMulai.addEventListener('change', hitungTotal);
  tglSelesai.addEventListener('change', hitungTotal);

  // Submit AJAX (tanpa reload halaman)
  form.addEventListener('submit', e => {
    e.preventDefault();

    const data = new FormData(form);
    data.append('id_mobil', btnSewa.dataset.id);

    fetch('/sewa/store', { // Ganti dengan endpoint controller-mu
      method: 'POST',
      body: data
    })
    .then(res => res.json())
    .then(result => {
      if (result.success) {
        alert('Sewa berhasil!');
        modal.classList.add('hidden');
      } else {
        alert('Gagal menyewa: ' + result.message);
      }
    })
    .catch(err => console.error('Error:', err));
  });
});
</script>
<!-- 