<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login RumahGue</title>

    <link rel="icon" href="{{ asset('assets/img/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/FortAwesome/Font-Awesome@6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>

<body style="background: linear-gradient(150deg, #FFFFFF 0%, #CDD3DF 100%);">
    @if (session('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: "{{ session('error') }}"
            });
        </script>
    @endif

    @error('email')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
                Toast.fire({
                icon: "error",
                title: "{{ $message }}"
            });
        </script>
    @enderror

    <div class="row p-4 m-0 min-vh-100">
        <div class="col-md-5 d-none d-md-block">
            <img src="{{ asset('assets/img/LandingPage/Home-back.png') }}"
                class="rounded-4 object-fit-cover"
                width="100%" height="100%">
        </div>

        <div class="col-md-7 d-flex flex-column align-items-center justify-content-center">
            <img src="{{ asset('assets/img/logo-login.png') }}" width="323" height="61" class="object-fit-contain mb-4">

            <form class="login-form" data-form="login" method="POST" action="{{ route('verify') }}">
                @csrf
                <p class="login-title text-center">Hi, Selamat Datang Kembali</p>
                <p class="login-subtitle text-center">
                    Silahkan masukan email dan password untuk masuk ke halaman utama website.
                </p>

                <input type="email" class="form-control input-login" name="emailUser" placeholder="Masukkan Email...">

                <div class="password-input">
                    <input type="password" id="passwordLogin" class="form-control input-login" name="passwordUser" placeholder="Masukkan Password...">
                    <i class="fa-regular fa-eye-slash toggle-password" id="togglePassword"></i>
                </div>

                {{-- <div class="form-extra">
                    <a href="#" class="text-decoration-none text-muted small">Lupa Password?</a>
                </div> --}}

                <button type="submit" class="btn btn-login w-100">Masuk</button>

                <div class="divider">
                    <hr>
                        <span>Atau Masuk Menggunakan</span>
                    <hr>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('redirect') }}" class="text-decoration-none text-muted"><i class="fa-brands fa-google fa-2x"></i></a>
                </div>
                <p class="fw-light mt-3 text-center">Belum Punya Akun? <a href="" class="text-decoration-none text-danger fw-semibold" id="goRegister">Daftar</a></p>
            </form>

            <div class="register-switch d-none">

                <div class="auth-switch" id="dynamicSwitch">
                    <div class="auth-indicator"></div>

                    <button type="button" class="active" data-action="user">
                        User
                    </button>

                    <button type="button" data-action="mitra">
                        Mitra
                    </button>
                </div>

            </div>


            @include('auth.user')

            @include('auth.mitra')

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/loginUI.js') }}"></script>

</body>
</html>
