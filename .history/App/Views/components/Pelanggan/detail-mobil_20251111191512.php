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


public function store() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_mobil = $_POST['id_mobil'];
        $tgl_mulai = $_POST['tgl_mulai'];
        $tgl_selesai = $_POST['tgl_selesai'];
        $lama_sewa = $_POST['lama_sewa'];
        $total_bayar = $_POST['total_bayar'];

        $result = $this->Model->insertSewa($id_mobil, $tgl_mulai, $tgl_selesai, $lama_sewa, $total_bayar);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }
}


<?php
require_once __DIR__ . '/../../Config/Database.php';

class Transaksi{
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function Store($id_mobil, $id_pelanggan, $id_pegawai, $tgl_sewa, $tgl_kembali, $durasi_sewa, $total_bayar, $status) {
        try{
            $sql = "INSERT INTO transaksi(id_mobil, id_pelanggan, id_pegawai, tgl_sewa, tgl_kembali, durasi_sewa, total_bayar, status) VALUES (:id_mobil, :id_pelanggan, :id_pegawai, :tgl_sewa, :tgl_kembali, :durasi_sewa, :total_bayar, :status)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id_mobil", $id_mobil);
            $stmt->bindParam(":id_pelanggan", $id_pelanggan);
            $stmt->bindParam(":id_pegawai", $id_pegawai);
            $stmt->bindParam(":tgl_sewa", $tgl_sewa);
            $stmt->bindParam(":tgl_kembali", $tgl_kembali);
            $stmt->bindParam(":durasi_sewa", $durasi_sewa);
            $stmt->bindParam(":total_bayar", $total_bayar);
            $stmt->bindParam(":status", $status);
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Data Gagal Di Tambahkan :" .$e->getMessage();
        }
    }

    public function getTransaksiByPelanggan($id_pelanggan) {
        try{
            $sql = "SELECT * FROM transaksi WHERE id_pelanggan = :id_pelanggan";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_pelanggan' => $id_pelanggan]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Gagal Di Temukan :" .$e->getMessage();
        }
    }

    public function getall($id_pelanggan){
        try{
            $sql = "SELECT 
                    t.id_transaksi,
                    t.tgl_sewa,
                    t.tgl_kembali,
                    t.durasi_sewa,
                    t.total_bayar,
                    t.status,
                    t.tgl_dibuat,
                    m.img,
                    m.tahun,
                    m.warna,
                    m.noplat,
                    p.nama as nama_pelanggan,
                    pg.nama as nama_pegawai
                    FROM transaksi t
                    INNER JOIN mobil m ON t.id_mobil = m.id_mobil
                    INNER JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
                    LEFT JOIN pegawai pg ON t.id_pegawai = pg.id_pegawai 
                    WHERE t.id_pelanggan = :id_pelanggan
                    ORDER BY t.tgl_dibuat DESC";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_pelanggan' => $id_pelanggan]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);  
            
        }catch(PDOException $e){
            error_log("Error getall transaksi: " . $e->getMessage());
            return [];
        }
    }

    public function getLastTransaksiByPelanggan($id_pelanggan) {
        try{
            $sql = "SELECT * FROM transaksi WHERE id_pelanggan = :id_pelanggan ORDER BY tgl_sewa DESC LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_pelanggan' => $id_pelanggan]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Gagal Di Temukan :" .$e->getMessage();
        }
    }

    public function updateStatusMobil($id_mobil, $status) {
        try{
            $sql = "UPDATE mobil SET status = :status WHERE id_mobil = :id_mobil";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":id_mobil", $id_mobil);
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Status Mobil Gagal Di Update :" .$e->getMessage();
        }
    }

    public function updateStatusTransaksi($id_transaksi, $status) {
        try{
            $sql = "UPDATE transaksi SET status = :status WHERE id_transaksi = :id_transaksi";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            return $stmt->execute();
        }catch(PDOException $e){
            echo "Status Transaksi Gagal Di Update :" .$e->getMessage();
        }
    }

    public function getAllTransaksi() {
        try{
            $sql = "SELECT transaksi.*, pelanggan.nama, mobil.noplat, tipemobil.merk, tipemobil.model, tipemobil.tipe
                    FROM transaksi
                    JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
                    JOIN mobil ON transaksi.id_mobil = mobil.id_mobil
                    JOIN tipemobil ON mobil.id_tipe = tipemobil.id_tipe
                    ORDER BY transaksi.tgl_sewa DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Gagal Di Temukan :" .$e->getMessage();
        }
    }

    public function getTransaksiById($id_transaksi) {
        try{
            $sql = "SELECT transaksi.*, pelanggan.nama, mobil.noplat, tipemobil.merk, tipemobil.model, tipemobil.tipe
                    FROM transaksi
                    JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
                    JOIN mobil ON transaksi.id_mobil = mobil.id_mobil
                    JOIN tipemobil ON mobil.id_tipe = tipemobil.id_tipe
                    WHERE transaksi.id_transaksi = :id_transaksi";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_transaksi' => $id_transaksi]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Data Gagal Di Temukan :" .$e->getMessage();
        }
    }
}
?>
ChatGPT said:
Perfect 👌, berarti struktur kamu sudah lengkap banget.
Dari controller dan model ini, kita sudah bisa langsung bikin AJAX modal sewa yang terhubung ke method:

PELENGGANController::buatTransaksi() → buat transaksi baru (POST JSON).

Data mobil bisa langsung diambil dari $detail di detail-mobil.php.

✅ Yang akan kita lakukan
Kita ubah app/views/pelanggan/components/detail-mobil.php agar:

Tombol "Sewa Sekarang" tidak pindah halaman.

Saat diklik → muncul modal form sewa (readonly data mobil + perhitungan otomatis hari & total).

Submit form pakai AJAX ke ?action=buatTransaksi (controller kamu sudah siap).

Styling modal pakai tema:

Background: neutral-900

Text: neutral-100

Accent: orange-500

🧩 Potongan kode siap pakai (untuk detail-mobil.php)
Tambahkan di bawah tombol “Sewa Sekarang”:

<!-- Tombol Sewa -->
<button id="btnSewa"
        data-id="<?= $detail['id_mobil']; ?>"
        data-nama="<?= htmlspecialchars($detail['merk'] . ' ' . $detail['model']); ?>"
        data-harga="<?= $detail['harga_perhari']; ?>"
        data-pelanggan="<?= $profile['id_pelanggan'] ?? ''; ?>"
        class="bg-orange-600 hover:bg-orange-500 text-neutral-100 px-4 py-2 rounded-lg mt-4">
  Sewa Sekarang
</button>

<!-- Modal Sewa -->
<div id="modalSewa" class="fixed inset-0 bg-neutral-900/80 flex items-center justify-center hidden z-50">
  <div class="bg-neutral-900 border border-orange-500 rounded-2xl p-6 w-full max-w-lg text-neutral-100 shadow-2xl relative">
    
    <button id="closeModal" class="absolute top-3 right-3 text-orange-500 hover:text-orange-400">
      ✕
    </button>
    
    <h2 class="text-2xl font-semibold mb-4 text-orange-500">Form Sewa Mobil</h2>
    
    <form id="formSewa">
      <input type="hidden" id="id_mobil" name="id_mobil">
      <input type="hidden" id="id_pelanggan" name="id_pelanggan">
      
      <div class="space-y-3">
        <div>
          <label class="block text-sm">Nama Mobil</label>
          <input type="text" id="nama_mobil" name="nama_mobil" readonly
                 class="w-full bg-neutral-800 border border-neutral-700 rounded p-2">
        </div>

        <div>
          <label class="block text-sm">Harga Sewa / Hari</label>
          <input type="text" id="harga_hari" readonly
                 class="w-full bg-neutral-800 border border-neutral-700 rounded p-2">
        </div>
        
        <div>
          <label class="block text-sm">Tanggal Mulai</label>
          <input type="date" id="tgl_sewa" name="tgl_sewa"
                 class="w-full bg-neutral-800 border border-neutral-700 rounded p-2">
        </div>
        
        <div>
          <label class="block text-sm">Tanggal Selesai</label>
          <input type="date" id="tgl_kembali" name="tgl_kembali"
                 class="w-full bg-neutral-800 border border-neutral-700 rounded p-2">
        </div>

        <div>
          <label class="block text-sm">Durasi (hari)</label>
          <input type="number" id="durasi_sewa" name="durasi_sewa" readonly
                 class="w-full bg-neutral-800 border border-neutral-700 rounded p-2">
        </div>

        <div>
          <label class="block text-sm">Total Bayar</label>
          <input type="text" id="total_bayar" name="total_bayar" readonly
                 class="w-full bg-neutral-800 border border-neutral-700 rounded p-2">
        </div>

        <button type="submit"
                class="w-full bg-orange-600 hover:bg-orange-500 text-neutral-100 rounded-lg p-2 mt-4">
          Konfirmasi Sewa
        </button>
      </div>
    </form>
  </div>
</div>
⚙️ Script JavaScript-nya
Tambahkan di paling bawah halaman (sebelum </body>):

<script>
document.addEventListener('DOMContentLoaded', () => {
  const btnSewa = document.getElementById('btnSewa');
  const modal = document.getElementById('modalSewa');
  const closeModal = document.getElementById('closeModal');
  const form = document.getElementById('formSewa');

  const idMobil = document.getElementById('id_mobil');
  const idPelanggan = document.getElementById('id_pelanggan');
  const namaMobil = document.getElementById('nama_mobil');
  const hargaHari = document.getElementById('harga_hari');
  const tglSewa = document.getElementById('tgl_sewa');
  const tglKembali = document.getElementById('tgl_kembali');
  const durasi = document.getElementById('durasi_sewa');
  const totalBayar = document.getElementById('total_bayar');

  let hargaPerHari = 0;

  // Klik tombol sewa → tampilkan modal
  btnSewa.addEventListener('click', () => {
    idMobil.value = btnSewa.dataset.id;
    idPelanggan.value = btnSewa.dataset.pelanggan;
    namaMobil.value = btnSewa.dataset.nama;
    hargaPerHari = parseInt(btnSewa.dataset.harga);
    hargaHari.value = 'Rp ' + hargaPerHari.toLocaleString('id-ID');

    modal.classList.remove('hidden');
  });

  // Tutup modal
  closeModal.addEventListener('click', () => modal.classList.add('hidden'));

  // Hitung total otomatis
  function hitungTotal() {
    if (!tglSewa.value || !tglKembali.value) return;
    const start = new Date(tglSewa.value);
    const end = new Date(tglKembali.value);
    if (end >= start) {
      const selisih = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
      durasi.value = selisih;
      totalBayar.value = (selisih * hargaPerHari).toLocaleString('id-ID');
    }
  }
  tglSewa.addEventListener('change', hitungTotal);
  tglKembali.addEventListener('change', hitungTotal);

  // Submit AJAX
  form.addEventListener('submit', e => {
    e.preventDefault();
    const data = new FormData(form);

    fetch('?action=buatTransaksi', {
      method: 'POST',
      body: data
    })
    .then(res => res.json())
    .then(result => {
      if (result.success) {
        alert('✅ Transaksi berhasil dibuat!');
        modal.classList.add('hidden');
        window.location.reload(); // reload biar status mobil update
      } else {
        alert('❌ ' + result.message);
      }
    })
    .catch(err => {
      console.error(err);
      alert('Terjadi kesalahan koneksi.');
    });
  });
});
</script>
✨ Hasilnya:
Saat klik “Sewa Sekarang”, langsung muncul modal (tanpa pindah halaman).

Modal menampilkan form yang sudah otomatis isi nama mobil, harga, dan total bayar (readonly).

Saat submit, data dikirim via AJAX ke ?action=buatTransaksi dan hasilnya muncul alert sukses/gagal.

Setelah sukses, halaman reload untuk update status mobil.

Kalau kamu mau, aku bisa buatin versi file lengkap detail-mobil.php siap pakai (gabung HTML + modal + script).
Mau aku tulis full versi final-nya biar bisa langsung replace di project kamu?




No file chosenNo file chosen
ChatGPT can make mistakes. Check important info. See Cookie Preferences.
