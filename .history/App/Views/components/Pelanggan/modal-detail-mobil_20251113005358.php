<!-- ===================== MODAL DETAIL + TRANSAKSI ===================== -->
<div id="modalDetail"class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm hidden p-4">
  <div class="relative bg-neutral-900 text-neutral-100 rounded-2xl shadow-2xl w-full max-w-3xl p-6 border border-neutral-800 max-h-[90vh] overflow-y-auto">

    <button id="closeModal" class="absolute top-4 right-4 text-orange-500 hover:text-orange-400 text-xl">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <div id="modalContent" class="flex flex-col gap-6">
      <i class="fa-solid fa-spinner text-orange-500 text-4xl mb-4 animate-spin self-center"></i>
      <p class="text-neutral-400 text-center text-lg font-semibold">Memuat data...</p>
    </div>
  </div>
</div>

<script>
const modal = document.getElementById('modalDetail');
const modalContent = document.getElementById('modalContent');

document.getElementById('closeModal').addEventListener('click', () => {
  modal.classList.add('hidden');
});

document.querySelectorAll('.btn-detail').forEach(btn => {
  btn.addEventListener('click', () => {
    const id = btn.dataset.id;
    lihatDetail(id);
  });
});

function lihatDetail(id) {
  modal.classList.remove('hidden');
  modalContent.innerHTML = `
    <i class="fa-solid fa-spinner text-orange-500 text-4xl mb-4 self-center animate-spin"></i>
    <p class="text-neutral-400 text-center text-lg font-semibold">Memuat data...</p>
  `;

  fetch(`index.php?action=detail-mobil&id=${id}`)
    .then(res => res.json())
    .then(data => {
      if (data.error) {
        modalContent.innerHTML = `<p class="text-red-500 text-center">${data.error}</p>`;
        return;
      }

      const hargaPerHari = parseFloat(data.harga);

    modalContent.innerHTML = `
        <div class="flex flex-col md:flex-row gap-6 border-b border-neutral-700 pb-4 mb-5">
          <!-- Gambar + Info Utama -->
          <div class="flex-shrink-0">
            <img src="uploads/${data.img}" alt="Mobil" class="w-48 h-32 object-cover rounded-lg shadow-md border border-neutral-700">
          </div>

          <!-- Info Detail -->
          <div class="flex-1 flex flex-col justify-between">
            <!-- Info Utama -->
            <div class="mb-3">
              <h2 class="text-2xl font-semibold text-orange-500">${data.merk} ${data.model}</h2>
              <p class="text-neutral-400">${data.tahun} • ${data.status} • ${data.bhn_bkr}</p>
            </div>

            <!-- Info Teknis -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm text-neutral-400">
              <div><span class="font-medium text-neutral-200">Warna:</span> ${data.warna ?? '-'}</div>
              <div><span class="font-medium text-neutral-200">No. Plat:</span> ${data.noplat}</div>
              <div><span class="font-medium text-neutral-200">No. Mesin:</span> ${data.nomesin}</div>
              <div><span class="font-medium text-neutral-200">No. Rangka:</span> ${data.norangka}</div>
              <div><span class="font-medium text-neutral-200">Tipe:</span> ${data.tipe}</div>
              <div><span class="font-medium text-neutral-200">Jenis:</span> ${data.jenis}</div>
              <div><span class="font-medium text-neutral-200">Silinder:</span> ${data.silinder} cc</div>
              <div><span class="font-medium text-neutral-200">Transmisi:</span> ${data.transmisi}</div>
              <div><span class="font-medium text-neutral-200">Pintu:</span> ${data.pintu}</div>
              <div><span class="font-medium text-neutral-200">Kursi:</span> ${data.kursi}</div>
              <div><span class="font-medium text-neutral-200 text-orange-500 font-semibold">Harga:</span> Rp ${parseFloat(data.harga).toLocaleString()}/hari</div>
            </div>
          </div>
        </div>

        <form id="formTransaksi" class="space-y-5">
          <input type="hidden" name="id_mobil" value="${data.id_mobil}">
          <input type="hidden" name="id_pelanggan" value="<?=  $id_ ?>">
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
