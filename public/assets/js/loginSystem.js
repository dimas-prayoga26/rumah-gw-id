function registerUser(){
    const form = document.querySelector('.user-regis-form');
    const btn = document.getElementById('btnRegister');
    const btnText = btn.querySelector('.btn-text');
    const btnLoading = btn.querySelector('.btn-loading');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // 🔒 disable button + loading
        btn.disabled = true;
        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');

        const formData = new FormData(form);

        axios.post('/login/request-otp', formData)
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
                    return axios.post('/login/verify-otp', formData)
                    .then(res => {
                        if (res.data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Registrasi Berhasil',
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
                            title: 'Verifikasi Gagal',
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
                title: 'Pendaftaran Gagal',
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
}

function registerMitra(){
    const form = document.querySelector('.worker-regis-form');
    const btn = document.getElementById('btnMitra');
    const btnText = btn.querySelector('.btn-text');
    const btnLoading = btn.querySelector('.btn-loading');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // 🔒 disable button + loading
        btn.disabled = true;
        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');

        const formData = new FormData(form);

        axios.post('/login/request-otp', formData)
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
                    return axios.post('/login/verify-otp', formData)
                    .then(res => {
                        if (res.data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Registrasi Berhasil',
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
                            title: 'Verifikasi Gagal',
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
                title: 'Pendaftaran Gagal',
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
}

document.addEventListener('DOMContentLoaded', function() {
    registerUser();
    registerMitra();
});
