Lewati ke konten
Riwayat obrolan

Anda bilang:
<!-- Modal Detail & Form Sewa -->
<div id="modalTransaksi"
     class="hidden fixed inset-0 z-[100] bg-neutral-900/80 flex justify-center items-center text-neutral-100">
  <div class="bg-neutral-900 rounded-2xl w-full max-w-2xl shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-4 border-b border-neutral-700">
      <h2 class="text-xl font-semibold text-neutral-100">Detail Mobil</h2>
      <button id="closeModal"
              class="text-neutral-300 hover:text-neutral-100 text-2xl font-bold">&times;</button>
    </div>

    <!-- Body -->
    <div class="p-6 space-y-6 max-h-[80vh] overflow-y-auto">
      <!-- Detail Mobil -->
      <div class="flex flex-col md:flex-row gap-6">
        <img id="mobilImage" src="uploads/default.svg" alt="Mobil"
             class="w-full md:w-1/3 h-48 object-cover rounded-lg border border-neutral-700">
        <div class="flex-1 grid grid-cols-2 gap-y-2 text-sm text-neutral-100">
          <p><strong>Merk:</strong> <span id="merk">-</span></p>
          <p><strong>Tipe:</strong> <span id="tipe">-</span></p>
          <p><strong>Model:</strong> <span id="model">-</span></p>
          <p><strong>Jenis:</strong> <span id="jenis">-</span></p>
          <p><strong>Tahun:</strong> <span id="tahun">-</span></p>
          <p><strong>Warna:</strong> <span id="warna">-</span></p>
          <p><strong>Transmisi:</strong> <span id="transmisi">-</span></p>
          <p><strong>Bahan Bakar:</strong> <span id="bhn_bkr">-</span></p>
          <p><strong>Silinder:</strong> <span id="silinder">-</span></p>
          <p><strong>Pintu:</strong> <span id="pintu">-</span></p>
          <p><strong>Kursi:</strong> <span id="kursi">-</span></p>
          <p><strong>Status:</strong> <span id="status" class="px-2 py-0.5 rounded text-xs font-semibold">-</span></p>
          <p class="col-span-2"><strong>No Plat:</strong> <span id="noplat">-</span></p>
          <p class="col-span-2"><strong>No Mesin:</strong> <span id="nomesin">-</span></p>
          <p class="col-span-2"><strong>No Rangka:</strong> <span id="norangka">-</span></p>
          <p class="col-span-2"><strong>Harga Sewa / Hari:</strong> Rp <span id="harga">-</span></p>
        </div>
      </div>

      <!-- FORM SEWA -->
      <form id="formSewa" class="border-t border-neutral-700 pt-5 mt-5 space-y-4">
        <h3 class="text-lg font-semibold text-neutral-100">Form Sewa</h3>
        <input type="hidden" id="id_mobil" name="id_mobil" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">
        <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="tgl_sewa" class="block text-sm text-neutral-300">Tanggal Sewa</label>
            <input type="date" id="tgl_sewa" name="tgl_sewa"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
          <div>
            <label for="tgl_kembali" class="block text-sm text-neutral-300">Tanggal Kembali</label>
            <input type="date" id="tgl_kembali" name="tgl_kembali"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
        </div>

        <div>
          <label for="durasi_sewa" class="block text-sm text-neutral-300">Durasi (hari)</label>
          <input type="number" id="durasi_sewa" name="durasi_sewa" min="1"
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" readonly required>
        </div>

        <div>
          <label for="total_bayar" class="block text-sm text-neutral-300">Total Bayar (Rp)</label>
          <input type="text" id="total_bayar" name="total_bayar" readonly
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100">
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-4">
          <button type="button" id="closeModalFooter"
                  class="px-4 py-2 rounded-lg bg-neutral-700 text-neutral-100 hover:bg-neutral-600 transition">
            Batal
          </button>
          <button type="submit"
                  class="px-4 py-2 rounded-lg bg-orange-500 text-neutral-100 hover:bg-orange-600 transition">
            Sewa Sekarang
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const modal = document.getElementById('modalTransaksi');
    const closeModal = document.getElementById('closeModal');
    const closeModalFooter = document.getElementById('closeModalFooter');
    const formSewa = document.getElementById('formSewa');
    const totalBayar = document.getElementById('total_bayar');
    const durasiInput = document.getElementById('durasi_sewa');
    const tglSewaInput = document.getElementById('tgl_sewa');
    const tglKembaliInput = document.getElementById('tgl_kembali');
    let hargaSewaPerHari = 0;

    // Fungsi tampilkan modal
    function showModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        body.classList.add('overflow-hidden');
    }

    // Fungsi reset modal
    function resetModal() {
        formSewa.reset();
        totalBayar.value = '';
        hargaSewaPerHari = 0;

        document.getElementById('mobilImage').src = 'uploads/default.svg';
        document.querySelectorAll('#modalTransaksi span').forEach(span => span.innerText = '-');

        const statusEl = document.getElementById('status');
        statusEl.className = "px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-200 text-gray-700";
    }

    // Fungsi sembunyikan modal
    function hideModal() {
        modal.classList.add('hidden');
        body.classList.remove('overflow-hidden');
        resetModal();
    }

    // Fungsi tampilkan data mobil
    function tampilkanData(data) {
        const mobilImage = document.getElementById('mobilImage');
        mobilImage.src = data.img && data.img.trim() !== '' ? uploads/${data.img} : 'uploads/default.svg';
        mobilImage.onerror = () => mobilImage.src = 'uploads/default.svg';

        document.getElementById('merk').innerText = data.merk;
        document.getElementById('tipe').innerText = data.tipe;
        document.getElementById('model').innerText = data.model;
        document.getElementById('jenis').innerText = data.jenis;
        document.getElementById('tahun').innerText = data.tahun;
        document.getElementById('warna').innerText = data.warna;
        document.getElementById('transmisi').innerText = data.transmisi;
        document.getElementById('bhn_bkr').innerText = data.bhn_bkr;
        document.getElementById('silinder').innerText = data.silinder;
        document.getElementById('pintu').innerText = data.pintu;
        document.getElementById('kursi').innerText = data.kursi;
        document.getElementById('noplat').innerText = data.noplat;
        document.getElementById('nomesin').innerText = data.nomesin;
        document.getElementById('norangka').innerText = data.norangka;
        document.getElementById('harga').innerText = parseFloat(data.harga).toLocaleString('id-ID');
        document.getElementById('id_mobil').value = data.id_mobil;
        hargaSewaPerHari = parseFloat(data.harga);

        const statusEl = document.getElementById('status');
        statusEl.innerText = data.status;
        statusEl.className = "px-2 py-0.5 text-xs font-semibold rounded-full";
        if (data.status === 'ready') statusEl.classList.add('bg-green-100','text-green-700');
        else if (data.status === 'rent') statusEl.classList.add('bg-yellow-100','text-yellow-700');
        else statusEl.classList.add('bg-gray-200','text-gray-700');
    }

    // Event untuk semua tombol sewa
    document.querySelectorAll('.sewa-btn').forEach(btn => {
        btn.addEventListener('click', async e => {
            e.preventDefault();
            const id = btn.dataset.id;
            resetModal();

            try {
                const res = await fetch(index.php?action=store-transaksi-pelanggan&id=${id});
                const data = await res.json();

                if (data.status === 'ok') {
                    tampilkanData(data.data);
                    showModal();
                } else {
                    alert(data.message || 'Terjadi kesalahan mengambil data mobil.');
                }
            } catch (err) {
                console.error(err);
                alert('Gagal memuat data mobil');
                hideModal();
            }
        });
    });

    // Tutup modal
    closeModal.addEventListener('click', hideModal);
    closeModalFooter.addEventListener('click', hideModal);
    modal.addEventListener('click', e => {
        if (e.target === modal) hideModal();
    });

    // Hitung durasi dan total otomatis
    function hitungDurasiDanTotal() {
        const tglSewa = new Date(tglSewaInput.value);
        const tglKembali = new Date(tglKembaliInput.value);

        if (tglSewaInput.value && tglKembaliInput.value) {
            if (tglKembali <= tglSewa) {
                durasiInput.value = '';
                totalBayar.value = '';
                return;
            }
            const diffTime = Math.abs(tglKembali - tglSewa);
            const durasi = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            durasiInput.value = durasi;
            totalBayar.value = hargaSewaPerHari > 0 ? (durasi * hargaSewaPerHari).toLocaleString('id-ID') : '';
        } else {
            durasiInput.value = '';
            totalBayar.value = '';
        }
    }

    tglSewaInput.addEventListener('change', hitungDurasiDanTotal);
    tglKembaliInput.addEventListener('change', hitungDurasiDanTotal);

    // Submit form sewa
    formSewa.addEventListener('submit', async e => {
        e.preventDefault();
        const formData = new FormData(formSewa);

        try {
            const res = await fetch('index.php?action=buat-transaksi', {
                method: 'POST',
                body: formData
            });
            const result = await res.json();

            if (result.success) {
                alert('Transaksi berhasil dibuat!');
                hideModal();
                location.reload();
            } else {
                alert(result.message || 'Gagal membuat transaksi!');
            }
        } catch (err) {
            console.error(err);
            alert('Terjadi kesalahan koneksi!');
        }
    });
});
</script>

cara dia dapat data id mobil gimana?
ChatGPT bilang:
Oke, mari kita teliti script-mu. Fokusnya adalah ini bagian event listener untuk tombol sewa:

document.querySelectorAll('.sewa-btn').forEach(btn => {
    btn.addEventListener('click', async e => {
        e.preventDefault();
        const id = btn.dataset.id; // ← di sini ambil id mobil
        resetModal();

        try {
            const res = await fetch(`index.php?action=store-transaksi-pelanggan&id=${id}`);
            const data = await res.json();
            ...
Penjelasannya:
document.querySelectorAll('.sewa-btn') → mengambil semua tombol dengan class sewa-btn.

btn.dataset.id → mengambil data attribute data-id dari tombol itu.
Jadi di HTML tombolnya harus seperti ini:

<button class="sewa-btn" data-id="123">Sewa</button>
data-id="123" → ini adalah ID mobil yang akan dikirim ke backend.

Variabel id di JS diisi dari situ, kemudian dipakai di URL fetch:

fetch(`index.php?action=store-transaksi-pelanggan&id=${id}`)
Artinya ketika tombol diklik, JS akan memanggil backend (index.php?action=store-transaksi-pelanggan) dan mengirim id mobil melalui query string (?id=123).

💡 Jadi modal itu tidak otomatis tahu ID mobil. ID mobil diambil dari data-id tombol sewa yang diklik. Tanpa data-id di HTML tombol, modal tidak akan tahu mobil mana yang dipilih.

Kalau mau, aku bisa bikin contoh tombol HTML dan cara backend index.php?action=store-transaksi-pelanggan ngambil ID itu. Mau aku buatkan?

Anda bilang:
trus untuk di input hidden nya sewa form gimana?
ChatGPT bilang:
Ah, ini bagian penting supaya form sewa tahu mobil mana yang disewa. Di modal-mu ada:

<input type="hidden" id="id_mobil" name="id_mobil" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">
Nah, awalnya value-nya cuma diisi dengan session (atau kosong). Tapi nanti di JS, ketika kamu menampilkan data mobil (tampilkanData(data)), ada baris ini:

document.getElementById('id_mobil').value = data.id_mobil;
Alurnya:
User klik tombol sewa → JS ambil data-id tombol.

Fetch ke backend → backend kirim JSON berisi detail mobil, termasuk id_mobil.

Fungsi tampilkanData(data) dipanggil → semua span di modal diisi, termasuk hidden input id_mobil.

Jadi ketika user submit form, id_mobil dikirim ke server lewat FormData.

Contoh isi FormData yang dikirim ke backend:

id_mobil=123
id_pelanggan=7
tgl_sewa=2025-11-12
tgl_kembali=2025-11-14
durasi_sewa=2
total_bayar=500000
💡 Intinya, JS mengisi hidden input id_mobil secara otomatis berdasarkan data dari backend, sehingga backend tahu mobil mana yang disewa saat form dikirim.

Kalau mau, aku bisa buatkan diagram alur dari tombol → modal → hidden input → submit supaya lebih jelas. Mau aku buatkan?

Anda bilang:
tapi kok pas submit masih aja data transaksi tidak lengkap ya
Data transaksi tidak lengkap
ChatGPT bilang:
Ah, kalau muncul error “Data transaksi tidak lengkap”, berarti ada beberapa kemungkinan: form tidak mengirim data yang dibutuhkan, atau backend belum menerima/memprosesnya dengan benar. Kita teliti step by step.

1️⃣ Periksa hidden input
Di modal-mu ada:

<input type="hidden" id="id_mobil" name="id_mobil" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">
<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">
id_mobil harusnya diisi oleh JS:

document.getElementById('id_mobil').value = data.id_mobil;
id_pelanggan harusnya dari session. Pastikan session sudah ada dan benar.

✅ Kalau salah satu kosong, backend akan menganggap data tidak lengkap.

2️⃣ Periksa input tanggal
Form butuh:

tgl_sewa
tgl_kembali
durasi_sewa
total_bayar
JS sudah menghitung durasi_sewa & total_bayar otomatis.

Pastikan durasi_sewa memang terisi sebelum submit.

Kalau user submit tanpa memilih tanggal, durasi_sewa kosong → backend akan reject.

3️⃣ Periksa format total_bayar
Kamu menggunakan:

totalBayar.value = (durasi * hargaSewaPerHari).toLocaleString('id-ID');
Ini akan jadi string dengan titik/komma (1.000.000), bukan angka murni.

Jika backend mengharapkan angka (int), ini bisa menyebabkan validasi gagal.

Solusi: pakai angka murni untuk dikirim:

totalBayar.value = durasi * hargaSewaPerHari;
Tampilannya bisa tetap pakai toLocaleString di modal, tapi value input hidden/form diisi angka murni.

4️⃣ Cek submit FormData
Saat submit:

const formData = new FormData(formSewa);
const res = await fetch('index.php?action=buat-transaksi', {
    method: 'POST',
    body: formData
});
Bisa dicek di browser console:

for (let [key, val] of formData.entries()) console.log(key, val);
Pastikan semua key (id_mobil, id_pelanggan, tgl_sewa, tgl_kembali, durasi_sewa, total_bayar) ada dan tidak kosong.

5️⃣ Cek backend
Backend harus mengecek semua field wajib. Misal:

$id_mobil = $_POST['id_mobil'] ?? null;
$id_pelanggan = $_POST['id_pelanggan'] ?? null;
$tgl_sewa = $_POST['tgl_sewa'] ?? null;
$tgl_kembali = $_POST['tgl_kembali'] ?? null;
$durasi = $_POST['durasi_sewa'] ?? null;
$total_bayar = $_POST['total_bayar'] ?? null;

if (!$id_mobil || !$id_pelanggan || !$tgl_sewa || !$tgl_kembali || !$durasi || !$total_bayar) {
    echo json_encode(['success'=>false,'message'=>'Data transaksi tidak lengkap']);
    exit;
}
Jika salah satu field tidak terkirim atau kosong → muncul pesan itu.

💡 Kesimpulan umum:

JS harus mengisi id_mobil dan durasi_sewa sebelum submit.

total_bayar harus dikirim sebagai angka murni.

Pastikan semua input wajib tidak kosong.

Bisa cek FormData sebelum fetch untuk memastikan semua ada.

Kalau mau, aku bisa bikin versi JS-mu yang sudah diperbaiki agar form selalu lengkap dan total_bayar dikirim dengan benar.

Mau aku buatkan langsung?

Anda bilang:
ohh iya ada status belum di masukin 
ChatGPT bilang:
Ah, itu dia! 😅

Kalau status mobil (misal ready/rent) juga dibutuhkan oleh backend untuk transaksi tapi belum dikirim di form, backend pasti menganggap data tidak lengkap.

Solusinya:
Tambahkan hidden input untuk status di form sewa:

<input type="hidden" id="status_mobil" name="status_mobil" value="">
Lalu di JS, saat tampilkanData(data) dipanggil, isi value-nya:

document.getElementById('status_mobil').value = data.status;
Jadi ketika form disubmit, semua data penting sudah terkirim:

id_mobil=123
id_pelanggan=7
tgl_sewa=2025-11-12
tgl_kembali=2025-11-14
durasi_sewa=2
total_bayar=500000
status_mobil=ready
✅ Dengan ini backend tidak akan lagi mengeluh “Data transaksi tidak lengkap”.

Kalau mau, aku bisa langsung edit JS + form agar semua field termasuk status otomatis terkirim. Mau aku buatkan?

Anda bilang:
bukan status mobil tapi status transaksi , berjalan, roses batal
ChatGPT bilang:
Ahh, sekarang jelas 😅. Jadi yang dimaksud status transaksi (berjalan, selesai, batal, dsb), bukan status mobil.

Biasanya status transaksi itu harus dikirim saat membuat transaksi supaya backend tahu transaksi itu baru dibuat, misal default berjalan.

Cara menambahkannya:
Tambahkan hidden input di form:

<input type="hidden" id="status_transaksi" name="status_transaksi" value="berjalan">
value="berjalan" → default, karena transaksi baru otomatis berjalan.

Kalau transaksi bisa langsung dibatalkan, bisa diubah nanti lewat update.

Tidak perlu diisi lewat JS, kecuali mau dinamis.

Saat submit, FormData otomatis akan mengirim:

status_transaksi=berjalan
Backend sekarang bisa menerima semua data lengkap:

$status_transaksi = $_POST['status_transaksi'] ?? 'berjalan';
💡 Kesimpulan:

Hidden input status_transaksi penting supaya backend tahu transaksi baru punya status apa.

Jangan bingung sama status mobil (ready/rent), itu untuk menandai mobil, bukan transaksi.

Kalau mau, aku bisa sekalian buatkan versi form + JS final dengan semua hidden input lengkap (id_mobil, id_pelanggan, status_transaksi) supaya error “data transaksi tidak lengkap” tidak muncul lagi.

Apakah mau aku buatkan versi itu?

Anda bilang:
ini backend nya
<?php
require_once __DIR__ . '/../Models/pelanggan.php';
require_once __DIR__ . '/../Middleware/middleware.php';
require_once __DIR__ . '/../Models/mobil.php';
require_once __DIR__ . '/../Models/transaksi.php';

class PELANGGANController{
    private $model;
    private $mobilmodel;
    private $transaksimodel;

    public function __construct(){
        $this->model = new Pelanggan();   
        $this->mobilmodel = new Mobil(); 
        $this->transaksimodel = new Transaksi(); 
    }

    public function index() {
        $isLoggedIn = Middleware::requireloginOptional(); // bisa login atau tidak
        $id_user = $isLoggedIn ? $_SESSION['user']['id_user'] : null;
        $profile = $id_user ? $this->model->getpelangganbyiduser($id_user) : null;

        $query = $_GET['q'] ?? '';
        $limit = 9;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $harga = $_GET['harga'] ?? null;
        $transmisi = $_GET['transmisi'] ?? null;
        $bhn_bkr = $_GET['bhn_bkr'] ?? null;
        // $kapasitas = $_GET['kapasitas'] ?? null;

        $hasFilter = !empty($harga) || !empty($transmisi) || !empty($bhn_bkr) || !empty($kapasitas);

        if ($hasFilter) {
            $data = $this->mobilmodel->filterMobil($harga, $transmisi, $bhn_bkr, $limit, $offset);
            $totalData = $this->mobilmodel->countFilterMobil($harga, $transmisi, $bhn_bkr);
            $totalPages = ceil($totalData / $limit);
        } elseif (!empty($query)) {
            $data = $this->mobilmodel->searchmobil($query, $limit, $offset);
            $totalData = $this->mobilmodel->countSearchMobil($query);
            $totalPages = ceil($totalData / $limit);
        } else {
            $data = $this->mobilmodel->getMobilWithLimit($limit, $offset);
            $totalData = $this->mobilmodel->countAllMobil();
            $totalPages = ceil($totalData / $limit);
        }

        include __DIR__ . '/../../App/Views/Pelanggan/index.php';
    }
    
    public function Storeprofile(){
        Middleware::requirerole('pelanggan'); 

        $id_user = $_SESSION['user']['id_user'];
        $dataLama = $this->model->getpelangganbyiduser($id_user);

         // 🟩 handle upload foto
        $fotoBaru = $dataLama['pp']; // default: pakai foto lama
        if (isset($_FILES['pp']) && $_FILES['pp']['error'] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['pp']['tmp_name'];
            $fileName = basename($_FILES['pp']['name']);
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

            if (in_array($fileExt, $allowed)) {
                $newName = 'pp_' . uniqid() . '.' . $fileExt;
                $uploadDir = __DIR__ . '/../../Public/uploads/';
                $uploadPath = $uploadDir . $newName;

                if (move_uploaded_file($tmpName, $uploadPath)) {
                    // 🟩 hapus foto lama kalau bukan default.svg
                    if (!empty($dataLama['pp']) && $dataLama['pp'] !== 'default.svg') {
                        $oldPath = $uploadDir . $dataLama['pp'];
                        if (file_exists($oldPath)) unlink($oldPath);
                    }
                    $fotoBaru = $newName;
                }
            }
        }

        $this->model->Updatepelanggan(
            $id_user = $_SESSION['user']['id_user'],
            $nama = $_POST['nama'],
            $nik = $_POST['nik'],
            $alamat = $_POST['alamat'],
            $kelurahan = $_POST['kelurahan'],
            $kecamatan = $_POST['kecamatan'],
            $kabkota = $_POST['kota'],
            $kp = $_POST['kp'],
            $telp = $_POST['telp'],
            $bio = $_POST['bio'],
            $fotoBaru
        );

        header("Location: index.php?action=index");
        exit;
    }

   public function Storetransaksi() {
    header('Content-Type: application/json');

    $id = $_GET['id'] ?? null;
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'Parameter id tidak ditemukan']);
        return;
    }

    $id = (int)$id;

    // Ambil detail mobil tanpa cek login
    $detail = $this->mobilmodel->detailmobil($id);

    if (!$detail) {
        echo json_encode(['status' => 'error', 'message' => 'Mobil tidak ditemukan']);
        return;
    }

    echo json_encode([
        'status' => 'ok',
        'data' => $detail
    ]);
}

public function buatTransaksi() {
    header('Content-Type: application/json');

    $id_mobil = $_POST['id_mobil'] ?? null;
    $id_pelanggan = $_POST['id_pelanggan'] ?? null;
    $id_pegawai = $_SESSION['user']['id_user'] ?? 1;
    $tgl_sewa = $_POST['tgl_sewa'] ?? null;
    $tgl_kembali = $_POST['tgl_kembali'] ?? null;
    $durasi_sewa = $_POST['durasi_sewa'] ?? null;
    $total_bayar = $_POST['total_bayar'] ?? null;
    $status = 'berjalan';

    if (!$id_mobil || !$id_pelanggan || !$tgl_sewa || !$tgl_kembali || !$durasi_sewa || !$total_bayar) {
        echo json_encode(['success' => false, 'message' => 'Data transaksi tidak lengkap']);
        return;
    }

    require_once __DIR__ . '/../Models/Transaksi.php';
    $transaksiModel = new Transaksi();
    $inserted = $transaksiModel->Store($id_mobil, $id_pelanggan, $id_pegawai, $tgl_sewa, $tgl_kembali, str_replace('.', '', $total_bayar), $durasi_sewa, $status);

    if ($inserted) {
        echo json_encode(['success' => true, 'message' => 'Transaksi berhasil dibuat']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan transaksi']);
    }
}


}
?>

<?php 
require_once __DIR__ . "/../../Config/Database.php";

class Transaksi{
    private $pdo;

    public function __construct(){
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function Store($id_mobil,$id_pelanggan,$id_pegawai,$tgl_sewa,$tgl_kembali,$total_bayar,$durasi_sewa,$status){
        try{
            $sql = "INSERT INTO transaksi(id_mobil,id_pelanggan,id_pegawai,tgl_sewa,tgl_kembali,total_bayar,durasi_sewa,status) 
            VALUES(:id_mobil,:id_pelanggan,:id_pegawai,:tgl_sewa,:tgl_kembali,:total_bayar,:durasi_sewa,:status)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id_mobil",$id_mobil);
            $stmt->bindParam(":id_pelanggan",$id_pelanggan);
            $stmt->bindParam(":id_pegawai",$id_pegawai);
            $stmt->bindParam(":tgl_sewa",$tgl_sewa);
            $stmt->bindParam(":tgl_kembali",$tgl_kembali);
            $stmt->bindParam(":total_bayar",$total_bayar);
            $stmt->bindParam(":durasi_sewa",$durasi_sewa);
            $stmt->bindParam(":status",$status);
            return $stmt->execute();
        }catch(PDOException $e){
            die("Gagal Mengeksekusi Query :" . $e->getMessage());
        }
    }

    public function Gettransaksi($id_transaksi){
        try{
            $sql = "SELECT * FROM transaksi WHERE id_transaksi = :id_transaksi";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(["id_transaksi" => $id_transaksi]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        }catch(PDOException $e){
            die("Gagal Mengeksekusi Query :" . $e->getMessage());
        }
    }
}

$transaksi = new Transaksi();
// $transaksi->Store(38,3,1,"2025-11-10 15:09:00","2025-12-10 15:09:00","6000000",2,"berjalan");
// $data = $transaksi->Gettransaksi(1);
// var_dump($data);
?>

<!-- Modal Detail & Form Sewa -->
<div id="modalTransaksi"
     class="hidden fixed inset-0 z-[100] bg-neutral-900/80 flex justify-center items-center text-neutral-100">
  <div class="bg-neutral-900 rounded-2xl w-full max-w-2xl shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-4 border-b border-neutral-700">
      <h2 class="text-xl font-semibold text-neutral-100">Detail Mobil</h2>
      <button id="closeModal"
              class="text-neutral-300 hover:text-neutral-100 text-2xl font-bold">&times;</button>
    </div>

    <!-- Body -->
    <div class="p-6 space-y-6 max-h-[80vh] overflow-y-auto">
      <!-- Detail Mobil -->
      <div class="flex flex-col md:flex-row gap-6">
        <img id="mobilImage" src="uploads/default.svg" alt="Mobil"
             class="w-full md:w-1/3 h-48 object-cover rounded-lg border border-neutral-700">
        <div class="flex-1 grid grid-cols-2 gap-y-2 text-sm text-neutral-100">
          <p><strong>Merk:</strong> <span id="merk">-</span></p>
          <p><strong>Tipe:</strong> <span id="tipe">-</span></p>
          <p><strong>Model:</strong> <span id="model">-</span></p>
          <p><strong>Jenis:</strong> <span id="jenis">-</span></p>
          <p><strong>Tahun:</strong> <span id="tahun">-</span></p>
          <p><strong>Warna:</strong> <span id="warna">-</span></p>
          <p><strong>Transmisi:</strong> <span id="transmisi">-</span></p>
          <p><strong>Bahan Bakar:</strong> <span id="bhn_bkr">-</span></p>
          <p><strong>Silinder:</strong> <span id="silinder">-</span></p>
          <p><strong>Pintu:</strong> <span id="pintu">-</span></p>
          <p><strong>Kursi:</strong> <span id="kursi">-</span></p>
          <p><strong>Status:</strong> <span id="status" class="px-2 py-0.5 rounded text-xs font-semibold">-</span></p>
          <p class="col-span-2"><strong>No Plat:</strong> <span id="noplat">-</span></p>
          <p class="col-span-2"><strong>No Mesin:</strong> <span id="nomesin">-</span></p>
          <p class="col-span-2"><strong>No Rangka:</strong> <span id="norangka">-</span></p>
          <p class="col-span-2"><strong>Harga Sewa / Hari:</strong> Rp <span id="harga">-</span></p>
        </div>
      </div>

      <!-- FORM SEWA -->
      <form id="formSewa" class="border-t border-neutral-700 pt-5 mt-5 space-y-4">
        <h3 class="text-lg font-semibold text-neutral-100">Form Sewa</h3>
        <input type="hidden" id="id_mobil" name="id_mobil">
        <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">
        <input type="hidden" id="status_transaksi" name="status_transaksi" value="berjalan">


        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="tgl_sewa" class="block text-sm text-neutral-300">Tanggal Sewa</label>
            <input type="date" id="tgl_sewa" name="tgl_sewa"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
          <div>
            <label for="tgl_kembali" class="block text-sm text-neutral-300">Tanggal Kembali</label>
            <input type="date" id="tgl_kembali" name="tgl_kembali"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
        </div>

        <div>
          <label for="durasi_sewa" class="block text-sm text-neutral-300">Durasi (hari)</label>
          <input type="number" id="durasi_sewa" name="durasi_sewa" min="1"
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" readonly required>
        </div>

        <div>
          <label for="total_bayar" class="block text-sm text-neutral-300">Total Bayar (Rp)</label>
          <input type="text" id="total_bayar" name="total_bayar" readonly
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100">
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-4">
          <button type="button" id="closeModalFooter"
                  class="px-4 py-2 rounded-lg bg-neutral-700 text-neutral-100 hover:bg-neutral-600 transition">
            Batal
          </button>
          <button type="submit"
                  class="px-4 py-2 rounded-lg bg-orange-500 text-neutral-100 hover:bg-orange-600 transition">
            Sewa Sekarang
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const modal = document.getElementById('modalTransaksi');
    const closeModal = document.getElementById('closeModal');
    const closeModalFooter = document.getElementById('closeModalFooter');
    const formSewa = document.getElementById('formSewa');
    const totalBayar = document.getElementById('total_bayar');
    const durasiInput = document.getElementById('durasi_sewa');
    const tglSewaInput = document.getElementById('tgl_sewa');
    const tglKembaliInput = document.getElementById('tgl_kembali');
    let hargaSewaPerHari = 0;

    // Fungsi tampilkan modal
    function showModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        body.classList.add('overflow-hidden');
    }

    // Fungsi reset modal
    function resetModal() {
        formSewa.reset();
        totalBayar.value = '';
        hargaSewaPerHari = 0;

        document.getElementById('mobilImage').src = 'uploads/default.svg';
        document.querySelectorAll('#modalTransaksi span').forEach(span => span.innerText = '-');

        const statusEl = document.getElementById('status');
        statusEl.className = "px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-200 text-gray-700";
    }

    // Fungsi sembunyikan modal
    function hideModal() {
        modal.classList.add('hidden');
        body.classList.remove('overflow-hidden');
        resetModal();
    }

    // Fungsi tampilkan data mobil
    function tampilkanData(data) {
        const mobilImage = document.getElementById('mobilImage');
        mobilImage.src = data.img && data.img.trim() !== '' ? uploads/${data.img} : 'uploads/default.svg';
        mobilImage.onerror = () => mobilImage.src = 'uploads/default.svg';

        document.getElementById('merk').innerText = data.merk;
        document.getElementById('tipe').innerText = data.tipe;
        document.getElementById('model').innerText = data.model;
        document.getElementById('jenis').innerText = data.jenis;
        document.getElementById('tahun').innerText = data.tahun;
        document.getElementById('warna').innerText = data.warna;
        document.getElementById('transmisi').innerText = data.transmisi;
        document.getElementById('bhn_bkr').innerText = data.bhn_bkr;
        document.getElementById('silinder').innerText = data.silinder;
        document.getElementById('pintu').innerText = data.pintu;
        document.getElementById('kursi').innerText = data.kursi;
        document.getElementById('noplat').innerText = data.noplat;
        document.getElementById('nomesin').innerText = data.nomesin;
        document.getElementById('norangka').innerText = data.norangka;
        document.getElementById('harga').innerText = parseFloat(data.harga).toLocaleString('id-ID');
        document.getElementById('id_mobil').value = data.id_mobil;
        hargaSewaPerHari = parseFloat(data.harga);

        const statusEl = document.getElementById('status');
        statusEl.innerText = data.status;
        statusEl.className = "px-2 py-0.5 text-xs font-semibold rounded-full";
        if (data.status === 'ready') statusEl.classList.add('bg-green-100','text-green-700');
        else if (data.status === 'rent') statusEl.classList.add('bg-yellow-100','text-yellow-700');
        else statusEl.classList.add('bg-gray-200','text-gray-700');
    }

    // Event untuk semua tombol sewa
    document.querySelectorAll('.sewa-btn').forEach(btn => {
        btn.addEventListener('click', async e => {
            e.preventDefault();
            const id = btn.dataset.id;
            resetModal();

            try {
                const res = await fetch(index.php?action=store-transaksi-pelanggan&id=${id});
                const data = await res.json();

                if (data.status === 'ok') {
                    tampilkanData(data.data);
                    showModal();
                } else {
                    alert(data.message || 'Terjadi kesalahan mengambil data mobil.');
                }
            } catch (err) {
                console.error(err);
                alert('Gagal memuat data mobil');
                hideModal();
            }
        });
    });

    // Tutup modal
    closeModal.addEventListener('click', hideModal);
    closeModalFooter.addEventListener('click', hideModal);
    modal.addEventListener('click', e => {
        if (e.target === modal) hideModal();
    });

    // Hitung durasi dan total otomatis
    function hitungDurasiDanTotal() {
        const tglSewa = new Date(tglSewaInput.value);
        const tglKembali = new Date(tglKembaliInput.value);

        if (tglSewaInput.value && tglKembaliInput.value) {
            if (tglKembali <= tglSewa) {
                durasiInput.value = '';
                totalBayar.value = '';
                return;
            }
            const diffTime = Math.abs(tglKembali - tglSewa);
            const durasi = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            durasiInput.value = durasi;
            totalBayar.value = hargaSewaPerHari > 0 ? (durasi * hargaSewaPerHari).toLocaleString('id-ID') : '';
        } else {
            durasiInput.value = '';
            totalBayar.value = '';
        }
    }

    tglSewaInput.addEventListener('change', hitungDurasiDanTotal);
    tglKembaliInput.addEventListener('change', hitungDurasiDanTotal);

    // Submit form sewa
    formSewa.addEventListener('submit', async e => {
        e.preventDefault();
        const formData = new FormData(formSewa);

        try {
            const res = await fetch('index.php?action=buat-transaksi', {
                method: 'POST',
                body: formData
            });
            const result = await res.json();

            if (result.success) {
                alert('Transaksi berhasil dibuat!');
                hideModal();
                location.reload();
            } else {
                alert(result.message || 'Gagal membuat transaksi!');
            }
        } catch (err) {
            console.error(err);
            alert('Terjadi kesalahan koneksi!');
        }
    });
});
</script>

tapi kok tetp ga mau ya sewa mobil
ChatGPT bilang:
Oke, mari kita teliti alur backend + frontend-mu secara detail. Dari kode yang kamu kirim, beberapa hal berpotensi bikin “tidak bisa sewa”:

1️⃣ Format total_bayar
Di JS-mu sekarang:

totalBayar.value = hargaSewaPerHari > 0 ? (durasi * hargaSewaPerHari).toLocaleString('id-ID') : '';
toLocaleString('id-ID') → akan menghasilkan string dengan titik sebagai ribuan, misal: 1.500.000.

Backend PHP:

$inserted = $transaksiModel->Store($id_mobil, $id_pelanggan, $id_pegawai, $tgl_sewa, $tgl_kembali, str_replace('.', '', $total_bayar), $durasi_sewa, $status);
Kamu str_replace('.', '', $total_bayar) → hilangkan titik, tapi jika ada koma (desimal) tetap ada, bisa bikin total_bayar invalid.

Solusi lebih aman: kirim angka murni dari JS:

totalBayar.value = durasi * hargaSewaPerHari; // angka murni
Di modal bisa tetap tampil dengan toLocaleString di span/element lain kalau mau.

2️⃣ id_pelanggan mungkin kosong
Di form:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">
Backend buatTransaksi mengharuskan id_pelanggan.

Pastikan session id_pelanggan benar-benar ada. Kalau null/empty → backend reject data.

Kalau belum login, $_SESSION['id_pelanggan'] bisa kosong → transaksi gagal.

✅ Bisa dicek di console JS sebelum submit:

console.log(document.getElementById('id_pelanggan').value);
3️⃣ durasi_sewa mungkin belum terisi
Fungsi hitungDurasiDanTotal baru dijalankan ketika user memilih tanggal.

Kalau user submit tanpa memilih tanggal atau salah input, durasi kosong → backend reject.

4️⃣ Backend buatTransaksi selalu set status
$status = 'berjalan';
Jadi hidden input status_transaksi tidak perlu dipakai, karena backend sudah default berjalan.

Pastikan backend juga tidak menimpa dengan nilai lain yang kosong.

5️⃣ Fetch ke backend
Kamu submit pakai JS:

const res = await fetch('index.php?action=buat-transaksi', {
    method: 'POST',
    body: formData
});
Pastikan di network tab browser bahwa request POST terkirim, dan semua form data terisi.

Bisa debug:

for (let [key, val] of formData.entries()) console.log(key, val);
Jika salah satu field kosong → backend akan mengembalikan:

{"success":false,"message":"Data transaksi tidak lengkap"}
🔹 Rangkuman paling sering bikin gagal:
id_pelanggan kosong → user belum login atau session salah.

id_mobil belum terisi → JS belum set sebelum submit.

durasi_sewa kosong → tanggal belum diisi atau salah kalkulasi.

total_bayar format string ribuan → backend parsing salah.

Kalau mau, aku bisa buatkan versi modal + JS + form submit yang sudah diperbaiki supaya selalu lengkap, total bayar angka murni, durasi dihitung otomatis, dan transaksi pasti bisa berhasil.

Mau aku buatkan versi itu langsung?

Anda bilang:
<!-- Modal Detail & Form Sewa -->
<div id="modalTransaksi"
     class="hidden fixed inset-0 z-[100] bg-neutral-900/80 flex justify-center items-center text-neutral-100">
  <div class="bg-neutral-900 rounded-2xl w-full max-w-2xl shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-4 border-b border-neutral-700">
      <h2 class="text-xl font-semibold text-neutral-100">Detail Mobil</h2>
      <button id="closeModal"
              class="text-neutral-300 hover:text-neutral-100 text-2xl font-bold">&times;</button>
    </div>

    <!-- Body -->
    <div class="p-6 space-y-6 max-h-[80vh] overflow-y-auto">
      <!-- Detail Mobil -->
      <div class="flex flex-col md:flex-row gap-6">
        <img id="mobilImage" src="uploads/default.svg" alt="Mobil"
             class="w-full md:w-1/3 h-48 object-cover rounded-lg border border-neutral-700">
        <div class="flex-1 grid grid-cols-2 gap-y-2 text-sm text-neutral-100">
          <p><strong>Merk:</strong> <span id="merk">-</span></p>
          <p><strong>Tipe:</strong> <span id="tipe">-</span></p>
          <p><strong>Model:</strong> <span id="model">-</span></p>
          <p><strong>Jenis:</strong> <span id="jenis">-</span></p>
          <p><strong>Tahun:</strong> <span id="tahun">-</span></p>
          <p><strong>Warna:</strong> <span id="warna">-</span></p>
          <p><strong>Transmisi:</strong> <span id="transmisi">-</span></p>
          <p><strong>Bahan Bakar:</strong> <span id="bhn_bkr">-</span></p>
          <p><strong>Silinder:</strong> <span id="silinder">-</span></p>
          <p><strong>Pintu:</strong> <span id="pintu">-</span></p>
          <p><strong>Kursi:</strong> <span id="kursi">-</span></p>
          <p><strong>Status:</strong> <span id="status" class="px-2 py-0.5 rounded text-xs font-semibold">-</span></p>
          <p class="col-span-2"><strong>No Plat:</strong> <span id="noplat">-</span></p>
          <p class="col-span-2"><strong>No Mesin:</strong> <span id="nomesin">-</span></p>
          <p class="col-span-2"><strong>No Rangka:</strong> <span id="norangka">-</span></p>
          <p class="col-span-2"><strong>Harga Sewa / Hari:</strong> Rp <span id="harga">-</span></p>
        </div>
      </div>

      <!-- FORM SEWA -->
      <form id="formSewa" class="border-t border-neutral-700 pt-5 mt-5 space-y-4">
        <h3 class="text-lg font-semibold text-neutral-100">Form Sewa</h3>
        <input type="hidden" id="id_mobil" name="id_mobil">
        <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">
        <input type="hidden" id="status_transaksi" name="status_transaksi" value="berjalan">


        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="tgl_sewa" class="block text-sm text-neutral-300">Tanggal Sewa</label>
            <input type="date" id="tgl_sewa" name="tgl_sewa"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
          <div>
            <label for="tgl_kembali" class="block text-sm text-neutral-300">Tanggal Kembali</label>
            <input type="date" id="tgl_kembali" name="tgl_kembali"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
        </div>

        <div>
          <label for="durasi_sewa" class="block text-sm text-neutral-300">Durasi (hari)</label>
          <input type="number" id="durasi_sewa" name="durasi_sewa" min="1"
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" readonly required>
        </div>

        <div>
          <label for="total_bayar" class="block text-sm text-neutral-300">Total Bayar (Rp)</label>
          <input type="text" id="total_bayar" name="total_bayar" readonly
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100">
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-4">
          <button type="button" id="closeModalFooter"
                  class="px-4 py-2 rounded-lg bg-neutral-700 text-neutral-100 hover:bg-neutral-600 transition">
            Batal
          </button>
          <button type="submit"
                  class="px-4 py-2 rounded-lg bg-orange-500 text-neutral-100 hover:bg-orange-600 transition">
            Sewa Sekarang
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const modal = document.getElementById('modalTransaksi');
    const closeModal = document.getElementById('closeModal');
    const closeModalFooter = document.getElementById('closeModalFooter');
    const formSewa = document.getElementById('formSewa');
    const totalBayar = document.getElementById('total_bayar');
    const durasiInput = document.getElementById('durasi_sewa');
    const tglSewaInput = document.getElementById('tgl_sewa');
    const tglKembaliInput = document.getElementById('tgl_kembali');
    let hargaSewaPerHari = 0;

    // Fungsi tampilkan modal
    function showModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        body.classList.add('overflow-hidden');
    }

    // Fungsi reset modal
    function resetModal() {
        formSewa.reset();
        totalBayar.value = '';
        hargaSewaPerHari = 0;

        document.getElementById('mobilImage').src = 'uploads/default.svg';
        document.querySelectorAll('#modalTransaksi span').forEach(span => span.innerText = '-');

        const statusEl = document.getElementById('status');
        statusEl.className = "px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-200 text-gray-700";
    }

    // Fungsi sembunyikan modal
    function hideModal() {
        modal.classList.add('hidden');
        body.classList.remove('overflow-hidden');
        resetModal();
    }

    // Fungsi tampilkan data mobil
    function tampilkanData(data) {
        const mobilImage = document.getElementById('mobilImage');
        mobilImage.src = data.img && data.img.trim() !== '' ? uploads/${data.img} : 'uploads/default.svg';
        mobilImage.onerror = () => mobilImage.src = 'uploads/default.svg';

        document.getElementById('merk').innerText = data.merk;
        document.getElementById('tipe').innerText = data.tipe;
        document.getElementById('model').innerText = data.model;
        document.getElementById('jenis').innerText = data.jenis;
        document.getElementById('tahun').innerText = data.tahun;
        document.getElementById('warna').innerText = data.warna;
        document.getElementById('transmisi').innerText = data.transmisi;
        document.getElementById('bhn_bkr').innerText = data.bhn_bkr;
        document.getElementById('silinder').innerText = data.silinder;
        document.getElementById('pintu').innerText = data.pintu;
        document.getElementById('kursi').innerText = data.kursi;
        document.getElementById('noplat').innerText = data.noplat;
        document.getElementById('nomesin').innerText = data.nomesin;
        document.getElementById('norangka').innerText = data.norangka;
        document.getElementById('harga').innerText = parseFloat(data.harga).toLocaleString('id-ID');
        document.getElementById('id_mobil').value = data.id_mobil;
        hargaSewaPerHari = parseFloat(data.harga);

        const statusEl = document.getElementById('status');
        statusEl.innerText = data.status;
        statusEl.className = "px-2 py-0.5 text-xs font-semibold rounded-full";
        if (data.status === 'ready') statusEl.classList.add('bg-green-100','text-green-700');
        else if (data.status === 'rent') statusEl.classList.add('bg-yellow-100','text-yellow-700');
        else statusEl.classList.add('bg-gray-200','text-gray-700');
    }

    // Event untuk semua tombol sewa
    document.querySelectorAll('.sewa-btn').forEach(btn => {
        btn.addEventListener('click', async e => {
            e.preventDefault();
            const id = btn.dataset.id;
            resetModal();

            try {
                const res = await fetch(index.php?action=store-transaksi-pelanggan&id=${id});
                const data = await res.json();

                if (data.status === 'ok') {
                    tampilkanData(data.data);
                    showModal();
                } else {
                    alert(data.message || 'Terjadi kesalahan mengambil data mobil.');
                }
            } catch (err) {
                console.error(err);
                alert('Gagal memuat data mobil');
                hideModal();
            }
        });
    });

    // Tutup modal
    closeModal.addEventListener('click', hideModal);
    closeModalFooter.addEventListener('click', hideModal);
    modal.addEventListener('click', e => {
        if (e.target === modal) hideModal();
    });

    // Hitung durasi dan total otomatis
    function hitungDurasiDanTotal() {
        const tglSewa = new Date(tglSewaInput.value);
        const tglKembali = new Date(tglKembaliInput.value);

        if (tglSewaInput.value && tglKembaliInput.value) {
            if (tglKembali <= tglSewa) {
                durasiInput.value = '';
                totalBayar.value = '';
                return;
            }
            const diffTime = Math.abs(tglKembali - tglSewa);
            const durasi = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            durasiInput.value = durasi;
            totalBayar.value = hargaSewaPerHari > 0 ? (durasi * hargaSewaPerHari).toLocaleString('id-ID') : '';
        } else {
            durasiInput.value = '';
            totalBayar.value = '';
        }
    }

    tglSewaInput.addEventListener('change', hitungDurasiDanTotal);
    tglKembaliInput.addEventListener('change', hitungDurasiDanTotal);

    // Submit form sewa
    formSewa.addEventListener('submit', async e => {
        e.preventDefault();
        const formData = new FormData(formSewa);

        try {
            const res = await fetch('index.php?action=buat-transaksi', {
                method: 'POST',
                body: formData
            });
            const result = await res.json();

            if (result.success) {
                alert('Transaksi berhasil dibuat!');
                hideModal();
                location.reload();
            } else {
                alert(result.message || 'Gagal membuat transaksi!');
            }
        } catch (err) {
            console.error(err);
            alert('Terjadi kesalahan koneksi!');
        }
    });
});
</script>


oke ini asli gw ga paham semua kode nya,soalnya pake ajax susha bener

ini juga

   public function Storetransaksi() {
    header('Content-Type: application/json');

    $id = $_GET['id'] ?? null;
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'Parameter id tidak ditemukan']);
        return;
    }

    $id = (int)$id;

    // Ambil detail mobil tanpa cek login
    $detail = $this->mobilmodel->detailmobil($id);

    if (!$detail) {
        echo json_encode(['status' => 'error', 'message' => 'Mobil tidak ditemukan']);
        return;
    }

    echo json_encode([
        'status' => 'ok',
        'data' => $detail
    ]);
}

public function buatTransaksi() {
    header('Content-Type: application/json');

    $id_mobil = $_POST['id_mobil'] ?? null;
    $id_pelanggan = $_POST['id_pelanggan'] ?? null;
    $id_pegawai = $_SESSION['user']['id_user'] ?? 1;
    $tgl_sewa = $_POST['tgl_sewa'] ?? null;
    $tgl_kembali = $_POST['tgl_kembali'] ?? null;
    $durasi_sewa = $_POST['durasi_sewa'] ?? null;
    $total_bayar = $_POST['total_bayar'] ?? null;
    $status = 'berjalan';

    if (!$id_mobil || !$id_pelanggan || !$tgl_sewa || !$tgl_kembali || !$durasi_sewa || !$total_bayar) {
        echo json_encode(['success' => false, 'message' => 'Data transaksi tidak lengkap']);
        return;
    }

    require_once __DIR__ . '/../Models/Transaksi.php';
    $transaksiModel = new Transaksi();
    $inserted = $transaksiModel->Store($id_mobil, $id_pelanggan, $id_pegawai, $tgl_sewa, $tgl_kembali, str_replace('.', '', $total_bayar), $durasi_sewa, $status);

    if ($inserted) {
        echo json_encode(['success' => true, 'message' => 'Transaksi berhasil dibuat']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan transaksi']);
    }
}



reset dah reset, sekarang mulai dari awal buat model controller, views, route sampe kelar lu bantu step by sttep
ChatGPT bilang:
Oke! Kita mulai dari awal dan bikin alur sewa mobil yang pasti jalan, step by step, dari database → model → controller → view → AJAX submit. Aku bakal jelasin tiap step supaya kamu ngerti alurnya. Kita buat versi sederhana tapi lengkap dulu.

STEP 1: Database / Table transaksi
Pastikan tabel transaksi punya kolom lengkap seperti ini:

CREATE TABLE transaksi (
    id_transaksi INT AUTO_INCREMENT PRIMARY KEY,
    id_mobil INT NOT NULL,
    id_pelanggan INT NOT NULL,
    id_pegawai INT NOT NULL,
    tgl_sewa DATE NOT NULL,
    tgl_kembali DATE NOT NULL,
    durasi_sewa INT NOT NULL,
    total_bayar DECIMAL(15,2) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'berjalan',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
Catatan: status default 'berjalan' jadi kalau hidden field terlewat pun backend tetap aman.

STEP 2: Model Transaksi.php
Biar rapi, kita bikin fungsi untuk insert transaksi + ambil transaksi:

<?php 
require_once __DIR__ . "/../../Config/Database.php";

class Transaksi {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    // Insert transaksi
    public function Store($data) {
        try {
            $sql = "INSERT INTO transaksi 
                (id_mobil, id_pelanggan, id_pegawai, tgl_sewa, tgl_kembali, durasi_sewa, total_bayar, status)
                VALUES (:id_mobil, :id_pelanggan, :id_pegawai, :tgl_sewa, :tgl_kembali, :durasi_sewa, :total_bayar, :status)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':id_mobil' => $data['id_mobil'],
                ':id_pelanggan' => $data['id_pelanggan'],
                ':id_pegawai' => $data['id_pegawai'],
                ':tgl_sewa' => $data['tgl_sewa'],
                ':tgl_kembali' => $data['tgl_kembali'],
                ':durasi_sewa' => $data['durasi_sewa'],
                ':total_bayar' => $data['total_bayar'],
                ':status' => $data['status'] ?? 'berjalan'
            ]);
        } catch (PDOException $e) {
            die("Gagal menyimpan transaksi: " . $e->getMessage());
        }
    }

    // Ambil transaksi berdasarkan ID
    public function Get($id_transaksi) {
        $stmt = $this->pdo->prepare("SELECT * FROM transaksi WHERE id_transaksi = :id");
        $stmt->execute([':id' => $id_transaksi]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
STEP 3: Controller PelangganController.php
Kita pisahkan dua endpoint penting:

Ambil detail mobil → AJAX

Buat transaksi → AJAX POST

<?php
require_once __DIR__ . '/../Models/Mobil.php';
require_once __DIR__ . '/../Models/Transaksi.php';

class PelangganController {
    private $mobilModel;
    private $transaksiModel;

    public function __construct() {
        $this->mobilModel = new Mobil();
        $this->transaksiModel = new Transaksi();
    }

    // Ambil detail mobil
    public function Storetransaksi() {
        header('Content-Type: application/json');
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'ID mobil tidak ditemukan']);
            return;
        }

        $detail = $this->mobilModel->detailmobil($id);
        if (!$detail) {
            echo json_encode(['status' => 'error', 'message' => 'Mobil tidak ditemukan']);
            return;
        }

        echo json_encode(['status' => 'ok', 'data' => $detail]);
    }

    // Buat transaksi
    public function buatTransaksi() {
        header('Content-Type: application/json');

        $data = [
            'id_mobil' => $_POST['id_mobil'] ?? null,
            'id_pelanggan' => $_POST['id_pelanggan'] ?? null,
            'id_pegawai' => $_SESSION['user']['id_user'] ?? 1,
            'tgl_sewa' => $_POST['tgl_sewa'] ?? null,
            'tgl_kembali' => $_POST['tgl_kembali'] ?? null,
            'durasi_sewa' => $_POST['durasi_sewa'] ?? null,
            'total_bayar' => $_POST['total_bayar'] ?? null,
            'status' => 'berjalan'
        ];

        // Cek data lengkap
        foreach ($data as $key => $val) {
            if (!$val) {
                echo json_encode(['success' => false, 'message' => "Field $key kosong"]);
                return;
            }
        }

        $inserted = $this->transaksiModel->Store($data);

        if ($inserted) {
            echo json_encode(['success' => true, 'message' => 'Transaksi berhasil dibuat']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan transaksi']);
        }
    }
}
?>
STEP 4: Routes / index.php
Pastikan route AJAX mengarah ke controller:

$action = $_GET['action'] ?? 'index';
$controller = new PelangganController();

switch($action) {
    case 'store-transaksi-pelanggan':
        $controller->Storetransaksi();
        break;
    case 'buat-transaksi':
        $controller->buatTransaksi();
        break;
    default:
        echo "Halaman tidak ditemukan";
}
STEP 5: View (Modal + Form)
Hal penting:

id_mobil → di-set oleh JS saat klik tombol sewa

id_pelanggan → harus ada session

durasi_sewa → dihitung JS otomatis

total_bayar → dikirim angka murni, jangan pakai toLocaleString

JS kalkulasi total bayar murni:

totalBayar.value = durasi * hargaSewaPerHari; // angka murni
Display bisa pakai span lain kalau mau tampil dengan ribuan.

Hidden input status_transaksi bisa dihapus karena backend default 'berjalan'.

Kalau kamu mau, aku bisa buatkan versi modal lengkap + JS AJAX submit yang sudah fix, tinggal copy-paste, pasti langsung jalan.

Apakah mau aku buatkan langsung versi itu?

Anda bilang:
tar tar disini buat apa ada status ok,status error
ChatGPT bilang:
Ah, itu bagian konvensi AJAX / API response. Aku jelasin step by step biar jelas:

Kenapa ada status: ok atau status: error di Storetransaksi()?
echo json_encode([
    'status' => 'ok',
    'data' => $detail
]);
status: ok → menandakan request berhasil, data tersedia.

status: error → request gagal, misal ID mobil tidak ditemukan, atau error lain.

message → biasanya berisi keterangan error yang bisa ditampilkan ke user.

Tujuan:

JS di frontend bisa cek dulu status sebelum menampilkan data.

Contoh di JS:

if (data.status === 'ok') {
    tampilkanData(data.data); // ambil data mobil
    showModal();
} else {
    alert(data.message || 'Terjadi kesalahan');
}
Jadi tidak langsung mengeksekusi data kalau status error, biar aman.

Bedanya dengan buatTransaksi()
echo json_encode(['success' => true, 'message' => 'Transaksi berhasil dibuat']);
Di sini kita pakai success: true/false karena ini aksi POST, bukan ambil data.

Memudahkan JS untuk menampilkan alert atau reload page:

if (result.success) {
    alert('Transaksi berhasil dibuat!');
    hideModal();
    location.reload();
} else {
    alert(result.message || 'Gagal membuat transaksi!');
}
Intinya:

status: ok/error → dipakai untuk GET data / fetch detail mobil

success: true/false → dipakai untuk POST / buat transaksi

Jadi tiap endpoint bisa punya konvensi response yang berbeda sesuai tujuannya.

Kalau mau, aku bisa bikin diagram alur AJAX dari klik tombol → ambil data → submit transaksi → response, biar gampang dimengerti.

Apakah mau aku buatkan diagramnya juga?

Anda bilang:
oke jadi intinya itu emang dari ajax ya,

sekarang lanjut ke bagain views nya + form
ChatGPT bilang:
Oke, kita mulai step by step bagian views + form sewa supaya jelas alurnya. Aku jelasin sambil kita bikin struktur minimal tapi lengkap:

1️⃣ Struktur folder sederhana
App/
 └─ Views/
     └─ Pelanggan/
         └─ index.php        ← daftar mobil
         └─ sewa_modal.php  ← modal detail & form sewa
Kamu bisa pisahkan modal di file tersendiri biar rapi, atau langsung di index.php.

2️⃣ View daftar mobil (index.php)
Ini menampilkan daftar mobil + tombol sewa:

<?php foreach($data as $mobil): ?>
<div class="mobil-card border p-3 rounded mb-3">
    <img src="uploads/<?= $mobil['img'] ?: 'default.svg' ?>" alt="Mobil" class="w-full h-32 object-cover mb-2">
    <h3><?= $mobil['merk'] ?> - <?= $mobil['tipe'] ?></h3>
    <p>Harga: Rp <?= number_format($mobil['harga'],0,',','.') ?>/hari</p>
    <button class="sewa-btn bg-orange-500 px-3 py-1 rounded text-white"
            data-id="<?= $mobil['id_mobil'] ?>">
        Sewa
    </button>
</div>
<?php endforeach; ?>

<!-- include modal -->
<?php include 'sewa_modal.php'; ?>
Tombol .sewa-btn nanti akan memicu AJAX fetch detail mobil.

data-id penting untuk fetch.

3️⃣ Modal detail + form sewa (sewa_modal.php)
Ini hampir sama dengan yang kamu kirim, tapi kita rapikan dan pastikan input hidden lengkap:

<div id="modalTransaksi" class="hidden fixed inset-0 z-100 bg-black/50 flex justify-center items-center">
  <div class="bg-white rounded-lg w-full max-w-2xl p-4">
    <h2 class="text-lg font-semibold mb-4">Detail Mobil</h2>

    <!-- Detail mobil -->
    <div class="grid grid-cols-2 gap-2 mb-4">
        <div>Merk:</div><div id="merk">-</div>
        <div>Tipe:</div><div id="tipe">-</div>
        <div>Harga/hari:</div><div id="harga">-</div>
    </div>

    <!-- Form sewa -->
    <form id="formSewa">
        <input type="hidden" name="id_mobil" id="id_mobil">
        <input type="hidden" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">
        <input type="hidden" name="status" value="berjalan">

        <label>Tanggal Sewa</label>
        <input type="date" name="tgl_sewa" id="tgl_sewa" required>

        <label>Tanggal Kembali</label>
        <input type="date" name="tgl_kembali" id="tgl_kembali" required>

        <label>Durasi (hari)</label>
        <input type="number" name="durasi_sewa" id="durasi_sewa" readonly required>

        <label>Total Bayar</label>
        <input type="text" name="total_bayar" id="total_bayar" readonly>

        <div class="mt-3 flex justify-end gap-2">
            <button type="button" id="closeModal">Batal</button>
            <button type="submit" class="bg-orange-500 text-white px-3 py-1 rounded">Sewa Sekarang</button>
        </div>
    </form>
  </div>
</div>
Catatan:

Input hidden id_mobil, id_pelanggan, dan status wajib diisi.

JS nanti yang mengisi id_mobil saat tombol sewa diklik.

tgl_sewa & tgl_kembali dihitung otomatis durasinya dan total bayar.

4️⃣ JavaScript minimal untuk modal + form
document.querySelectorAll('.sewa-btn').forEach(btn => {
    btn.addEventListener('click', async () => {
        const id = btn.dataset.id;
        const res = await fetch(`index.php?action=store-transaksi-pelanggan&id=${id}`);
        const data = await res.json();

        if (data.status === 'ok') {
            document.getElementById('id_mobil').value = data.data.id_mobil;
            document.getElementById('merk').innerText = data.data.merk;
            document.getElementById('tipe').innerText = data.data.tipe;
            document.getElementById('harga').innerText = data.data.harga;

            document.getElementById('modalTransaksi').classList.remove('hidden');
        } else {
            alert(data.message);
        }
    });
});

// Hitung durasi + total bayar
document.getElementById('tgl_kembali').addEventListener('change', () => {
    const tglSewa = new Date(document.getElementById('tgl_sewa').value);
    const tglKembali = new Date(document.getElementById('tgl_kembali').value);
    const harga = parseFloat(document.getElementById('harga').innerText);

    if (!isNaN(tglSewa) && !isNaN(tglKembali) && tglKembali > tglSewa) {
        const durasi = Math.ceil((tglKembali - tglSewa)/(1000*60*60*24));
        document.getElementById('durasi_sewa').value = durasi;
        document.getElementById('total_bayar').value = (durasi * harga).toLocaleString('id-ID');
    }
});

// Submit form
document.getElementById('formSewa').addEventListener('submit', async e => {
    e.preventDefault();
    const formData = new FormData(e.target);

    const res = await fetch('index.php?action=buat-transaksi', {
        method: 'POST',
        body: formData
    });
    const result = await res.json();

    alert(result.message);
    if (result.success) location.reload();
});
Kalau mau, step selanjutnya kita bisa buat Controller buatTransaksi + Model Transaksi->Store() yang benar-benar minimal tapi siap pakai, supaya tombol sewa bisa langsung jalan.

Aku bisa lanjut buat step itu sekarang.

Mau aku lanjutkan bikin Controller + Model nya juga?

Anda bilang:
<!-- Modal Detail & Form Sewa -->
<div id="modalTransaksi"
     class="hidden fixed inset-0 z-[100] bg-neutral-900/80 flex justify-center items-center text-neutral-100">
  <div class="bg-neutral-900 rounded-2xl w-full max-w-2xl shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-4 border-b border-neutral-700">
      <h2 class="text-xl font-semibold text-neutral-100">Detail Mobil</h2>
      <button id="closeModal"
              class="text-neutral-300 hover:text-neutral-100 text-2xl font-bold">&times;</button>
    </div>

    <!-- Body -->
    <div class="p-6 space-y-6 max-h-[80vh] overflow-y-auto">
      <!-- Detail Mobil -->
      <div class="flex flex-col md:flex-row gap-6">
        <img id="mobilImage" src="uploads/default.svg" alt="Mobil"
             class="w-full md:w-1/3 h-48 object-cover rounded-lg border border-neutral-700">
        <div class="flex-1 grid grid-cols-2 gap-y-2 text-sm text-neutral-100">
          <p><strong>Merk:</strong> <span id="merk">-</span></p>
          <p><strong>Tipe:</strong> <span id="tipe">-</span></p>
          <p><strong>Model:</strong> <span id="model">-</span></p>
          <p><strong>Jenis:</strong> <span id="jenis">-</span></p>
          <p><strong>Tahun:</strong> <span id="tahun">-</span></p>
          <p><strong>Warna:</strong> <span id="warna">-</span></p>
          <p><strong>Transmisi:</strong> <span id="transmisi">-</span></p>
          <p><strong>Bahan Bakar:</strong> <span id="bhn_bkr">-</span></p>
          <p><strong>Silinder:</strong> <span id="silinder">-</span></p>
          <p><strong>Pintu:</strong> <span id="pintu">-</span></p>
          <p><strong>Kursi:</strong> <span id="kursi">-</span></p>
          <p><strong>Status:</strong> <span id="status" class="px-2 py-0.5 rounded text-xs font-semibold">-</span></p>
          <p class="col-span-2"><strong>No Plat:</strong> <span id="noplat">-</span></p>
          <p class="col-span-2"><strong>No Mesin:</strong> <span id="nomesin">-</span></p>
          <p class="col-span-2"><strong>No Rangka:</strong> <span id="norangka">-</span></p>
          <p class="col-span-2"><strong>Harga Sewa / Hari:</strong> Rp <span id="harga">-</span></p>
        </div>
      </div>

      <!-- FORM SEWA -->
      <form id="formSewa" class="border-t border-neutral-700 pt-5 mt-5 space-y-4">
        <h3 class="text-lg font-semibold text-neutral-100">Form Sewa</h3>
        <input type="hidden" id="id_mobil" name="id_mobil">
        <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="tgl_sewa" class="block text-sm text-neutral-300">Tanggal Sewa</label>
            <input type="date" id="tgl_sewa" name="tgl_sewa"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
          <div>
            <label for="tgl_kembali" class="block text-sm text-neutral-300">Tanggal Kembali</label>
            <input type="date" id="tgl_kembali" name="tgl_kembali"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
        </div>

        <div>
          <label for="durasi_sewa" class="block text-sm text-neutral-300">Durasi (hari)</label>
          <input type="number" id="durasi_sewa" name="durasi_sewa" min="1"
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" readonly required>
        </div>

        <div>
          <label for="total_bayar" class="block text-sm text-neutral-300">Total Bayar (Rp)</label>
          <input type="text" id="total_bayar" name="total_bayar" readonly
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100">
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-4">
          <button type="button" id="closeModalFooter"
                  class="px-4 py-2 rounded-lg bg-neutral-700 text-neutral-100 hover:bg-neutral-600 transition">
            Batal
          </button>
          <button type="submit"
                  class="px-4 py-2 rounded-lg bg-orange-500 text-neutral-100 hover:bg-orange-600 transition">
            Sewa Sekarang
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


oke aku pake html css ini aja lu buat kan js nya
ChatGPT bilang:
Oke, kita bikin JavaScript lengkap untuk modal + form sewa berdasarkan HTML/CSS yang kamu pakai. Aku buat versi yang minimal tapi langsung jalan:

document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const modal = document.getElementById('modalTransaksi');
    const closeModal = document.getElementById('closeModal');
    const closeModalFooter = document.getElementById('closeModalFooter');
    const formSewa = document.getElementById('formSewa');
    const totalBayar = document.getElementById('total_bayar');
    const durasiInput = document.getElementById('durasi_sewa');
    const tglSewaInput = document.getElementById('tgl_sewa');
    const tglKembaliInput = document.getElementById('tgl_kembali');
    let hargaSewaPerHari = 0;

    // Fungsi tampilkan modal
    function showModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        body.classList.add('overflow-hidden');
    }

    // Fungsi sembunyikan modal
    function hideModal() {
        modal.classList.add('hidden');
        body.classList.remove('overflow-hidden');
        formSewa.reset();
        totalBayar.value = '';
        durasiInput.value = '';
        hargaSewaPerHari = 0;
        document.getElementById('mobilImage').src = 'uploads/default.svg';
        document.querySelectorAll('#modalTransaksi span').forEach(span => span.innerText = '-');
    }

    // Fungsi tampilkan data mobil ke modal
    function tampilkanData(data) {
        document.getElementById('id_mobil').value = data.id_mobil;
        document.getElementById('merk').innerText = data.merk;
        document.getElementById('tipe').innerText = data.tipe;
        document.getElementById('model').innerText = data.model;
        document.getElementById('jenis').innerText = data.jenis;
        document.getElementById('tahun').innerText = data.tahun;
        document.getElementById('warna').innerText = data.warna;
        document.getElementById('transmisi').innerText = data.transmisi;
        document.getElementById('bhn_bkr').innerText = data.bhn_bkr;
        document.getElementById('silinder').innerText = data.silinder;
        document.getElementById('pintu').innerText = data.pintu;
        document.getElementById('kursi').innerText = data.kursi;
        document.getElementById('noplat').innerText = data.noplat;
        document.getElementById('nomesin').innerText = data.nomesin;
        document.getElementById('norangka').innerText = data.norangka;
        document.getElementById('harga').innerText = parseFloat(data.harga).toLocaleString('id-ID');
        hargaSewaPerHari = parseFloat(data.harga);

        const mobilImage = document.getElementById('mobilImage');
        mobilImage.src = data.img && data.img.trim() !== '' ? `uploads/${data.img}` : 'uploads/default.svg';
        mobilImage.onerror = () => mobilImage.src = 'uploads/default.svg';

        const statusEl = document.getElementById('status');
        statusEl.innerText = data.status;
        statusEl.className = "px-2 py-0.5 rounded text-xs font-semibold";
        if (data.status === 'ready') statusEl.classList.add('bg-green-100','text-green-700');
        else if (data.status === 'rent') statusEl.classList.add('bg-yellow-100','text-yellow-700');
        else statusEl.classList.add('bg-gray-200','text-gray-700');
    }

    // Event tombol sewa
    document.querySelectorAll('.sewa-btn').forEach(btn => {
        btn.addEventListener('click', async (e) => {
            e.preventDefault();
            const id = btn.dataset.id;

            try {
                const res = await fetch(`index.php?action=store-transaksi-pelanggan&id=${id}`);
                const data = await res.json();

                if (data.status === 'ok') {
                    tampilkanData(data.data);
                    showModal();
                } else {
                    alert(data.message || 'Gagal mengambil data mobil');
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan koneksi');
            }
        });
    });

    // Tutup modal
    closeModal.addEventListener('click', hideModal);
    closeModalFooter.addEventListener('click', hideModal);
    modal.addEventListener('click', e => {
        if (e.target === modal) hideModal();
    });

    // Hitung durasi & total bayar otomatis
    function hitungDurasiDanTotal() {
        const tglSewa = new Date(tglSewaInput.value);
        const tglKembali = new Date(tglKembaliInput.value);

        if (tglSewaInput.value && tglKembaliInput.value) {
            if (tglKembali <= tglSewa) {
                durasiInput.value = '';
                totalBayar.value = '';
                return;
            }
            const diffTime = Math.abs(tglKembali - tglSewa);
            const durasi = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            durasiInput.value = durasi;
            totalBayar.value = hargaSewaPerHari > 0 ? (durasi * hargaSewaPerHari).toLocaleString('id-ID') : '';
        } else {
            durasiInput.value = '';
            totalBayar.value = '';
        }
    }

    tglSewaInput.addEventListener('change', hitungDurasiDanTotal);
    tglKembaliInput.addEventListener('change', hitungDurasiDanTotal);

    // Submit form
    formSewa.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(formSewa);

        try {
            const res = await fetch('index.php?action=buat-transaksi', {
                method: 'POST',
                body: formData
            });
            const result = await res.json();

            alert(result.message);
            if (result.success) {
                hideModal();
                location.reload();
            }
        } catch (err) {
            console.error(err);
            alert('Terjadi kesalahan koneksi!');
        }
    });
});
✅ Fitur JS ini:

Modal muncul/tertutup.

Data mobil diambil via fetch (AJAX) dan ditampilkan di modal.

Hitung otomatis durasi + total bayar.

Submit form sewa via AJAX, tidak reload page.

Reset form + modal saat ditutup.

Kalau mau, aku bisa buatkan versi lengkap dengan controller PHP Storetransaksi + buatTransaksi supaya tombol sewa ini langsung jalan end-to-end.

Mau aku lanjut buatkan sekarang?

Anda bilang:
oke tar dimana dia dapat session id_pelanggan?
ChatGPT bilang:
Oke, jadi bagian ini:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">
Itu mengambil id_pelanggan dari session PHP. Artinya:

Saat user login ke website, server PHP menyimpan informasi user di $_SESSION.

Contohnya:

$_SESSION['id_pelanggan'] = $row['id_pelanggan']; // setelah login sukses
Jadi nanti ketika form sewa dikirim, field id_pelanggan otomatis terisi dari session dan dikirim ke controller tanpa user harus mengetik apa-apa.

⚠️ Catatan penting:

Pastikan session sudah session_start() di awal page.

Jika user belum login, $_SESSION['id_pelanggan'] akan kosong, jadi biasanya tombol “Sewa” dikunci atau diarahkan ke login.

Kalau mau, aku bisa bikinkan contoh login sederhana + session supaya form sewa ini otomatis punya id_pelanggan.

Mau aku buatkan?

Anda bilang:
di bagian mana dari kode ku ada itu?perasaan gw nyimpen id user aja
ChatGPT bilang:
Ah iya, aku liat dari kode backend kamu sebelumnya:

Di PELANGGANController kamu cuma nampung id_user dari session:

$id_user = $_SESSION['user']['id_user'] ?? 1;
Belum ada bagian yang menyimpan id_pelanggan langsung ke session. Jadi kalau di form kamu pake:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">
maka nilainya kosong, karena memang $_SESSION['id_pelanggan'] belum pernah di-set.

Itu kenapa transaksi bisa gagal “Data transaksi tidak lengkap” — field id_pelanggan tidak terisi.

Solusi:
Bisa ambil id_pelanggan dari database berdasarkan id_user yang ada di session, misalnya:

$id_user = $_SESSION['user']['id_user'];
$id_pelanggan = $this->model->getpelangganbyiduser($id_user)['id_pelanggan'];
Terus di view, ganti value hidden:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $id_pelanggan ?? '' ?>">
Dengan begitu, form akan otomatis punya id_pelanggan yang valid ketika submit.

Kalau mau, aku bisa bikinkan versi revisi view + JS lengkap yang langsung pakai id_pelanggan ini. Mau aku buatkan?

Anda bilang:
<?php
require_once __DIR__ . '/../Models/pelanggan.php';
require_once __DIR__ . '/../Middleware/middleware.php';
require_once __DIR__ . '/../Models/mobil.php';
require_once __DIR__ . '/../Models/transaksi.php';

class PELANGGANController{
    private $model;
    private $mobilmodel;
    private $transaksimodel;

    public function __construct(){
        $this->model = new Pelanggan();   
        $this->mobilmodel = new Mobil(); 
        $this->transaksimodel = new Transaksi(); 
    }

    public function index() {
        $isLoggedIn = Middleware::requireloginOptional(); // bisa login atau tidak
        $id_user = $isLoggedIn ? $_SESSION['user']['id_user'] : null;
        $profile = $id_user ? $this->model->getpelangganbyiduser($id_user) : null;

        $query = $_GET['q'] ?? '';
        $limit = 9;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $harga = $_GET['harga'] ?? null;
        $transmisi = $_GET['transmisi'] ?? null;
        $bhn_bkr = $_GET['bhn_bkr'] ?? null;
        // $kapasitas = $_GET['kapasitas'] ?? null;

        $hasFilter = !empty($harga) || !empty($transmisi) || !empty($bhn_bkr) || !empty($kapasitas);

        if ($hasFilter) {
            $data = $this->mobilmodel->filterMobil($harga, $transmisi, $bhn_bkr, $limit, $offset);
            $totalData = $this->mobilmodel->countFilterMobil($harga, $transmisi, $bhn_bkr);
            $totalPages = ceil($totalData / $limit);
        } elseif (!empty($query)) {
            $data = $this->mobilmodel->searchmobil($query, $limit, $offset);
            $totalData = $this->mobilmodel->countSearchMobil($query);
            $totalPages = ceil($totalData / $limit);
        } else {
            $data = $this->mobilmodel->getMobilWithLimit($limit, $offset);
            $totalData = $this->mobilmodel->countAllMobil();
            $totalPages = ceil($totalData / $limit);
        }

        include __DIR__ . '/../../App/Views/Pelanggan/index.php';
    }
    
    public function Storeprofile(){
        Middleware::requirerole('pelanggan'); 

        $id_user = $_SESSION['user']['id_user'];
        $dataLama = $this->model->getpelangganbyiduser($id_user);

         // 🟩 handle upload foto
        $fotoBaru = $dataLama['pp']; // default: pakai foto lama
        if (isset($_FILES['pp']) && $_FILES['pp']['error'] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['pp']['tmp_name'];
            $fileName = basename($_FILES['pp']['name']);
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

            if (in_array($fileExt, $allowed)) {
                $newName = 'pp_' . uniqid() . '.' . $fileExt;
                $uploadDir = __DIR__ . '/../../Public/uploads/';
                $uploadPath = $uploadDir . $newName;

                if (move_uploaded_file($tmpName, $uploadPath)) {
                    // 🟩 hapus foto lama kalau bukan default.svg
                    if (!empty($dataLama['pp']) && $dataLama['pp'] !== 'default.svg') {
                        $oldPath = $uploadDir . $dataLama['pp'];
                        if (file_exists($oldPath)) unlink($oldPath);
                    }
                    $fotoBaru = $newName;
                }
            }
        }

        $this->model->Updatepelanggan(
            $id_user = $_SESSION['user']['id_user'],
            $nama = $_POST['nama'],
            $nik = $_POST['nik'],
            $alamat = $_POST['alamat'],
            $kelurahan = $_POST['kelurahan'],
            $kecamatan = $_POST['kecamatan'],
            $kabkota = $_POST['kota'],
            $kp = $_POST['kp'],
            $telp = $_POST['telp'],
            $bio = $_POST['bio'],
            $fotoBaru
        );

        header("Location: index.php?action=index");
        exit;
    }

// Ambil detail mobil
public function Storetransaksi() {
    header('Content-Type: application/json');
    $id = $_GET['id'] ?? null;
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID mobil tidak ditemukan']);
        return;
    }

    $detail = $this->mobilmodel->detailmobil($id);
    if (!$detail) {
        echo json_encode(['status' => 'error', 'message' => 'Mobil tidak ditemukan']);
        return;
    }

    echo json_encode(['status' => 'ok', 'data' => $detail]);
}


// Buat transaksi
public function buatTransaksi() {
    header('Content-Type: application/json');

    $data = [
        'id_mobil' => $_POST['id_mobil'] ?? null,
        'id_pelanggan' => $_POST['id_pelanggan'] ?? null,
        'id_pegawai' => $_SESSION['user']['id_user'] ?? 1,
        'tgl_sewa' => $_POST['tgl_sewa'] ?? null,
        'tgl_kembali' => $_POST['tgl_kembali'] ?? null,
        'durasi_sewa' => $_POST['durasi_sewa'] ?? null,
        'total_bayar' => $_POST['total_bayar'] ?? null,
        'status' => 'berjalan'
    ];

    // Cek data lengkap
    foreach ($data as $key => $val) {
        if (!$val) {
            echo json_encode(['success' => false, 'message' => "Field $key kosong"]);
            return;
        }
    }

    $inserted = $this->transaksimodel->Store(
        $id_mobil = $_POST['id_mobil'] ?? null,
        $id_pelanggan = $_POST['id_pelanggan'] ?? null,
        $id_pegawai = $_SESSION['user']['id_user'] ?? 1,
        $tgl_sewa = $_POST['tgl_sewa'] ?? null,
        $tgl_kembali = $_POST['tgl_kembali'] ?? null,
        $durasi_sewa = $_POST['durasi_sewa'] ?? null,
        $total_bayar = $_POST['total_bayar'] ?? null,
        $status = 'berjalan'
    );

    if ($inserted) {
        echo json_encode(['success' => true, 'message' => 'Transaksi berhasil dibuat']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan transaksi']);
    }
}

}
?>


ada ga? id pelanggan ? kalau ga tambah dimana?
ChatGPT bilang:
Oke, aku periksa kode PELANGGANController yang kamu kirim. Jawaban singkatnya: belum ada id_pelanggan yang langsung disimpan di session.

Yang ada cuma id_user dari session:

$id_user = $_SESSION['user']['id_user'] ?? null;
$profile = $id_user ? $this->model->getpelangganbyiduser($id_user) : null;
Jadi kalau di view kamu pakai:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">
nilai id_pelanggan akan kosong, karena $_SESSION['id_pelanggan'] belum pernah di-set.

Cara menambahkan id_pelanggan
Ambil id_pelanggan dari database berdasarkan id_user:

$id_user = $_SESSION['user']['id_user'];
$profile = $this->model->getpelangganbyiduser($id_user);
$id_pelanggan = $profile['id_pelanggan'] ?? null;
Lalu pass ke view (misal di index()):

include __DIR__ . '/../../App/Views/Pelanggan/index.php';
di view ganti:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $id_pelanggan ?? '' ?>">
Dengan cara ini, form sewa akan otomatis punya id_pelanggan yang valid ketika submit ke buatTransaksi().

Kalau mau, aku bisa buatkan versi revisi lengkap index.php + JS modal yang langsung pakai id_pelanggan ini.

Apakah mau aku buatkan sekarang?

Anda bilang:
        $isLoggedIn = Middleware::requireloginOptional(); // bisa login atau tidak
        $id_user = $isLoggedIn ? $_SESSION['user']['id_user'] : null;
        $profile = $id_user ? $this->model->getpelangganbyiduser($id_user) : null;

ini artinya ap aya
ChatGPT bilang:
Oke, aku jelasin satu per satu baris ini:

$isLoggedIn = Middleware::requireloginOptional(); // bisa login atau tidak
Ini memanggil middleware yang ngecek apakah user login atau nggak.

Karena pakai requireloginOptional(), user boleh login atau tidak.

Hasilnya disimpan di $isLoggedIn, jadi nilainya true kalau login, false/null kalau belum login.

$id_user = $isLoggedIn ? $_SESSION['user']['id_user'] : null;
Ini pakai ternary operator.

Kalau $isLoggedIn true → ambil id_user dari session ($_SESSION['user']['id_user']).

Kalau false → $id_user = null.

Intinya ini nge-set $id_user hanya kalau user sudah login.

$profile = $id_user ? $this->model->getpelangganbyiduser($id_user) : null;
Lagi-lagi ternary operator.

Kalau $id_user ada → panggil model getpelangganbyiduser($id_user) untuk ambil data pelanggan dari database.

Kalau $id_user null → $profile = null.

Jadi hasil akhirnya:

$isLoggedIn → true/false, menandakan user login atau tidak.

$id_user → id user dari session (kalau login) atau null.

$profile → data pelanggan lengkap dari database atau null kalau user belum login.

Kalau mau, aku bisa tulis versi revisi modal form yang otomatis ambil id_pelanggan dari $profile['id_pelanggan'] supaya form sewa bisa langsung jalan.

Mau aku buatkan versi itu sekarang?

Anda bilang:
<?php
require_once __DIR__ . '/../Models/pelanggan.php';
require_once __DIR__ . '/../Middleware/middleware.php';
require_once __DIR__ . '/../Models/mobil.php';
require_once __DIR__ . '/../Models/transaksi.php';

class PELANGGANController{
    private $model;
    private $mobilmodel;
    private $transaksimodel;

    public function __construct(){
        $this->model = new Pelanggan();   
        $this->mobilmodel = new Mobil(); 
        $this->transaksimodel = new Transaksi(); 
    }

    public function index() {
        $isLoggedIn = Middleware::requireloginOptional(); // bisa login atau tidak
        $id_user = $isLoggedIn ? $_SESSION['user']['id_user'] : null;
        $profile = $id_user ? $this->model->getpelangganbyiduser($id_user) : null;
        $id_pelanggan = $profile['id_pelanggan'] ?? Null;

        $query = $_GET['q'] ?? '';
        $limit = 9;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $harga = $_GET['harga'] ?? null;
        $transmisi = $_GET['transmisi'] ?? null;
        $bhn_bkr = $_GET['bhn_bkr'] ?? null;
        // $kapasitas = $_GET['kapasitas'] ?? null;

        $hasFilter = !empty($harga) || !empty($transmisi) || !empty($bhn_bkr) || !empty($kapasitas);

        if ($hasFilter) {
            $data = $this->mobilmodel->filterMobil($harga, $transmisi, $bhn_bkr, $limit, $offset);
            $totalData = $this->mobilmodel->countFilterMobil($harga, $transmisi, $bhn_bkr);
            $totalPages = ceil($totalData / $limit);
        } elseif (!empty($query)) {
            $data = $this->mobilmodel->searchmobil($query, $limit, $offset);
            $totalData = $this->mobilmodel->countSearchMobil($query);
            $totalPages = ceil($totalData / $limit);
        } else {
            $data = $this->mobilmodel->getMobilWithLimit($limit, $offset);
            $totalData = $this->mobilmodel->countAllMobil();
            $totalPages = ceil($totalData / $limit);
        }

        include __DIR__ . '/../../App/Views/Pelanggan/index.php';
    }
    
    public function Storeprofile(){
        Middleware::requirerole('pelanggan'); 

        $id_user = $_SESSION['user']['id_user'];
        $dataLama = $this->model->getpelangganbyiduser($id_user);

         // 🟩 handle upload foto
        $fotoBaru = $dataLama['pp']; // default: pakai foto lama
        if (isset($_FILES['pp']) && $_FILES['pp']['error'] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['pp']['tmp_name'];
            $fileName = basename($_FILES['pp']['name']);
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

            if (in_array($fileExt, $allowed)) {
                $newName = 'pp_' . uniqid() . '.' . $fileExt;
                $uploadDir = __DIR__ . '/../../Public/uploads/';
                $uploadPath = $uploadDir . $newName;

                if (move_uploaded_file($tmpName, $uploadPath)) {
                    // 🟩 hapus foto lama kalau bukan default.svg
                    if (!empty($dataLama['pp']) && $dataLama['pp'] !== 'default.svg') {
                        $oldPath = $uploadDir . $dataLama['pp'];
                        if (file_exists($oldPath)) unlink($oldPath);
                    }
                    $fotoBaru = $newName;
                }
            }
        }

        $this->model->Updatepelanggan(
            $id_user = $_SESSION['user']['id_user'],
            $nama = $_POST['nama'],
            $nik = $_POST['nik'],
            $alamat = $_POST['alamat'],
            $kelurahan = $_POST['kelurahan'],
            $kecamatan = $_POST['kecamatan'],
            $kabkota = $_POST['kota'],
            $kp = $_POST['kp'],
            $telp = $_POST['telp'],
            $bio = $_POST['bio'],
            $fotoBaru
        );

        header("Location: index.php?action=index");
        exit;
    }

// Ambil detail mobil
public function Storetransaksi() {
    header('Content-Type: application/json');
    $id = $_GET['id'] ?? null;
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID mobil tidak ditemukan']);
        return;
    }

    $detail = $this->mobilmodel->detailmobil($id);
    if (!$detail) {
        echo json_encode(['status' => 'error', 'message' => 'Mobil tidak ditemukan']);
        return;
    }

    echo json_encode(['status' => 'ok', 'data' => $detail]);
}


// Buat transaksi
public function buatTransaksi() {
    header('Content-Type: application/json');

    $data = [
        'id_mobil' => $_POST['id_mobil'] ?? null,
        'id_pelanggan' => $_POST['id_pelanggan'] ?? null,
        'id_pegawai' => $_SESSION['user']['id_user'] ?? 1,
        'tgl_sewa' => $_POST['tgl_sewa'] ?? null,
        'tgl_kembali' => $_POST['tgl_kembali'] ?? null,
        'durasi_sewa' => $_POST['durasi_sewa'] ?? null,
        'total_bayar' => $_POST['total_bayar'] ?? null,
        'status' => 'berjalan'
    ];

    // Cek data lengkap
    foreach ($data as $key => $val) {
        if (!$val) {
            echo json_encode(['success' => false, 'message' => "Field $key kosong"]);
            return;
        }
    }

    $inserted = $this->transaksimodel->Store(
        $id_mobil = $_POST['id_mobil'] ?? null,
        $id_pelanggan = $_POST['id_pelanggan'] ?? null,
        $id_pegawai = $_SESSION['user']['id_user'] ?? 1,
        $tgl_sewa = $_POST['tgl_sewa'] ?? null,
        $tgl_kembali = $_POST['tgl_kembali'] ?? null,
        $durasi_sewa = $_POST['durasi_sewa'] ?? null,
        $total_bayar = $_POST['total_bayar'] ?? null,
        $status = 'berjalan'
    );

    if ($inserted) {
        echo json_encode(['success' => true, 'message' => 'Transaksi berhasil dibuat']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan transaksi']);
    }
}

}
?>

udah ku tambah tuh session nya bener ga?
ChatGPT bilang:
Iya, dari kode yang kamu kasih, penambahan id_pelanggan udah bener arahannya, tapi aku jelasin detailnya supaya jelas:

$isLoggedIn = Middleware::requireloginOptional(); // bisa login atau tidak
$id_user = $isLoggedIn ? $_SESSION['user']['id_user'] : null;
$profile = $id_user ? $this->model->getpelangganbyiduser($id_user) : null;
$id_pelanggan = $profile['id_pelanggan'] ?? Null;
$id_user → ambil dari session $_SESSION['user']['id_user'] kalau login. ✅

$profile → ambil data pelanggan dari database pakai id_user. ✅

$id_pelanggan → ambil id_pelanggan dari data profil kalau ada, kalau nggak ada → null. ✅

Jadi sekarang kamu punya $id_pelanggan yang bisa dikirim ke form modal.

Saran tambahan supaya aman:

Di view (index.php atau modal), gunakan:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $id_pelanggan ?? '' ?>">
Dengan ini, form sewa otomatis tahu siapa pelanggan yang sedang login, tanpa harus user input manual.

Jangan lupa cek di controller buatTransaksi() kalau $id_pelanggan masih null → jangan simpan transaksi.

Kalau mau, aku bisa bikinkan versi modal + JS yang otomatis pakai $id_pelanggan ini.
Mau aku buatkan sekarang?

Anda bilang:
tapi pas submit masih aja id pelanggan kosong
ChatGPT bilang:
Ah, itu masalahnya jelas sekarang. 😅

Yang terjadi biasanya karena value $id_pelanggan belum dikirim ke modal form di HTML, atau JS tidak membaca value hidden input dengan benar.

Cek beberapa hal penting:

1️⃣ Pastikan di index.php modal ada input hidden yang benar:
<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $id_pelanggan ?? '' ?>">
$id_pelanggan harus sudah di-define di controller sebelum include view.

Dari kode yang kamu kirim, ini sudah benar.

2️⃣ Pastikan JS tidak menimpa value hidden ini
Di JS kamu ada fungsi resetModal():

function resetModal() {
    formSewa.reset();
    totalBayar.value = '';
    hargaSewaPerHari = 0;

    document.getElementById('mobilImage').src = 'uploads/default.svg';
    document.querySelectorAll('#modalTransaksi span').forEach(span => span.innerText = '-');

    const statusEl = document.getElementById('status');
    statusEl.className = "px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-200 text-gray-700";
}
Masalahnya:

formSewa.reset() → akan mengosongkan semua input, termasuk id_pelanggan.

Jadi saat modal ditampilkan, input hidden jadi kosong.

3️⃣ Cara fix
Ganti resetModal() supaya tidak reset id_pelanggan:

function resetModal() {
    // Simpan id_pelanggan
    const idPelanggan = document.getElementById('id_pelanggan').value;

    formSewa.reset(); // reset input lain
    totalBayar.value = '';
    hargaSewaPerHari = 0;

    document.getElementById('mobilImage').src = 'uploads/default.svg';
    document.querySelectorAll('#modalTransaksi span').forEach(span => span.innerText = '-');

    const statusEl = document.getElementById('status');
    statusEl.className = "px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-200 text-gray-700";

    // kembalikan id_pelanggan
    document.getElementById('id_pelanggan').value = idPelanggan;
}
✅ Dengan ini, saat submit, id_pelanggan tetap ada walaupun modal di-reset.

Kalau mau, aku bisa bikinkan versi JS modal + submit AJAX lengkap yang sudah pasti kirim id_pelanggan ke controller.

Mau aku buatkan sekalian?

Anda bilang:
<!-- Modal Detail & Form Sewa -->
<div id="modalTransaksi"
     class="hidden fixed inset-0 z-[100] bg-neutral-900/80 flex justify-center items-center text-neutral-100">
  <div class="bg-neutral-900 rounded-2xl w-full max-w-2xl shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-4 border-b border-neutral-700">
      <h2 class="text-xl font-semibold text-neutral-100">Detail Mobil</h2>
      <button id="closeModal"
              class="text-neutral-300 hover:text-neutral-100 text-2xl font-bold">&times;</button>
    </div>

    <!-- Body -->
    <div class="p-6 space-y-6 max-h-[80vh] overflow-y-auto">
      <!-- Detail Mobil -->
      <div class="flex flex-col md:flex-row gap-6">
        <img id="mobilImage" src="uploads/default.svg" alt="Mobil"
             class="w-full md:w-1/3 h-48 object-cover rounded-lg border border-neutral-700">
        <div class="flex-1 grid grid-cols-2 gap-y-2 text-sm text-neutral-100">
          <p><strong>Merk:</strong> <span id="merk">-</span></p>
          <p><strong>Tipe:</strong> <span id="tipe">-</span></p>
          <p><strong>Model:</strong> <span id="model">-</span></p>
          <p><strong>Jenis:</strong> <span id="jenis">-</span></p>
          <p><strong>Tahun:</strong> <span id="tahun">-</span></p>
          <p><strong>Warna:</strong> <span id="warna">-</span></p>
          <p><strong>Transmisi:</strong> <span id="transmisi">-</span></p>
          <p><strong>Bahan Bakar:</strong> <span id="bhn_bkr">-</span></p>
          <p><strong>Silinder:</strong> <span id="silinder">-</span></p>
          <p><strong>Pintu:</strong> <span id="pintu">-</span></p>
          <p><strong>Kursi:</strong> <span id="kursi">-</span></p>
          <p><strong>Status:</strong> <span id="status" class="px-2 py-0.5 rounded text-xs font-semibold">-</span></p>
          <p class="col-span-2"><strong>No Plat:</strong> <span id="noplat">-</span></p>
          <p class="col-span-2"><strong>No Mesin:</strong> <span id="nomesin">-</span></p>
          <p class="col-span-2"><strong>No Rangka:</strong> <span id="norangka">-</span></p>
          <p class="col-span-2"><strong>Harga Sewa / Hari:</strong> Rp <span id="harga">-</span></p>
        </div>
      </div>

      <!-- FORM SEWA -->
      <form id="formSewa" class="border-t border-neutral-700 pt-5 mt-5 space-y-4">
        <h3 class="text-lg font-semibold text-neutral-100">Form Sewa</h3>
        <input type="hidden" id="id_mobil" name="id_mobil">
        <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="tgl_sewa" class="block text-sm text-neutral-300">Tanggal Sewa</label>
            <input type="date" id="tgl_sewa" name="tgl_sewa"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
          <div>
            <label for="tgl_kembali" class="block text-sm text-neutral-300">Tanggal Kembali</label>
            <input type="date" id="tgl_kembali" name="tgl_kembali"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
        </div>

        <div>
          <label for="durasi_sewa" class="block text-sm text-neutral-300">Durasi (hari)</label>
          <input type="number" id="durasi_sewa" name="durasi_sewa" min="1"
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" readonly required>
        </div>

        <div>
          <label for="total_bayar" class="block text-sm text-neutral-300">Total Bayar (Rp)</label>
          <input type="text" id="total_bayar" name="total_bayar" readonly
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100">
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-4">
          <button type="button" id="closeModalFooter"
                  class="px-4 py-2 rounded-lg bg-neutral-700 text-neutral-100 hover:bg-neutral-600 transition">
            Batal
          </button>
          <button type="submit"
                  class="px-4 py-2 rounded-lg bg-orange-500 text-neutral-100 hover:bg-orange-600 transition">
            Sewa Sekarang
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const modal = document.getElementById('modalTransaksi');
    const closeModal = document.getElementById('closeModal');
    const closeModalFooter = document.getElementById('closeModalFooter');
    const formSewa = document.getElementById('formSewa');
    const totalBayar = document.getElementById('total_bayar');
    const durasiInput = document.getElementById('durasi_sewa');
    const tglSewaInput = document.getElementById('tgl_sewa');
    const tglKembaliInput = document.getElementById('tgl_kembali');
    let hargaSewaPerHari = 0;

    // Fungsi tampilkan modal
    function showModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        body.classList.add('overflow-hidden');
    }

    // Fungsi sembunyikan modal
    function hideModal() {
        modal.classList.add('hidden');
        body.classList.remove('overflow-hidden');
        formSewa.reset();
        totalBayar.value = '';
        durasiInput.value = '';
        hargaSewaPerHari = 0;
        document.getElementById('mobilImage').src = 'uploads/default.svg';
        document.querySelectorAll('#modalTransaksi span').forEach(span => span.innerText = '-');
    }

    // Fungsi tampilkan data mobil ke modal
    function tampilkanData(data) {
        document.getElementById('id_mobil').value = data.id_mobil;
        document.getElementById('merk').innerText = data.merk;
        document.getElementById('tipe').innerText = data.tipe;
        document.getElementById('model').innerText = data.model;
        document.getElementById('jenis').innerText = data.jenis;
        document.getElementById('tahun').innerText = data.tahun;
        document.getElementById('warna').innerText = data.warna;
        document.getElementById('transmisi').innerText = data.transmisi;
        document.getElementById('bhn_bkr').innerText = data.bhn_bkr;
        document.getElementById('silinder').innerText = data.silinder;
        document.getElementById('pintu').innerText = data.pintu;
        document.getElementById('kursi').innerText = data.kursi;
        document.getElementById('noplat').innerText = data.noplat;
        document.getElementById('nomesin').innerText = data.nomesin;
        document.getElementById('norangka').innerText = data.norangka;
        document.getElementById('harga').innerText = parseFloat(data.harga).toLocaleString('id-ID');
        hargaSewaPerHari = parseFloat(data.harga);

        const mobilImage = document.getElementById('mobilImage');
        mobilImage.src = data.img && data.img.trim() !== '' ? uploads/${data.img} : 'uploads/default.svg';
        mobilImage.onerror = () => mobilImage.src = 'uploads/default.svg';

        const statusEl = document.getElementById('status');
        statusEl.innerText = data.status;
        statusEl.className = "px-2 py-0.5 rounded text-xs font-semibold";
        if (data.status === 'ready') statusEl.classList.add('bg-green-100','text-green-700');
        else if (data.status === 'rent') statusEl.classList.add('bg-yellow-100','text-yellow-700');
        else statusEl.classList.add('bg-gray-200','text-gray-700');
    }

    // Event tombol sewa
    document.querySelectorAll('.sewa-btn').forEach(btn => {
        btn.addEventListener('click', async (e) => {
            e.preventDefault();
            const id = btn.dataset.id;

            try {
                const res = await fetch(index.php?action=store-transaksi-pelanggan&id=${id});
                const data = await res.json();

                if (data.status === 'ok') {
                    tampilkanData(data.data);
                    showModal();
                } else {
                    alert(data.message || 'Gagal mengambil data mobil');
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan koneksi');
            }
        });
    });

    // Tutup modal
    closeModal.addEventListener('click', hideModal);
    closeModalFooter.addEventListener('click', hideModal);
    modal.addEventListener('click', e => {
        if (e.target === modal) hideModal();
    });

    // Hitung durasi & total bayar otomatis
    function hitungDurasiDanTotal() {
        const tglSewa = new Date(tglSewaInput.value);
        const tglKembali = new Date(tglKembaliInput.value);

        if (tglSewaInput.value && tglKembaliInput.value) {
            if (tglKembali <= tglSewa) {
                durasiInput.value = '';
                totalBayar.value = '';
                return;
            }
            const diffTime = Math.abs(tglKembali - tglSewa);
            const durasi = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            durasiInput.value = durasi;
            totalBayar.value = hargaSewaPerHari > 0 ? (durasi * hargaSewaPerHari).toLocaleString('id-ID') : '';
        } else {
            durasiInput.value = '';
            totalBayar.value = '';
        }
    }

    tglSewaInput.addEventListener('change', hitungDurasiDanTotal);
    tglKembaliInput.addEventListener('change', hitungDurasiDanTotal);

    // Submit form
    formSewa.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(formSewa);

        try {
            const res = await fetch('index.php?action=buat-transaksi', {
                method: 'POST',
                body: formData
            });
            const result = await res.json();

            alert(result.message);
            if (result.success) {
                hideModal();
                location.reload();
            }
        } catch (err) {
            console.error(err);
            alert('Terjadi kesalahan koneksi!');
        }
    });
});

</script>


ada yang di ubah?
ChatGPT bilang:
Ahh iya, sekarang jelas kenapa id_pelanggan masih kosong saat submit. 😅

Masalah utama ada di bagian hideModal() / reset form. Saat ini kamu pakai:

function hideModal() {
    modal.classList.add('hidden');
    body.classList.remove('overflow-hidden');
    formSewa.reset(); // ← ini akan reset semua input termasuk id_pelanggan
    totalBayar.value = '';
    durasiInput.value = '';
    hargaSewaPerHari = 0;
    document.getElementById('mobilImage').src = 'uploads/default.svg';
    document.querySelectorAll('#modalTransaksi span').forEach(span => span.innerText = '-');
}
formSewa.reset() otomatis mengosongkan hidden input id_pelanggan sehingga value yang dikirim ke server jadi kosong.

🔹 Solusinya
Ganti hideModal() supaya tidak mereset id_pelanggan:

function hideModal() {
    modal.classList.add('hidden');
    body.classList.remove('overflow-hidden');

    // Simpan id_pelanggan sebelum reset
    const idPelanggan = document.getElementById('id_pelanggan').value;

    // Reset form tapi kembalikan id_pelanggan
    formSewa.reset();
    document.getElementById('id_pelanggan').value = idPelanggan;

    totalBayar.value = '';
    durasiInput.value = '';
    hargaSewaPerHari = 0;
    document.getElementById('mobilImage').src = 'uploads/default.svg';
    document.querySelectorAll('#modalTransaksi span').forEach(span => span.innerText = '-');
}
✅ Dengan ini, saat submit, id_pelanggan tetap ada.

Kalau mau, aku bisa langsung bikin versi final JS modal + submit yang sudah fix, termasuk reset form tapi tetap simpan hidden inputs, dan menghitung total otomatis.

Mau aku buatkan sekalian?

Anda bilang:
<!-- Modal Detail & Form Sewa -->
<div id="modalTransaksi"
     class="hidden fixed inset-0 z-[100] bg-neutral-900/80 flex justify-center items-center text-neutral-100">
  <div class="bg-neutral-900 rounded-2xl w-full max-w-2xl shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-4 border-b border-neutral-700">
      <h2 class="text-xl font-semibold text-neutral-100">Detail Mobil</h2>
      <button id="closeModal"
              class="text-neutral-300 hover:text-neutral-100 text-2xl font-bold">&times;</button>
    </div>

    <!-- Body -->
    <div class="p-6 space-y-6 max-h-[80vh] overflow-y-auto">
      <!-- Detail Mobil -->
      <div class="flex flex-col md:flex-row gap-6">
        <img id="mobilImage" src="uploads/default.svg" alt="Mobil"
             class="w-full md:w-1/3 h-48 object-cover rounded-lg border border-neutral-700">
        <div class="flex-1 grid grid-cols-2 gap-y-2 text-sm text-neutral-100">
          <p><strong>Merk:</strong> <span id="merk">-</span></p>
          <p><strong>Tipe:</strong> <span id="tipe">-</span></p>
          <p><strong>Model:</strong> <span id="model">-</span></p>
          <p><strong>Jenis:</strong> <span id="jenis">-</span></p>
          <p><strong>Tahun:</strong> <span id="tahun">-</span></p>
          <p><strong>Warna:</strong> <span id="warna">-</span></p>
          <p><strong>Transmisi:</strong> <span id="transmisi">-</span></p>
          <p><strong>Bahan Bakar:</strong> <span id="bhn_bkr">-</span></p>
          <p><strong>Silinder:</strong> <span id="silinder">-</span></p>
          <p><strong>Pintu:</strong> <span id="pintu">-</span></p>
          <p><strong>Kursi:</strong> <span id="kursi">-</span></p>
          <p><strong>Status:</strong> <span id="status" class="px-2 py-0.5 rounded text-xs font-semibold">-</span></p>
          <p class="col-span-2"><strong>No Plat:</strong> <span id="noplat">-</span></p>
          <p class="col-span-2"><strong>No Mesin:</strong> <span id="nomesin">-</span></p>
          <p class="col-span-2"><strong>No Rangka:</strong> <span id="norangka">-</span></p>
          <p class="col-span-2"><strong>Harga Sewa / Hari:</strong> Rp <span id="harga">-</span></p>
        </div>
      </div>

      <!-- FORM SEWA -->
      <form id="formSewa" class="border-t border-neutral-700 pt-5 mt-5 space-y-4">
        <h3 class="text-lg font-semibold text-neutral-100">Form Sewa</h3>
        <input type="hidden" id="id_mobil" name="id_mobil">
        <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="tgl_sewa" class="block text-sm text-neutral-300">Tanggal Sewa</label>
            <input type="date" id="tgl_sewa" name="tgl_sewa"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
          <div>
            <label for="tgl_kembali" class="block text-sm text-neutral-300">Tanggal Kembali</label>
            <input type="date" id="tgl_kembali" name="tgl_kembali"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
        </div>

        <div>
          <label for="durasi_sewa" class="block text-sm text-neutral-300">Durasi (hari)</label>
          <input type="number" id="durasi_sewa" name="durasi_sewa" min="1"
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" readonly required>
        </div>

        <div>
          <label for="total_bayar" class="block text-sm text-neutral-300">Total Bayar (Rp)</label>
          <input type="text" id="total_bayar" name="total_bayar" readonly
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100">
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-4">
          <button type="button" id="closeModalFooter"
                  class="px-4 py-2 rounded-lg bg-neutral-700 text-neutral-100 hover:bg-neutral-600 transition">
            Batal
          </button>
          <button type="submit"
                  class="px-4 py-2 rounded-lg bg-orange-500 text-neutral-100 hover:bg-orange-600 transition">
            Sewa Sekarang
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const modal = document.getElementById('modalTransaksi');
    const closeModal = document.getElementById('closeModal');
    const closeModalFooter = document.getElementById('closeModalFooter');
    const formSewa = document.getElementById('formSewa');
    const totalBayar = document.getElementById('total_bayar');
    const durasiInput = document.getElementById('durasi_sewa');
    const tglSewaInput = document.getElementById('tgl_sewa');
    const tglKembaliInput = document.getElementById('tgl_kembali');
    let hargaSewaPerHari = 0;

    // Fungsi tampilkan modal
    function showModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        body.classList.add('overflow-hidden');
    }

    // Fungsi sembunyikan modal
    function hideModal() {
        modal.classList.add('hidden');
        body.classList.remove('overflow-hidden');

        // Simpan id_pelanggan sebelum reset
        const idPelanggan = document.getElementById('id_pelanggan').value;

        // Reset form tapi kembalikan id_pelanggan
        formSewa.reset();
        document.getElementById('id_pelanggan').value = idPelanggan;

        totalBayar.value = '';
        durasiInput.value = '';
        hargaSewaPerHari = 0;
        document.getElementById('mobilImage').src = 'uploads/default.svg';
        document.querySelectorAll('#modalTransaksi span').forEach(span => span.innerText = '-');
    }


    // Fungsi tampilkan data mobil ke modal
    function tampilkanData(data) {
        document.getElementById('id_mobil').value = data.id_mobil;
        document.getElementById('merk').innerText = data.merk;
        document.getElementById('tipe').innerText = data.tipe;
        document.getElementById('model').innerText = data.model;
        document.getElementById('jenis').innerText = data.jenis;
        document.getElementById('tahun').innerText = data.tahun;
        document.getElementById('warna').innerText = data.warna;
        document.getElementById('transmisi').innerText = data.transmisi;
        document.getElementById('bhn_bkr').innerText = data.bhn_bkr;
        document.getElementById('silinder').innerText = data.silinder;
        document.getElementById('pintu').innerText = data.pintu;
        document.getElementById('kursi').innerText = data.kursi;
        document.getElementById('noplat').innerText = data.noplat;
        document.getElementById('nomesin').innerText = data.nomesin;
        document.getElementById('norangka').innerText = data.norangka;
        document.getElementById('harga').innerText = parseFloat(data.harga).toLocaleString('id-ID');
        hargaSewaPerHari = parseFloat(data.harga);

        const mobilImage = document.getElementById('mobilImage');
        mobilImage.src = data.img && data.img.trim() !== '' ? uploads/${data.img} : 'uploads/default.svg';
        mobilImage.onerror = () => mobilImage.src = 'uploads/default.svg';

        const statusEl = document.getElementById('status');
        statusEl.innerText = data.status;
        statusEl.className = "px-2 py-0.5 rounded text-xs font-semibold";
        if (data.status === 'ready') statusEl.classList.add('bg-green-100','text-green-700');
        else if (data.status === 'rent') statusEl.classList.add('bg-yellow-100','text-yellow-700');
        else statusEl.classList.add('bg-gray-200','text-gray-700');
    }

    // Event tombol sewa
    document.querySelectorAll('.sewa-btn').forEach(btn => {
        btn.addEventListener('click', async (e) => {
            e.preventDefault();
            const id = btn.dataset.id;

            try {
                const res = await fetch(index.php?action=store-transaksi-pelanggan&id=${id});
                const data = await res.json();

                if (data.status === 'ok') {
                    tampilkanData(data.data);
                    showModal();
                } else {
                    alert(data.message || 'Gagal mengambil data mobil');
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan koneksi');
            }
        });
    });

    // Tutup modal
    closeModal.addEventListener('click', hideModal);
    closeModalFooter.addEventListener('click', hideModal);
    modal.addEventListener('click', e => {
        if (e.target === modal) hideModal();
    });

    // Hitung durasi & total bayar otomatis
    function hitungDurasiDanTotal() {
        const tglSewa = new Date(tglSewaInput.value);
        const tglKembali = new Date(tglKembaliInput.value);

        if (tglSewaInput.value && tglKembaliInput.value) {
            if (tglKembali <= tglSewa) {
                durasiInput.value = '';
                totalBayar.value = '';
                return;
            }
            const diffTime = Math.abs(tglKembali - tglSewa);
            const durasi = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            durasiInput.value = durasi;
            totalBayar.value = hargaSewaPerHari > 0 ? (durasi * hargaSewaPerHari).toLocaleString('id-ID') : '';
        } else {
            durasiInput.value = '';
            totalBayar.value = '';
        }
    }

    tglSewaInput.addEventListener('change', hitungDurasiDanTotal);
    tglKembaliInput.addEventListener('change', hitungDurasiDanTotal);

    // Submit form
    formSewa.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(formSewa);

        try {
            const res = await fetch('index.php?action=buat-transaksi', {
                method: 'POST',
                body: formData
            });
            const result = await res.json();

            alert(result.message);
            if (result.success) {
                hideModal();
                location.reload();
            }
        } catch (err) {
            console.error(err);
            alert('Terjadi kesalahan koneksi!');
        }
    });
});

</script>

kok masih alert id pelanggan kosong ya
ChatGPT bilang:
Ahh sekarang saya ngerti masalahnya. 😅

Masalah bukan di JS modal. Masalah utamanya:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">
Kamu pake $_SESSION['id_pelanggan'], tapi dari controller yang kamu buat, kamu hanya menyimpan $id_user di session:

$id_user = $_SESSION['user']['id_user'];
$_SESSION['id_pelanggan'] tidak pernah di-set, makanya value kosong. 💡

🔹 Solusi 1: Set id_pelanggan di session saat login / index
Misal di PELANGGANController::index():

$isLoggedIn = Middleware::requireloginOptional();
$id_user = $isLoggedIn ? $_SESSION['user']['id_user'] : null;
$profile = $id_user ? $this->model->getpelangganbyiduser($id_user) : null;

// Simpan id_pelanggan ke session supaya bisa diakses di form
if ($profile) {
    $_SESSION['id_pelanggan'] = $profile['id_pelanggan'];
}
Lalu di modal, value hidden input bisa tetap sama:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">
🔹 Solusi 2: Kirim langsung dari PHP ke view, tanpa session
Di controller index():

$id_pelanggan = $profile['id_pelanggan'] ?? null;
Di view modal:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $id_pelanggan ?? '' ?>">
Ini lebih bersih, karena tidak mengubah session global.

Kesimpulannya: id_pelanggan kosong karena kamu tidak menyimpannya di session sama sekali. JS dan form-nya sudah benar.

Kalau mau, aku bisa bikin versi final modal + JS + PHP yang fix, supaya id_pelanggan otomatis tersimpan dan dikirim ke server.

Mau aku buatkan?

Anda bilang:
Terjadi kesalahan koneksi! sekarang errro nya itu
ChatGPT bilang:
Ah, sekarang error-nya pindah ke fetch POST (Terjadi kesalahan koneksi!). Itu artinya request tidak sampai ke server atau server me-return error 500 / PHP error. Mari kita cek kemungkinan penyebabnya satu per satu.

1️⃣ Cek URL request di JS
Di JS kamu:

const res = await fetch('index.php?action=buat-transaksi', {
    method: 'POST',
    body: formData
});
Pastikan:

File index.php memang menerima action=buat-transaksi dan tidak ada rewrite/middleware yang memblokir.

Kalau kamu pakai routing custom, pastikan URL-nya sesuai path.

2️⃣ Cek PHP untuk error
PHP mungkin me-return error 500, misal karena $_POST['id_pelanggan'] kosong atau ada bug di Transaksi->Store().

Tambahkan sementara di awal buatTransaksi():

public function buatTransaksi() {
    header('Content-Type: application/json');

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
Ini akan menampilkan error PHP kalau ada. Biasanya, id_pelanggan yang kosong bisa bikin query insert gagal dan PHP error.

3️⃣ Pastikan id_pelanggan terisi
Di form modal hidden input:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $id_pelanggan ?? '' ?>">
Jika value kosong, $_POST['id_pelanggan'] = null.

Server akan mem-block insert di database jika id_pelanggan NOT NULL.

Kalau pakai JS untuk reset form modal, jangan reset hidden input id_pelanggan. Dari kode terakhirmu, ini sudah benar:

const idPelanggan = document.getElementById('id_pelanggan').value;
formSewa.reset();
document.getElementById('id_pelanggan').value = idPelanggan;
Jadi JS-nya aman.

4️⃣ Cek console / network tab
Buka DevTools → Network → tab Fetch/XHR.

Submit form.

Lihat request POST ke index.php?action=buat-transaksi.

Lihat response dari server. Kalau ada PHP error, pasti muncul di sana.

🔹 Kesimpulan sementara:
Error ini bukan karena JS, tapi karena server-side PHP error / database insert gagal. Paling sering karena:

id_pelanggan kosong (NULL)

Format tanggal / total_bayar salah

Query insert gagal (cek Transaksi->Store)

Kalau mau, aku bisa bikin versi buatTransaksi() dengan debug lengkap supaya bisa langsung kelihatan field mana yang bikin gagal dan response JSON-nya jelas.

Mau aku bikinkan?

Anda bilang:
<?php
require_once __DIR__ . '/../App/Controllers/auth-controller.php';
require_once __DIR__ . '/../App/Controllers/pelanggan-controller.php';
require_once __DIR__ . '/../App/Controllers/pegawai-controller.php';

$Authcontroller = new AUTHController;
$Pelanggancontroller = new PELANGGANController;
$Pegawaicontroller = new PEGAWAIController;

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

switch ($action) {

    // AUTHENTICATION    
    case 'login':
        $Authcontroller->showlogin();
        break;
    case 'storelogin':
        $Authcontroller->login();
        break;      
    case 'signup':
        $Authcontroller->showsignup();
        break;   
    case 'storesignup':
        $Authcontroller->signup();
        break;
    case 'logout':
        $Authcontroller->logout();
        break;      
    
    // PELANGGAN    
    case 'index':
        $Pelanggancontroller->index();
        break;
    case 'store-profile-pelanggan':
        $Pelanggancontroller->Storeprofile();
        break;  
    case 'store-transaksi-pelanggan':
        $Pelanggancontroller->Storetransaksi($id);
        break;       
    case 'buat-transaksi':
        $Pelanggancontroller->buattransaksi();
        break;  

    //PEGAWAI
    case 'index-pegawai';
        $Pegawaicontroller->index();
        break;
    case 'profile-pegawai':
        $Pegawaicontroller->Showprofile();
        break;    
    case 'store-profile-pegawai':
        $Pegawaicontroller->Storeprofile();
        break;  
    
    // 404 Not Found    
    default:
        http_response_code(404);
        include __DIR__ . '/../App/Views/errors/404.php';
        break;
}
?>
ChatGPT bilang:
Oke, dari file routing (index.php) ini aku lihat ada beberapa hal penting yang bisa bikin masalah id_pelanggan kosong atau fetch Terjadi kesalahan koneksi!:

1️⃣ Nama method case sensitive
Di switch-case:

case 'buat-transaksi':
    $Pelanggancontroller->buattransaksi();
    break;  
Tapi di controller kamu methodnya namanya:

public function buatTransaksi() { ... }
PHP itu case-sensitive untuk method. Jadi $Pelanggancontroller->buattransaksi() tidak ada, menyebabkan Fatal error 500, yang JS tangkap sebagai Terjadi kesalahan koneksi!.

✅ Solusi: ubah routing jadi sesuai method:

case 'buat-transaksi':
    $Pelanggancontroller->buatTransaksi();
    break;
2️⃣ Pastikan id_pelanggan di session
Di controller index(), kamu buat:

$id_pelanggan = $profile['id_pelanggan'] ?? Null;
Tapi kalau kamu pakai JS modal, input hidden:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">
Kamu tidak menyimpan $id_pelanggan ke session.

Jadi $_SESSION['id_pelanggan'] kosong → form submit POST → $_POST['id_pelanggan'] kosong.

✅ Solusi: di index() setelah ambil profile, simpan ke session:

if ($profile) {
    $_SESSION['id_pelanggan'] = $profile['id_pelanggan'];
}
Atau langsung isi value hidden dari $profile['id_pelanggan'] tanpa pakai session:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $profile['id_pelanggan'] ?? '' ?>">
3️⃣ Debug tambahan
Supaya gampang tahu kalau masih error:

public function buatTransaksi() {
    header('Content-Type: application/json');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $id_pelanggan = $_POST['id_pelanggan'] ?? null;
    if (!$id_pelanggan) {
        echo json_encode(['success' => false, 'message' => 'id_pelanggan kosong!']);
        return;
    }

    // lanjut simpan transaksi...
}
Ini bikin pasti muncul alert kalau id_pelanggan kosong.

💡 Kesimpulan:
Masalah utama kamu sekarang:

Method buatTransaksi() dipanggil dengan huruf kecil → Fatal error 500.

Hidden input id_pelanggan ambil dari session yang belum di-set → kosong saat submit.

Kalau ini diperbaiki, form sewa harusnya sukses.

Kalau mau, aku bisa tuliskan versi full controller + routing + modal yang sudah fix supaya submit transaksi langsung dapat id_pelanggan tanpa error.

Mau aku bikinkan?

Anda bilang:
Terjadi kesalahan koneksi!

masih loh, ini penyebab nya apa asih
ChatGPT bilang:
Oke, kalau alert masih muncul Terjadi kesalahan koneksi! artinya fetch JS gagal menerima response valid dari server. Kita harus cek step by step kemungkinan penyebab:

1️⃣ Method controller salah
Di index.php routing kamu:

case 'buat-transaksi':
    $Pelanggancontroller->buattransaksi(); // ❌ salah huruf kecil
Di controller:

public function buatTransaksi() { ... } // huruf T besar
PHP bersifat case-sensitive, jadi pemanggilan method yang salah akan menyebabkan Fatal error 500 → JS catch sebagai catch(err) → alert Terjadi kesalahan koneksi!.

✅ Solusi:

case 'buat-transaksi':
    $Pelanggancontroller->buatTransaksi(); // T besar
    break;
2️⃣ id_pelanggan kosong
Di form modal:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">
Kalau $_SESSION['id_pelanggan'] belum di-set → akan dikirim kosong → controller buatTransaksi() dicek dan bisa return error JSON → JS menangkap error.

Solusi:
Di PELANGGANController->index() setelah ambil profile:

if ($profile) {
    $_SESSION['id_pelanggan'] = $profile['id_pelanggan'];
}
Atau lebih sederhana, langsung isi hidden input dari $profile:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $profile['id_pelanggan'] ?? '' ?>">
3️⃣ Debug response server
Tambahkan debug di awal buatTransaksi():

public function buatTransaksi() {
    header('Content-Type: application/json');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $id_pelanggan = $_POST['id_pelanggan'] ?? null;
    if (!$id_pelanggan) {
        echo json_encode(['success' => false, 'message' => 'id_pelanggan kosong!']);
        return;
    }

    // lanjut proses...
}
Kalau masih muncul alert Terjadi kesalahan koneksi!, kemungkinan fatal error PHP karena method dipanggil salah, atau ada require yang gagal.

4️⃣ Cek Console / Network
Buka DevTools → Network → pilih request buat-transaksi.

Lihat Response dan Status Code.

500 → Fatal error PHP

200 → Response JSON

Kalau 500 → artinya masih ada masalah PHP (method typo, session belum start, atau require gagal).

💡 Kesimpulan umum:

Case-sensitive method hampir selalu penyebab error koneksi ini.

Session id_pelanggan kosong → alert “Field id_pelanggan kosong”.

Kalau sudah fix kedua hal ini, transaksi harusnya jalan.

Kalau kamu mau, aku bisa tulis versi siap pakai dari:

Controller index() + buatTransaksi()

Modal form hidden id_pelanggan

Supaya fetch JS sukses dan id_pelanggan terisi otomatis.

Mau aku buatkan langsung?

Anda bilang:
<?php
require_once __DIR__ . '/../App/Controllers/auth-controller.php';
require_once __DIR__ . '/../App/Controllers/pelanggan-controller.php';
require_once __DIR__ . '/../App/Controllers/pegawai-controller.php';

$Authcontroller = new AUTHController;
$Pelanggancontroller = new PELANGGANController;
$Pegawaicontroller = new PEGAWAIController;

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

switch ($action) {

    // AUTHENTICATION    
    case 'login':
        $Authcontroller->showlogin();
        break;
    case 'storelogin':
        $Authcontroller->login();
        break;      
    case 'signup':
        $Authcontroller->showsignup();
        break;   
    case 'storesignup':
        $Authcontroller->signup();
        break;
    case 'logout':
        $Authcontroller->logout();
        break;      
    
    // PELANGGAN    
    case 'index':
        $Pelanggancontroller->index();
        break;
    case 'store-profile-pelanggan':
        $Pelanggancontroller->Storeprofile();
        break;  
    case 'store-transaksi-pelanggan':
        $Pelanggancontroller->Storetransaksi($id);
        break;       
    case 'buat-transaksi':
        $Pelanggancontroller->buatTransaksi();
        break;  

    //PEGAWAI
    case 'index-pegawai';
        $Pegawaicontroller->index();
        break;
    case 'profile-pegawai':
        $Pegawaicontroller->Showprofile();
        break;    
    case 'store-profile-pegawai':
        $Pegawaicontroller->Storeprofile();
        break;  
    
    // 404 Not Found    
    default:
        http_response_code(404);
        include __DIR__ . '/../App/Views/errors/404.php';
        break;
}
?>

udah gw benerin
ChatGPT bilang:
Oke, sekarang routing-nya sudah memanggil method buatTransaksi() dengan T besar, jadi masalah Fatal error karena method tidak ada sudah hilang. ✅

Langkah selanjutnya untuk memastikan id_pelanggan tidak kosong:

1️⃣ Set $_SESSION['id_pelanggan'] di index
Di PELANGGANController->index() setelah ambil profile:

$profile = $id_user ? $this->model->getpelangganbyiduser($id_user) : null;
$id_pelanggan = $profile['id_pelanggan'] ?? null;

// Simpan di session supaya modal bisa akses
if ($id_pelanggan) {
    $_SESSION['id_pelanggan'] = $id_pelanggan;
}
2️⃣ Update modal hidden input
Di form modal:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['id_pelanggan'] ?? '' ?>">
Sekarang, saat modal muncul, input id_pelanggan sudah berisi ID pelanggan.

3️⃣ Debug di controller buatTransaksi
Tambahkan pengecekan awal supaya jelas jika masih kosong:

$id_pelanggan = $_POST['id_pelanggan'] ?? null;
if (!$id_pelanggan) {
    echo json_encode(['success' => false, 'message' => 'id_pelanggan kosong!']);
    return;
}
Kalau JS masih menampilkan Terjadi kesalahan koneksi!, buka DevTools → Network → request buat-transaksi, lihat status code & response. Kalau 200 dengan message JSON, JS bisa alert message tersebut.

Kalau mau, aku bisa tulis versi lengkap controller + modal + JS supaya transaksi bisa langsung submit tanpa error id_pelanggan kosong.

Mau aku buatkan langsung?

Anda bilang:
<?php
require_once __DIR__ . '/../Models/pelanggan.php';
require_once __DIR__ . '/../Middleware/middleware.php';
require_once __DIR__ . '/../Models/mobil.php';
require_once __DIR__ . '/../Models/transaksi.php';

class PELANGGANController{
    private $model;
    private $mobilmodel;
    private $transaksimodel;

    public function __construct(){
        $this->model = new Pelanggan();   
        $this->mobilmodel = new Mobil(); 
        $this->transaksimodel = new Transaksi(); 
    }

    public function index() {
        $isLoggedIn = Middleware::requireloginOptional(); // bisa login atau tidak
        $id_user = $isLoggedIn ? $_SESSION['user']['id_user'] : null;
        $profile = $id_user ? $this->model->getpelangganbyiduser($id_user) : null;
        $id_pelanggan = $profile['id_pelanggan'] ?? Null;

        $query = $_GET['q'] ?? '';
        $limit = 9;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $harga = $_GET['harga'] ?? null;
        $transmisi = $_GET['transmisi'] ?? null;
        $bhn_bkr = $_GET['bhn_bkr'] ?? null;
        // $kapasitas = $_GET['kapasitas'] ?? null;

        $hasFilter = !empty($harga) || !empty($transmisi) || !empty($bhn_bkr) || !empty($kapasitas);

        if ($hasFilter) {
            $data = $this->mobilmodel->filterMobil($harga, $transmisi, $bhn_bkr, $limit, $offset);
            $totalData = $this->mobilmodel->countFilterMobil($harga, $transmisi, $bhn_bkr);
            $totalPages = ceil($totalData / $limit);
        } elseif (!empty($query)) {
            $data = $this->mobilmodel->searchmobil($query, $limit, $offset);
            $totalData = $this->mobilmodel->countSearchMobil($query);
            $totalPages = ceil($totalData / $limit);
        } else {
            $data = $this->mobilmodel->getMobilWithLimit($limit, $offset);
            $totalData = $this->mobilmodel->countAllMobil();
            $totalPages = ceil($totalData / $limit);
        }

        include __DIR__ . '/../../App/Views/Pelanggan/index.php';
    }
    
    public function Storeprofile(){
        Middleware::requirerole('pelanggan'); 

        $id_user = $_SESSION['user']['id_user'];
        $dataLama = $this->model->getpelangganbyiduser($id_user);

         // 🟩 handle upload foto
        $fotoBaru = $dataLama['pp']; // default: pakai foto lama
        if (isset($_FILES['pp']) && $_FILES['pp']['error'] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['pp']['tmp_name'];
            $fileName = basename($_FILES['pp']['name']);
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

            if (in_array($fileExt, $allowed)) {
                $newName = 'pp_' . uniqid() . '.' . $fileExt;
                $uploadDir = __DIR__ . '/../../Public/uploads/';
                $uploadPath = $uploadDir . $newName;

                if (move_uploaded_file($tmpName, $uploadPath)) {
                    // 🟩 hapus foto lama kalau bukan default.svg
                    if (!empty($dataLama['pp']) && $dataLama['pp'] !== 'default.svg') {
                        $oldPath = $uploadDir . $dataLama['pp'];
                        if (file_exists($oldPath)) unlink($oldPath);
                    }
                    $fotoBaru = $newName;
                }
            }
        }

        $this->model->Updatepelanggan(
            $id_user = $_SESSION['user']['id_user'],
            $nama = $_POST['nama'],
            $nik = $_POST['nik'],
            $alamat = $_POST['alamat'],
            $kelurahan = $_POST['kelurahan'],
            $kecamatan = $_POST['kecamatan'],
            $kabkota = $_POST['kota'],
            $kp = $_POST['kp'],
            $telp = $_POST['telp'],
            $bio = $_POST['bio'],
            $fotoBaru
        );

        header("Location: index.php?action=index");
        exit;
    }

// Ambil detail mobil
public function Storetransaksi() {
    header('Content-Type: application/json');
    $id = $_GET['id'] ?? null;
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID mobil tidak ditemukan']);
        return;
    }

    $detail = $this->mobilmodel->detailmobil($id);
    if (!$detail) {
        echo json_encode(['status' => 'error', 'message' => 'Mobil tidak ditemukan']);
        return;
    }

    echo json_encode(['status' => 'ok', 'data' => $detail]);
}


// Buat transaksi
public function buatTransaksi() {
    header('Content-Type: application/json');

    $data = [
        'id_mobil' => $_POST['id_mobil'] ?? null,
        'id_pelanggan' => $_POST['id_pelanggan'] ?? null,
        'id_pegawai' => $_SESSION['user']['id_user'] ?? 1,
        'tgl_sewa' => $_POST['tgl_sewa'] ?? null,
        'tgl_kembali' => $_POST['tgl_kembali'] ?? null,
        'durasi_sewa' => $_POST['durasi_sewa'] ?? null,
        'total_bayar' => $_POST['total_bayar'] ?? null,
        'status' => 'berjalan'
    ];

    // Cek data lengkap
    foreach ($data as $key => $val) {
        if (!$val) {
            echo json_encode(['success' => false, 'message' => "Field $key kosong"]);
            return;
        }
    }

    $inserted = $this->transaksimodel->Store(
        $id_mobil = $_POST['id_mobil'] ?? null,
        $id_pelanggan = $_POST['id_pelanggan'] ?? null,
        $id_pegawai = $_SESSION['user']['id_user'] ?? 1,
        $tgl_sewa = $_POST['tgl_sewa'] ?? null,
        $tgl_kembali = $_POST['tgl_kembali'] ?? null,
        $durasi_sewa = $_POST['durasi_sewa'] ?? null,
        $total_bayar = $_POST['total_bayar'] ?? null,
        $status = 'berjalan'
    );

    if ($inserted) {
        echo json_encode(['success' => true, 'message' => 'Transaksi berhasil dibuat']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan transaksi']);
    }
}

}
?>

<?php 
require_once __DIR__ . "/../../Config/Database.php";

class Transaksi{
    private $pdo;

    public function __construct(){
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function Store($id_mobil,$id_pelanggan,$id_pegawai,$tgl_sewa,$tgl_kembali,$total_bayar,$durasi_sewa,$status){
        try{
            $sql = "INSERT INTO transaksi(id_mobil,id_pelanggan,id_pegawai,tgl_sewa,tgl_kembali,total_bayar,durasi_sewa,status) 
            VALUES(:id_mobil,:id_pelanggan,:id_pegawai,:tgl_sewa,:tgl_kembali,:total_bayar,:durasi_sewa,:status)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id_mobil",$id_mobil);
            $stmt->bindParam(":id_pelanggan",$id_pelanggan);
            $stmt->bindParam(":id_pegawai",$id_pegawai);
            $stmt->bindParam(":tgl_sewa",$tgl_sewa);
            $stmt->bindParam(":tgl_kembali",$tgl_kembali);
            $stmt->bindParam(":total_bayar",$total_bayar);
            $stmt->bindParam(":durasi_sewa",$durasi_sewa);
            $stmt->bindParam(":status",$status);
            return $stmt->execute();
        }catch(PDOException $e){
            die("Gagal Mengeksekusi Query :" . $e->getMessage());
        }
    }

    public function GetidTransaksi($id_transaksi){
        try{
            $sql = "SELECT * FROM transaksi WHERE id_transaksi = :id_transaksi";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(["id_transaksi" => $id_transaksi]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        }catch(PDOException $e){
            die("Gagal Mengeksekusi Query :" . $e->getMessage());
        }
    }
}

$transaksi = new Transaksi();
// $transaksi->Store(38,3,1,"2025-11-10 15:09:00","2025-12-10 15:09:00","6000000",2,"berjalan");
// $data = $transaksi->Gettransaksi(1);
// var_dump($data);
?>

<?php
require_once __DIR__ . '/../../Config/Database.php';

class Pelanggan{
    private $pdo;

    public function __construct(){
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function Insertpelanggan($id_user,$nama,$nik,$alamat,$kelurahan,$kecamatan,$kota,$kp,$telp,$bio,$pp){
        try{
            $sql = "INSERT INTO pelanggan(id_user,nama,nik,alamat,kelurahan,kecamatan,kota,kp,telp,bio,pp) VALUES(:id_user,:nama,:nik,:alamat,:kelurahan,:kecamatan,:kota,:kp,:telp,:bio,:pp)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_user',$id_user);
            $stmt->bindParam(':nama',$nama);
            $stmt->bindParam(':nik',$nik);
            $stmt->bindParam(':alamat',$alamat);
            $stmt->bindParam(':kelurahan',$kelurahan);
            $stmt->bindParam(':kecamatan',$kecamatan);
            $stmt->bindParam(':kota',$kota);
            $stmt->bindParam(':kp',$kp);
            $stmt->bindParam(':telp',$telp);
            $stmt->bindParam(':bio',$bio);
            $stmt->bindParam(':pp',$pp);
            return $stmt->execute();
        }catch(PDOException $e){
            die('Gagal Menambahkan Data :' .  $e->getMessage());
        }
    }

    public function Selectpelanggan(){
        try{
            $sql = "SELECT * FROM pelanggan";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            die('Gagal Menampilkan Data :' .  $e->getMessage());
        }
    }

    public function getpelangganbyiduser($id_user){
        try{
            $sql = "SELECT * FROM pelanggan WHERE id_user = :id_user";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id_user'=>$id_user]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            die('Gagal Menampilkan Data Dengan ID User :' .  $e->getMessage());
        }
    }

    public function Updatepelanggan($id_user,$nama,$nik,$alamat,$kelurahan,$kecamatan,$kota,$kp,$telp,$bio,$pp){
        try{
            $sql = "UPDATE pelanggan SET nama=:nama,nik=:nik,alamat=:alamat,kelurahan=:kelurahan,kecamatan=:kecamatan,kota=:kota,kp=:kp,telp=:telp,bio=:bio,pp=:pp WHERE id_user=:id_user";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_user',$id_user);
            $stmt->bindParam(':nama',$nama);
            $stmt->bindParam(':nik',$nik);
            $stmt->bindParam(':alamat',$alamat);
            $stmt->bindParam(':kelurahan',$kelurahan);
            $stmt->bindParam(':kecamatan',$kecamatan);
            $stmt->bindParam(':kota',$kota);
            $stmt->bindParam(':kp',$kp);
            $stmt->bindParam(':telp',$telp);
            $stmt->bindParam(':bio',$bio);
            $stmt->bindParam(':pp',$pp);
            return $stmt->execute();
        }catch(PDOException $e){
            die('Gagal Memperbarui Data :' .  $e->getMessage());
        }
    }

    public function Deletepelanggan($id_pelanggan){
        try{
            $sql = "DELETE FROM pelanggan WHERE id_pelanggan = :id_pelanggan";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute(['id_pelanggan' => $id_pelanggan]);
        }catch(PDOException $e){
            die('Gagal Menghapus Data :' .  $e->getMessage());
        }
    }
}

// $pelanggan = new Pelanggan();
// $pelanggan->Insertpelanggan(1,'','','','','','','','','','','');
// $pelanggan->Updatepelanggan(3,1,'Fadlan',1234,'Jl Aw Syahrani','Gunung kelua','Samarinda Ulu','Samarinda',12345,'0822100732928','testing','testing.jpg');
// $pelanggan->Deletepelanggan(2);
// $data = $pelanggan->Selectpelanggan();
// $data = $pelanggan->getpelangganbyiduser(1);
// var_dump($data);
?>

<!-- Modal Detail & Form Sewa -->
<div id="modalTransaksi"
     class="hidden fixed inset-0 z-[100] bg-neutral-900/80 flex justify-center items-center text-neutral-100">
  <div class="bg-neutral-900 rounded-2xl w-full max-w-2xl shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-4 border-b border-neutral-700">
      <h2 class="text-xl font-semibold text-neutral-100">Detail Mobil</h2>
      <button id="closeModal"
              class="text-neutral-300 hover:text-neutral-100 text-2xl font-bold">&times;</button>
    </div>

    <!-- Body -->
    <div class="p-6 space-y-6 max-h-[80vh] overflow-y-auto">
      <!-- Detail Mobil -->
      <div class="flex flex-col md:flex-row gap-6">
        <img id="mobilImage" src="uploads/default.svg" alt="Mobil"
             class="w-full md:w-1/3 h-48 object-cover rounded-lg border border-neutral-700">
        <div class="flex-1 grid grid-cols-2 gap-y-2 text-sm text-neutral-100">
          <p><strong>Merk:</strong> <span id="merk">-</span></p>
          <p><strong>Tipe:</strong> <span id="tipe">-</span></p>
          <p><strong>Model:</strong> <span id="model">-</span></p>
          <p><strong>Jenis:</strong> <span id="jenis">-</span></p>
          <p><strong>Tahun:</strong> <span id="tahun">-</span></p>
          <p><strong>Warna:</strong> <span id="warna">-</span></p>
          <p><strong>Transmisi:</strong> <span id="transmisi">-</span></p>
          <p><strong>Bahan Bakar:</strong> <span id="bhn_bkr">-</span></p>
          <p><strong>Silinder:</strong> <span id="silinder">-</span></p>
          <p><strong>Pintu:</strong> <span id="pintu">-</span></p>
          <p><strong>Kursi:</strong> <span id="kursi">-</span></p>
          <p><strong>Status:</strong> <span id="status" class="px-2 py-0.5 rounded text-xs font-semibold">-</span></p>
          <p class="col-span-2"><strong>No Plat:</strong> <span id="noplat">-</span></p>
          <p class="col-span-2"><strong>No Mesin:</strong> <span id="nomesin">-</span></p>
          <p class="col-span-2"><strong>No Rangka:</strong> <span id="norangka">-</span></p>
          <p class="col-span-2"><strong>Harga Sewa / Hari:</strong> Rp <span id="harga">-</span></p>
        </div>
      </div>

      <!-- FORM SEWA -->
      <form id="formSewa" class="border-t border-neutral-700 pt-5 mt-5 space-y-4">
        <h3 class="text-lg font-semibold text-neutral-100">Form Sewa</h3>
        <input type="hidden" id="id_mobil" name="id_mobil">
        <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $profile['id_pelanggan'] ?? '' ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="tgl_sewa" class="block text-sm text-neutral-300">Tanggal Sewa</label>
            <input type="date" id="tgl_sewa" name="tgl_sewa"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
          <div>
            <label for="tgl_kembali" class="block text-sm text-neutral-300">Tanggal Kembali</label>
            <input type="date" id="tgl_kembali" name="tgl_kembali"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
        </div>

        <div>
          <label for="durasi_sewa" class="block text-sm text-neutral-300">Durasi (hari)</label>
          <input type="number" id="durasi_sewa" name="durasi_sewa" min="1"
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" readonly required>
        </div>

        <div>
          <label for="total_bayar" class="block text-sm text-neutral-300">Total Bayar (Rp)</label>
          <input type="text" id="total_bayar" name="total_bayar" readonly
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100">
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-4">
          <button type="button" id="closeModalFooter"
                  class="px-4 py-2 rounded-lg bg-neutral-700 text-neutral-100 hover:bg-neutral-600 transition">
            Batal
          </button>
          <button type="submit"
                  class="px-4 py-2 rounded-lg bg-orange-500 text-neutral-100 hover:bg-orange-600 transition">
            Sewa Sekarang
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const modal = document.getElementById('modalTransaksi');
    const closeModal = document.getElementById('closeModal');
    const closeModalFooter = document.getElementById('closeModalFooter');
    const formSewa = document.getElementById('formSewa');
    const totalBayar = document.getElementById('total_bayar');
    const durasiInput = document.getElementById('durasi_sewa');
    const tglSewaInput = document.getElementById('tgl_sewa');
    const tglKembaliInput = document.getElementById('tgl_kembali');
    let hargaSewaPerHari = 0;

    // Fungsi tampilkan modal
    function showModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        body.classList.add('overflow-hidden');
    }

    // Fungsi sembunyikan modal
    function hideModal() {
        modal.classList.add('hidden');
        body.classList.remove('overflow-hidden');

        // Simpan id_pelanggan sebelum reset
        const idPelanggan = document.getElementById('id_pelanggan').value;

        // Reset form tapi kembalikan id_pelanggan
        formSewa.reset();
        document.getElementById('id_pelanggan').value = idPelanggan;

        totalBayar.value = '';
        durasiInput.value = '';
        hargaSewaPerHari = 0;
        document.getElementById('mobilImage').src = 'uploads/default.svg';
        document.querySelectorAll('#modalTransaksi span').forEach(span => span.innerText = '-');
    }


    // Fungsi tampilkan data mobil ke modal
    function tampilkanData(data) {
        document.getElementById('id_mobil').value = data.id_mobil;
        document.getElementById('merk').innerText = data.merk;
        document.getElementById('tipe').innerText = data.tipe;
        document.getElementById('model').innerText = data.model;
        document.getElementById('jenis').innerText = data.jenis;
        document.getElementById('tahun').innerText = data.tahun;
        document.getElementById('warna').innerText = data.warna;
        document.getElementById('transmisi').innerText = data.transmisi;
        document.getElementById('bhn_bkr').innerText = data.bhn_bkr;
        document.getElementById('silinder').innerText = data.silinder;
        document.getElementById('pintu').innerText = data.pintu;
        document.getElementById('kursi').innerText = data.kursi;
        document.getElementById('noplat').innerText = data.noplat;
        document.getElementById('nomesin').innerText = data.nomesin;
        document.getElementById('norangka').innerText = data.norangka;
        document.getElementById('harga').innerText = parseFloat(data.harga).toLocaleString('id-ID');
        hargaSewaPerHari = parseFloat(data.harga);

        const mobilImage = document.getElementById('mobilImage');
        mobilImage.src = data.img && data.img.trim() !== '' ? uploads/${data.img} : 'uploads/default.svg';
        mobilImage.onerror = () => mobilImage.src = 'uploads/default.svg';

        const statusEl = document.getElementById('status');
        statusEl.innerText = data.status;
        statusEl.className = "px-2 py-0.5 rounded text-xs font-semibold";
        if (data.status === 'ready') statusEl.classList.add('bg-green-100','text-green-700');
        else if (data.status === 'rent') statusEl.classList.add('bg-yellow-100','text-yellow-700');
        else statusEl.classList.add('bg-gray-200','text-gray-700');
    }

    // Event tombol sewa
    document.querySelectorAll('.sewa-btn').forEach(btn => {
        btn.addEventListener('click', async (e) => {
            e.preventDefault();
            const id = btn.dataset.id;

            try {
                const res = await fetch(index.php?action=store-transaksi-pelanggan&id=${id});
                const data = await res.json();

                if (data.status === 'ok') {
                    tampilkanData(data.data);
                    showModal();
                } else {
                    alert(data.message || 'Gagal mengambil data mobil');
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan koneksi');
            }
        });
    });

    // Tutup modal
    closeModal.addEventListener('click', hideModal);
    closeModalFooter.addEventListener('click', hideModal);
    modal.addEventListener('click', e => {
        if (e.target === modal) hideModal();
    });

    // Hitung durasi & total bayar otomatis
    function hitungDurasiDanTotal() {
        const tglSewa = new Date(tglSewaInput.value);
        const tglKembali = new Date(tglKembaliInput.value);

        if (tglSewaInput.value && tglKembaliInput.value) {
            if (tglKembali <= tglSewa) {
                durasiInput.value = '';
                totalBayar.value = '';
                return;
            }
            const diffTime = Math.abs(tglKembali - tglSewa);
            const durasi = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            durasiInput.value = durasi;
            totalBayar.value = hargaSewaPerHari > 0 ? (durasi * hargaSewaPerHari).toLocaleString('id-ID') : '';
        } else {
            durasiInput.value = '';
            totalBayar.value = '';
        }
    }

    tglSewaInput.addEventListener('change', hitungDurasiDanTotal);
    tglKembaliInput.addEventListener('change', hitungDurasiDanTotal);

    // Submit form
    formSewa.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(formSewa);

        try {
            const res = await fetch('index.php?action=buat-transaksi', {
                method: 'POST',
                body: formData
            });
            const result = await res.json();

            alert(result.message);
            if (result.success) {
                hideModal();
                location.reload();
            }
        } catch (err) {
            console.error(err);
            alert('Terjadi kesalahan koneksi!');
        }
    });
});

</script><!-- Modal Detail & Form Sewa -->
<div id="modalTransaksi"
     class="hidden fixed inset-0 z-[100] bg-neutral-900/80 flex justify-center items-center text-neutral-100">
  <div class="bg-neutral-900 rounded-2xl w-full max-w-2xl shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-4 border-b border-neutral-700">
      <h2 class="text-xl font-semibold text-neutral-100">Detail Mobil</h2>
      <button id="closeModal"
              class="text-neutral-300 hover:text-neutral-100 text-2xl font-bold">&times;</button>
    </div>

    <!-- Body -->
    <div class="p-6 space-y-6 max-h-[80vh] overflow-y-auto">
      <!-- Detail Mobil -->
      <div class="flex flex-col md:flex-row gap-6">
        <img id="mobilImage" src="uploads/default.svg" alt="Mobil"
             class="w-full md:w-1/3 h-48 object-cover rounded-lg border border-neutral-700">
        <div class="flex-1 grid grid-cols-2 gap-y-2 text-sm text-neutral-100">
          <p><strong>Merk:</strong> <span id="merk">-</span></p>
          <p><strong>Tipe:</strong> <span id="tipe">-</span></p>
          <p><strong>Model:</strong> <span id="model">-</span></p>
          <p><strong>Jenis:</strong> <span id="jenis">-</span></p>
          <p><strong>Tahun:</strong> <span id="tahun">-</span></p>
          <p><strong>Warna:</strong> <span id="warna">-</span></p>
          <p><strong>Transmisi:</strong> <span id="transmisi">-</span></p>
          <p><strong>Bahan Bakar:</strong> <span id="bhn_bkr">-</span></p>
          <p><strong>Silinder:</strong> <span id="silinder">-</span></p>
          <p><strong>Pintu:</strong> <span id="pintu">-</span></p>
          <p><strong>Kursi:</strong> <span id="kursi">-</span></p>
          <p><strong>Status:</strong> <span id="status" class="px-2 py-0.5 rounded text-xs font-semibold">-</span></p>
          <p class="col-span-2"><strong>No Plat:</strong> <span id="noplat">-</span></p>
          <p class="col-span-2"><strong>No Mesin:</strong> <span id="nomesin">-</span></p>
          <p class="col-span-2"><strong>No Rangka:</strong> <span id="norangka">-</span></p>
          <p class="col-span-2"><strong>Harga Sewa / Hari:</strong> Rp <span id="harga">-</span></p>
        </div>
      </div>

      <!-- FORM SEWA -->
      <form id="formSewa" class="border-t border-neutral-700 pt-5 mt-5 space-y-4">
        <h3 class="text-lg font-semibold text-neutral-100">Form Sewa</h3>
        <input type="hidden" id="id_mobil" name="id_mobil">
        <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $profile['id_pelanggan'] ?? '' ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="tgl_sewa" class="block text-sm text-neutral-300">Tanggal Sewa</label>
            <input type="date" id="tgl_sewa" name="tgl_sewa"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
          <div>
            <label for="tgl_kembali" class="block text-sm text-neutral-300">Tanggal Kembali</label>
            <input type="date" id="tgl_kembali" name="tgl_kembali"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
        </div>

        <div>
          <label for="durasi_sewa" class="block text-sm text-neutral-300">Durasi (hari)</label>
          <input type="number" id="durasi_sewa" name="durasi_sewa" min="1"
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" readonly required>
        </div>

        <div>
          <label for="total_bayar" class="block text-sm text-neutral-300">Total Bayar (Rp)</label>
          <input type="text" id="total_bayar" name="total_bayar" readonly
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100">
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-4">
          <button type="button" id="closeModalFooter"
                  class="px-4 py-2 rounded-lg bg-neutral-700 text-neutral-100 hover:bg-neutral-600 transition">
            Batal
          </button>
          <button type="submit"
                  class="px-4 py-2 rounded-lg bg-orange-500 text-neutral-100 hover:bg-orange-600 transition">
            Sewa Sekarang
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const modal = document.getElementById('modalTransaksi');
    const closeModal = document.getElementById('closeModal');
    const closeModalFooter = document.getElementById('closeModalFooter');
    const formSewa = document.getElementById('formSewa');
    const totalBayar = document.getElementById('total_bayar');
    const durasiInput = document.getElementById('durasi_sewa');
    const tglSewaInput = document.getElementById('tgl_sewa');
    const tglKembaliInput = document.getElementById('tgl_kembali');
    let hargaSewaPerHari = 0;

    // Fungsi tampilkan modal
    function showModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        body.classList.add('overflow-hidden');
    }

    // Fungsi sembunyikan modal
    function hideModal() {
        modal.classList.add('hidden');
        body.classList.remove('overflow-hidden');

        // Simpan id_pelanggan sebelum reset
        const idPelanggan = document.getElementById('id_pelanggan').value;

        // Reset form tapi kembalikan id_pelanggan
        formSewa.reset();
        document.getElementById('id_pelanggan').value = idPelanggan;

        totalBayar.value = '';
        durasiInput.value = '';
        hargaSewaPerHari = 0;
        document.getElementById('mobilImage').src = 'uploads/default.svg';
        document.querySelectorAll('#modalTransaksi span').forEach(span => span.innerText = '-');
    }


    // Fungsi tampilkan data mobil ke modal
    function tampilkanData(data) {
        document.getElementById('id_mobil').value = data.id_mobil;
        document.getElementById('merk').innerText = data.merk;
        document.getElementById('tipe').innerText = data.tipe;
        document.getElementById('model').innerText = data.model;
        document.getElementById('jenis').innerText = data.jenis;
        document.getElementById('tahun').innerText = data.tahun;
        document.getElementById('warna').innerText = data.warna;
        document.getElementById('transmisi').innerText = data.transmisi;
        document.getElementById('bhn_bkr').innerText = data.bhn_bkr;
        document.getElementById('silinder').innerText = data.silinder;
        document.getElementById('pintu').innerText = data.pintu;
        document.getElementById('kursi').innerText = data.kursi;
        document.getElementById('noplat').innerText = data.noplat;
        document.getElementById('nomesin').innerText = data.nomesin;
        document.getElementById('norangka').innerText = data.norangka;
        document.getElementById('harga').innerText = parseFloat(data.harga).toLocaleString('id-ID');
        hargaSewaPerHari = parseFloat(data.harga);

        const mobilImage = document.getElementById('mobilImage');
        mobilImage.src = data.img && data.img.trim() !== '' ? uploads/${data.img} : 'uploads/default.svg';
        mobilImage.onerror = () => mobilImage.src = 'uploads/default.svg';

        const statusEl = document.getElementById('status');
        statusEl.innerText = data.status;
        statusEl.className = "px-2 py-0.5 rounded text-xs font-semibold";
        if (data.status === 'ready') statusEl.classList.add('bg-green-100','text-green-700');
        else if (data.status === 'rent') statusEl.classList.add('bg-yellow-100','text-yellow-700');
        else statusEl.classList.add('bg-gray-200','text-gray-700');
    }

    // Event tombol sewa
    document.querySelectorAll('.sewa-btn').forEach(btn => {
        btn.addEventListener('click', async (e) => {
            e.preventDefault();
            const id = btn.dataset.id;

            try {
                const res = await fetch(index.php?action=store-transaksi-pelanggan&id=${id});
                const data = await res.json();

                if (data.status === 'ok') {
                    tampilkanData(data.data);
                    showModal();
                } else {
                    alert(data.message || 'Gagal mengambil data mobil');
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan koneksi');
            }
        });
    });

    // Tutup modal
    closeModal.addEventListener('click', hideModal);
    closeModalFooter.addEventListener('click', hideModal);
    modal.addEventListener('click', e => {
        if (e.target === modal) hideModal();
    });

    // Hitung durasi & total bayar otomatis
    function hitungDurasiDanTotal() {
        const tglSewa = new Date(tglSewaInput.value);
        const tglKembali = new Date(tglKembaliInput.value);

        if (tglSewaInput.value && tglKembaliInput.value) {
            if (tglKembali <= tglSewa) {
                durasiInput.value = '';
                totalBayar.value = '';
                return;
            }
            const diffTime = Math.abs(tglKembali - tglSewa);
            const durasi = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            durasiInput.value = durasi;
            totalBayar.value = hargaSewaPerHari > 0 ? (durasi * hargaSewaPerHari).toLocaleString('id-ID') : '';
        } else {
            durasiInput.value = '';
            totalBayar.value = '';
        }
    }

    tglSewaInput.addEventListener('change', hitungDurasiDanTotal);
    tglKembaliInput.addEventListener('change', hitungDurasiDanTotal);

    // Submit form
    formSewa.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(formSewa);

        try {
            const res = await fetch('index.php?action=buat-transaksi', {
                method: 'POST',
                body: formData
            });
            const result = await res.json();

            alert(result.message);
            if (result.success) {
                hideModal();
                location.reload();
            }
        } catch (err) {
            console.error(err);
            alert('Terjadi kesalahan koneksi!');
        }
    });
});

</script>
<?php
require_once __DIR__ . '/../App/Controllers/auth-controller.php';
require_once __DIR__ . '/../App/Controllers/pelanggan-controller.php';
require_once __DIR__ . '/../App/Controllers/pegawai-controller.php';

$Authcontroller = new AUTHController;
$Pelanggancontroller = new PELANGGANController;
$Pegawaicontroller = new PEGAWAIController;

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

switch ($action) {

    // AUTHENTICATION    
    case 'login':
        $Authcontroller->showlogin();
        break;
    case 'storelogin':
        $Authcontroller->login();
        break;      
    case 'signup':
        $Authcontroller->showsignup();
        break;   
    case 'storesignup':
        $Authcontroller->signup();
        break;
    case 'logout':
        $Authcontroller->logout();
        break;      
    
    // PELANGGAN    
    case 'index':
        $Pelanggancontroller->index();
        break;
    case 'store-profile-pelanggan':
        $Pelanggancontroller->Storeprofile();
        break;  
    case 'store-transaksi-pelanggan':
        $Pelanggancontroller->Storetransaksi($id);
        break;       
    case 'buat-transaksi':
        $Pelanggancontroller->buatTransaksi();
        break;  

    //PEGAWAI
    case 'index-pegawai';
        $Pegawaicontroller->index();
        break;
    case 'profile-pegawai':
        $Pegawaicontroller->Showprofile();
        break;    
    case 'store-profile-pegawai':
        $Pegawaicontroller->Storeprofile();
        break;  
    
    // 404 Not Found    
    default:
        http_response_code(404);
        include __DIR__ . '/../App/Views/errors/404.php';
        break;
}
?>
ChatGPT bilang:
Oke, aku sudah lihat seluruh kode kamu. Dari pengalaman sebelumnya, penyebab “Terjadi kesalahan koneksi!” saat submit form sewa biasanya karena request POST ke index.php?action=buat-transaksi tidak berhasil. Dari kode kamu, ada beberapa kemungkinan penyebabnya:

1️⃣ id_pelanggan kosong
Di form modal kamu sudah:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $profile['id_pelanggan'] ?? '' ?>">
Tapi $profile didefinisikan di PELANGGANController->index().
Kalau modal muncul di halaman lain atau $profile null, id_pelanggan jadi kosong → server langsung mengembalikan:

echo json_encode(['success' => false, 'message' => "Field id_pelanggan kosong"]);
Solusi: pastikan $profile['id_pelanggan'] selalu ada, atau ambil dari session:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['user']['id_user'] ?? '' ?>">
Dan di controller, jika id_pelanggan masih null, lakukan mapping dari user ke pelanggan:

if(!$data['id_pelanggan']) {
    $pelanggan = $this->model->getpelangganbyiduser($_SESSION['user']['id_user']);
    $data['id_pelanggan'] = $pelanggan['id_pelanggan'] ?? null;
}
2️⃣ fetch gagal karena URL salah
JS kamu mengirim request ke:

fetch('index.php?action=buat-transaksi', { method:'POST', body: formData })
Pastikan path index.php sesuai lokasi file ini di server. Kalau kamu memanggilnya dari subfolder, bisa gagal → 404 → catch → alert Terjadi kesalahan koneksi.

Coba gunakan path relatif ke root:

fetch('/index.php?action=buat-transaksi', { method:'POST', body: formData })
Atau cek di DevTools → Network apakah request berhasil, status 200, dan response JSON.

3️⃣ Error PDO / database
Di Transaksi->Store(), kalau terjadi error PDO, kamu langsung die():

catch(PDOException $e){
    die("Gagal Mengeksekusi Query :" . $e->getMessage());
}
Kalau ini terjadi, response tidak valid JSON → JS catch → alert kesalahan koneksi.

Solusi sementara: log error, jangan die() supaya response tetap JSON:

catch(PDOException $e){
    echo json_encode(['success'=>false,'message'=>'Gagal menyimpan transaksi: '.$e->getMessage()]);
    return false;
}
4️⃣ id_pegawai default
Di buatTransaksi() kamu pakai:

'id_pegawai' => $_SESSION['user']['id_user'] ?? 1,
Kalau user belum login, id_pegawai jadi 1 → mungkin tidak ada di DB → query gagal.

✅ Rangkuman langkah debug
Pastikan id_pelanggan selalu ada (session atau fetch dari DB).

Pastikan URL fetch('index.php?action=buat-transaksi') benar.

Cek response Network tab di DevTools → lihat JSON atau error.

Jangan gunakan die() di PDO, gunakan json_encode() untuk error.

Kalau mau, aku bisa buatkan versi final buatTransaksi() + JS + modal` yang aman supaya selalu berhasil submit dan menampilkan error dari server langsung, sehingga “Terjadi kesalahan koneksi!” hilang.

Apakah mau aku buatkan sekarang?

Anda bilang:
kalau mau buat session untuk id pelanggan gimana
ChatGPT bilang:
Oke, kalau kamu mau membuat session untuk id_pelanggan, ini langkahnya secara rapi dan aman:

1️⃣ Mulai session
Di file entry-point kamu (index.php atau bootstrap awal), panggil session_start():

<?php
session_start();
require_once __DIR__ . '/../App/Controllers/auth-controller.php';
require_once __DIR__ . '/../App/Controllers/pelanggan-controller.php';
require_once __DIR__ . '/../App/Controllers/pegawai-controller.php';
Tanpa session_start(), $_SESSION nggak akan jalan.

2️⃣ Simpan id_pelanggan ke session saat login / signup
Misal di AUTHController->login() setelah user berhasil login:

$user = $this->model->getUserByEmail($_POST['email']); // contoh ambil data user
$pelanggan = $this->pelangganModel->getpelangganbyiduser($user['id_user']);

$_SESSION['user'] = [
    'id_user' => $user['id_user'],
    'email' => $user['email'],
    'role' => $user['role']
];

// simpan id_pelanggan juga
$_SESSION['user']['id_pelanggan'] = $pelanggan['id_pelanggan'] ?? null;
Kalau user baru daftar (signup), setelah insert ke table pelanggan, langsung ambil id_pelanggan dan simpan ke session.

3️⃣ Gunakan session di controller / form
Di PELANGGANController, kamu tinggal pakai session:

$id_pelanggan = $_SESSION['user']['id_pelanggan'] ?? null;
Di form hidden:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['user']['id_pelanggan'] ?? '' ?>">
Dengan ini, JS akan mengirim id_pelanggan otomatis, nggak perlu lagi ambil dari $profile.

4️⃣ Update transaksi pakai session
Di buatTransaksi():

$data = [
    'id_mobil' => $_POST['id_mobil'] ?? null,
    'id_pelanggan' => $_SESSION['user']['id_pelanggan'] ?? null,
    'id_pegawai' => $_SESSION['user']['id_user'] ?? 1,
    ...
];
Ini memastikan id_pelanggan selalu ada.

Kalau mau, aku bisa buatkan versi revisi lengkap PELANGGANController->buatTransaksi() + modal form yang sudah pakai session, langsung siap pakai tanpa error koneksi.

Mau aku buatkan sekalian?

Anda bilang:
<?php
session_start();
require_once __DIR__ . '/../Models/user.php';
require_once __DIR__ . '/../Models/pelanggan.php';
require_once __DIR__ . '/../Models/pegawai.php';

class AUTHController {
    private $model;
    private $pelangganmodel;
    private $pegawaimodel;

    public function __construct() {
        $this->model = new User();
        $this->pelangganmodel = new Pelanggan();
        $this->pegawaimodel = new Pegawai();
    }

    public function showlogin() {
        require_once __DIR__ . '/../Views/Auth/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // 1️⃣ Validasi input kosong
            if (empty($email) || empty($password)) {
                $_SESSION['error'] = 'Email dan password tidak boleh kosong!';
                header("Location: ../Public/?action=login");
                exit;
            }

            // 2️⃣ Ambil user dari database
            $foundUser = $this->model->getuserbyemail($email);

            // 3️⃣ Jika user tidak ditemukan
            if (!$foundUser) {
                $_SESSION['error'] = 'Email tidak ditemukan!';
                header("Location: ../Public/?action=login");
                exit;
            }

            // 4️⃣ Verifikasi password
            if (!password_verify($password, $foundUser['password'])) {
                $_SESSION['error'] = 'Password salah!';
                header("Location: ../Public/?action=login");
                exit;
            }

            // 5️⃣ Simpan ke session
            $user = $this->model->getUserByEmail($_POST['email']); // contoh ambil data user
            $pelanggan = $this->pelangganmodel->getpelangganbyiduser($user['id_user']);

            $_SESSION['user'] = [
                'id_user' => $user['id_user'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            // simpan id_pelanggan juga
            $_SESSION['user']['id_pelanggan'] = $pelanggan['id_pelanggan'] ?? null;

            
            // Insert Data kosong ke table Pelanggan/Pegawai
            if ($foundUser['role'] === 'pelanggan') {
                if (!$this->pelangganmodel->getpelangganbyiduser($foundUser['id_user'])) {
                    $this->pelangganmodel->Insertpelanggan($foundUser['id_user'], Null, Null, Null, Null, Null, Null, Null, Null, Null, Null);
                }
            } elseif ($foundUser['role'] === 'pegawai') {
                if (!$this->pegawaimodel->getpegawaibyiduser($foundUser['id_user'])) {
                    $this->pegawaimodel->Insertpegawai($foundUser['id_user'], '', '', Null , '', '', '', '','','','','');
                }
            }

            // 6️⃣ Redirect ke dashboard
            header("Location: ../Public/?action=index");
            exit;
        }
    }
    
    public function showsignup() {
        require_once __DIR__ . '/../Views/Auth/signup.php';
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $jk = trim($_POST['jk']);

            if (empty($email) || empty($password) || empty($jk)) {
                $_SESSION['error'] = 'Data Tidak Boleh Kosong!';
                header("Location: ../Views/Auth/signup.php");
                exit;
            }

            $users = $this->model->Selectuser();
            foreach ($users as $user) {
                if ($user['email'] === $email) {
                    $_SESSION['error'] = 'Email sudah terdaftar!';
                    header("Location: ../Views/Auth/signup.php");
                    exit;
                }
            }

            if ($this->model->Insertuser($email, $password,$jk)) {
                $_SESSION['success'] = 'Registrasi berhasil, silakan login.';
                header("Location: ../Public/?action=login");
                exit;
            } else {
                $_SESSION['error'] = 'Gagal mendaftar.';
                header("Location: ../Views/Auth/signup.php");
                exit;
            }
        }
    }

      
    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ../Public/?action=index");
        exit;
    }
}
?>
<?php
require_once __DIR__ . '/../Models/pelanggan.php';
require_once __DIR__ . '/../Middleware/middleware.php';
require_once __DIR__ . '/../Models/mobil.php';
require_once __DIR__ . '/../Models/transaksi.php';

class PELANGGANController{
    private $model;
    private $mobilmodel;
    private $transaksimodel;

    public function __construct(){
        $this->model = new Pelanggan();   
        $this->mobilmodel = new Mobil(); 
        $this->transaksimodel = new Transaksi(); 
    }

    public function index() {
        $isLoggedIn = Middleware::requireloginOptional(); // bisa login atau tidak
        $id_user = $isLoggedIn ? $_SESSION['user']['id_user'] : null;
        $profile = $id_user ? $this->model->getpelangganbyiduser($id_user) : null;
        $id_pelanggan = $_SESSION['user']['id_pelanggan'] ?? null;

        $query = $_GET['q'] ?? '';
        $limit = 9;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $harga = $_GET['harga'] ?? null;
        $transmisi = $_GET['transmisi'] ?? null;
        $bhn_bkr = $_GET['bhn_bkr'] ?? null;
        // $kapasitas = $_GET['kapasitas'] ?? null;

        $hasFilter = !empty($harga) || !empty($transmisi) || !empty($bhn_bkr) || !empty($kapasitas);

        if ($hasFilter) {
            $data = $this->mobilmodel->filterMobil($harga, $transmisi, $bhn_bkr, $limit, $offset);
            $totalData = $this->mobilmodel->countFilterMobil($harga, $transmisi, $bhn_bkr);
            $totalPages = ceil($totalData / $limit);
        } elseif (!empty($query)) {
            $data = $this->mobilmodel->searchmobil($query, $limit, $offset);
            $totalData = $this->mobilmodel->countSearchMobil($query);
            $totalPages = ceil($totalData / $limit);
        } else {
            $data = $this->mobilmodel->getMobilWithLimit($limit, $offset);
            $totalData = $this->mobilmodel->countAllMobil();
            $totalPages = ceil($totalData / $limit);
        }

        include __DIR__ . '/../../App/Views/Pelanggan/index.php';
    }
    
    public function Storeprofile(){
        Middleware::requirerole('pelanggan'); 

        $id_user = $_SESSION['user']['id_user'];
        $dataLama = $this->model->getpelangganbyiduser($id_user);

         // 🟩 handle upload foto
        $fotoBaru = $dataLama['pp']; // default: pakai foto lama
        if (isset($_FILES['pp']) && $_FILES['pp']['error'] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['pp']['tmp_name'];
            $fileName = basename($_FILES['pp']['name']);
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

            if (in_array($fileExt, $allowed)) {
                $newName = 'pp_' . uniqid() . '.' . $fileExt;
                $uploadDir = __DIR__ . '/../../Public/uploads/';
                $uploadPath = $uploadDir . $newName;

                if (move_uploaded_file($tmpName, $uploadPath)) {
                    // 🟩 hapus foto lama kalau bukan default.svg
                    if (!empty($dataLama['pp']) && $dataLama['pp'] !== 'default.svg') {
                        $oldPath = $uploadDir . $dataLama['pp'];
                        if (file_exists($oldPath)) unlink($oldPath);
                    }
                    $fotoBaru = $newName;
                }
            }
        }

        $this->model->Updatepelanggan(
            $id_user = $_SESSION['user']['id_user'],
            $nama = $_POST['nama'],
            $nik = $_POST['nik'],
            $alamat = $_POST['alamat'],
            $kelurahan = $_POST['kelurahan'],
            $kecamatan = $_POST['kecamatan'],
            $kabkota = $_POST['kota'],
            $kp = $_POST['kp'],
            $telp = $_POST['telp'],
            $bio = $_POST['bio'],
            $fotoBaru
        );

        header("Location: index.php?action=index");
        exit;
    }

// Ambil detail mobil
public function Storetransaksi() {
    header('Content-Type: application/json');
    $id = $_GET['id'] ?? null;
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID mobil tidak ditemukan']);
        return;
    }

    $detail = $this->mobilmodel->detailmobil($id);
    if (!$detail) {
        echo json_encode(['status' => 'error', 'message' => 'Mobil tidak ditemukan']);
        return;
    }

    echo json_encode(['status' => 'ok', 'data' => $detail]);
}


// Buat transaksi
public function buatTransaksi() {
    header('Content-Type: application/json');

    $data = [
        'id_mobil' => $_POST['id_mobil'] ?? null,
        'id_pelanggan' => $_POST['id_pelanggan'] ?? null,
        'id_pegawai' => $_SESSION['user']['id_user'] ?? 1,
        'tgl_sewa' => $_POST['tgl_sewa'] ?? null,
        'tgl_kembali' => $_POST['tgl_kembali'] ?? null,
        'durasi_sewa' => $_POST['durasi_sewa'] ?? null,
        'total_bayar' => $_POST['total_bayar'] ?? null,
        'status' => 'berjalan'
    ];

    // Cek data lengkap
    foreach ($data as $key => $val) {
        if (!$val) {
            echo json_encode(['success' => false, 'message' => "Field $key kosong"]);
            return;
        }
    }

    $inserted = $this->transaksimodel->Store(
        $id_mobil = $_POST['id_mobil'] ?? null,
        $id_pelanggan = $_POST['id_pelanggan'] ?? null,
        $id_pegawai = $_SESSION['user']['id_user'] ?? 1,
        $tgl_sewa = $_POST['tgl_sewa'] ?? null,
        $tgl_kembali = $_POST['tgl_kembali'] ?? null,
        $durasi_sewa = $_POST['durasi_sewa'] ?? null,
        $total_bayar = $_POST['total_bayar'] ?? null,
        $status = 'berjalan'
    );

    if ($inserted) {
        echo json_encode(['success' => true, 'message' => 'Transaksi berhasil dibuat']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan transaksi']);
    }
}

}
?>
<!-- Modal Detail & Form Sewa -->
<div id="modalTransaksi"
     class="hidden fixed inset-0 z-[100] bg-neutral-900/80 flex justify-center items-center text-neutral-100">
  <div class="bg-neutral-900 rounded-2xl w-full max-w-2xl shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-4 border-b border-neutral-700">
      <h2 class="text-xl font-semibold text-neutral-100">Detail Mobil</h2>
      <button id="closeModal"
              class="text-neutral-300 hover:text-neutral-100 text-2xl font-bold">&times;</button>
    </div>

    <!-- Body -->
    <div class="p-6 space-y-6 max-h-[80vh] overflow-y-auto">
      <!-- Detail Mobil -->
      <div class="flex flex-col md:flex-row gap-6">
        <img id="mobilImage" src="uploads/default.svg" alt="Mobil"
             class="w-full md:w-1/3 h-48 object-cover rounded-lg border border-neutral-700">
        <div class="flex-1 grid grid-cols-2 gap-y-2 text-sm text-neutral-100">
          <p><strong>Merk:</strong> <span id="merk">-</span></p>
          <p><strong>Tipe:</strong> <span id="tipe">-</span></p>
          <p><strong>Model:</strong> <span id="model">-</span></p>
          <p><strong>Jenis:</strong> <span id="jenis">-</span></p>
          <p><strong>Tahun:</strong> <span id="tahun">-</span></p>
          <p><strong>Warna:</strong> <span id="warna">-</span></p>
          <p><strong>Transmisi:</strong> <span id="transmisi">-</span></p>
          <p><strong>Bahan Bakar:</strong> <span id="bhn_bkr">-</span></p>
          <p><strong>Silinder:</strong> <span id="silinder">-</span></p>
          <p><strong>Pintu:</strong> <span id="pintu">-</span></p>
          <p><strong>Kursi:</strong> <span id="kursi">-</span></p>
          <p><strong>Status:</strong> <span id="status" class="px-2 py-0.5 rounded text-xs font-semibold">-</span></p>
          <p class="col-span-2"><strong>No Plat:</strong> <span id="noplat">-</span></p>
          <p class="col-span-2"><strong>No Mesin:</strong> <span id="nomesin">-</span></p>
          <p class="col-span-2"><strong>No Rangka:</strong> <span id="norangka">-</span></p>
          <p class="col-span-2"><strong>Harga Sewa / Hari:</strong> Rp <span id="harga">-</span></p>
        </div>
      </div>

      <!-- FORM SEWA -->
      <form id="formSewa" class="border-t border-neutral-700 pt-5 mt-5 space-y-4">
        <h3 class="text-lg font-semibold text-neutral-100">Form Sewa</h3>
        <input type="hidden" id="id_mobil" name="id_mobil">
        <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['user']['id_pelanggan'] ?? '' ?>">


        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="tgl_sewa" class="block text-sm text-neutral-300">Tanggal Sewa</label>
            <input type="date" id="tgl_sewa" name="tgl_sewa"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
          <div>
            <label for="tgl_kembali" class="block text-sm text-neutral-300">Tanggal Kembali</label>
            <input type="date" id="tgl_kembali" name="tgl_kembali"
                   class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" required>
          </div>
        </div>

        <div>
          <label for="durasi_sewa" class="block text-sm text-neutral-300">Durasi (hari)</label>
          <input type="number" id="durasi_sewa" name="durasi_sewa" min="1"
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100 focus:ring-2 focus:ring-orange-500 outline-none" readonly required>
        </div>

        <div>
          <label for="total_bayar" class="block text-sm text-neutral-300">Total Bayar (Rp)</label>
          <input type="text" id="total_bayar" name="total_bayar" readonly
                 class="w-full border border-neutral-700 rounded-lg px-3 py-2 mt-1 bg-neutral-800 text-neutral-100">
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-4">
          <button type="button" id="closeModalFooter"
                  class="px-4 py-2 rounded-lg bg-neutral-700 text-neutral-100 hover:bg-neutral-600 transition">
            Batal
          </button>
          <button type="submit"
                  class="px-4 py-2 rounded-lg bg-orange-500 text-neutral-100 hover:bg-orange-600 transition">
            Sewa Sekarang
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const modal = document.getElementById('modalTransaksi');
    const closeModal = document.getElementById('closeModal');
    const closeModalFooter = document.getElementById('closeModalFooter');
    const formSewa = document.getElementById('formSewa');
    const totalBayar = document.getElementById('total_bayar');
    const durasiInput = document.getElementById('durasi_sewa');
    const tglSewaInput = document.getElementById('tgl_sewa');
    const tglKembaliInput = document.getElementById('tgl_kembali');
    let hargaSewaPerHari = 0;

    // Fungsi tampilkan modal
    function showModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        body.classList.add('overflow-hidden');
    }

    // Fungsi sembunyikan modal
    function hideModal() {
        modal.classList.add('hidden');
        body.classList.remove('overflow-hidden');

        // Simpan id_pelanggan sebelum reset
        const idPelanggan = document.getElementById('id_pelanggan').value;

        // Reset form tapi kembalikan id_pelanggan
        formSewa.reset();
        document.getElementById('id_pelanggan').value = idPelanggan;

        totalBayar.value = '';
        durasiInput.value = '';
        hargaSewaPerHari = 0;
        document.getElementById('mobilImage').src = 'uploads/default.svg';
        document.querySelectorAll('#modalTransaksi span').forEach(span => span.innerText = '-');
    }


    // Fungsi tampilkan data mobil ke modal
    function tampilkanData(data) {
        document.getElementById('id_mobil').value = data.id_mobil;
        document.getElementById('merk').innerText = data.merk;
        document.getElementById('tipe').innerText = data.tipe;
        document.getElementById('model').innerText = data.model;
        document.getElementById('jenis').innerText = data.jenis;
        document.getElementById('tahun').innerText = data.tahun;
        document.getElementById('warna').innerText = data.warna;
        document.getElementById('transmisi').innerText = data.transmisi;
        document.getElementById('bhn_bkr').innerText = data.bhn_bkr;
        document.getElementById('silinder').innerText = data.silinder;
        document.getElementById('pintu').innerText = data.pintu;
        document.getElementById('kursi').innerText = data.kursi;
        document.getElementById('noplat').innerText = data.noplat;
        document.getElementById('nomesin').innerText = data.nomesin;
        document.getElementById('norangka').innerText = data.norangka;
        document.getElementById('harga').innerText = parseFloat(data.harga).toLocaleString('id-ID');
        hargaSewaPerHari = parseFloat(data.harga);

        const mobilImage = document.getElementById('mobilImage');
        mobilImage.src = data.img && data.img.trim() !== '' ? uploads/${data.img} : 'uploads/default.svg';
        mobilImage.onerror = () => mobilImage.src = 'uploads/default.svg';

        const statusEl = document.getElementById('status');
        statusEl.innerText = data.status;
        statusEl.className = "px-2 py-0.5 rounded text-xs font-semibold";
        if (data.status === 'ready') statusEl.classList.add('bg-green-100','text-green-700');
        else if (data.status === 'rent') statusEl.classList.add('bg-yellow-100','text-yellow-700');
        else statusEl.classList.add('bg-gray-200','text-gray-700');
    }

    // Event tombol sewa
    document.querySelectorAll('.sewa-btn').forEach(btn => {
        btn.addEventListener('click', async (e) => {
            e.preventDefault();
            const id = btn.dataset.id;

            try {
                const res = await fetch(index.php?action=store-transaksi-pelanggan&id=${id});
                const data = await res.json();

                if (data.status === 'ok') {
                    tampilkanData(data.data);
                    showModal();
                } else {
                    alert(data.message || 'Gagal mengambil data mobil');
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan koneksi');
            }
        });
    });

    // Tutup modal
    closeModal.addEventListener('click', hideModal);
    closeModalFooter.addEventListener('click', hideModal);
    modal.addEventListener('click', e => {
        if (e.target === modal) hideModal();
    });

    // Hitung durasi & total bayar otomatis
    function hitungDurasiDanTotal() {
        const tglSewa = new Date(tglSewaInput.value);
        const tglKembali = new Date(tglKembaliInput.value);

        if (tglSewaInput.value && tglKembaliInput.value) {
            if (tglKembali <= tglSewa) {
                durasiInput.value = '';
                totalBayar.value = '';
                return;
            }
            const diffTime = Math.abs(tglKembali - tglSewa);
            const durasi = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            durasiInput.value = durasi;
            totalBayar.value = hargaSewaPerHari > 0 ? (durasi * hargaSewaPerHari).toLocaleString('id-ID') : '';
        } else {
            durasiInput.value = '';
            totalBayar.value = '';
        }
    }

    tglSewaInput.addEventListener('change', hitungDurasiDanTotal);
    tglKembaliInput.addEventListener('change', hitungDurasiDanTotal);

    // Submit form
    formSewa.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(formSewa);

        try {
            const res = await fetch('index.php?action=buat-transaksi', {
                method: 'POST',
                body: formData
            });
            const result = await res.json();

            alert(result.message);
            if (result.success) {
                hideModal();
                location.reload();
            }
        } catch (err) {
            console.error(err);
            alert('Terjadi kesalahan koneksi!');
        }
    });
});

</script>

masih aja kosong
ChatGPT bilang:
Oke, aku sudah lihat kode kamu secara menyeluruh. Kalau id_pelanggan di form modal masih kosong, penyebabnya biasanya ada beberapa hal yang harus dicek urutan dan timing session serta pengambilan datanya di PHP. Aku jelaskan step by step:

1️⃣ Pastikan session_start() dipanggil paling awal
Di semua file PHP yang memproses session, termasuk PELANGGANController dan view modal, harus ada:

<?php
session_start();
Kalau sudah dipanggil di AUTHController, pastikan di file index / bootstrap juga dipanggil sebelum include view.

2️⃣ Pastikan session id_pelanggan sudah terisi setelah login
Di AUTHController->login(), kamu punya:

$pelanggan = $this->pelangganmodel->getpelangganbyiduser($user['id_user']);
$_SESSION['user']['id_pelanggan'] = $pelanggan['id_pelanggan'] ?? null;
Masalah umum: kalau pelanggan belum ada di DB, getpelangganbyiduser mengembalikan null, sehingga id_pelanggan di session jadi null.

Solusi: buat pelanggan dulu sebelum menyimpan ke session. Misal:

if ($foundUser['role'] === 'pelanggan') {
    $pelanggan = $this->pelangganmodel->getpelangganbyiduser($foundUser['id_user']);
    if (!$pelanggan) {
        $this->pelangganmodel->Insertpelanggan($foundUser['id_user'], null, null, null, null, null, null, null, null, null, null);
        $pelanggan = $this->pelangganmodel->getpelangganbyiduser($foundUser['id_user']); // ambil lagi
    }
    $_SESSION['user']['id_pelanggan'] = $pelanggan['id_pelanggan'];
}
Ini memastikan id_pelanggan tidak null.

3️⃣ Pastikan view bisa mengakses session
Di modal form:

<input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?= $_SESSION['user']['id_pelanggan'] ?? '' ?>">
Kalau ini tetap kosong → berarti $_SESSION['user']['id_pelanggan'] belum ada saat view di-include.

Cek dengan menambahkan debug di atas form:

<?php var_dump($_SESSION['user']); ?>
Kalau muncul null atau array kosong → berarti session belum di-set dengan benar.

4️⃣ Form JS tetap mempertahankan id_pelanggan
Di script JS kamu sudah benar:

const idPelanggan = document.getElementById('id_pelanggan').value;
formSewa.reset();
document.getElementById('id_pelanggan').value = idPelanggan;
Ini hanya menjaga value saat modal ditutup.

Pastikan modal di-render setelah session ada, bukan di cache atau HTML statis.

5️⃣ Pastikan buatTransaksi() ambil id_pelanggan dari session bukan POST
Sekarang kamu pakai:

'id_pelanggan' => $_POST['id_pelanggan'] ?? null
Kalau form kosong → ini tetap null. Lebih aman ambil dari session:

'id_pelanggan' => $_SESSION['user']['id_pelanggan'] ?? null
Lalu di JS, value form bisa tetap diisi untuk debugging, tapi backend tidak tergantung input hidden.

Kalau mau, aku bisa buatkan versi revisi AUTHController->login() + modal + buatTransaksi() yang pasti id_pelanggan tidak akan kosong, dan sudah safe pakai session.

Apakah mau aku buatkan?




No file chosenNo file chosen
ChatGPT dapat membuat kesalahan. Periksa info penting. Lihat Preferensi Cookie.
