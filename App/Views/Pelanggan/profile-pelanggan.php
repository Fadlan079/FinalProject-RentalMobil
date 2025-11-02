<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile - Cylc Rent Car</title>
  <link rel="stylesheet" href="output.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <style>
    html {
      scroll-behavior: smooth;
    }

    .scrollbar-hide::-webkit-scrollbar { display: none; }

    ::-webkit-scrollbar {
      width: 10px;
    }

    ::-webkit-scrollbar-track {
      background: #171717;
    }

    ::-webkit-scrollbar-thumb {
      background: #f97316;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #ea580c;
    }
  </style>
</head>
<body>
  <form action="index.php?action=store-profile-pelanggan" method="post" enctype="multipart/form-data" 
        class="w-full h-full p-8 space-y-6 bg-neutral-900 text-neutral-50">

    <div class="flex justify-between items-center">
        <div class="text-neutral-100">
        <h2>Cylc Rent Car</h2>
        </div>
        <a href="index.php?action=index" class="text-gray-500">
            <i class="fa-solid fa-xmark"></i>
        </a>
    </div>
    <div class="text-orange-50 flex flex-col gap-5 mt-5">
      <div class="flex items-center justify-between bg-neutral-800 text-neutral-50 rounded-2xl p-4 w-full max-w-2xl mx-auto">
        <div class="flex items-center gap-4">
            <div class="relative w-16 h-16 rounded-full overflow-hidden">
            <img id="preview" 
                src="uploads/<?= !empty($data['pp']) ? htmlspecialchars($data['pp']) : 'default.svg' ?>"
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
      <input type="text" name="nama" placeholder="Nama" class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300">

      <label for="">NIK</label>
      <input type="number" name="nik" placeholder="12345678" class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300">

      <label for="">Alamat</label>
      <input type="text" name="alamat" placeholder="Jl Raya" class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300">

      <label for="">Kelurahan</label>
      <input type="text" name="kelurahan" placeholder="Gunung Kelua" class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300">

      <label for="">Kecamatan</label>
      <input type="text" name="kecamatan" placeholder="Samarinda Ulu" class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300">

      <label for="">Kabupaten Kota</label>
      <input type="text" name="kabkota" placeholder="Samarinda" class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300">

      <label for="">Kode Pos</label>
      <input type="number" name="kp" max="5" placeholder="12345" class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300">

      <label for="">No Telepon</label>
      <input type="tel" name="telp" placeholder="08xxxxxxxxxx" class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300">

      <label for="">Bio</label>
      <textarea name="bio" class="p-2 border-2 border-neutral-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300"></textarea>

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
</body>
</html>
