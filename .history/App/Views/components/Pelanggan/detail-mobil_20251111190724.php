<!-- Modal Sewa -->
<div id="modalSewa" class="fixed inset-0 bg-neutral-900/70 flex items-center justify-center z-50 hidden">
  <div class="bg-neutral-900 border border-orange-500 rounded-2xl p-6 w-full max-w-lg text-neutral-100 shadow-2xl relative">
    
    <button id="closeModal" class="absolute top-3 right-3 text-orange-500 hover:text-orange-400">
      ✕
    </button>
    
    <h2 class="text-2xl font-semibold mb-4 text-orange-500">Form Sewa Mobil</h2>
    
    <form id="formSewa" method="POST">
      <div class="space-y-3">
        <div>
          <label class="block text-sm">Nama Mobil</label>
          <input type="text" id="nama_mobil" name="nama_mobil" readonly
                 class="w-full bg-neutral-800 text-neutral-100 rounded p-2 border border-neutral-700">
        </div>
        
        <div>
          <label class="block text-sm">Tanggal Mulai</label>
          <input type="date" id="tgl_mulai" name="tgl_mulai"
                 class="w-full bg-neutral-800 text-neutral-100 rounded p-2 border border-neutral-700">
        </div>
        
        <div>
          <label class="block text-sm">Tanggal Selesai</label>
          <input type="date" id="tgl_selesai" name="tgl_selesai"
                 class="w-full bg-neutral-800 text-neutral-100 rounded p-2 border border-neutral-700">
        </div>

        <div>
          <label class="block text-sm">Lama Sewa (hari)</label>
          <input type="number" id="lama_sewa" name="lama_sewa" readonly
                 class="w-full bg-neutral-800 text-neutral-100 rounded p-2 border border-neutral-700">
        </div>

        <div>
          <label class="block text-sm">Total Bayar</label>
          <input type="text" id="total_bayar" name="total_bayar" readonly
                 class="w-full bg-neutral-800 text-neutral-100 rounded p-2 border border-neutral-700">
        </div>

        <button type="submit"
                class="w-full bg-orange-600 hover:bg-orange-500 text-neutral-100 rounded-lg p-2 mt-4">
          Konfirmasi Sewa
        </button>
      </div>
    </form>
  </div>
</div>
