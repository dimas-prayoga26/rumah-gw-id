@extends('mitra.main')

@section('title', 'Pengaturan')
@section('subtitle', 'Kelola pengaturan akun mitra Anda di sini.')

@section('mainContent')
<div class="row align-items-center justify-content-center" style="min-height: 80dvh;">
    <div class="col-lg-6 col-md-8 col-sm-12">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title mb-4 text-center">Ubah Password</h5>

                <form id="password-change">
                    <div class="mb-3">
                        <label class="form-label">Password Lama</label>
                        <input type="password" name="passUser" class="form-control" placeholder="Password Lama">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="newPassUser" class="form-control" placeholder="Password Baru">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="passUserRepeat" class="form-control" placeholder="Konfirmasi Password Baru">
                    </div>

                    <button type="submit" class="btn bg-danger py-2 w-100" id="btnPassword">
                        <span class="btn-text text-white">Ubah Password</span>
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

<script src="{{ asset('assets/js/password.js') }}"></script>
@endsection
