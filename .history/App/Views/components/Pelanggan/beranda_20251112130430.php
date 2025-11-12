<div class="relative flex items-center justify-center px-4 py-10 group">
  <!-- Background blur -->
  <div class="absolute z-0 -top-10 -left-20 w-56 h-56 sm:w-72 sm:h-72 bg-orange-500 rounded-full opacity-20 blur-3xl"></div>
  <div class="absolute z-0 bottom-0 right-0 w-72 h-72 sm:w-96 sm:h-96 bg-neutral-800 rounded-full opacity-25 blur-3xl"></div>

  <!-- Slider container -->
  <div class="relative rounded-2xl overflow-hidden shadow-xl w-full max-w-3xl h-[60vh] sm:h-auto sm:aspect-[16/9]">
    <div id="slider" class="flex transition-transform duration-700 ease-in-out">
      <img src="assets/jesko.svg" class="w-full h-full flex-shrink-0 object-cover object-center">
      <img src="assets/lotus-evija.svg" class="w-full h-full flex-shrink-0 object-cover object-center">
      <img src="assets/ilustration-2.svg" class="w-full h-full flex-shrink-0 object-cover object-center">
      <img src="assets/4.svg" class="w-full h-full flex-shrink-0 object-cover object-center">
      <img src="assets/5.svg" class="w-full h-full flex-shrink-0 object-cover object-center">
      <img src="assets/6.svg" class="w-full h-full flex-shrink-0 object-cover object-center">
      <img src="assets/7.svg" class="w-full h-full flex-shrink-0 object-cover object-center">
    </div>

    <!-- Overlay content -->
    <div class="absolute inset-0 bg-gradient-to-t from-neutral-900/80 via-neutral-900/40 to-transparent backdrop-blur-[1px] flex flex-col justify-center items-center text-center gap-3 sm:gap-5 text-neutral-100 px-4">
      <h2 class="text-2xl sm:text-4xl md:text-5xl font-semibold tracking-wide leading-snug">
        Skip the rental car counter
      </h2>
      <p class="text-sm sm:text-lg md:text-xl text-neutral-200 max-w-md">
        Rent just about any car, just about anywhere
      </p>
      <a href="#tentang"
         class="px-4 sm:px-6 py-2 sm:py-3 bg-orange-500 hover:bg-orange-600 text-orange-50 font-semibold tracking-wide rounded-xl shadow-lg transition-all duration-300">
        Get To Know Cylc
      </a>
    </div>

    <!-- Navigation buttons -->
    <button id="prev"
      class="opacity-0 absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 bg-neutral-900/40 hover:bg-neutral-900/70 text-white p-2 sm:p-3 rounded-full group-hover:opacity-100 hover:scale-110 transition-all duration-300">
      <i class="fa-solid fa-chevron-left"></i>
    </button>
    <button id="next"
      class="opacity-0 absolute right-3 sm:right-4 top-1/2 -translate-y-1/2 bg-neutral-900/40 hover:bg-neutral-900/70 text-white p-2 sm:p-3 rounded-full group-hover:opacity-100 hover:scale-110 transition-all duration-300">
      <i class="fa-solid fa-chevron-right"></i>
    </button>
  </div>
</div>

<script>
  const slider = document.getElementById('slider');
  const slides = slider.children;
  const total = slides.length;
  let index = 0;

  const nextBtn = document.getElementById('next');
  const prevBtn = document.getElementById('prev');

  function showSlide(i) {
    index = (i + total) % total;
    slider.style.transform = `translateX(-${index * 100}%)`;
  }

  nextBtn.addEventListener('click', () => showSlide(index + 1));
  prevBtn.addEventListener('click', () => showSlide(index - 1));

  setInterval(() => showSlide(index + 1), 5000);
</script>
