// Preview foto profil
const fotoInput = document.getElementById('foto_profil');
const previewImg = document.getElementById('preview_foto');

fotoInput.addEventListener('change', function(){
    const file = this.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = function(e){
            previewImg.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

// Harga input Rp format
const hargaInput = document.getElementById('harga');

function formatRupiahStabil(angka) {
    angka = angka.replace(/\D/g, ''); // hanya angka
    if(angka === '') return '';
    return 'Rp ' + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

hargaInput.addEventListener('input', function(e) {
    const selectionStart = this.selectionStart;
    const selectionEnd = this.selectionEnd;

    const oldLength = this.value.length;

    const angka = this.value.replace(/\D/g,'');
    this.value = formatRupiahStabil(angka);

    const newLength = this.value.length;
    const diff = newLength - oldLength;

    this.setSelectionRange(selectionStart + diff, selectionEnd + diff);
});
