<link rel="stylesheet" href="{{ asset('assets/css/hero.css') }}">

<div class="home-banner d-flex flex-column justify-content-center align-items-center text-center mb-5">
    <!-- Video Background -->
    <video autoplay muted loop playsinline preload="none" class="home-video">
        <source src="{{ asset('assets/img/Hero.mp4') }}" type="video/mp4">
        Browser kamu tidak mendukung video tag.
    </video>

    <!-- Overlay -->
    <div class="home-overlay"></div>

    <div class="container position-relative">
        <!-- Badge -->
        <span class="badge rounded-pill bg-dark px-3 py-2 mb-3 home-badge">
            <i class="fa-solid fa-globe"></i> Platform Sewa Jasa
        </span>

        <!-- Title -->
        <h1 class="home-title mb-3">
            Solusi Jasa Bangunan Gue
        </h1>

        <!-- Subtitle -->
        <p class="home-subtitle mb-5">
            Bangun, renovasi, dan desain ruang impian Anda dengan tenaga profesional
            yang terverifikasi, harga transparan, dan proses yang mudah.
        </p>

        <!-- Search -->
        <div class="home-search shadow-lg rounded-4 p-3">
            <div class="row g-2 align-items-center">
                <p class="fw-normal text-black text-start fs-5 mb-2">Cari Jasa</p>
                <div class="col-md">
                    <a href="{{ route('jasa', ['kategori' => 'Tukang']) }}" class="btn btn-light w-100 text-start home-search-btn">
                        <i class="fa-solid fa-hammer me-2"></i> Jasa Tukang
                    </a href="javascript:void(0)">
                </div>
                <div class="col-md">
                    <a href="{{ route('jasa', ['kategori' => 'Interior']) }}" class="btn btn-light w-100 text-start home-search-btn">
                        <i class="fa-solid fa-couch me-2"></i> Jasa Interior
                    </a href="javascript:void(0)">
                </div>
                <div class="col-md">
                    <a href="{{ route('jasa', ['kategori' => 'Arsitek']) }}" class="btn btn-light w-100 text-start home-search-btn">
                        <i class="fa-solid fa-compass-drafting me-2"></i> Jasa Arsitek
                    </a href="javascript:void(0)">
                </div>
                {{-- <div class="col-md-auto">
                    <a href="javascript:void(0)" onclick="upcomingJasa()" class="btn btn-dark px-4">
                        <i class="fa-solid fa-arrow-right"></i>
                    </a href="javascript:void(0)">
                </div> --}}
            </div>
        </div>
    </div>
</div>

<script>
    function upcomingJasa() {
        Swal.fire({
            icon: 'info',
            title: 'Jasa Segera Hadir',
            text: 'Jasa ini sedang dalam pengembangan dan akan segera hadir. Terima kasih atas kesabaran Anda!',
            confirmButtonText: 'OK'
        });
    }
</script>
