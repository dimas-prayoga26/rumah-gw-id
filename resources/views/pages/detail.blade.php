@extends('main')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/detailJasa.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>

<div class="container mt-5">
    <span class="mb-3 d-inline-block">
        <a href="{{ route('jasa') }}" class="text-decoration-none text-danger fw-normal">
            <i class="fa-solid fa-arrow-left"></i>&nbsp;&nbsp;Kembali ke Jasa Interior
        </a>
    </span>
    <div class="row">
        {{-- Slider kiri --}}
        <div class="col-lg-6 col-md-12">

            {{-- Slider utama --}}
            <div class="swiper mySwiper2">
                <div class="swiper-wrapper">
                    @foreach($sliderImages as $img)
                        <div class="swiper-slide higlight-img">
                            <img src="{{ asset($img['path'] . $img['file']) }}"
                                 class="img-fluid object-fit-cover"
                                 onclick="openModal('{{ asset($img['path'] . $img['file']) }}')">
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Thumbnail di bawah, kotak --}}
            <div class="swiper mySwiper mt-3">
                <div class="swiper-wrapper">
                    @foreach($sliderImages as $img)
                        <div class="swiper-slide" style="width:100px; height:100px;">
                            <img src="{{ asset($img['path'] . $img['file']) }}"
                                 class="img-fluid object-fit-cover w-100 h-100"
                                 style="cursor:pointer; border-radius:5px;"
                                 onclick="swiperMain.slideTo({{ $loop->index }})">
                        </div>
                    @endforeach
                </div>

                {{-- Arrow kiri kanan --}}
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

        </div>

        {{-- Detail kanan --}}
        <div class="col-lg-6 col-md-12 col-sm-12 mt-lg-0 mt-md-4 mt-sm-4" id="detail-right">
            <h3 class="fw-normal fs-3">{{ $jasa->user->nama ?? 'Nama Tidak Ada' }}</h3>
            <span>
                <span class="badge rounded-pill bg-success px-2 py-1 fs-7 fw-normal">{{ $jasa->keahlian }}</span>
                <span class="badge rounded-pill bg-danger px-2 py-1 fs-7 fw-normal">{{ $jasa->lokasi }}</span>
                @if ($jasa->promos->isNotEmpty())
                    <span class="badge rounded-pill bg-primary px-2 py-1 fs-7 fw-normal">Diskon {{ $jasa->promos->first()->diskon }}%</span>
                @endif
            </span>
            <p class="harga-detail text-danger mt-3">
                Rp {{ number_format($jasa->promos->isNotEmpty() ? $jasa->promos->first()->harga_akhir : $jasa->harga,0,',','.') }} /
                @if ($jasa->keahlian == 'Tukang')
                    Hari
                @else
                    m<sup>2</sup>
                @endif
            </p>
            <p class="mt-3">{{ $jasa->deskripsi }}</p>
            <a href="javascript:void(0);"
            class="btn btn-danger py-2 w-100 mt-3"
            onclick="contactViaWhatsapp('{{ $jasa->id }}', '{{ $jasa->user->nama }}', '{{ $jasa->whatsapp }}')">
            Hubungi via WhatsApp&nbsp;&nbsp;<i class="fa-brands fa-whatsapp fa-1x"></i>
            </a>

            <script>
            function contactViaWhatsapp(jasaId, namaMitra, waNumber) {
                const tokenMeta = document.querySelector('meta[name="csrf-token"]');
                if(!tokenMeta) {
                    console.error('CSRF token not found!');
                    return;
                }

                // 1. Buat notifikasi dulu
                fetch('/notif-create', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': tokenMeta.content
                    },
                    body: JSON.stringify({
                        jasa_id: jasaId,
                        message: `User menghubungi Mitra ${namaMitra} via WhatsApp`
                    })
                })
                .then(res => res.json())
                .then(data => {
                    // 2. Buka WhatsApp di tab baru
                    const waLink = `https://wa.me/${waNumber}?text=${encodeURIComponent(
                        'Halo ' + namaMitra + ', saya melihat jasa Anda di RumahGue dan tertarik. Saya ingin berdiskusi terlebih dahulu mengenai kebutuhan saya. Terima kasih.'
                    )}`;
                    window.open(waLink, '_blank');
                })
                .catch(err => console.error(err));
            }
            </script>

        </div>
    </div>

    {{-- Saran mitra lain --}}
    <div class="mt-5">
        <h5>Saran Mitra Lain</h5>
        <div class="swiper relatedSwiper">
            <div class="swiper-wrapper">
                @foreach($relatedJasa as $rj)
                    <div class="col-lg-6 col-md-12 col-sm-12 mb-4 jasa-card swiper-slide">
                        <div class="card h-100 shadow-sm position-relative d-flex flex-column">
                            <img
                                src="{{ asset('assets/img/Profile/' . $rj->foto_profil) }}"
                                class="card-img-top"
                                style="height:250px; object-fit:cover; object-position: top;"
                            >

                            <span class="bg-danger fw-normal text-white px-2 py-1 position-absolute" style="top: 10px; right: 10px">
                                <i class="fa-solid fa-location-dot fa-xs"></i>&nbsp;&nbsp;{{ $rj->lokasi }}
                            </span>

                            <div class="card-body d-flex flex-column">
                                {{-- Nama dan keahlian di atas --}}
                                <div>
                                    <h5 class="card-title mb-1">{{ $rj->user->nama }}</h5>
                                    <small class="text-muted d-block mb-2">Mitra {{ $rj->keahlian }}</small>
                                </div>

                                {{-- Harga dan tombol selalu di bawah --}}
                                <div class="mt-auto">
                                    <p class="mb-2">
                                        Estimasi mulai dari <br>
                                        <strong class="text-danger">
                                            Rp {{ number_format($rj->harga,0,',','.') }}

                                        </strong>
                                    </p>
                                    <a href="{{ route('jasa-detail', $rj->id) }}" class="btn btn-outline-danger py-2 btn-sm w-100">
                                        Lihat Detail&nbsp;&nbsp;<i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Arrow --}}
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>

{{-- Modal pop-up --}}
<div id="imageModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="row">
                <div class="col-md-6">
                    <img id="modalImg" src="" class="img-fluid w-100 object-fit-cover">
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 mt-lg-0 mt-md-4 mt-sm-4">
                    <h3 class="fw-normal fs-3">{{ $jasa->user->nama ?? 'Nama Tidak Ada' }}</h3>
                    <span>
                        <span class="badge rounded-pill bg-success px-2 py-1 fs-7">{{ $jasa->keahlian }}</span>
                        <span class="badge rounded-pill bg-danger px-2 py-1 fs-7">{{ $jasa->lokasi }}</span>
                    </span>
                    <p class="harga-detail text-danger mt-3">Rp {{ number_format($jasa->harga,0,',','.') }}</p>
                    <p class="mt-3">{{ $jasa->deskripsi }}</p>
                    <a href="javascript:void(0);"
                        class="btn btn-danger py-2 w-100 mt-3"
                        onclick="contactViaWhatsapp('{{ $jasa->id }}', '{{ $jasa->user->nama }}', '{{ $jasa->whatsapp }}')">
                        Hubungi via WhatsApp&nbsp;&nbsp;<i class="fa-brands fa-whatsapp fa-1x"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
  // Thumbnail Swiper
  var swiperThumbs = new Swiper(".mySwiper", {
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
    navigation: {
      nextEl: ".mySwiper .swiper-button-next",
      prevEl: ".mySwiper .swiper-button-prev",
    },
  });

  // Main Swiper
  var swiperMain = new Swiper(".mySwiper2", {
    spaceBetween: 10,
    thumbs: {
      swiper: swiperThumbs,
    },
  });

  // Related Swiper
  var relatedSwiper = new Swiper(".relatedSwiper", {
    slidesPerView: 4,
    spaceBetween: 10,
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        576: {
            slidesPerView: 2,
        },
        992: {
            slidesPerView: 3,
        },
        1200: {
            slidesPerView: 4,
        },
    },
    navigation: {
      nextEl: ".relatedSwiper .swiper-button-next",
      prevEl: ".relatedSwiper .swiper-button-prev",
    },
  });

  // Modal function
  function openModal(src){
      document.getElementById('modalImg').src = src;
      var myModal = new bootstrap.Modal(document.getElementById('imageModal'));
      myModal.show();
  }
</script>
@endsection
