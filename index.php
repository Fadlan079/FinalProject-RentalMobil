<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cylc Rent Car</title>
  <link rel="stylesheet" href="src/output.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <style>
    @keyframes marquee {
      0%{
        transform: translateX(100%);
      }
      100% {
        transform: translateX(-50%);
      }
    }

    .marquee {
      animation: marquee 15s linear infinite;
    }
  </style>
</head>
<body class="h-screen bg-neutral-200 font-serif">
  <header class="h-screen relative">
    <div class="bg-neutral-900 h-130 w-full relative">
      <img src="src/assets/Jesko Absolut.jpeg" alt="bg" class="absolute inset-0 h-full w-full object-cover">
    </div>
    <div class="whitespace-nowrap p-3 shadow-xl overflow-hidden text-4xl">
      <div class="flex marquee">
        <p class="px-3"><i class="fa-solid fa-car-side"></i></p>
        <p class="px-3"><i class="fa-solid fa-car-side"></i></p>
        <p class="px-3"><i class="fa-solid fa-car-side"></i></p>
        <!-- <img src="src/assets/koennigsegg.jpeg" alt="koenigsegg logo"> -->
      </div>
    </div>
    <div class="absolute inset-0 flex justify-between top-5 mx-10 z-20">
      <div>
        <div class="flex text-lg relative">
          <a href="index.php" class="block cursor-pointer bg-neutral-200 w-10 h-10 rounded-full text-neutral-900 p-2 mx-2 shadow-xl"><i class="fa-solid fa-car"></i></a>
          <div class="bg-neutral-200 rounded-l-lg rounded-r-4xl w-35 p-1"></div>
          <a href="index.php" class="block text-neutral-900 absolute ml-16 mt-1 shadow-xl">Cylc Rent Car</a>
        </div>
      </div>
      <div>
        <div class="text-sm my-auto flex gap-4">
          <a href="#" class="cursor-pointer inline-block bg-neutral-200 p-2 shadow-xl text-neutral-200 rounded-lg hover:-translate-y-1 hover:shadow-xl transition-all duration-300">List Cars</a>
          <a href="#" class="cursor-pointer inline-block p-2 shadow-xl text-neutral-200 rounded-lg hover:-translate-y-1 hover:shadow-xl transition-all duration-300">Booking Cars</a>
          <details class="relative inline-block cursor-pointer">
            <summary class="bg-neutral-800 p-2 shadow-xl text-neutral-200 rounded-lg  active:scale-90 transition-all duration-300 marker:content-none">
              <i class="fa-solid fa-bars"></i>
              <i class="fa-solid fa-user"></i>
            </summary>
            <ul class="absolute z-100 right-0 mt-2 px-5 py-5 w-45 text-sm bg-neutral-200 rounded-xl border border-neutral-300">
              <li class="p-1"><a href="App/Controllers/login.php">Log in</a></li>
              <li class="p-1"><a href="App/Controllers/signup.php">Sign up</a></li>
              <hr class="m-1 border border-neutral-500">
              <li class="p-1"><a href="#"><i class="fa-solid fa-car-on"></i> Why choose Cycl</a></li>
              <li class="p-1"><a href="#"><i class="fa-solid fa-headset"></i> Contact support</a></li>
              <li class="p-1"><a href="#"><i class="fa-solid fa-gears"></i> Setting</a></li>
            </ul>
          </details>
        </div>
      </div>
    </div>
    <div class="absolute text-neutral-200 justify-center text-center inset-0 flex flex-col rounded-xl">
      <!-- <h2 class="text-5xl font-semibold p-1 m-1 tracking-wide">Skip the rental car counter</h2>
      <p class="text-xl p-1 m-1 tracking-wide">Rent just about any car, just about anywhere</p> -->
      <form action="" class="bg-neutral-200 text-neutral-900 rounded-full p-2 m-2 w-330 mx-auto flex shadow-xl border border-neutral-300">
        <input type="text" placeholder="Search for any car..." class="w-full outline-none p-1">
        <button type="submit" class="p-2 w-12 h-12 bg-neutral-900 text-neutral-200 rounded-full active:scale-90"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
      <button class="flex justify-center cursor-pointer shadow-xl text-lg p-1 m-1 bg-neutral-200 rounded-lg text-neutral-900 w-50 mx-auto active:scale-90 transition-all duration-300">Get to know Cylc <i class="fa-solid fa-caret-right my-auto"></i></button>
    </div>
  </header>
  <!-- <header class="relative max-w-6xl m-auto mx-auto">
    <nav class="p-3 text-neutral-900">
      <div class="flex justify-between">
        <div class="flex text-lg relative">
          <a href="index.php" class="block cursor-pointer bg-neutral-900 w-10 h-10 rounded-full text-neutral-200 p-2 mx-2 shadow-xl"><i class="fa-solid fa-car"></i></a>
          <div class="bg-neutral-900 rounded-l-lg rounded-r-4xl w-35 p-1"></div>
          <a href="index.php" class="block text-neutral-200 absolute ml-16 mt-1 shadow-xl">Cylc Rent Car</a>
        </div>
        <div class="text-sm my-auto flex gap-4">
          <a href="#" class="cursor-pointer inline-block bg-neutral-800 p-2 shadow-xl text-neutral-200 rounded-lg hover:-translate-y-1 hover:shadow-xl transition-all duration-300">List Cars</a>
          <a href="#" class="cursor-pointer inline-block bg-neutral-800 p-2 shadow-xl text-neutral-200 rounded-lg hover:-translate-y-1 hover:shadow-xl transition-all duration-300">Booking Cars</a>
          <details class="relative inline-block cursor-pointer">
            <summary class="bg-neutral-800 p-2 shadow-xl text-neutral-200 rounded-lg  active:scale-90 transition-all duration-300 marker:content-none">
              <i class="fa-solid fa-bars"></i>
              <i class="fa-solid fa-user"></i>
            </summary>
            <ul class="absolute z-20 right-0 mt-2 px-5 py-5 w-45 text-sm bg-neutral-200 rounded-xl border border-neutral-300">
              <li class="p-1"><a href="App/Controllers/login.php">Log in</a></li>
              <li class="p-1"><a href="App/Views/signup.php">Sign up</a></li>
              <hr class="m-1 border border-neutral-500">
              <li class="p-1"><a href="#"><i class="fa-solid fa-car-on"></i> Why choose Cycl</a></li>
              <li class="p-1"><a href="#"><i class="fa-solid fa-headset"></i> Contact support</a></li>
              <li class="p-1"><a href="#"><i class="fa-solid fa-gears"></i> Setting</a></li>
            </ul>
          </details>
        </div>
      </div>
    </nav>
    <img src="src/assets/jesko Absolut.jpeg" alt="koenisegg" class="rounded-2xl w-279 h-100 mx-auto shadow-xl">
    <div class="bg-neutral-900"></div>
    <div class="absolute text-neutral-200 justify-center text-center inset-0 flex flex-col backdrop-blur-xs top-15 rounded-xl">
      <h2 class="text-5xl font-semibold p-1 m-1 tracking-wide">Skip the rental car counter</h2>
      <p class="text-xl p-1 m-1 tracking-wide">Rent just about any car, just about anywhere</p>
      <form action="" class="bg-neutral-200 text-neutral-900 rounded-xl p-1 m-2 w-200 mx-auto flex shadow-xl border border-neutral-300">
        <input type="text" placeholder="Search for any car..." class="w-full outline-none p-1">
        <button type="submit" class="p-2 bg-neutral-900 text-neutral-200 rounded-lg active:scale-90"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
      <button class="flex justify-center cursor-pointer shadow-xl text-lg p-1 m-1 bg-neutral-200 rounded-lg text-neutral-900 w-50 mx-auto active:scale-90 transition-all duration-300">Get to know Cylc <i class="fa-solid fa-caret-right my-auto"></i></button>
    </div>
  </header> -->
  <main>
    <section class="h-screen bg-neutral-900">
      <div class="max-w-6xl m-auto flex">
        <div>
          <h2>Tentang Kami</h2>
          <h2>Rent Car Cylc</h2>
          <p>Sewa Mobil Samarinda adalah penyedia jasa rental mobil terpercaya di Kota Samarinda, Kalimantan Timur. Didirikan dengan semangat memberikan solusi transportasi yang aman, nyaman, dan terjangkau, kami hadir untuk memenuhi kebutuhan mobilitas masyarakat, wisatawan, hingga pelaku bisnis di kota ini.

          Dengan armada yang selalu terawat dan pelayanan yang profesional, kami telah dipercaya oleh berbagai kalangan—mulai dari individu, keluarga, perusahaan, hingga instansi pemerintahan. Sewa Mobil samarinda selalu menjunjung tinggi prinsip pelayanan prima, transparansi harga, dan kepuasan pelanggan sebagai prioritas utama.</p>
          <button class="bg-neutral-200 p-2 rounded-xl shadow-xl">Whatsapp Admin</button>
        </div>
        <div>
          <img src="" alt="ilustrasi">
        </div>
      </div>
    </section>
    <section class="h-screen bg-teal-800">
      <div class="max-w-6xl m-auto text-center">
        <h2 class="text-neutral-200 p-7 text-5xl">Jenis Layanan Rental Mobil Cylc</h2>
        <p class="text-neutral-200">Sewa mobil Samarinda menghadirkan beragam jenis layanan rental mobil yang fleksibel, efisien, dan dapat disesuaikan dengan kebutuhan pelanggan. Kami memahami bahwa setiap perjalanan memiliki karakteristik dan tujuan yang berbeda, oleh karena itu kami menyediakan pilihan layanan yang dirancang khusus untuk memberikan kenyamanan, kemudahan, serta kontrol penuh kepada pelanggan dalam menentukan jenis layanan yang paling sesuai</p>
        <div class="grid grid-cols-3 gap-6 m-7 p-7">
          <div class="bg-neutral-200 shadow-xl rounded-xl p-4 h-90 text-center">
            <h2 class="text-7xl p-2"><i class="fa-solid fa-key"></i></h2>
            <h2 class="p-2 font-semibold">Sewa Mobil Lepas Kunci</h2>
            <p class="p-2 text-neutral-600">Cocok untuk Anda yang ingin berkendara sendiri dan lebih fleksibel dalam mengatur waktu perjalanan. Layanan ini tersedia untuk sewa harian maupun jangka panjang.</p>
          </div>
          <div class="bg-neutral-200 shadow-xl rounded-xl p-4 h-90 text-center">
            <h2 class="text-7xl p-2"><i class="fa-solid fa-id-card"></i></h2>
            <h2 class="p-2 font-semibold">Sewa Mobil dengan Driver</h2>
            <p class="p-2 text-neutral-600">Driver berpengalaman dan ramah yang siap mengantar Anda ke berbagai tujuan dengan aman dan efisien. Ideal untuk perjalanan bisnis, tamu VIP, atau liburan keluarga.</p>
          </div>
          <div class="bg-neutral-200 shadow-xl rounded-xl p-4 h-90 text-center">
            <h2 class="text-7xl p-2"><i class="fa-solid fa-clock"></i></h2>
            <h2 class="p-2 font-semibold">Sewa Harian dan Bulanan</h2>
            <p class="p-2 text-neutral-600">Pilihan fleksibel untuk Anda yang membutuhkan kendaraan dalam jangka pendek atau panjang, baik untuk keperluan pribadi, bisnis, maupun operasional perusahaan.</p>
          </div>
        </div>
        
      </div>
    </section>
    <section class="h-screen max-w-6xl m-auto mt-6">
      <div class="flex justify-between text-neutral-200 mx-70 m-10">
        <button class="cursor-pointer bg-neutral-900 p-2 rounded-xl shadow-xl hover:-translate-y-1 hover:shadow-xl transition-all duration-300"><i class="fa-solid fa-car"></i> All</button>
        <button class="cursor-pointer text-neutral-900 p-2 rounded-xl shadow-xl hover:bg-neutral-900 hover:text-neutral-200 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300"><i class="fa-solid fa-people-roof"></i> Family</button>
        <button class="cursor-pointer text-neutral-900 p-2 rounded-xl shadow-xl hover:bg-neutral-900 hover:text-neutral-200 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300"><i class="fa-solid fa-money-bills"></i> Economy</button>
        <button class="cursor-pointer text-neutral-900 p-2 rounded-xl shadow-xl hover:bg-neutral-900 hover:text-neutral-200 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300"><i class="fa-solid fa-key"></i> Self Drive</button>
        <button class="cursor-pointer text-neutral-900 p-2 rounded-xl shadow-xl hover:bg-neutral-900 hover:text-neutral-200 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300"><i class="fa-solid fa-user-tie"></i> With Driver</button>
      </div>
      <h1 class="text-2xl m-10">Car rental at Los Angeles (LAX) airport</h1>
      <div class="grid grid-cols-4 gap-6 mt-6">
        <div class="shadow-xl rounded-xl p-1 group cursor-pointer relative group overflow-hidden ">
          <div class="absolute inset-0 bottom-40 rounded-t-xl bg-neutral-900/40 backdrop-blur-xl -translate-y-14 text-neutral-200 text-center group-hover:translate-y-0 group-hover:shadow-xl transition-all duration-300">
            <h2 class="text-xl p-1">Example Car</h2>
          </div>
          <img src="src/assets/jesko Absolut.jpeg" alt="koenigsegg" class="rounded-xl p-1">
          <div class="flex gap-7 text-neutral-500 p-1 text-xs">
            <p><i class="fa-solid fa-suitcase"></i> 1</p>
            <p><i class="fa-solid fa-user"></i> 2</p>
            <p>Automatic</p>
            <p>In use</p>
          </div>
          <div class="flex p-1">
            <h2 class="text-orange-500 text-xl font-sans">IDR 7.000.000</h2>
            <p class="text-sm p-1 text-neutral-500">/Day</p>
          </div>
          <a href="#" class="p-1 text-sm underline">View Details</a>
        </div>
        <div class="shadow-xl rounded-xl p-1 group cursor-pointer relative group overflow-hidden">
          <div class="absolute inset-0 bottom-40 rounded-t-xl bg-neutral-900/40 backdrop-blur-xl  -translate-y-14 text-neutral-200 text-center group-hover:translate-y-0 group-hover:shadow-xl transition-all duration-300">
            <h2 class="text-xl p-1">Example Car</h2>
          </div>
          <img src="src/assets/jesko Absolut.jpeg" alt="koenigsegg" class="rounded-xl p-1">
          <div class="flex gap-7 text-neutral-500 p-1 text-xs">
            <p><i class="fa-solid fa-suitcase"></i> 1</p>
            <p><i class="fa-solid fa-user"></i> 2</p>
            <p>Automatic</p>
            <p>In use</p>
          </div>
          <div class="flex p-1">
            <h2 class="text-orange-500 text-xl font-sans">IDR 7.000.000</h2>
            <p class="text-sm p-1 text-neutral-500">/Day</p>
          </div>
          <a href="#" class="p-1 text-sm underline">View Details</a>
        </div>
        <div class="shadow-xl rounded-xl p-1 group cursor-pointer relative group overflow-hidden">
          <div class="absolute inset-0 bottom-40 rounded-t-xl bg-neutral-900/40 backdrop-blur-xl  -translate-y-14 text-neutral-200 text-center group-hover:translate-y-0 group-hover:shadow-xl transition-all duration-300">
            <h2 class="text-xl p-1">Example Car</h2>
          </div>
          <img src="src/assets/jesko Absolut.jpeg" alt="koenigsegg" class="rounded-xl p-1">
          <div class="flex gap-7 text-neutral-500 p-1 text-xs">
            <p><i class="fa-solid fa-suitcase"></i> 1</p>
            <p><i class="fa-solid fa-user"></i> 2</p>
            <p>Automatic</p>
            <p>In use</p>
          </div>
          <div class="flex p-1">
            <h2 class="text-orange-500 text-xl font-sans">IDR 7.000.000</h2>
            <p class="text-sm p-1 text-neutral-500">/Day</p>
          </div>
          <a href="#" class="p-1 text-sm underline">View Details</a>
        </div>
        <div class="shadow-xl rounded-xl p-1 group cursor-pointer relative group overflow-hidden">
          <div class="absolute inset-0 bottom-40 rounded-t-xl bg-neutral-900/40 backdrop-blur-xl  -translate-y-14 text-neutral-200 text-center group-hover:translate-y-0 group-hover:shadow-xl transition-all duration-300">
            <h2 class="text-xl p-1">Example Car</h2>
          </div>
          <img src="src/assets/jesko Absolut.jpeg" alt="koenigsegg" class="rounded-xl p-1">
          <div class="flex gap-7 text-neutral-500 p-1 text-xs">
            <p><i class="fa-solid fa-suitcase"></i> 1</p>
            <p><i class="fa-solid fa-user"></i> 2</p>
            <p>Automatic</p>
            <p>In use</p>
          </div>
          <div class="flex p-1">
            <h2 class="text-orange-500 text-xl font-sans">IDR 7.000.000</h2>
            <p class="text-sm p-1 text-neutral-500">/Day</p>
          </div>
          <a href="#" class="p-1 text-sm underline">View Details</a>
        </div>
        <div class="shadow-xl rounded-xl p-1 group cursor-pointer relative group overflow-hidden">
          <div class="absolute inset-0 bottom-40 rounded-t-xl bg-neutral-900/40 backdrop-blur-xl  -translate-y-14 text-neutral-200 text-center group-hover:translate-y-0 group-hover:shadow-xl transition-all duration-300">
            <h2 class="text-xl p-1">Example Car</h2>
          </div>
          <img src="src/assets/jesko Absolut.jpeg" alt="koenigsegg" class="rounded-xl p-1">
          <div class="flex gap-7 text-neutral-500 p-1 text-xs">
            <p><i class="fa-solid fa-suitcase"></i> 1</p>
            <p><i class="fa-solid fa-user"></i> 2</p>
            <p>Automatic</p>
            <p>In use</p>
          </div>
          <div class="flex p-1">
            <h2 class="text-orange-500 text-xl font-sans">IDR 7.000.000</h2>
            <p class="text-sm p-1 text-neutral-500">/Day</p>
          </div>
          <a href="#" class="p-1 text-sm underline">View Details</a>
        </div>
        <div class="shadow-xl rounded-xl p-1 group cursor-pointer relative group overflow-hidden">
          <div class="absolute inset-0 bottom-40 rounded-t-xl bg-neutral-900/40 backdrop-blur-xl  -translate-y-14 text-neutral-200 text-center group-hover:translate-y-0 group-hover:shadow-xl transition-all duration-300">
            <h2 class="text-xl p-1">Example Car</h2>
          </div>
          <img src="src/assets/jesko Absolut.jpeg" alt="koenigsegg" class="rounded-xl p-1">
          <div class="flex gap-7 text-neutral-500 p-1 text-xs">
            <p><i class="fa-solid fa-suitcase"></i> 1</p>
            <p><i class="fa-solid fa-user"></i> 2</p>
            <p>Automatic</p>
            <p>In use</p>
          </div>
          <div class="flex p-1">
            <h2 class="text-orange-500 text-xl font-sans">IDR 7.000.000</h2>
            <p class="text-sm p-1 text-neutral-500">/Day</p>
          </div>
          <a href="#" class="p-1 text-sm underline">View Details</a>
        </div>
        <div class="shadow-xl rounded-xl p-1 group cursor-pointer relative group overflow-hidden">
          <div class="absolute inset-0 bottom-40 rounded-t-xl bg-neutral-900/40 backdrop-blur-xl  -translate-y-14 text-neutral-200 text-center group-hover:translate-y-0 group-hover:shadow-xl transition-all duration-300">
            <h2 class="text-xl p-1">Example Car</h2>
          </div>
          <img src="src/assets/jesko Absolut.jpeg" alt="koenigsegg" class="rounded-xl p-1">
          <div class="flex gap-7 text-neutral-500 p-1 text-xs">
            <p><i class="fa-solid fa-suitcase"></i> 1</p>
            <p><i class="fa-solid fa-user"></i> 2</p>
            <p>Automatic</p>
            <p>In use</p>
          </div>
          <div class="flex p-1">
            <h2 class="text-orange-500 text-xl font-sans">IDR 7.000.000</h2>
            <p class="text-sm p-1 text-neutral-500">/Day</p>
          </div>
          <a href="#" class="p-1 text-sm underline">View Details</a>
        </div>
        <div class="shadow-xl rounded-xl p-1 group cursor-pointer relative group overflow-hidden">
          <div class="absolute inset-0 bottom-40 rounded-t-xl bg-neutral-900/40 backdrop-blur-xl  -translate-y-14 text-neutral-200 text-center group-hover:translate-y-0 group-hover:shadow-xl transition-all duration-300">
            <h2 class="text-xl p-1">Example Car</h2>
          </div>
          <img src="src/assets/jesko Absolut.jpeg" alt="koenigsegg" class="rounded-xl p-1">
          <div class="flex gap-7 text-neutral-500 p-1 text-xs">
            <p><i class="fa-solid fa-suitcase"></i> 1</p>
            <p><i class="fa-solid fa-user"></i> 2</p>
            <p>Automatic</p>
            <p>In use</p>
          </div>
          <div class="flex p-1">
            <h2 class="text-orange-500 text-xl font-sans">IDR 7.000.000</h2>
            <p class="text-sm p-1 text-neutral-500">/Day</p>
          </div>
          <a href="#" class="p-1 text-sm underline">View Details</a>
        </div>
      </div>
    </section>
    <section class="h-fit py-20 bg-orange-500">
      <div class="max-w-6xl m-auto">
        <div class="text-center m-7 p-7  text-neutral-200">
          <h2 class="text-4xl p-4">Keuntungan Menggunakan Jasa Car Rent Cylc</h2>
          <p class="text-neutral-300">Menggunakan jasa rental mobil, khususnya dari Sewa mobil Samarinda, memberikan beragam manfaat nyata yang sering kali jauh lebih efisien dan praktis dibandingkan membawa kendaraan pribadi atau mengandalkan transportasi umum. Baik untuk keperluan pribadi, perjalanan dinas, kunjungan kerja, atau liburan keluarga, rental mobil menawarkan fleksibilitas, kenyamanan, dan kontrol penuh atas perjalanan Anda.</p>
        </div>
        <div class="grid grid-cols-1 gap-3">
          <div class="bg-neutral-200 shadow-xl rounded-xl p-4 flex gap-10">
            <h2 class="text-6xl"><i class="fa-solid fa-map-location-dot"></i></h2>
            <div>
              <h2 class="font-semibold">Fleksibilitas Tinggi dalam Menentukan Rute dan Waktu</h2>
              <p class="text-sm text-neutral-600">Dengan kendaraan sewaan, Anda bebas mengatur rencana perjalanan tanpa terikat jadwal transportasi umum. Anda bisa berhenti kapan saja, menyesuaikan waktu keberangkatan, atau menambahkan destinasi secara spontan—semuanya bisa dilakukan tanpa tekanan waktu.</p>
            </div>
          </div>
          <div class="bg-neutral-200 shadow-xl rounded-xl p-4 flex gap-10">
            <h2 class="text-6xl"><i class="fa-solid fa-screwdriver-wrench"></i></h2>
            <div>
              <h2 class="font-semibold">Bebas dari Beban Perawatan dan Pajak Kendaraan</h2>
              <p class="text-sm text-neutral-600">Memiliki mobil pribadi memerlukan biaya rutin untuk servis berkala, perawatan, penggantian suku cadang, pajak, dan asuransi. Dengan menyewa mobil, Anda cukup membayar biaya sewa saja tanpa harus memikirkan biaya-biaya tambahan tersebut.</p>
            </div>
          </div>
          <div class="bg-neutral-200 shadow-xl rounded-xl p-4 flex gap-10">
            <h2 class="text-6xl"><i class="fa-solid fa-face-smile"></i></h2>
            <div>
              <h2 class="font-semibold">Kenyamanan Maksimal</h2>
              <p class="text-sm text-neutral-600">Armada Sewa mobil Samarinda selalu dalam kondisi prima, bersih, dan nyaman. Baik interior maupun eksterior mobil kami dirawat secara berkala agar pelanggan mendapatkan pengalaman berkendara yang menyenangkan—baik saat dalam kota maupun perjalanan luar kota.</p>
            </div>
          </div>
          <div class="bg-neutral-200 shadow-xl rounded-xl p-4 flex gap-10">
            <h2 class="text-6xl"><i class="fa-solid fa-sack-dollar"></i></h2>
            <div>
              <h2 class="font-semibold">Efisiensi Biaya</h2>
              <p class="text-sm text-neutral-600">Jika Anda hanya sesekali membutuhkan mobil, menyewa jauh lebih hemat daripada membeli mobil pribadi. Anda cukup membayar sesuai kebutuhan, entah itu untuk harian, mingguan, atau bulanan, tanpa terbebani pengeluaran jangka panjang.</p>
            </div>
          </div>
          <div class="bg-neutral-200 shadow-xl rounded-xl p-4 flex gap-10">
            <h2 class="text-6xl"><i class="fa-solid fa-car"></i></h2>
            <div>
              <h2 class="font-semibold">Beragam Pilihan Kendaraan Sesuai Kebutuhan</h2>
              <p class="text-sm text-neutral-600">Setiap perjalanan memiliki kebutuhan berbeda. Untuk keperluan keluarga, city tour, acara formal, atau bisnis, kami menyediakan berbagai tipe kendaraan yang bisa dipilih sesuai keperluan, mulai dari city car, MPV, SUV, hingga mobil mewah.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="h-fit py-7">
      <div class="max-w-6xl m-auto text-center">
        <div>
          <h2 class="text-5xl py-5">Keunggulan Sewa di Cylc</h2>
          <div class="grid grid-cols-4 gap-0">
            <div class="bg-orange-500 rounded-xl shadow-xl p-4 m-4">
              <h2 class="text-7xl"><i class="fa-solid fa-circle-check"></i></h2>
              <h2 class="font-semibold py-2">Cepat, Tepat dan Ramah</h2>
              <p class="text-sm">Kami berkomitmen untuk memberikan layanan yang cepat, tepat dan ramah</p>
            </div>
            <div class="bg-orange-500 rounded-xl shadow-xl p-4 m-4">
              <h2 class="text-7xl"><i class="fa-solid fa-plane"></i></h2>
              <h2 class="font-semibold py-2">Gratis Jemput Airport</h2>
              <p class="text-sm">Gratis layanan jemput dari/ke Bandara Samarinda saat menggunakan layanan rental mobil kami</p>
            </div>
            <div class="bg-orange-500 rounded-xl shadow-xl p-4 m-4">
              <h2 class="text-7xl"><i class="fa-solid fa-medal"></i></h2>
              <h2 class="font-semibold py-2">Usaha Resmi</h2>
              <p class="text-sm">Usaha rental mobil kami sudah berbadan hukum. Tidak perlu ragu dan khawatir bekerjasama dengan kami.</p>
            </div>
            <div class="bg-orange-500 rounded-xl shadow-xl p-4 m-4">
              <h2 class="text-7xl"><i class="fa-solid fa-clock"></i></h2>
              <h2 class="font-semibold py-2">Layanan 24 Jam</h2>
              <p class="text-sm">Usaha rental mobil kami sudah berbadan hukum. Tidak perlu ragu dan khawatir bekerjasama dengan kami.</p>
            </div>
          </div>
        </div>
        <div class="mt-20">
          <h2 class="text-5xl p-5">Gallery</h2>
          <div class="overflow-x-scroll no-scrollbar flex p-4 max-w-full rounded-xl">
            <img src="src/assets/Jesko Absolut.jpeg" alt="ilustration" class="inline-block mx-1 rounded-xl shadow-xl w-128 h-64">
            <img src="src/assets/Jesko Absolut.jpeg" alt="ilustration" class="inline-block mx-1 rounded-xl shadow-xl w-128 h-64">
            <img src="src/assets/Jesko Absolut.jpeg" alt="ilustration" class="inline-block mx-1 rounded-xl shadow-xl w-128 h-64">
            <img src="src/assets/Jesko Absolut.jpeg" alt="ilustration" class="inline-block mx-1 rounded-xl shadow-xl w-128 h-64">
            <img src="src/assets/Jesko Absolut.jpeg" alt="ilustration" class="inline-block mx-1 rounded-xl shadow-xl w-128 h-64">
            <img src="src/assets/Jesko Absolut.jpeg" alt="ilustration" class="inline-block mx-1 rounded-xl shadow-xl w-128 h-64">
            <img src="src/assets/Jesko Absolut.jpeg" alt="ilustration" class="inline-block mx-1 rounded-xl shadow-xl w-128 h-64">
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer class="bg-neutral-900 text-neutral-200 w-full p-3 text-center">
    <p>&copy; 2025 Cylc Rent Car. All rights reserved.</p>
  </footer>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>