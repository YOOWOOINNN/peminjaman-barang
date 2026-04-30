import './bootstrap';

// Fungsi memunculkan keranjang saat card diklik
function toggleSelection(card) {
    const mainIcon = card.querySelector('.main-icon');
    const cartIcon = card.querySelector('.cart-icon');
    const wrapper = card.querySelector('.icon-wrapper');

    if (cartIcon.style.display === 'none') {
        mainIcon.style.display = 'none';
        cartIcon.style.display = 'block';
        card.style.borderColor = '#fb8c00'; // Beri border orange saat terpilih
    } else {
        mainIcon.style.display = 'block';
        cartIcon.style.display = 'none';
        card.style.borderColor = 'rgba(255, 255, 255, 0.1)';
    }
}

// Simulasi CRUD Delete
function deleteItem(id, ev) {
    const e = ev || (typeof event !== 'undefined' ? event : null);
    if (e && e.stopPropagation) e.stopPropagation(); // Agar fungsi klik card tidak ikut jalan
    if (confirm('Yakin ingin menghapus data ini?')) {
        const element = document.getElementById('item-row-' + id);
        if (element) {
            element.style.opacity = '0';
            setTimeout(() => element.remove(), 300);
        }
        alert('Barang ' + id + ' berhasil dihapus (Simulasi)');
    }
}

// Simulasi CRUD Edit
function editItem(id, ev) {
    const e = ev || (typeof event !== 'undefined' ? event : null);
    if (e && e.stopPropagation) e.stopPropagation();
    const newName = prompt("Masukkan nama barang baru:");
    if (newName) {
        const card = document.getElementById('item-row-' + id);
        if (card) {
            const label = card.querySelector('.label');
            if (label) label.innerText = newName.toUpperCase();
        }
        alert('Data diperbarui!');
    }
}