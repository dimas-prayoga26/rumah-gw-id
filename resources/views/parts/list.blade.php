<section class="my-5">
    <div class="container">
        <style>
            .jasa-card{
                border-radius:12px;
                overflow:hidden;
                transition:0.3s;
            }

            .jasa-card:hover{
                transform:translateY(-5px);
            }

            .jasa-img-swiper {
                width: 100%;
                height: 176px;
            }

            .jasa-img-swiper .swiper-slide img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        </style>
        <div class="row align-items-center mb-4">
            <div class="col-6">
                <h3 class="mb-0 fw-bold">Rekomendasi Gue</h3>
            </div>
            <div class="col-6 text-end">
                <a href="{{ route('jasa') }}" class="text-decoration-none fw-light text-muted">Lihat Semua...</a>
            </div>
        </div>

        <div class="row g-4">
            @foreach ($jasa as $item)
            <div class="
            @if ($item->count() == 1)
                col-xl-12 col-lg-12 col-md-12 col-12
            @elseif ($item->count() == 2)
                col-xl-6 col-lg-6 col-md-6 col-12
            @elseif ($item->count() == 3)
                col-xl-4 col-lg-4 col-md-6 col-12
            @else
                col-xl-3 col-lg-3 col-md-6 col-12
            @endif
            ">

                <div class="card jasa-card border-0 shadow-sm">

                    <!-- Image -->
                    <div class="swiper jasa-img-swiper">
                        <div class="swiper-wrapper">

                            @php $hasPortfolio = false; @endphp

                            @for ($i = 1; $i <= 5; $i++)
                                @php $field = $i == 1 ? 'portfolio' : 'portfolio'.$i; @endphp

                                @if(!empty($item->$field))
                                    @php $hasPortfolio = true; @endphp

                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets/img/Portfolio/'.$item->user->nama.'/'.$item->$field) }}"
                                            class="card-img-top jasa-img"
                                            alt="Portfolio {{ $i }}">
                                    </div>
                                @endif
                            @endfor

                            @if(!$hasPortfolio)
                                <div class="swiper-slide">
                                    <img src="{{ asset('assets/img/Vector/images.png') }}"
                                        class="card-img-top jasa-img"
                                        alt="Portfolio Default">
                                </div>
                            @endif

                        </div>
                        <!-- Pastikan class ini -->
                        <div class="swiper-pagination"></div>
                    </div>

                    <!-- Card Body -->
                    <a href="{{ route('jasa-detail', $item->id) }}" class="text-decoration-none text-black">
                    <div class="card-body">

                        <!-- Avatar + Name -->
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('assets/img/Profile/' . $item->foto_profil) }}"
                                 class="rounded-circle me-2"
                                 width="32"
                                 height="32">

                            <p class="mb-0 fw-medium">{{ $item->user->nama }}</p>
                        </div>

                        <hr class="my-2">

                        <!-- Category + Rating -->
                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <span class="text-danger small">
                                Jasa {{ $item->keahlian }}
                            </span>

                            <span class="small text-dark">
                                <i class="fa-solid fa-star"></i> 4.5
                            </span>

                        </div>

                        <!-- Description -->
                        <p class="text-muted small mb-0" style="text-align:justify;">
                            {{ Str::limit($item->deskripsi, 90, '...') }}
                        </p>

                    </div>
                    </a>

                </div>

            </div>
            @endforeach
        </div>
    </div>
</section>
<script>
document.querySelectorAll('.jasa-img-swiper').forEach(function(el){
    new Swiper(el, {
        loop: true,
        pagination: {
            el: el.querySelector('.swiper-pagination'), // pastikan sama dengan HTML
            clickable: true
        },
    });
});
</script>
