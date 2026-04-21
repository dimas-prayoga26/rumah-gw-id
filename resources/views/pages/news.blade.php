@extends('main')

@section('content')
<div class="container" style="min-height: 55.4dvh">
    <div class="my-4">
        <a href="{{ route('rumahgue') }}" class="text-decoration-none text-black fw-light fs-5">
            <i class="fa-solid fa-arrow-left"></i>&nbsp;&nbsp;Kembali
        </a>
    </div>

    <div class="my-4">
        <div class="row">
            <h3 class="fw-light mb-3">Berita Gue</h3>
        </div>

        <div class="row">
            @foreach ($berita as $item)
            <div class="col-lg-4 mb-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-duration="500" data-aos-once="true" data-aos-delay="{{ $loop->iteration * 200 }}" data-aos-offset="0">
                <div class="card h-100 d-flex flex-column">

                @if($item['image'])
                    <img src="{{ $item['image'] }}" class="card-img-top" alt="{{ $item['title'] }}">
                @else
                    <img src="{{ asset('assets/img/LandingPage/Home-back.png') }}" class="card-img-top" alt="{{ $item['title'] }}">
                @endif

                    <div class="card-body d-flex flex-column">

                        <p class="card-title mb-2 fs-5 fw-semibold">{{ $item['title'] }}</p>

                        <p class="fw-normal text-black-50 mb-3 d-flex justify-content-between">
                            <span>
                                {{ \Carbon\Carbon::createFromLocaleFormat('d F Y', 'id', $item['date'])->diffForHumans() }}
                            </span>
                            <span>
                                dari Kompas.com
                            </span>
                        </p>

                        <div class="mt-auto">
                            <a href="{{ $item['link'] }}" target="_blank" class="btn btn-danger w-100 text-center">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="d-flex justify-content-end align-items-center mt-4">
                <span>{{ $berita->links('pagination::simple-bootstrap-4') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
