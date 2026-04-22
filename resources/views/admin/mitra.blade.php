@extends('admin.main')

@section('title', 'Data Mitra')
@section('subtitle', 'Kelola data mitra di sini.')

@section('mainContent')
<link rel="stylesheet" href="{{ asset('assets/css/user.css')}}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--single {
        height: 38px;
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 4px 12px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }

    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #6c757d;
    }

    .portfolio-dropzone {
        border: 2px dashed #ced4da;
        border-radius: 0.5rem;
        background: #fafafa;
        padding: 1.25rem;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
    }

    .portfolio-dropzone:hover,
    .portfolio-dropzone.is-dragover {
        border-color: #dc3545;
        background: #fff4f6;
    }

    .portfolio-preview-card {
        position: relative;
        border: 1px solid #e9ecef;
        border-radius: 0.5rem;
        overflow: hidden;
        background: #fff;
    }

    .portfolio-preview-card img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        display: block;
    }

    .btn-remove-portfolio-image {
        position: absolute;
        top: 6px;
        right: 6px;
        border: 0;
        border-radius: 999px;
        width: 26px;
        height: 26px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-md-6"><p class="fw-semibold fs-4">List Data Mitra</p></div>
            <div class="col-md-6 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMitraModal">
                    <i class="fa-solid fa-plus"></i> Tambah Mitra
                </button>
            </div>
        </div>

        <table id="mitrasTable" class="table table-bordered table-striped nowrap w-100">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Keahlian</th>
                    <th>Kabupaten/Kota</th>
                    <th>Alamat</th>
                    <th>Whatsapp</th>
                    <th>Harga</th>
                    {{-- <th>Role</th> --}}
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mitras as $mitra)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mitra->user->nama }}</td>
                    <td>{{ Str::limit($mitra->deskripsi,30,'...') }}</td>
                    <td>{{ $mitra->keahlian }}</td>
                    <td>
                        @if(filled($mitra->kabupaten_kota))
                            {{ $mitra->kabupaten_kota }}
                        @else
                            <span class="badge text-bg-secondary">Data tidak ada</span>
                        @endif
                    </td>
                    <td>{{ Str::limit($mitra->alamat_mitra,30,'...') }}</td>
                    <td>{{ $mitra->whatsapp }}</td>
                    <td>Rp {{ number_format($mitra->harga, 0, ',', '.') }}</td>
                    {{-- <td class="text-center">
                        @if($mitra->user->is_mitra == 1)
                            <span class="badge badge-role badge-mitra">Mitra</span>
                        @else
                            <span class="badge badge-role badge-user">User</span>
                        @endif
                    </td> --}}
                    <td class="text-center">
                        <button class="btn btn-sm btn-warning text-white btn-edit-mitra"
                            data-id="{{ $mitra->user->id }}"
                            data-nama="{{ $mitra->user->nama }}"
                            data-email="{{ $mitra->user->email }}"
                            data-portfolios='@json($mitra->imagePortofolios->pluck("mitra_image_portfolio")->values())'
                            data-lokasi="{{ $mitra->lokasi }}"
                            data-provinsi="{{ $mitra->provinsi }}"
                            data-kabupaten="{{ $mitra->kabupaten_kota }}"
                            data-kecamatan="{{ $mitra->kecamatan }}"
                            data-desa="{{ $mitra->desa }}"
                            data-deskripsi="{{ $mitra->deskripsi }}"
                            data-keahlian="{{ $mitra->keahlian }}"
                            data-alamat="{{ $mitra->alamat_mitra }}"
                            data-whatsapp="{{ $mitra->whatsapp }}"
                            data-harga="{{ $mitra->harga }}">
                            <i class="fa-solid fa-pen"></i> Edit
                        </button>
                        <form class="d-inline form-delete-mitra" data-id="{{ $mitra->user->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addMitraModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <form id="addMitraForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Mitra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="namaMitra" id="namaMitraTambah" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email Mitra</label>
                            <input type="email" name="emailMitra" id="emailMitraTambah" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Provinsi</label>
                            <select id="provinsiMitraTambah" class="form-control lokasi-level">
                                <option value="" selected>Pilih Provinsi</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kabupaten/Kota</label>
                            <select id="kabupatenMitraTambah" class="form-control lokasi-level" disabled>
                                <option value="" selected>Pilih Kabupaten/Kota</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kecamatan</label>
                            <select id="kecamatanMitraTambah" class="form-control lokasi-level" disabled>
                                <option value="" selected>Pilih Kecamatan</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Desa/Kelurahan</label>
                            <select id="desaMitraTambah" class="form-control lokasi-level" disabled>
                                <option value="" selected>Pilih Desa/Kelurahan</option>
                            </select>
                        </div>

                        <input type="hidden" name="lokasiMitra" id="lokasiMitraTambah">
                        <input type="hidden" name="provinsiMitra" id="provinsiMitraTambahHidden">
                        <input type="hidden" name="kabupatenMitra" id="kabupatenMitraTambahHidden">
                        <input type="hidden" name="kecamatanMitra" id="kecamatanMitraTambahHidden">
                        <input type="hidden" name="desaMitra" id="desaMitraTambahHidden">

                        <div class="col-md-6">
                            <label class="form-label">Keahlian Mitra</label>
                            <select name="keahlianMitra" id="keahlianMitraTambah" class="form-control" required>
                                <option value="" selected>Pilih Keahlian</option>
                                <option value="Interior">Interior</option>
                                <option value="Arsitek">Arsitek</option>
                                <option value="Tukang">Tukang</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Whatsapp Mitra</label>
                            <input type="text" name="whatsappMitra" oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="whatsappMitraTambah" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Harga Mitra</label>
                            <input type="text" name="hargaMitra" oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="hargaMitraTambah" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Alamat Lengkap</label>
                            <input type="text" name="alamatMitra" id="alamatMitraTambah" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Image Portofolio</label>
                            <div id="portfolioDropzone" class="portfolio-dropzone">
                                <input type="file" id="portfolioImagesInput" name="portfolioImages[]" class="d-none" accept="image/jpeg,image/png,image/webp" multiple>
                                <div class="fw-semibold mb-1">Drop image di sini atau klik untuk pilih</div>
                                <small class="text-muted d-block">Maksimal 20 gambar, format JPG/JPEG/PNG/WEBP, ukuran max 2MB per file</small>
                            </div>
                            <div class="row g-2 mt-1" id="portfolioPreviewGrid"></div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Deskripsi Mitra</label>
                            <textarea name="deskripsiMitra" id="deskripsiMitraTambah" class="form-control" rows="3" placeholder="Ceritakan secara singkat tentang mitra, pengalaman, dan keahlian..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <small class="text-danger">Catatan: Password otomatis terisi "password"</small>
                    <button type="submit" id="btnTambahMitra" class="btn btn-danger w-100">
                        <span class="btn-text"><i class="fa-regular fa-floppy-disk"></i> Simpan Data</span>
                        <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm"></span> Loading...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="editMitraModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <form id="editMitraForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Mitra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="text" hidden name="id" id="id">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="namaMitra" id="namaMitraEdit" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email Mitra</label>
                            <input type="email" name="emailMitra" id="emailMitraEdit" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Provinsi</label>
                            <select id="provinsiMitraEdit" class="form-control lokasi-level">
                                <option value="" selected>Pilih Provinsi</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kabupaten/Kota</label>
                            <select id="kabupatenMitraEdit" class="form-control lokasi-level" disabled>
                                <option value="" selected>Pilih Kabupaten/Kota</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kecamatan</label>
                            <select id="kecamatanMitraEdit" class="form-control lokasi-level" disabled>
                                <option value="" selected>Pilih Kecamatan</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Desa/Kelurahan</label>
                            <select id="desaMitraEdit" class="form-control lokasi-level" disabled>
                                <option value="" selected>Pilih Desa/Kelurahan</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <small class="text-muted d-block" id="lokasiLamaText">Lokasi saat ini: -</small>
                            <input type="hidden" name="lokasiMitra" id="lokasiMitraEdit">
                            <input type="hidden" name="provinsiMitra" id="provinsiMitraEditHidden">
                            <input type="hidden" name="kabupatenMitra" id="kabupatenMitraEditHidden">
                            <input type="hidden" name="kecamatanMitra" id="kecamatanMitraEditHidden">
                            <input type="hidden" name="desaMitra" id="desaMitraEditHidden">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Keahlian Mitra</label>
                            <select name="keahlianMitra" id="keahlianMitraEdit" class="form-control">
                                <option selected hidden>Pilih Keahlian</option>
                                <option value="Interior">Interior</option>
                                <option value="Arsitek">Arsitek</option>
                                <option value="Tukang">Tukang</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Whatsapp Mitra</label>
                            <input type="text" name="whatsappMitra" oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="whatsappMitraEdit" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Harga Mitra</label>
                            <input type="text" name="hargaMitra" id="hargaMitraEdit" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Alamat Lengkap</label>
                            <input type="text" name="alamatMitra" id="alamatMitraEdit" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Image Portofolio Saat Ini</label>
                            <div class="row g-2" id="existingPortfolioPreviewGrid"></div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Update Image Portofolio (Opsional)</label>
                            <div id="portfolioDropzoneEdit" class="portfolio-dropzone">
                                <input type="file" id="portfolioImagesInputEdit" name="portfolioImages[]" class="d-none" accept="image/jpeg,image/png,image/webp" multiple>
                                <div class="fw-semibold mb-1">Drop image di sini atau klik untuk pilih</div>
                                <small class="text-muted d-block">Jika diisi, image lama akan diganti semua. Maksimal 20 gambar, ukuran max 2MB per file</small>
                            </div>
                            <div class="row g-2 mt-1" id="portfolioPreviewGridEdit"></div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Deskripsi Mitra</label>
                            <textarea name="deskripsiMitra" id="deskripsiMitraEdit" class="form-control" rows="3" placeholder="Ceritakan secara singkat tentang mitra, pengalaman, dan keahlian..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="btnEditMitra" class="btn btn-danger w-100">
                        <span class="btn-text"><i class="fa-solid fa-rotate"></i> Perbarui Data</span>
                        <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm"></span> Loading...</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('js-admin')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/js/mitra.js') }}"></script>
@endsection
