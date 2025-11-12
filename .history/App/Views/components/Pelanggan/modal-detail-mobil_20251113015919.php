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
  const idPelanggan = <?= $id_pelanggan ?? 'null' ?>;
</script>

<script>
const modal = document.getElementById('modalDetail');
const modalContent = document.getElementById('modalContent');
const closeModalBtn = document.getElementById('closeModal');

closeModalBtn.addEventListener('click', closeModal);

function closeModal() {
  modal.classList.add('hidden');
  modalContent.innerHTML = `
    <i class="fa-solid fa-spinner text-orange-500 text-4xl mb-4 animate-spin self-center"></i>
    <p class="text-neutral-400 text-center text-lg font-semibold">Memuat data...</p>
  `;
}

// buka modal & load detail
document.querySelectorAll('.btn-detail').forEach(btn => {
  btn.addEventListener('click', () => {
    const id = btn.dataset.id;
    openModal(id);
  });
});

function openModal(id) {
  modal.classList.remove('hidden');

  fetch(`index.php?action=detail-mobil&id=${id}`)
    .then(res => res.json())
    .then(data => {
      if (data.error) {
        modalContent.innerHTML = `<p class="text-red-500 text-center">${data.error}</p>`;
        return;
      }

      const hargaPerHari = parseFloat(data.harga);

      modalContent.innerHTML = `...`; // HTML detail + form seperti sebelumnya

      // Hanya pasang listener submit **sekali per form**
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

      form.addEventListener('submit', async e => {
        e.preventDefault();
        const formData = new FormData(form);
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerText = 'Menyimpan...';

        try {
          const res = await fetch('index.php?action=store-transaksi', { method: 'POST', body: formData });
          const resp = await res.json();
          if (resp.success) {
            alert(resp.success);
            closeModal(); // reset modal & isi
          } else {
            alert(resp.error || 'Terjadi kesalahan saat menyimpan transaksi.');
          }
        } catch(err) {
          console.error(err);
          alert('Terjadi kesalahan koneksi.');
        } finally {
          submitButton.disabled = false;
          submitButton.innerText = 'Simpan Transaksi';
        }
      });

    })
    .catch(err => {
      modalContent.innerHTML = `<p class="text-red-500 text-center">Terjadi kesalahan: ${err}</p>`;
      console.error(err);
    });
}

</script>
