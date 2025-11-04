<div id="logoutModal" class="fixed inset-0 bg-neutral-900 bg-opacity-50 hidden justify-center items-center z-[999]">
  <div class="bg-neutral-900 text-neutral-100 rounded-xl p-6 shadow-lg text-center w-80">
    <h3 class="text-lg font-semibold mb-3">Yakin ingin logout?</h3>
    <div class="flex justify-center gap-3">
      <button id="cancelLogout" class="px-4 py-2 border border-neutral-500 rounded-lg">Batal</button>
      <a href="index.php?action=logout" id="confirmLogout" class="px-4 py-2 bg-red-500 rounded-lg text-red-50">Logout</a>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
  const logoutLinks = document.querySelectorAll('a[href="index.php?action=logout"]');
  const modal = document.getElementById('logoutModal');
  const cancelBtn = document.getElementById('cancelLogout');
  const confirmBtn = document.getElementById('confirmLogout');

  logoutLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      if (link.id === 'confirmLogout') return;

      e.preventDefault();
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    });
  });

  cancelBtn.addEventListener('click', () => {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  });
});
</script>
