(function () {
    const layout = document.getElementById('layout');

    // Buka/tutup sidebar (tutup otomatis di layar kecil)
    if (layout && window.innerWidth <= 800) layout.classList.add('collapsed');
    document.getElementById('toggleSidebar')?.addEventListener('click', () => layout?.classList.toggle('collapsed'));
    document.getElementById('closeSidebar')?.addEventListener('click', () => layout?.classList.add('collapsed'));

    // Layar penuh
    document.getElementById('toggleFullscreen')?.addEventListener('click', () => {
        document.fullscreenElement ? document.exitFullscreen() : document.documentElement.requestFullscreen();
    });

    // Filter menu sidebar
    document.getElementById('menuSearch')?.addEventListener('input', (e) => {
        const q = e.target.value.toLowerCase();
        document.querySelectorAll('.menu a').forEach((a) => {
            a.style.display = a.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    });

    // Cari di tabel
    document.querySelector('.table-search')?.addEventListener('input', (e) => {
        const q = e.target.value.toLowerCase();
        document.querySelectorAll('.data-table tbody tr').forEach((tr) => {
            tr.style.display = tr.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    });

    // Modal tambah / edit
    document.querySelectorAll('[data-open]').forEach((btn) =>
        btn.addEventListener('click', () => document.getElementById(btn.dataset.open)?.classList.add('open'))
    );
    document.querySelectorAll('.modal').forEach((m) => {
        m.addEventListener('click', (e) => {
            if (e.target === m || e.target.closest('[data-close]')) m.classList.remove('open');
        });
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') document.querySelectorAll('.modal.open').forEach((m) => m.classList.remove('open'));
    });

    // Hapus (tampilan saja)
    document.querySelectorAll('[data-delete]').forEach((btn) =>
        btn.addEventListener('click', () => {
            if (confirm('Hapus data ini?')) btn.closest('tr').remove();
        })
    );
})();
