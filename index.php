<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cylc Rent Car</title>
  <link rel="stylesheet" href="src/CSS/output.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body class="h-screen bg-neutral-200 font-serif">
  <header class="relative max-w-6xl m-auto mx-auto">
    <nav class="p-3 text-neutral-900">
      <div class="flex justify-between">
        <div class="flex text-lg relative">
          <a href="index.php" class="block cursor-pointer bg-neutral-900 w-10 h-10 rounded-full text-neutral-200 p-2 mx-2 shadow-xl" data-aos="fade-down" data-aos-duration="2000" data-aos-delay="1200"><i class="fa-solid fa-car"></i></a>
          <div class="bg-neutral-900 rounded-l-lg rounded-r-4xl w-35 p-1" data-aos="fade-right" data-aos-duration="2000" data-aos-delay="0"></div>
          <a href="index.php" class="block text-neutral-200 absolute ml-16 mt-1 shadow-xl" data-aos="zoom-in" data-aos-duration="2000" data-aos-delay="1200">Cylc Rent Car</a>
        </div>
        <div class="text-sm my-auto flex gap-4">
          <a href="#" class="cursor-pointer inline-block bg-neutral-800 p-2 shadow-xl text-neutral-200 rounded-lg hover:-translate-y-1 hover:shadow-xl transition-all duration-300">List Cars</a>
          <a href="#" class="cursor-pointer inline-block bg-neutral-800 p-2 shadow-xl text-neutral-200 rounded-lg hover:-translate-y-1 hover:shadow-xl transition-all duration-300">Booking Cars</a>
          <details class="relative inline-block cursor-pointer">
            <summary class="bg-neutral-800 p-2 shadow-xl text-neutral-200 rounded-lg hover:-translate-y-1 hover:shadow-xl transition-all duration-300 marker:content-none">
              <i class="fa-solid fa-bars"></i>
              <i class="fa-solid fa-user"></i>
            </summary>
            <ul class="absolute z-20 right-0 mt-2 px-5 py-5 w-45 text-sm bg-neutral-200 rounded-xl border border-neutral-300">
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
    </nav>
    <img src="src/IMG/jesko Absolut.jpeg" alt="koenisegg" class="rounded-2xl w-279 h-100 mx-auto shadow-xl">
    <div class="bg-neutral-900"></div>
    <div class="absolute text-neutral-200 justify-center text-center inset-0 flex flex-col backdrop-blur-xs top-15 rounded-xl">
      <h2 class="text-5xl font-semibold p-1 m-1 tracking-wide">Skip the rental car counter</h2>
      <p class="text-xl p-1 m-1 tracking-wide">Rent just about any car, just about anywhere</p>
      <form action="">search</form>
      <button class="flex justify-center cursor-pointer shadow-xl text-lg p-1 m-1 bg-neutral-200 rounded-lg text-neutral-900 w-50 mx-auto hover:-translate-y-1 hover:shadow-xl transition-all duration-300">Get to know Cylc <i class="fa-solid fa-caret-right my-auto"></i></button>
    </div>
  </header>
  <main class="max-w-6xl m-auto mt-6">
    <div class="flex justify-between text-neutral-200 mt-7 mx-70 ">
      <button class="cursor-pointer bg-neutral-900 p-2 rounded-xl shadow-xl hover:-translate-y-1 hover:shadow-xl transition-all duration-300"><i class="fa-solid fa-car"></i> All</button>
      <button class="cursor-pointer text-neutral-900 p-2 rounded-xl shadow-xl hover:bg-neutral-900 hover:text-neutral-200 hover:-translate-y-1 hover:shadow-xl transition-all duration-300"><i class="fa-solid fa-people-roof"></i> Family</button>
      <button class="cursor-pointer text-neutral-900 p-2 rounded-xl shadow-xl hover:bg-neutral-900 hover:text-neutral-200 hover:-translate-y-1 hover:shadow-xl transition-all duration-300"><i class="fa-solid fa-money-bills"></i> Economy</button>
      <button class="cursor-pointer text-neutral-900 p-2 rounded-xl shadow-xl hover:bg-neutral-900 hover:text-neutral-200 hover:-translate-y-1 hover:shadow-xl transition-all duration-300"><i class="fa-solid fa-key"></i> Self Drive</button>
      <button class="cursor-pointer text-neutral-900 p-2 rounded-xl shadow-xl hover:bg-neutral-900 hover:text-neutral-200 hover:-translate-y-1 hover:shadow-xl transition-all duration-300"><i class="fa-solid fa-user-tie"></i> With Driver</button>
    </div>

    <section class="h-screen mt-7">
      <h1 class="text-2xl">Konigsegg rental at Los Angeles (LAX) airport</h1>
      <div class="grid grid-cols-4 gap-6 mt-6">
        <div class="shadow-xl rounded-xl p-1 group cursor-pointer">
          <h2 class="text-xl p-1">Koenigsegg Jesco</h2>
          <img src="src/IMG/jesko Absolut.jpeg" alt="koenigsegg" class="rounded-xl p-1">
          <div class="flex gap-7 text-neutral-500 p-1 text-xs">
            <p><i class="fa-solid fa-suitcase"></i> 1</p>
            <p><i class="fa-solid fa-user"></i> 2</p>
            <p>Automatic</p>
            <p>Unavailable</p>
          </div>
          <div class="flex p-1">
            <h2 class="text-orange-500 text-xl font-sans">IDR 7.000.000</h2>
            <p class="text-sm p-1 text-neutral-500">/Day</p>
          </div>
          <a href="#" class="p-1 text-sm">View Details</a>
        </div>

        <!-- <div class="shadow-xl rounded-xl p-1 group cursor-pointer">
          <h2 class="text-xl p-1">Koenigsegg Jesco</h2>
          <img src="src/IMG/jesko Absolut.jpeg" alt="koenigsegg" class="rounded-xl p-1">
          <div class="grid grid-cols-2 gap-2 text-center text-neutral-500 p-1 text-sm">
            <p><i class="fa-solid fa-suitcase"></i> 1</p>
            <p><i class="fa-solid fa-user"></i> 2</p>
            <p>Automatic</p>
            <p><i class="fa-solid fa-circle-check text-green-500"></i> Availble</p>
          </div>
          <div class="flex p-1">
            <h2 class="text-orange-500 text-xl font-sans">IDR 7.000.000</h2>
            <p class="text-sm p-1 text-neutral-500">/Day</p>
          </div>
          <a href="#" class="p-1 text-sm">View Details</a>
        </div> -->

        <div class="shadow-xl rounded-xl p-1 group cursor-pointer">
          <h2 class="text-xl p-1">Koenigsegg Jesco</h2>
          <img src="src/IMG/jesko Absolut.jpeg" alt="koenigsegg" class="rounded-xl p-1">
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
          <a href="#" class="p-1 text-sm">View Details</a>
        </div>

        <div class="shadow-xl rounded-xl p-1 group cursor-pointer">
          <h2 class="text-xl p-1">Koenigsegg Jesco</h2>
          <img src="src/IMG/jesko Absolut.jpeg" alt="koenigsegg" class="rounded-xl p-1">
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
          <a href="#" class="p-1 text-sm">View Details</a>
        </div>

        <div class="shadow-xl rounded-xl p-1 grou cursor-pointer">
          <h2 class="text-xl p-1">Koenigsegg Jesco</h2>
          <img src="src/IMG/jesko Absolut.jpeg" alt="koenigsegg" class="rounded-xl p-1">
          <div class="flex gap-7 text-neutral-500 p-1 text-xs">
            <p><i class="fa-solid fa-suitcase"></i> 1</p>
            <p><i class="fa-solid fa-user"></i> 2</p>
            <p>Automatic</p>
            <p>Available</p>
          </div>
          <div class="flex p-1">
            <h2 class="text-orange-500 text-xl font-sans">IDR 7.000.000</h2>
            <p class="text-sm p-1 text-neutral-500">/Day</p>
          </div>
          <a href="#" class="p-1 text-sm">View Details</a>
        </div>
      </div>
    </section>
  </main>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>