<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insert Mobil - Cylc Rent Car</title>
  <link rel="stylesheet" href="../src/output.css">
</head>

<body class="bg-[url('../src/assets/Jesko%20absolut.jpeg')] bg-cover bg-center bg-no-repeat h-screen flex justify-center items-center">
  
  <form method="POST" class="shadow-2xl w-full max-w-xl p-10 rounded-2xl bg-neutral-900/50 backdrop-blur-md text-neutral-100 border border-neutral-700 grid gap-5">
    
    <h2 class="text-3xl font-semibold text-center text-orange-400">Tambah Data Mobil</h2>
    <hr class="border-orange-500/50 mb-4">

    <div class="flex flex-col">
      <label for="merek" class="mb-1 text-sm text-neutral-300">Merek</label>
      <input type="text"  name="merek" placeholder="Contoh: Koenigsegg" required class="rounded-xl p-2 bg-neutral-800 border border-neutral-700 focus:ring-2 focus:ring-orange-500 focus:outline-none">
    </div>

    <div class="flex flex-col">
      <label for="model" class="mb-1 text-sm text-neutral-300">Model</label>
      <input type="text" name="model" placeholder="Contoh: Jesko Absolut" required class="rounded-xl p-2 bg-neutral-800 border border-neutral-700 focus:ring-2 focus:ring-orange-500 focus:outline-none">
    </div>

    <div class="flex flex-col">
      <label for="tahun" class="mb-1 text-sm text-neutral-300">Tahun</label>
      <input type="number" name="tahun" min="1900" max="2100" placeholder="Contoh: 2022" required class="rounded-xl p-2 bg-neutral-800 border border-neutral-700 focus:ring-2 focus:ring-orange-500 focus:outline-none">
    </div>

    <div class="flex flex-col">
      <label for="harga_sewa" class="mb-1 text-sm text-neutral-300">Harga Sewa / Hari</label>
      <input type="number" name="harga_sewa" min="2000000" max="500000000" step="500000" placeholder="Contoh: 9000000" required class="rounded-xl p-2 bg-neutral-800 border border-neutral-700 focus:ring-2 focus:ring-orange-500 focus:outline-none">
    </div>

    <div class="flex flex-col">
      <label for="status" class="mb-1 text-sm text-neutral-300">Status</label>
      <select  name="status" required class="bg-neutral-800 border border-neutral-700 rounded-xl p-2 focus:ring-2 focus:ring-orange-500 focus:outline-none">
        <option disabled selected hidden>--- Pilih Status ---</option>
        <option value="ready">Ready</option>
        <option value="rent">Rent</option>
        <option value="maintenance">Maintenance</option>
      </select>
    </div>

    <button type="submit" class="mt-2 bg-orange-500 hover:bg-orange-600 transition-all duration-300 p-2 rounded-xl shadow-lg font-semibold text-orange-50"> Simpan</button>

    <a href="index.php" class="text-center underline font-semibold hover:text-orange-400 transition">Kembali</a>
  </form>

</body>
</html>
