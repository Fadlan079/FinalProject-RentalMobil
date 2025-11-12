<script>
  const modalTransaksi = document.getElementById('modalTransaksi');
  const closeTransaksi = document.getElementById('closeTransaksi');
  const formTransaksi = document.getElementById('formTransaksi');

  // 1️⃣ Fungsi untuk buka modal transaksi dari tombol Sewa Sekarang
  function openModalTransaksi(idMobil) {
    document.getElementById('id_mobil').value = idMobil; // set id mobil
    modalTransaksi.classList.remove('hidden');
    modalTransaksi.classList.add('flex');
  }

  // 2️⃣ Tombol close modal transaksi
  closeTransaksi.addEventListener('click', () => {
    modalTransaksi.classList.add('hidden');
    modalTransaksi.classList.remove('flex');
    formTransaksi.reset(); // reset form
  });

  // 3️⃣ Submit form transaksi via AJAX
  formTransaksi.addEventListener('submit', e => {
    e.preventDefault();

    const formData = new FormData(formTransaksi);

    // Tambahkan spinner / loading state (opsional)
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
          alert(data.message || 'Transaksi berhasil disimpan!');
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

  // 4️⃣ Integrasi dengan tombol Sewa Sekarang di modal detail
  // Asumsikan modal detail sudah ada dan tombol punya class .btn-sewa
  document.addEventListener('click', function(e) {
    if (e.target.closest('.btn-sewa')) {
      const idMobil = e.target.closest('.btn-sewa').dataset.id; // ambil data-id
      openModalTransaksi(idMobil);
    }
  });
</script>
