@extends('mitra.main')

@section('title', 'Portofolio')
@section('subtitle', 'Kelola portofolio mitra Anda di sini.')

@section('mainContent')
<div class="container-fluid">
    @php
        $portfolios = collect([
            $mitra->portfolio,
            $mitra->portfolio2,
            $mitra->portfolio3,
            $mitra->portfolio4,
            $mitra->portfolio5,
        ])->filter();

        $nama = $mitra->user->nama;
        $portfolioCount = $portfolios->count();
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Daftar Portofolio</h5>
        <button id="btnTambahPortfolio" class="btn btn-primary {{ $portfolioCount >= 5 ? 'disabled' : '' }}">
            <i class="fa-solid fa-plus"></i> Tambah Portofolio
        </button>
    </div>

    @if($portfolioCount >= 5)
        <div class="alert alert-warning text-center">
            <i class="fa-solid fa-triangle-exclamation me-2"></i>
            Maksimal 5 portofolio diperbolehkan.
        </div>
    @endif

    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 g-4" id="portfolioGrid">
        @forelse($portfolios as $index => $gambar)
            <div class="col" data-index="{{ $index }}">
                <div class="card h-100 shadow-sm portfolio-card border-0 rounded-4 overflow-hidden"
                     style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="position-relative overflow-hidden" style="height: 200px;">
                        <img src="{{ asset('assets/img/Portfolio/'.$nama.'/'.$gambar) }}"
                             alt="Portofolio {{ $index + 1 }}"
                             class="w-100 h-100 object-fit-cover img-preview"
                             style="transition: transform 0.4s ease;"
                             onmouseover="this.style.transform='scale(1.1)'"
                             onmouseout="this.style.transform='scale(1)'">
                    </div>

                    <div class="card-body">
                        <h6 class="card-title fw-semibold">Portofolio {{ $index + 1 }}</h6>
                    </div>

                    <div class="card-footer bg-transparent border-0 d-flex gap-2 px-3 pb-3 pt-0">
                        <button class="btn btn-sm btn-outline-warning flex-fill btnEditPortfolio"
                                data-index="{{ $index }}"
                                data-file="{{ $gambar }}"
                                data-nama="{{ $nama }}">
                            <i class="bi bi-pencil-fill me-1"></i> Edit
                        </button>

                        <button class="btn btn-sm btn-outline-danger flex-fill btnDeletePortfolio"
                                data-index="{{ $index }}">
                            <i class="bi bi-trash-fill me-1"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <i class="bi bi-images fs-1 mb-3"></i>
                <p class="fs-5">Belum ada portofolio</p>
                <p class="small">Silahkan tambahkan portofolio untuk menampilkan karya terbaik Anda.</p>
            </div>
        @endforelse
    </div>
</div>

<style>
    .portfolio-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }
    .object-fit-cover { object-fit: cover; }
</style>

<script src="{{ asset('assets/js/porto.js') }}"></script>
@endsection
