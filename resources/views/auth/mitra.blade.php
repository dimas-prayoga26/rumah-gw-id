<form class="worker-regis-form form-hidden mt-4" data-form="mitra">

    <input type="text" name="namaUser" class="form-control input-login" required placeholder="Masukkan Nama Anda...">
    <input type="email" class="form-control input-login" required name="emailUser" placeholder="Masukkan Email Anda...">
    <select class="form-control input-login" required name="keahlianMitra">
        <option selected class="d-none">Pilih Keahlian Anda...</option>
        <option value="Interior">Interior</option>
        <option value="Arsitek">Arsitek</option>
        <option value="Konstruksi">Konstruksi</option>
        <option value="Tukang">Tukang</option>
    </select>
    <input type="text" class="form-control input-login" required oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/[^\d]/g, '')" name="teleponMitra" placeholder="Masukkan No. Whatsapp Anda...">
    <input type="text" name="alamatMitra" class="form-control input-login" required placeholder="Masukkan Alamat Anda...">

    <div class="password-input">
        <input type="password" id="password" name="passUser" class="form-control input-login" required placeholder="Masukkan Password...">
        <i class="fa-regular fa-eye toggle-password"></i>
    </div>

    <div class="password-input">
        <input type="password" id="passwordRepeat" name="passUserRepeat" class="form-control input-login" required placeholder="Masukkan Ulang Password...">
        <i class="fa-regular fa-eye toggle-password"></i>
    </div>

    <button type="submit" class="btn btn-login w-100" id="btnMitra">
        <span class="btn-text">Daftar</span>
        <span class="btn-loading d-none">
            <span class="spinner-border spinner-border-sm"></span>
            Loading...
        </span>
    </button>

    <p class="fw-light mt-3 text-center">Sudah Punya Akun? <a href="" class="text-decoration-none text-danger fw-semibold ">Login</a></p>
</form>
