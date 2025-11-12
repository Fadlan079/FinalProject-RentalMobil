<!-- Modal Utama (Bisa untuk alert, confirm, success, error) -->
<div id="mainModal" class="fixed inset-0 hidden justify-center items-center z-[998] bg-black/50">
  <div class="bg-neutral-900 text-neutral-100 rounded-xl p-6 shadow-lg w-96 text-center">
    <h3 id="modalTitle" class="text-lg font-semibold mb-3">Judul Modal</h3>
    <p id="modalMessage" class="text-neutral-300 text-sm mb-6">Isi pesan akan muncul di sini.</p>
    <div id="modalButtons" class="flex justify-center gap-3">
      <button id="modalCancel" class="hidden px-4 py-2 border border-neutral-500 rounded-lg">Batal</button>
      <button id="modalConfirm" class="px-4 py-2 bg-orange-500 hover:bg-orange-600 rounded-lg text-white">OK</button>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('mainModal');
  const title = document.getElementById('modalTitle');
  const message = document.getElementById('modalMessage');
  const cancelBtn = document.getElementById('modalCancel');
  const confirmBtn = document.getElementById('modalConfirm');
  const buttons = document.getElementById('modalButtons');

  function closeModal() {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }

  cancelBtn.addEventListener('click', closeModal);
  confirmBtn.addEventListener('click', closeModal);

  /**
   * Fungsi untuk menampilkan modal dinamis
   * @param {Object} options - konfigurasi modal
   * options = {
   *   title: "Judul Modal",
   *   message: "Isi pesan modal",
   *   type: "alert" | "confirm" | "success" | "error",
   *   onConfirm: function() {}
   * }
   */
  window.showModal = function(options = {}) {
    title.textContent = options.title || "Pemberitahuan";
    message.textContent = options.message || "";
    cancelBtn.classList.add('hidden');
    confirmBtn.textContent = "OK";
    confirmBtn.className = "px-4 py-2 rounded-lg text-white bg-orange-500 hover:bg-orange-600";

    // Atur tipe modal
    switch (options.type) {
      case "confirm":
        cancelBtn.classList.remove('hidden');
        confirmBtn.textContent = "Ya";
        break;
      case "success":
        confirmBtn.className = "px-4 py-2 rounded-lg text-white bg-green-500 hover:bg-green-600";
        break;
      case "error":
        confirmBtn.className = "px-4 py-2 rounded-lg text-white bg-red-500 hover:bg-red-600";
        break;
    }

    // Tindakan saat konfirmasi
    confirmBtn.onclick = () => {
      closeModal();
      if (typeof options.onConfirm === "function") {
        options.onConfirm();
      }
    };

    modal.classList.remove('hidden');
    modal.classList.add('flex');
  };
});
</script>
