document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('password-change');
    const btn = document.getElementById('btnPassword');
    const btnText = btn.querySelector('.btn-text');
    const btnLoading = btn.querySelector('.btn-loading');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // 🔒 disable button + loading
        btn.disabled = true;
        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');

        const formData = new FormData(form);

        axios.post('/mitra/change-password', formData)
        .then(res => {
            Swal.fire({
                title: "Verifikasi OTP",
                text: "Kode OTP telah dikirimkan ke email Anda",
                input: "text",
                inputPlaceholder: "Masukkan Kode OTP Disini",
                showCancelButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonText: "Verifikasi",
                cancelButtonText: "Batal",
                preConfirm: (otp) => {
                    formData.append('otp', otp);
                    return axios.post('/mitra/new-password', formData)
                    .then(res => {
                        if (res.data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Password Berhasil Diubah',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                text: 'Silahkan login untuk melanjutkan.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = res.data.redirect;
                            });
                        }
                    })
                    .catch(err => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Password Gagal Diubah',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            text: err.response.data.message,
                            confirmButtonText: 'OK'
                        });
                    });
                }
            })
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
                text: message,
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
