<!-- ===================== MODAL DETAIL + TRANSAKSI ===================== -->
<div id="modalDetail" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm hidden">
  <div class="relative bg-neutral-900 text-neutral-100 rounded-2xl shadow-2xl w-full max-w-3xl p-6 border border-neutral-800">

    <!-- Tombol Close -->
    <button id="closeModal" class="absolute top-4 right-4 text-orange-500 hover:text-orange-400 text-xl">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- Konten modal -->
    <div id="modalContent" class="flex flex-col gap-6">
      <i class="fa-solid fa-spinner text-orange-500 text-4xl mb-4 animate-spin self-center"></i>
      <p class="text-neutral-400 text-center text-lg font-semibold">Memuat data...</p>
    </div>
  </div>
</div>

<script>
function lihatDetail(id) {
  modal.classList.remove('hidden');
  modalContent.innerHTML = `
    <i class="fa-solid fa-spinner text-orange-500 text-4xl mb-4 self-center animate-spin"></i>
    <p class="text-neutral-400 text-center text-lg font-semibold">Memuat data...</p>
  `;

  // Fetch detail mobil + tipe mobil
  fetch(`index.php?action=detail-mobil&id=${id}`)
    .then(res => res.json())
    .then(data => {
      if (data.error) {
        modalContent.innerHTML = `<p class="text-red-500 text-center">${data.error}</p>`;
        return;
      }

      // Hitung harga default & tampilkan form
      const hargaPerHari = parseFloat(data.harga);

      modalContent.innerHTML = `
        <!-- Header Detail -->
        <div class="flex items-center gap-5 border-b border-neutral-700 pb-4 mb-5">
          <img src="uploads/${data.img}" alt="Mobil" class="w-36 h-24 object-cover rounded-lg shadow-md border border-neutral-700">
          <div>
            <h2 class="text-2xl font-semibold text-orange-500">${data.merk} ${data.model}</h2>
            <p class="text-neutral-400">${data.tahun} • ${data.status} • ${data.bhn_bkr}</p>
          </div>
        </div>

        <!-- Body Detail -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm mb-5">
          <div><p class="text-neutral-400">Merk</p><p class="font-medium">${data.merk}</p></div>
          <div><p class="text-neutral-400">Model</p><p class="font-medium">${data.model}</p></div>
          <div><p class="text-neutral-400">Tipe</p><p class="font-medium">${data.tipe}</p></div>
          <div><p class="text-neutral-400">Jenis</p><p class="font-medium">${data.jenis}</p></div>
          <div><p class="text-neutral-400">Silinder</p><p class="font-medium">${data.silinder} cc</p></div>
          <div><p class="text-neutral-400">Bahan Bakar</p><p class="font-medium">${data.bhn_bkr}</p></div>
          <div><p class="text-neutral-400">Transmisi</p><p class="font-medium">${data.transmisi}</p></div>
          <div><p class="text-neutral-400">Pintu</p><p class="font-medium">${data.pintu}</p></div>
          <div><p class="text-neutral-400">Kursi</p><p class="font-medium">${data.kursi}</p></div>
          <div class="col-span-2 md:col-span-3"><p class="text-neutral-400">Harga</p><p class="text-orange-500 font-bold text-lg">Rp ${hargaPerHari.toLocaleString()}/hari</p></div>
        </div>

        <!-- Form Transaksi -->
        <form id="formTransaksi" class="space-y-5 border-t border-neutral-700 pt-5">
          <input type="hidden" name="id_mobil" value="${data.id_mobil}">
          <input type="hidden" name="id_pelanggan" value="1"> <!-- sesuaikan session user -->
          <input type="hidden" name="id_pegawai" value="1">

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-neutral-400 mb-1">Tanggal Sewa</label>
              <input type="datetime-local" name="tgl_sewa" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
            </div>
            <div>
              <label class="block text-neutral-400 mb-1">Tanggal Kembali</label>
              <input type="datetime-local" name="tgl_kembali" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
            </div>
          </div>

          <div>
            <label class="block text-neutral-400 mb-1">Durasi Sewa (hari)</label>
            <input type="number" name="durasi_sewa" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none" readonly>
          </div>

          <div>
            <label class="block text-neutral-400 mb-1">Total Bayar (Rp)</label>
            <input type="number" name="total_bayar" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none" readonly>
          </div>

          <div class="flex justify-end pt-3">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 px-6 py-2 rounded-lg text-neutral-100 font-medium shadow-md transition-all">Simpan Transaksi</button>
          </div>
        </form>
      `;

      const form = modalContent.querySelector('#formTransaksi');
      const tglSewa = form.querySelector('input[name="tgl_sewa"]');
      const tglKembali = form.querySelector('input[name="tgl_kembali"]');
      const durasiInput = form.querySelector('input[name="durasi_sewa"]');
      const totalBayarInput = form.querySelector('input[name="total_bayar"]');

      function hitungDurasi() {
        if (tglSewa.value && tglKembali.value) {
          const start = new Date(tglSewa.value);
          const end = new Date(tglKembali.value);
          let diff = Math.ceil((end - start) / (1000*60*60*24));
          diff = diff > 0 ? diff : 0;
          durasiInput.value = diff;
          totalBayarInput.value = diff * hargaPerHari;
        }
      }

      tglSewa.addEventListener('change', hitungDurasi);
      tglKembali.addEventListener('change', hitungDurasi);

      form.addEventListener('submit', e => {
        e.preventDefault();
        const formData = new FormData(form);
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        const originalText = submitButton.innerHTML;
        submitButton.innerHTML = 'Menyimpan...';

        fetch('insertTransaksi.php', { method: 'POST', body: formData })
          .then(res => res.json())
          .then(resp => {
            if (resp.success) {
              alert(resp.success);
              modal.classList.add('hidden');
            } else {
              alert(resp.error || 'Terjadi kesalahan saat menyimpan transaksi.');
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

    })
    .catch(err => {
      modalContent.innerHTML = `<p class="text-red-500 text-center">Terjadi kesalahan: ${err}</p>`;
      console.error(err);
    });
}

</script>
