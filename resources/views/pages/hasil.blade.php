@extends('main')

@section('content')
<div class="container" style="min-height: 60.4dvh">
    <div class="my-4">
        <a href="{{ route('rumahgue') }}" class="text-decoration-none text-black fw-light fs-5">
            <i class="fa-solid fa-arrow-left"></i>&nbsp;&nbsp;Kembali
        </a>
    </div>

    @php
        $recomend = Session::get('recomend');
        $rab = Session::get('rab');
    @endphp

    {{-- Hasil Rekomendasi Ruangan --}}
    <div class="my-4">
        <div class="row">
            <h3 class="fw-light mb-3">Hasil Rekomendasi Pembangunan</h3>
        </div>

        @if($recomend && !empty($recomend['ruang_1']))
        <table class="table table-bordered border-danger">
            <thead class="bg-danger text-white text-center">
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Nama Ruang</th>
                    <th>QTY</th>
                    <th>Luas (m²)</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                <tr class="text-center">
                    <td colspan="5" class="py-3 pe-5 bg-danger-subtle">Lantai 1</td>
                </tr>
                @foreach($recomend['ruang_1'] as $ruang)
                    @if(!($ruang['nama'] === 'Ruang Cuci Jemuran' && !empty($recomend['ruang_2'])))
                        <tr class="text-center">
                            <td>{{ $no++ }}</td>
                            <td><img src="{{ $ruang['img'] }}" alt="{{ $ruang['nama'] }}" width="60"></td>
                            <td>{{ $ruang['nama'] }}</td>
                            <td>{{ $ruang['jml'] }}</td>
                            <td>{{ number_format($ruang['luas'], 2) }} m<sup>2</sup></td>
                        </tr>
                    @endif
                @endforeach

                @if(!empty($recomend['ruang_2']))
                <tr class="text-center">
                    <td colspan="5" class="py-3 pe-5 bg-danger-subtle">Lantai 2</td>
                </tr>
                    @php $nomor = 1; @endphp
                    @foreach($recomend['ruang_2'] as $ruang)
                    <tr class="text-center">
                        <td>{{ $nomor++ }}</td>
                        <td><img src="{{ $ruang['img'] }}" alt="{{ $ruang['nama'] }}" width="60"></td>
                        <td>{{ $ruang['nama'] }}</td>
                        <td>{{ $ruang['jml'] }}</td>
                        <td>{{ number_format($ruang['luas'], 2) }} m<sup>2</sup></td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @else
        <p class="text-center fs-5 mt-3">
            Lakukan simulasi terlebih dahulu
            <a href="{{ route('rumahgue') }}#simulasi-rumah" class="text-danger text-decoration-none">Klik Disini</a>
        </p>
        @endif
    </div>

    {{-- RAB --}}
    @if($rab && !empty($rab['lantai1']))
    <div class="my-5">
        <h3 class="fw-light mb-3">Rencana Anggaran Biaya (RAB)</h3>

        @php
            $totalHarga = 0;
        @endphp

        @foreach($rab['lantai1'] as $kategori => $items)
        <h5 class="mt-4">{{ $kategori }}</h5>
        <table class="table table-bordered border-danger" id="table-rab">
            <thead class="bg-danger text-white text-center">
                <tr>
                    <th>No</th>
                    <th class="w-50">Macam Pekerjaan</th>
                    <th class="w-25">Jumlah</th>
                    <th class="w-25">Harga (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach($items as $item)
                @php
                    $jumlah = $item[3] * $item[1];
                    $totalHarga += $jumlah;
                @endphp
                <tr class="text-center">
                    <td>{{ $i++ }}</td>
                    <td class="text-start">{{ $item[0] }}</td>
                    <td ><span class="unit">{{ number_format($item[1], 2) }}</span> <span class="volume">{!! $item[2] !!}</span></td>
                    <td class="text-end">Rp. {{ number_format($jumlah,0,",",".") }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach

        <div class="text-end mt-3">
            <table class="table table-bordered border-danger">
                <tbody>
                    <tr>
                        <td class="text-start w-50"><strong>Total Biaya:</strong></td>
                        <td class="text-end" id="tot-biaya">Rp {{ number_format($totalHarga,0,",",".") }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="w-100 text-center">
            <button onclick="printRAB()" class="btn btn-dark text-white rounded-2" id="print-btn">
                <span class="btn-text">
                    <i class="fa-solid fa-print"></i> Print
                </span>
                <span class="btn-loading d-none">
                    <span class="spinner-border spinner-border-sm"></span>
                    Loading...
                </span>
            </button>
            <form id="send-rab-form" class="d-inline-block" data-url="{{ route('send-rab') }}">
                @csrf
                <button type="submit" class="btn btn-danger text-white rounded-2" id="email-btn">
                    <span class="btn-text">
                        <i class="fa-solid fa-envelope"></i> Kirim ke Email
                    </span>
                    <span class="btn-loading d-none">
                        <span class="spinner-border spinner-border-sm"></span>
                        Loading...
                    </span>
                </button>
            </form>
        </div>
    </div>
    @endif
</div>

<script src="{{ asset('assets/js/simulasi/print.js') }}"></script>
@endsection
