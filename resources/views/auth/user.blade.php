<form class="user-regis-form form-hidden mt-4" data-form="user">

    <input type="text" class="form-control input-login" name="namaUser" placeholder="Masukkan Nama Anda...">
    <input type="email" class="form-control input-login" name="emailUser" placeholder="Masukkan Email Anda...">

    <div class="password-input">
        <input type="password" name="passUser" id="passwordRegis" class="form-control input-login" placeholder="Masukkan Password...">
        <i class="fa-regular fa-eye-slash toggle-password"></i>
    </div>

    <div class="password-input">
        <input type="password" id="passwordRepeat" name="passUserRepeat" class="form-control input-login" placeholder="Masukkan Ulang Password...">
        <i class="fa-regular fa-eye-slash toggle-password"></i>
    </div>

    <button type="submit" class="btn btn-login w-100" id="btnRegister">
        <span class="btn-text">Daftar</span>
        <span class="btn-loading d-none">
            <span class="spinner-border spinner-border-sm"></span>
            Loading...
        </span>
    </button>


    <p class="fw-light mt-3 text-center">Sudah Punya Akun? <a href="" class="text-decoration-none text-danger fw-semibold ">Login</a></p>
</form>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('assets/js/loginSystem.js') }}"></script>

