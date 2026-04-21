@extends('admin.main')

@section('title', 'Data Mitra')
@section('subtitle', 'Kelola data mitra di sini.')

@section('mainContent')
<link rel="stylesheet" href="{{ asset('assets/css/user.css')}}">

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
                    <th>Alamat</th>
                    <th>Whatsapp</th>
                    <th>Harga</th>
                    <th>Role</th>
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
                    <td>{{ Str::limit($mitra->alamat_mitra,30,'...') }}</td>
                    <td>{{ $mitra->whatsapp }}</td>
                    <td>Rp {{ number_format($mitra->harga, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @if($mitra->user->is_mitra == 1)
                            <span class="badge badge-role badge-mitra">Mitra</span>
                        @else
                            <span class="badge badge-role badge-user">User</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-warning text-white btn-edit-mitra"
                            data-id="{{ $mitra->user->id }}"
                            data-nama="{{ $mitra->user->nama }}"
                            data-email="{{ $mitra->user->email }}"
                            data-lokasi="{{ $mitra->lokasi }}"
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="addMitraForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Mitra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="namaMitra" id="namaMitraTambah" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Mitra</label>
                        <input type="email" name="emailMitra" id="emailMitraTambah" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lokasi Mitra</label>
                        <select name="lokasiMitra" id="LokasiMitraID" class="form-control">
                            <option selected hidden>Pilih Lokasi</option>
                            @include('parts.kota')
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Mitra</label>
                        <textarea name="deskripsiMitra" id="deskripsiMitraID" class="form-control" placeholder="Ceritakan secara singkat tentang mitra, pengalaman, dan keahlian..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keahlian Mitra</label>
                        <select name="keahlianMitra" id="keahlianMitraID" class="form-control">
                            <option selected hidden>Pilih Keahlian</option>
                            <option value="Interior">Interior</option>
                            <option value="Arsitek">Arsitek</option>
                            <option value="Tukang">Tukang</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <input type="text" name="alamatMitra" id="alamatMitraTambah" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Whatsapp Mitra</label>
                        <input type="text" name="whatsappMitra" oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="whatsappMitraTambah" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Mitra</label>
                        <input type="text" name="hargaMitra" oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="hargaMitraTambah" class="form-control" required>
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
    <div class="modal-dialog modal-dialog-centered">
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
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="namaMitra" id="namaMitraEdit" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Mitra</label>
                        <input type="email" name="emailMitra" id="emailMitraEdit" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lokasi Mitra</label>
                        <select name="lokasiMitra" id="LokasiMitraID" class="form-control">
                            <option selected hidden>Pilih Lokasi</option>
                            @include('parts.kota')
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Mitra</label>
                        <textarea name="deskripsiMitra" id="deskripsiMitraID" class="form-control" placeholder="Ceritakan secara singkat tentang mitra, pengalaman, dan keahlian..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keahlian Mitra</label>
                        <select name="keahlianMitra" id="keahlianMitraID" class="form-control">
                            <option selected hidden>Pilih Keahlian</option>
                            <option value="Interior">Interior</option>
                            <option value="Arsitek">Arsitek</option>
                            <option value="Tukang">Tukang</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <input type="text" name="alamatMitra" id="alamatMitraEdit" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Whatsapp Mitra</label>
                        <input type="text" name="whatsappMitra" oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="whatsappMitraEdit" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Mitra</label>
                        <input type="text" name="hargaMitra" id="hargaMitraEdit" class="form-control" required>
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
<script src="{{ asset('assets/js/mitra.js') }}"></script>
@endsection
