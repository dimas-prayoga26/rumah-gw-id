@extends('mitra.main')

@section('title', 'Data Promo')
@section('subtitle', 'Kelola data promo di sini.')

@section('mainContent')
<link rel="stylesheet" href="{{ asset('assets/css/user.css')}}">

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p class="fw-semibold fs-4">List Data Promo</p>
            </div>
            <div class="col-md-6 text-end align-self-center">
                <button class="btn btn-primary mb-3"
                        data-bs-toggle="modal"
                        data-bs-target="#addPromoModal">
                    <i class="fa-solid fa-plus"></i> Tambah Promo
                </button>
            </div>
        </div>
        <table id="promosTable" class="table table-bordered table-striped nowrap" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th class="text-center">Diskon</th>
                    <th class="text-center">Harga Akhir</th>
                    <th class="text-center">Tanggal Mulai</th>
                    <th class="text-center">Tanggal Selesai</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($promo as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->judul }}</td>
                        <td class="text-center">{{ $data->diskon }}%</td>
                        <td class="text-center">Rp {{ number_format($data->harga_akhir, 0, ',', '.') }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($data->tanggal_mulai)->locale('id_ID')->translatedFormat('d F Y') }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($data->tanggal_selesai)->locale('id_ID')->translatedFormat('d F Y') }}</td>
                        <td class="text-center">
                            @if (date('Y-m-d') < $data->tanggal_mulai)
                                <span class="badge fw-normal bg-secondary">Akan Datang</span>
                            @elseif (date('Y-m-d') >= $data->tanggal_mulai && date('Y-m-d') <= $data->tanggal_selesai)
                                <span class="badge fw-normal bg-success">Aktif</span>
                            @else
                                <span class="badge fw-normal bg-danger">Kadaluarsa</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm text-white {{ date('Y-m-d') >= $data->tanggal_mulai ? 'd-none' : '' }} btn-warning btn-edit"
                            data-id="{{ $data->id }}"
                            data-judul="{{ $data->judul }}"
                            data-diskon="{{ $data->diskon }}"
                            data-harga_akhir="{{ $data->harga_akhir }}"
                            data-tanggal_mulai="{{ $data->tanggal_mulai }}"
                            data-tanggal_selesai="{{ $data->tanggal_selesai }}"
                            >
                            <i class="fa-solid fa-pen"></i>&nbsp;&nbsp;Edit</button>
                            <form class="d-inline form-delete-user" data-id="{{ $data->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i>&nbsp;Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addPromoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="addPromoForm" data-url="{{ route('promo.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Promo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Promo</label>
                        <input type="text" name="judul" id="judul" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Diskon (%)</label>
                        <input type="number" name="diskon" id="diskon" class="form-control" min="0" max="100" oninput="if (this.value >= 100) { this.value = 100; } else { this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\1+/g, '$1'); }">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn bg-danger" id="btnAddPromo">
                            <span class="btn-text text-white">
                                <i class="fa-solid fa-rotate"></i>&nbsp;&nbsp;Tambahkan Data
                            </span>
                            <span class="btn-loading d-none">
                                <span class="spinner-border spinner-border-sm"></span>
                                Loading...
                            </span>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="editPromoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="editPromoForm" data-url="{{ route('promo.update', 0) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data Promo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" id="id">

                    <div class="mb-3">
                        <label class="form-label">Judul Promo</label>
                        <input type="text" name="judul" id="edit_judul" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Diskon (%)</label>
                        <input type="number" name="diskon" id="edit_diskon" class="form-control" min="0" max="100" oninput="if (this.value >= 100) { this.value = 100; } else { this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\1+/g, '$1'); }">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="edit_tanggal_mulai" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="edit_tanggal_selesai" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn bg-danger" id="btnEditPromo">
                        <span class="btn-text text-white">
                            <i class="fa-solid fa-rotate"></i>&nbsp;&nbsp;Perbarui Data
                        </span>
                        <span class="btn-loading d-none">
                            <span class="spinner-border spinner-border-sm"></span>
                            Loading...
                        </span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('js-mitra')
    <script src="{{ asset('assets/js/promo.js') }}"></script>
@endsection


