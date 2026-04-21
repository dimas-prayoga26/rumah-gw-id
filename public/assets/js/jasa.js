document.addEventListener('DOMContentLoaded', function () {

    const range = document.getElementById('priceRange');
    const priceValue = document.getElementById('priceValue');
    const lokasiSelect = document.getElementById('lokasi-mitra');
    const cards = document.querySelectorAll('.jasa-card');

    function formatRupiah(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function filterJasa() {
        const minPrice = parseInt(range.value);
        const selectedLokasi = lokasiSelect.value;

        priceValue.innerText = formatRupiah(minPrice);

        cards.forEach(card => {
            const price = parseInt(card.dataset.price);
            const lokasi = card.dataset.lokasi;

            const matchHarga = price >= minPrice;
            const matchLokasi = selectedLokasi === '0' || lokasi === selectedLokasi;

            if (matchHarga && matchLokasi) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }

    range.addEventListener('input', filterJasa);
    lokasiSelect.addEventListener('change', filterJasa);

    filterJasa(); // initial
});
