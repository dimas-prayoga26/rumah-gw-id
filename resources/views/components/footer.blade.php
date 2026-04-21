<footer style="background-color: #101828">
    <div class="container py-5 mt-5">
        <div class="row py-3">
            <div class="col-md-4">
                <img src="{{ asset('assets/img/logo-white.png') }}" alt="Logo Rumahgue" width="207px" height="39px" class="mb-3">
                <p class="text-white-50 w-75 fw-lighter mb-0" style="letter-spacing: 1px">
                    Rencanakan rumah impian Anda dengan simulasi interaktif dan temukan jasa arsitek, interior, serta tukang terpercaya dalam satu platform.
                </p>
            </div>
            <div class="col-md-4">
                <p class="fw-semibold text-white mb-0 mt-lg-0 mt-md-0 mt-sm-5 mt-5">Company</p>
                <ul class="list-unstyled mt-4">
                    <li class="text-white-50 fw-lighter pb-2" style="letter-spacing: 1px">
                        <a href="{{ route('rumahgue') }}" class="text-decoration-none text-white-50">Beranda</a>
                    </li>
                    <a class="text-white-50 fw-lighter" style="letter-spacing: 1px">
                        <a href="{{ route('rumahgue') }}/#simulasi-rumah" class="text-decoration-none text-white-50 fw-lighter" style="letter-spacing: 1px">Simulasi Rumah</a>
                    </li>
                    <li class="text-white-50 fw-lighter pt-2" style="letter-spacing: 1px">
                        <a href="{{ route('berita-gue') }}" class="text-decoration-none text-white-50">Berita</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 mt-4 mt-md-0">
                <div class="d-flex align-items-center flex-wrap gap-2 w-100 px-3 py-2 rounded-3"
                    style="background-color: #282A32; border: 1px solid #384048;">

                    <i class="fa-solid fa-envelope" style="color: #8588A6; font-size: 20px;"></i>

                    <p class="text-white mb-0 flex-grow-1 small text-truncate">
                        rumahgue.id@gmail.com
                    </p>

                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=rumahgue.id@gmail.com"
                        target="_blank"
                        class="btn btn-danger px-3 py-2 text-white text-decoration-none">
                        Kontak Kami
                    </a>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <a href="https://web.facebook.com/rumahgueid" target="_blank" class="text-decoration-none py-2 px-3 bg-white text-muted rounded-3">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com/rumahgue.id" target="_blank" class="text-decoration-none py-2 px-3 bg-white text-muted rounded-3">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://x.com/rumahgueid" target="_blank" class="text-decoration-none py-2 px-3 bg-white text-muted rounded-3">
                        <i class="fa-brands fa-x"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
