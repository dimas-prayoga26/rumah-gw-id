<link rel="stylesheet" href="{{ asset('assets/css/ads.css') }}">

<div class="container px-0">
    <div class="swiper hero-swiper">
        <div class="swiper-wrapper">
            @php
                $data = [
                    ['path' => asset('assets/img/LandingPage/Ads/Kontruksi.png'), 'jasa' => 'Jasa Tukang', 'caption' => 'Lihat apakah saat ini sedang ada penawaran menarik untuk jasa tukang dan wujudkan rumah impian Anda dengan biaya lebih terjangkau.', 'promo' => 'TukangPromo', 'title' => 'Pembangunan Rumah'],
                    ['path' => asset('assets/img/LandingPage/Ads/Interior.png'), 'jasa' => 'Jasa Interior', 'caption' => 'Temukan desain interior yang sesuai dengan gaya hidup Anda dan wujudkan ruang yang nyaman.', 'promo' => 'InteriorPromo', 'title' => 'Desain Interior'],
                    ['path' => asset('assets/img/LandingPage/Ads/Arsitek.png'), 'jasa' => 'Jasa Arsitek', 'caption' => 'Dapatkan layanan arsitektur profesional untuk merancang rumah impian Anda dengan fungsi dan estetika yang optimal.', 'promo' => 'ArsitekPromo', 'title' => 'Jasa Arsitek'],
                ]
            @endphp
            @foreach ($data as $item)
            <div class="swiper-slide">
                <div class="row slide-content align-items-center" style="background-color: red; min-height: 399.98px;">

                    <!-- TEXT -->
                    <div class="col-lg-6 text-white ps-5 py-5">
                        <h1 class="fw-bolder">Cek Promo <br>{{ $item['title'] }}</h1>
                        <p class="fw-light">{{ $item['jasa'] }}</p>
                        <p class="fw-light w-75">{{ $item['caption'] }}</p>

                        <a href="{{ route('jasa', ['promo' => $item['promo']]) }}" class="text-decoration-none">
                            Cek Promo
                        </a>
                    </div>

                    <!-- IMAGE -->
                    <div class="col-lg-6 d-none d-lg-flex pe-5 justify-content-end">
                        <img src="{{ $item['path'] }}"
                            class="img-fluid"
                            style="max-height: 400px;">
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        <!-- dots -->
        <div class="swiper-pagination"></div>
    </div>
</div>

<script>
    const swiper = new Swiper('.hero-swiper', {
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>

