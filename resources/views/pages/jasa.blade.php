@extends('main')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/jasa.css') }}">
<div class="container mt-5 shadow-lg p-4 rounded" id="jasaPage">
    {{-- HEADER --}}
    <div class="row header-row align-items-center mb-4">
        <div class="col-md-6">
            <h1 class="fw-normal fs-3 mb-0">{{ $title }}</h1>
            <small class="text-muted">{{ $subtitle }}</small>
        </div>

        {{-- FILTER --}}
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label mb-1">Estimasi Harga Minimal</label>
                    <input
                    type="range"
                    class="form-range"
                    min="0"
                    max="10000000"
                    step="500000"
                    id="priceRange"
                    value="0"
                    >
                    <span class="fw-semibold">
                        Rp <span id="priceValue">0</span> /
                        @if (Request()->query('kategori') == 'Tukang')
                            Hari
                        @else
                            m<sup>2</sup>
                        @endif
                    </span>
                </div>
                <div class="col-md-6 mt-sm-3">
                    <label class="form-label mb-1">Lokasi</label>
                    <select name="lokasi-mitra" id="lokasi-mitra" class="form-select">
                        <option value="0" selected>Semua Lokasi</option>
                        @foreach ($lokasi as $item)
                            <option value="{{ $item->lokasi }}">{{ $item->lokasi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- LIST JASA --}}
    <div class="row" id="jasaList">

        @forelse ($jasa as $data)
            @php
                $hargaPromo = $data->promos->firstWhere('mitra_id', $data->id)?->harga_akhir;
            @endphp
            <div
                class="col-lg-3 col-md-6 col-sm-12 mb-4 jasa-card"
                data-price="{{ $hargaPromo ?? $data->harga }}"
                data-lokasi="{{ $data->lokasi }}"
            >
                <div class="card h-100 shadow-sm position-relative d-flex flex-column">
                    <img
                        src="{{ asset('assets/img/Profile/' . $data->foto_profil) }}"
                        class="card-img-top"
                        style="height:250px; object-fit:cover; object-position: top;"
                    >

                    <span class="bg-danger fw-normal text-white px-2 py-1 position-absolute" style="top: 10px; right: 10px">
                        <i class="fa-solid fa-location-dot fa-xs"></i>&nbsp;&nbsp;{{ $data->lokasi }}
                    </span>

                    <div class="card-body d-flex flex-column">
                        {{-- Nama dan keahlian di atas --}}
                        <div>
                            <h5 class="card-title mb-1">{{ $data->user->nama }}</h5>
                            <small class="text-muted d-block mb-2">Mitra {{ $data->keahlian }}</small>
                        </div>

                        {{-- Harga dan tombol selalu di bawah --}}
                        <div class="mt-auto">
                            <p class="mb-2">
                                Estimasi mulai dari <br>
                                <div class="d-flex justify-content-between">
                                    <strong class="text-danger">
                                        Rp {{ number_format($hargaPromo ?? $data->harga,0,',','.') }} /
                                        @if (Request()->query('kategori') == 'Tukang')
                                        Hari
                                        @else
                                        m<sup>2</sup>
                                        @endif
                                    </strong>
                                    @if ($data->promos->firstWhere('mitra_id', $data->id)?->diskon > 0)
                                    <span class="badge bg-danger align-self-center">
                                        {{ $data->promos->firstWhere('mitra_id', $data->id)?->diskon }}%
                                    </span>
                                    @endif
                                </div>
                            </p>
                            <a href="{{ route('jasa-detail', $data->id) }}" class="btn btn-outline-danger py-2 btn-sm w-100">
                                Lihat Detail&nbsp;&nbsp;<i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">
                    @if (Request()->query('promo'))
                        Tidak ada promo tersedia.
                    @else
                        Tidak ada jasa tersedia.
                    @endif
                </p>
            </div>
        @endforelse

    </div>
</div>

<script src="{{ asset('assets/js/jasa.js') }}"></script>
@endsection

