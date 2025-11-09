<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-10 max-w-6xl mx-auto">
    <div>
        <h3 class="text-lg font-semibold text-orange-500 mb-2">Cylc Rent Car</h3>
        <p class="text-sm text-neutral-400">
            Penyedia layanan sewa mobil terpercaya di Samarinda dengan berbagai pilihan mobil terbaik, harga bersahabat, dan pelayanan profesional.
        </p>
        <p class="text-sm text-neutral-500 mt-3"><i class="fa-solid fa-location-dot"></i> JL.Pahlawan No 123.Samarinda</p>
        <p class="text-sm text-neutral-500"><i class="fa-solid fa-clock"></i> 08.00 - 21.00 WITA</p>
    </div>

    <div>
        <h3 class="text-lg font-semibold text-orange-500 mb-2">Hubungi Kami</h3>
        <ul class="space-y-2 text-sm text-neutral-400">
            <li><i class="fa-solid fa-phone-volume"></i> +62 823-5383-0741</li>
            <li><i class="fa-solid fa-envelope"></i> cylcrentcar@gmail.com</li>
        </ul>
        <div class="flex gap-4 mt-3 text-xl">
            <a href="https://wa.me/6282353830741?text=Halo Admin Cylc Rent Car,Saya ingin tanya tentang ketersediaan mobil koenigsegg jesko absolut" target="_blank" class="hover:text-green-500 transition"><i class="fa-brands fa-whatsapp"></i></a>
            <a href="https://www.instagram.com/cylc_rentcar" class="hover:text-pink-500 transition"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://www.facebook.com/cylcrentcar" class="hover:text-blue-500 transition"><i class="fa-brands fa-facebook"></i></a>
        </div>
        </div>
    </div>

    <div class="col-span-2 border-t border-neutral-800 text-center py-3 text-sm text-neutral-500">
        &copy; 2025 <span class="text-orange-500 font-semibold">Cylc Rent Car</span>. All rights reserved.
    </div>
</div>    

<script>
const globalModal = document.getElementById('globalModal');
const modalTitle = document.getElementById('modalTitle');
const modalMessage = document.getElementById('modalMessage');
const modalButton = document.getElementById('modalButton');
const modalIcon = document.getElementById('modalIcon');

function showModal(type, title, message, redirect = null) {
  // Tentukan ikon & warna berdasarkan tipe
  const icons = {
    success: '✅',
    error: '❌',
    logout: '🚪'
  };
  const colors = {
    success: 'text-green-500',
    error: 'text-red-500',
    logout: 'text-orange-500'
  };

  modalIcon.textContent = icons[type] || 'ℹ️';
  modalIcon.className = `${colors[type]} text-5xl mb-3`;

  modalTitle.textContent = title;
  modalMessage.textContent = message;
  
  globalModal.classList.remove('hidden');

  modalButton.onclick = () => {
    globalModal.classList.add('hidden');
    if (redirect) window.location.href = redirect;
  };
}
</script>
