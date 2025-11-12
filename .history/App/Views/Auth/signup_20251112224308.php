<?php if (isset($_SESSION['error'])): ?>
  <div class="bg-red-600 text-white p-2 rounded mb-3 text-center">
    <?= $_SESSION['error']; ?>
  </div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
  <div class="bg-green-600 text-white p-2 rounded mb-3 text-center">
    <?= $_SESSION['success']; ?>
  </div>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SignUp - Cylc Rent Car</title>
  <link rel="stylesheet" href="output.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <style>
    html {
      scroll-behavior: smooth;
    }

    .scrollbar-hide::-webkit-scrollbar { display: none; }

    ::-webkit-scrollbar {
      width: 5px;
      transition: width 0.3s ease;
    }

    ::-webkit-scrollbar-track {
      background: #171717;
    }

    ::-webkit-scrollbar-thumb {
      background: #f97316;
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #ea580c;
      box-shadow: 0 0 0 2px #ea580c;
    }

  </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-neutral-900 via-neutral-800 to-neutral-900 flex items-center justify-center text-gray-100">

  <form action="index.php?action=storesignup" method="post"
        class="w-full max-w-md p-8 rounded-2xl bg-neutral-800/80 backdrop-blur-md shadow-2xl space-y-5 border border-neutral-700">
    
    <div class="text-center space-y-2">
      <i class="fa-solid fa-pen-to-square text-4xl text-orange-500"></i>
      <h2 class="text-3xl font-bold tracking-wide">Buat Akun Anda</h2>
      <p class="text-sm text-gray-400">Daftar sekarang untuk menikmati kemudahan sewa mobil bersama <span class="text-orange-400 font-medium">Cylc Rent Car</span></p>
    </div>

    <div>
      <label class="block mb-1 text-sm font-medium text-gray-300">Nama Lengkap</label>
      <div class="relative">
          <i class="fa-solid fa-user absolute left-3 top-3 text-gray-400"></i>
        <input name="nama" type="text" placeholder="Masukkan nama lengkap Anda" required
               class="w-full pl-10 pr-3 py-2 rounded-lg bg-neutral-700 border border-neutral-600 text-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
      </div>
    </div>


    <div>
      <label class="block mb-1 text-sm font-medium text-gray-300">Email</label>
      <div class="relative">
        <i class="fa-solid fa-envelope absolute left-3 top-3 text-gray-400"></i>
        <input name="email" type="email" placeholder="you@example.com" required
               class="w-full pl-10 pr-3 py-2 rounded-lg bg-neutral-700 border border-neutral-600 text-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
      </div>
    </div>

    <div>
      <label class="block mb-1 text-sm font-medium text-gray-300">Password</label>
      <div class="relative">
        <i class="fa-solid fa-lock absolute left-3 top-3 text-gray-400"></i>
        <input name="password" type="password" placeholder="********" required
               class="w-full pl-10 pr-3 py-2 rounded-lg bg-neutral-700 border border-neutral-600 text-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
      </div>
    </div>

      <div>
      <label class="block mb-1 text-sm font-medium text-gray-300">Nik</label>
      <div class="relative">
        <i class="fa-solid fa-id-card absolute left-3 top-3 text-gray-400"></i>
        <input name="nik" type="text" minlength="16" maxlength="16" placeholder="Masukkan NIK (16 digit)" required
               class="w-full pl-10 pr-3 py-2 rounded-lg bg-neutral-700 border border-neutral-600 text-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
      </div>
    </div>

      <div>
      <label class="block mb-1 text-sm font-medium text-gray-300">Alamat</label>
      <div class="relative">
        <i class="fa-solid fa-location-dot absolute left-3 top-3 text-gray-400"></i>
        <input name="alamat" type="text" placeholder="Tuliskan alamat lengkap" required
               class="w-full pl-10 pr-3 py-2 rounded-lg bg-neutral-700 border border-neutral-600 text-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
      </div>
    </div>

    <div>
      <label class="block mb-1 text-sm font-medium text-gray-300">Kota</label>
      <div class="relative">
        <i class="fa-solid fa-lock absolute left-3 top-3 text-gray-400"></i>
        <input name="p" type="text" placeholder="Masukkan kota" required
               class="w-full pl-10 pr-3 py-2 rounded-lg bg-neutral-700 border border-neutral-600 text-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
      </div>
    </div>

    <div>
      <label class="block mb-1 text-sm font-medium text-gray-300">No Telepon</label>
      <div class="relative">
        <i class="fa-solid fa-lock absolute left-3 top-3 text-gray-400"></i>
        <input name="password" type="password" placeholder="********" required
               class="w-full pl-10 pr-3 py-2 rounded-lg bg-neutral-700 border border-neutral-600 text-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
      </div>
    </div>

    <div>
        <label class="block mb-1 text-sm font-medium text-gray-300">Jenis Kelamin</label>
        <div class="relative">
            <i class="fa-solid fa-venus-mars absolute left-3 top-3 text-gray-400"></i>
            <select name="jk" required
            class="w-full pl-10 pr-8 py-2 rounded-lg bg-neutral-700 border border-neutral-600 text-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500 appearance-none cursor-pointer transition">
                <option value="" disabled selected>Pilih jenis kelamin</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>

            <i class="fa-solid fa-chevron-down absolute right-3 top-3 text-gray-400 pointer-events-none"></i>
        </div>
    </div>

    <button type="submit"
            class="w-full flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 rounded-lg shadow-md transition duration-300">
      <i class="fa-solid fa-pen-to-square"></i> Sign Up
    </button>

    <div class="flex items-center gap-2">
      <hr class="flex-grow border-neutral-600">
      <span class="text-gray-400 text-sm">atau</span>
      <hr class="flex-grow border-neutral-600">
    </div>

    <p class="text-center text-sm text-gray-400">
      Sudah punya akun?
      <a href="index.php?action=login"
         class="text-orange-400 hover:text-orange-300 font-medium transition">
         login Sekarang
      </a>
    </p>

      <a href="index.php?action=index"
         class="block text-orange-400 hover:text-orange-300 text-center text-sm font-medium transition">
         <i class="fa-solid fa-arrow-left"></i> Kembali Ke Beranda
      </a>
  </form>

</body>
</html>
