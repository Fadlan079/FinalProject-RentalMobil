<div class="relative overflow-hidden">
    <div class="absolute z-0 -top-10 -left-20 w-72 h-72 bg-orange-500 rounded-full opacity-20 blur-3xl"></div>
    <div class="absolute z-0 bottom-0 right-0 w-96 h-96 bg-neutral-800 rounded-full opacity-25 blur-3xl"></div>

  <div class="relative z-20 grid grid-cols-1 lg:grid-cols-2 gap-3 max-w-6xl m-auto">
    <div>
        <div class="p-5 m-5 text-center">
            <h2 class="text-xl font-semibold text-orange-500 tracking-wide">Pelayanan Pelanggan</h2>
            <p class="text-md text-neutral-900">
                Sampaikan pesan atau kendala yang kamu alami, kami siap membantu.
            </p>
        </div>
        <form action="send-mail.php" method="post" class="m-5  space-y-4 bg-neutral-900 border-2 border-neutral-700 text-neutral-50 p-6 rounded-xl shadow-lg w-full max-w-md mx-auto">
            <div>
                <label for="nama" class="block mb-1">Nama</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda"
                class="w-full p-2 border border-neutral-700 rounded-lg bg-neutral-800 text-neutral-100 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300"
                required>
            </div>

            <div>
                <label for="email" class="block mb-1">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email aktif"
                class="w-full p-2 border border-neutral-700 rounded-lg bg-neutral-800 text-neutral-100 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300"
                required>
            </div>

            <div>
                <label for="pesan" class="block mb-1">Isi Pesan</label>
                <textarea id="pesan" name="pesan" rows="4" placeholder="Tulis pesan Anda di sini..."
                class="w-full p-2 border border-neutral-700 rounded-lg bg-neutral-800 text-neutral-100 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-300"
                required></textarea>
            </div>

            <button type="submit"
                class="w-full bg-orange-500 text-white font-semibold p-2 rounded-lg hover:bg-orange-600 transition-all duration-300">
                Kirim Pesan
            </button>
        </form>
    </div>

    <div class="grid grid-rows-2 gap-3 lg:mt-10">
        <div class="flex flex-col gap-3 text-center bg-neutral-900 text-neutral-50 border-2 p-5 border-neutral-700 rounded-xl">
            <div class="p-2 m-2 text-center">
                <h2 class="text-xl font-semibold  text-orange-500 tracking-wide">Hubungi Kami Secara Langsung</h2>
                <p class="text-sm text-neutral-400">
                    Butuh respon lebih cepat? Kamu bisa menghubungi admin kami melalui WhatsApp atau media sosial resmi di bawah ini.
                    Kami siap membantu setiap hari pukul 08.00-21.00 WITA.
                </p>
            </div>
            <div class="flex justify-center items-center text-center font-semibold text-2xl gap-6 p-2 m-2">
                <a href="https://www.instagram.com/digimonn.s"  target="_blank" class="p-2 rounded-xl shadow-lg w-10 h-10 hover:text-pink-500 transition-all duration-300"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.facebook.com/cylcrentcar" target="_blank" class="p-2 rounded-xl shadow-lg w-10 h-10 hover:text-blue-500 transition-all duration-300"><i class="fa-brands fa-square-facebook"></i></a>
                <a href="https://wa.me/6282353830741?text=Halo Admin Cylc Rent Car,Saya ingin tanya tentang ketersediaan mobil koenigsegg jesko absolut" target="_blank" class="p-2 rounded-xl shadow-lg w-10 h-10 hover:text-green-500 transition-all duration-300"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
    </div>
</div>
</div>
