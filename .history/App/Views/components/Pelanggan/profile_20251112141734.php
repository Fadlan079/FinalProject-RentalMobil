<form id="ProfileSidebar" action="index.php?action=store-profile-pelanggan" method="post" enctype="multipart/form-data" 
    class="fixed left-0 top-0 z-200 overflow-y-auto w-full lg:w-128 h-full p-8 space-y-6 bg-neutral-900 text-neutral-50 -translate-x-full transition-all scrollbar-hide">

<div class="flex justify-between items-center">
    <div class="text-neutral-100">
    <h2>Cylc Rent Car</h2>
    </div>
    <button type="button" id="CloseProfile" class="text-gray-500">
        <i class="fa-solid fa-xmark"></i>
    </button>
</div>
<div class="text-orange-50 flex flex-col gap-5 mt-5">
    <div class="flex items-center justify-between bg-neutral-800 text-neutral-50 rounded-2xl p-4 w-full max-w-2xl mx-auto">
    <div class="flex items-center gap-4">
        <div class="relative w-16 h-16 rounded-full overflow-hidden">
        <img id="preview" 
            src="uploads/<?= !empty($profile['pp']) ? htmlspecialchars($profile['pp']) : 'default.svg' ?>"
            alt="Foto Profil" 
            class="object-cover w-full h-full">
        <input type="file" id="pp" name="pp" accept="image/*" class="hidden">
        </div>
    </div>

    <button type="button" 
            id="btnUbah" 
            class="bg-orange-500 hover:bg-orange-600 text-orange-50 text-sm font-semibold px-4 py-2 rounded-lg">
        Ubah foto
    </button>
    </div>

    <label for="">Nama</label>
    <input type="text" name="nama" value="<?= htmlspecialchars($profile['nama'])?>" placeholder="Masukkan nama lengkap Anda" class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300">

    <label for="">NIK</label>
    <input type="text" name="nik" value="<?= htmlspecialchars($profile['nik'])?>" minlength="16" maxlength="16" placeholder="Masukkan NIK (16 digit)" class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300">

    <label for="">Alamat</label>
    <input type="text" name="alamat" value="<?= htmlspecialchars($profile['alamat'])?>" placeholder="Tuliskan alamat lengkap" class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300">

    <label for="">Kelurahan</label>
    <input type="text" name="kelurahan" value="<?= htmlspecialchars($profile['kelurahan'])?>" placeholder="Masukkan nama kelurahan" class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300">

    <label for="">Kecamatan</label>
    <input type="text" name="kecamatan" value="<?= htmlspecialchars($profile['kecamatan'])?>" placeholder="Masukkan kecamatan" class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300">

    <label for="">Kota</label>
    <input type="text" name="kota" value="<?= htmlspecialchars($profile['kota'])?>" placeholder="Masukkan kota" class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300">

    <label for="">Kode Pos</label>
    <input type="text" name="kp" minlength="5" maxlength="5" value="<?= htmlspecialchars($profile['kp'])?>" placeholder="Masukkan kode pos (5 digit)" class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300">

    <label for="">No Telepon</label>
    <input type="tel" name="telp" value="<?= htmlspecialchars($profile['telp'])?>" minlength="10" maxlength="13" pattern="^0[0-9]{9,12}$" placeholder="Contoh: 081234567890" class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300">

    <label for="">Bio</label>
    <textarea name="bio" placeholder="Ceritakan sedikit tentang diri Anda..." class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300"><?= htmlspecialchars($profile['bio'])?>
    </textarea>

    <input type="submit" value="Konfirmasi" class="p-2 bg-orange-500 font-semibold rounded-xl hover:bg-orange-600 transition-all duration-300">
</div>
</form>
<script>
    const input = document.getElementById('pp');
    const preview = document.getElementById('preview');
    const btnUbah = document.getElementById('btnUbah');

    btnUbah.addEventListener('click', () => input.click());

    input.addEventListener('change', e => {
        const file = e.target.files[0];
        if (file) preview.src = URL.createObjectURL(file);
    });
</script>