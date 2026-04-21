@extends('mitra.main')

@section('title', 'Data Diri')
@section('subtitle', 'Kelola data diri mitra Anda di sini.')

@section('mainContent')
<div class="row align-items-center justify-content-center" style="min-height: 80dvh;">
    <div class="col-lg-6 col-md-8 col-sm-12">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title mb-4 text-center">Data Diri</h5>

                <form id="data-change" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-12">
                        <img src="{{ asset('assets/img/Profile/'. $mitra->foto_profil) }}" width="200" height="200" alt="Foto Profil" class="d-block mx-auto mb-3 object-fit-cover rounded-circle" style="object-position: top;">
                        <input type="file" name="foto_profil" hidden id="foto_profil" accept="image/*">
                        <button type="button" class="btn btn-secondary d-block mx-auto mb-4" id="btnChangeFoto">Ubah Foto Profil</button>
                    </div>
                    <div class="row">
                        <!-- KIRI -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="namaMitra" value="{{ $mitra->user->nama }}" class="form-control" placeholder="Nama Mitra">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Lokasi</label>
                                <select name="lokasiMitra" class="form-control">
                                    <option selected hidden>Pilih Lokasi</option>
                                    @include('parts.kota')
                                </select>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const lokasiMitra = @json($mitra->lokasi);
                                    const selectLokasi = document.querySelector('select[name="lokasiMitra"]');

                                    if (selectLokasi && lokasiMitra) {
                                        selectLokasi.value = lokasiMitra;
                                    }
                                });
                            </script>

                            <div class="mb-3">
                                <label class="form-label">Whatsapp Aktif</label>
                                <input type="text"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    name="waMitra"
                                    value="{{ $mitra->whatsapp }}"
                                    class="form-control"
                                    placeholder="Whatsapp Mitra">
                            </div>
                        </div>

                        <!-- KANAN -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="emailMitra" value="{{ $mitra->user->email }}" class="form-control" placeholder="Email Mitra">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Keahlian</label>
                                <select name="keahlianMitra" class="form-control">
                                    <option value="Interior" {{ $mitra->keahlian == 'Interior' ? 'selected' : '' }}>Interior</option>
                                    <option value="Arsitek" {{ $mitra->keahlian == 'Arsitek' ? 'selected' : '' }}>Arsitek</option>
                                    <option value="Konstruksi" {{ $mitra->keahlian == 'Konstruksi' ? 'selected' : '' }}>Konstruksi</option>
                                    <option value="Tukang" {{ $mitra->keahlian == 'Tukang' ? 'selected' : '' }}>Tukang</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga Jasa</label>
                                <input type="text"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    name="hargaMitra"
                                    value="{{ $mitra->harga }}"
                                    class="form-control"
                                    placeholder="Harga Mitra">
                            </div>
                        </div>

                        <!-- ALAMAT (FULL WIDTH) -->
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <input type="text" name="alamatMitra" value="{{ $mitra->alamat_mitra }}" class="form-control" placeholder="Alamat Mitra">
                            </div>
                        </div>

                        <!-- DESKRIPSI / TENTANG MITRA (FULL WIDTH) -->
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Tentang Mitra</label>
                                <textarea
                                    name="deskripsiMitra"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Ceritakan secara singkat tentang mitra, pengalaman, dan keahlian..."
                                >{{ $mitra->deskripsi }}</textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn bg-danger py-2 w-100" id="btnDataDiri">
                        <span class="btn-text text-white"><i class="fa-solid fa-rotate"></i>&nbsp;&nbsp;Ubah Data</span>
                        <span class="btn-loading d-none">
                            <span class="spinner-border spinner-border-sm"></span>
                            Loading...
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/data.js') }}"></script>
@endsection
