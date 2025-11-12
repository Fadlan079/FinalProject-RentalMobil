<!-- ===================== MODAL DETAIL + TRANSAKSI ===================== -->
<div id="modalDetail" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm hidden">
  <div class="relative bg-neutral-900 text-neutral-100 rounded-2xl shadow-2xl w-full max-w-3xl p-6 border border-neutral-800">

    <!-- Tombol Close -->
    <button id="closeModal" class="absolute top-4 right-4 text-orange-500 hover:text-orange-400 text-xl">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <!-- Konten modal akan diisi via JS -->
    <div id="modalContent" class="flex flex-col gap-6">
      <i class="fa-solid fa-spinner text-orange-500 text-4xl mb-4 animate-spin self-center"></i>
      <p class="text-neutral-400 text-center text-lg font-semibold">Memuat data...</p>
    </div>
  </div>
</div>

<script>
  const modal = document.getElementById('modalDetail');
  const modalContent = document.getElementById('modalContent');

  // Tombol close modal
  document.getElementById('closeModal').addEventListener('click', () => {
    modal.classList.add('hidden');
  });

  // Event tombol detail
  document.querySelectorAll('.btn-detail').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id;
      lihatDetail(id); // panggil AJAX
    });
  });

  function lihatDetail(id) {
    // Tampilkan modal dengan loading
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

        // Isi modal dengan detail mobil + form transaksi
        modalContent.innerHTML = `
          <!-- Header Detail -->
          <div class="flex items-center gap-5 border-b border-neutral-700 pb-4 mb-5">
            <img src="uploads/${data.img}" alt="Mobil" class="w-36 h-24 object-cover rounded-lg shadow-md border border-neutral-700">
            <div>
              <h2 class="text-2xl font-semibold text-orange-500">${data.merk} ${data.model}</h2>
              <p class="text-neutral-400">${data.tahun ?? '2023'} • ${data.status ?? 'Ready'} • ${data.bhn_bkr}</p>
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
            <div class="col-span-2 md:col-span-3"><p class="text-neutral-400">Harga</p><p class="text-orange-500 font-bold text-lg">Rp ${parseInt(data.harga).toLocaleString()}/hari</p></div>
          </div>

          <!-- Form Transaksi -->
          <form id="formTransaksi" class="space-y-5 border-t border-neutral-700 pt-5">
            <input type="hidden" name="id_mobil" value="${data.id}">

            <div>
              <label class="block text-neutral-400 mb-1">Pelanggan</label>
              <select name="id_pelanggan" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
                <option value="">-- Pilih Pelanggan --</option>
                <option value="1">Fadlan Firdaus</option>
                <option value="2">Rizky Maulana</option>
                <option value="3">Andi Saputra</option>
              </select>
            </div>

            <div>
              <label class="block text-neutral-400 mb-1">Pegawai</label>
              <select name="id_pegawai" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
                <option value="">-- Pilih Pegawai --</option>
                <option value="1">Admin 1</option>
                <option value="2">Admin 2</option>
              </select>
            </div>

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
              <input type="number" name="durasi_sewa" min="1" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none" value="1">
            </div>

            <div>
              <label class="block text-neutral-400 mb-1">Total Bayar (Rp)</label>
              <input type="number" name="total_bayar" value="${data.harga}" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none" readonly>
            </div>

            <div>
              <label class="block text-neutral-400 mb-1">Status</label>
              <select name="status" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg p-2 focus:border-orange-500 focus:outline-none">
                <option value="berjalan">Berjalan</option>
                <option value="selesai">Selesai</option>
                <option value="batal">Batal</option>
              </select>
            </div>

            <div class="flex justify-end pt-3">
              <button type="submit" class="bg-orange-500 hover:bg-orange-600 px-6 py-2 rounded-lg text-neutral-100 font-medium shadow-md transition-all">Simpan Transaksi</button>
            </div>
          </form>
        `;

        // Event hitung total bayar
        const durasiInput = modalContent.querySelector('input[name="durasi_sewa"]');
        const totalBayarInput = modalContent.querySelector('input[name="total_bayar"]');
        const hargaPerHari = parseInt(data.harga);

        durasiInput.addEventListener('input', () => {
          const durasi = parseInt(durasiInput.value) || 1;
          totalBayarInput.value = hargaPerHari * durasi;
        });

        // Submit form via AJAX
        const formTransaksi = modalContent.querySelector('#formTransaksi');
        formTransaksi.addEventListener('submit', e => {
          e.preventDefault();
          const formData = new FormData(formTransaksi);

          const submitButton = formTransaksi.querySelector('button[type="submit"]');
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
