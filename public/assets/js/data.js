const btnChangeFoto = document.getElementById('btnChangeFoto');
const inputFoto = document.getElementById('foto_profil');
const previewImg = document.querySelector('img[alt="Foto Profil"]');

if (btnChangeFoto && inputFoto) {
    btnChangeFoto.addEventListener('click', function () {
        inputFoto.click();
    });

    inputFoto.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;

        if (!file.type.startsWith('image/')) {
            alert('File harus berupa gambar');
            inputFoto.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src = e.target.result;
        };
        reader.readAsDataURL(file);
    });
}

// =============================
// FORMAT RUPIAH (HARGA MITRA)
// =============================
const hargaInput = document.querySelector('input[name="hargaMitra"]');

if (hargaInput) {
    // format awal dari DB
    if (hargaInput.value) {
        hargaInput.value = formatRupiah(hargaInput.value);
    }

    hargaInput.addEventListener('input', function () {
        let angka = this.value.replace(/[^0-9]/g, '');
        this.value = formatRupiah(angka);
    });
}

// Fungsi format Rupiah
function formatRupiah(angka) {
    if (!angka) return '';

    let numberString = angka.toString();
    let sisa = numberString.length % 3;
    let rupiah = numberString.substr(0, sisa);
    let ribuan = numberString.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
        rupiah += (sisa ? '.' : '') + ribuan.join('.');
    }

    return 'Rp ' + rupiah;
}

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('data-change');
    const btn = document.getElementById('btnDataDiri');
    const btnText = btn.querySelector('.btn-text');
    const btnLoading = btn.querySelector('.btn-loading');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // 🔒 disable button + loading
        btn.disabled = true;
        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');

        // 🔥 BERSIHKAN HARGA SEBELUM DIKIRIM
        if (hargaInput) {
            hargaInput.value = hargaInput.value.replace(/[^0-9]/g, '');
        }

        const formData = new FormData(form);

        axios.post('/mitra/update-profile', formData)
            .then(res => {
                if (res.data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Perubahan Berhasil',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        text: 'Data Diri Anda Telah Diperbarui.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = res.data.redirect;
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Perubahan Gagal',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        text: res.data.message,
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(err => {
                let message = 'Terjadi kesalahan';

                if (err.response?.status === 422) {
                    const errors = err.response.data.errors;
                    message = Object.values(errors)[0][0];
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Perubahan Gagal',
                    text: err.response.data.message,
                });
            })
            .finally(() => {
                // 🔓 aktifkan kembali button
                btn.disabled = false;
                btnText.classList.remove('d-none');
                btnLoading.classList.add('d-none');
            });
    });
});
