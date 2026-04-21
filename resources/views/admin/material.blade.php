@extends('admin.main')

@section('title', 'Data Material')
@section('subtitle', 'Kelola data Material di sini.')

@section('mainContent')
<link rel="stylesheet" href="{{ asset('assets/css/user.css')}}">

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p class="fw-semibold fs-4">List Data Material</p>
            </div>
        </div>
        <table id="materialsTable" class="table table-bordered table-striped nowrap" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Rasio</th>
                    <th>Item</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($material as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->kategori }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->harga }}</td>
                        <td>{{ $data->rasio }}</td>
                        <td>{{ $data->item }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm text-white btn-warning btn-edit"
                                data-id="{{ $data->id }}"
                                data-nama="{{ $data->nama }}"
                                data-harga="{{ $data->harga }}"
                                data-rasio="{{ $data->rasio }}"
                            >
                            <i class="fa-solid fa-pen"></i>&nbsp;&nbsp;Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit Material -->
<div class="modal fade" id="editMaterialModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="editMaterialForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" id="id">

                    <div class="mb-3">
                        <label class="form-label">Nama Material</label>
                        <input type="text" disabled name="namaMaterial" id="namaMaterial" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" id="harga" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rasio</label>
                        <input type="text" name="rasio" id="rasio" class="form-control">
                    </div>
                </div>

                <div class="w-100 d-flex justify-content-center">
                    <button type="submit" class="btn bg-danger py-2 mb-3 w-75" id="btnMaterial">
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

@section('js-admin')
<script src="{{ asset('assets/js/material.js') }}"></script>
@endsection
