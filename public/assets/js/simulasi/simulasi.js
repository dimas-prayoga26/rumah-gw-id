// ============================
// Simulasi Data
// ============================
let data = {
    panjang: 0,
    lebar: 0,
    luas: 0,
    luasTotal: 0,
    hook: null,
    auto: true,
    gsb: 2,
    carpot: false,
    lantai: 1,
    autoLantai: true,
};

// ============================
// Hitung luas bangunan
// ============================
function calculateLuas() {
    data.luas = data.hook
        ? (data.panjang - data.gsb) * (data.lebar - data.gsb)
        : (data.panjang - data.gsb) * data.lebar;

    const luasTanah = data.panjang * data.lebar;

    let sisa = luasTanah - data.luas;

    if (sisa < 17.5) {
        if (data.luas - (17.5 - sisa) > 36) {
            data.luas -= 17.5 - sisa;
            sisa = 17.5;
            data.carpot = true;
        } else {
            data.carpot = false;
        }
    } else {
        data.carpot = true;
    }

    data.sisa = sisa;

    return {
        luasTanah,
        rth: sisa - 17.5,
    };
}

// ============================
// Render ke form
// ============================
function renderForm(luasTanah, rth) {
    document.getElementById("l-tanah").value = luasTanah.toFixed(2);
    document.getElementById("l-bangunan").value = data.luas.toFixed(2);
    document.getElementById("l-rth").value = rth > 0 ? rth.toFixed(2) : 0;
    document.getElementById("l-carpot").value = 17.5;

    let total =
        data.lantai === 2 && data.luas >= 47 ? data.luas * 2 : data.luas;

    data.luasTotal = total;

    document.getElementById("label-luas").innerHTML =
        `( ${total} m<sup>2</sup> )`;
}

// ============================
// Auto lantai
// ============================
function handleAutoLantai() {
    if (!data.autoLantai) return;

    if (data.luas >= 47 && data.lantai === 1) {
        lantaiChange(document.getElementById("lantai-naik"), 2);
    }

    if (data.luas < 47 && data.lantai === 2) {
        lantaiChange(document.getElementById("lantai-turun"), 1);
    }
}

// ============================
// Update semua
// ============================
function updateLuas() {
    if (data.panjang && data.lebar) {
        document.getElementById("lantai-naik").disabled = false;
        document.getElementById("lantai-turun").disabled = false;
    }
    if (!data.panjang || !data.lebar) return;

    const { luasTanah, rth } = calculateLuas();

    renderForm(luasTanah, rth);

    handleAutoLantai();
}

// ============================
// Input panjang
// ============================
document.getElementById("panjang-tanah").addEventListener("input", function () {
    data.panjang = parseInt(this.value) || 0;

    if (data.auto && data.panjang < 36) {
        const denom = data.panjang - 2 + (data.hook ? 2 : 0);

        if (denom > 0) {
            data.lebar = Math.round(36 / denom);
            document.getElementById("inputLebar").value = data.lebar;
        }
    }

    updateLuas();
});

// ============================
// Input lebar
// ============================
document.getElementById("inputLebar").addEventListener("input", function () {
    data.lebar = parseInt(this.value) || 0;
    data.auto = false;

    updateLuas();
});

// ============================
// Hook tanah
// ============================
function choiceHook(elem, isPinggir) {
    data.hook = isPinggir;

    document
        .querySelectorAll(".tombol-lokasi button")
        .forEach((b) => b.classList.remove("active"));

    elem.classList.add("active");

    updateLuas();
}

// ============================
// Ganti lantai
// ============================
function lantaiChange(elem, lt) {
    if (data.luas < 47 && lt === 2) return;

    data.lantai = lt;
    data.autoLantai = false;

    const lt1 = document.getElementById("lantai-turun");
    const lt2 = document.getElementById("lantai-naik");
    const spanLantai = document.getElementById("lantai-rumah");

    lt1.classList.remove("active");
    lt2.classList.remove("active");

    if (lt == 1) {
        lt2.classList.add("active"); // tombol naik merah
        lt1.disabled = true;
        lt2.disabled = false;
    } else {
        lt1.classList.add("active"); // tombol turun merah
        lt2.disabled = true;
        lt1.disabled = false;
    }

    // update teks lantai
    spanLantai.innerHTML = `Lantai ${lt} <label id="label-luas">( ${data.luasTotal} m<sup>2</sup> )</label>`;

    renderForm(data.panjang * data.lebar, data.sisa);
}

// ============================
// Kirim ke backend
// ============================
function getRecommend() {
    updateLuas();

    const panjang = document.getElementById("panjang-tanah").value.trim();
    const lebar = document.getElementById("inputLebar").value.trim();
    const hook = data.hook; // misal ini dari tombol hook
    const lantai = data.lantai; // dari select / tombol

    // Validasi sebelum axios
    if (!panjang) {
        Swal.fire({
            icon: "warning",
            title: "Panjang Tanah Kosong",
            text: "Mohon isi panjang tanah sebelum mensimulasikan rumah!",
        });
        return;
    }

    if (!lebar) {
        Swal.fire({
            icon: "warning",
            title: "Lebar Tanah Kosong",
            text: "Mohon isi lebar tanah sebelum mensimulasikan rumah!",
        });
        return;
    }

    if (data.hook === null) {
        Swal.fire({
            icon: "warning",
            title: "Lokasi Strategis Belum Dipilih",
            text: "Mohon pilih lokasi strategis (Pinggir Jalan / Hook Jalan) sebelum mensimulasikan rumah!",
        });
        return;
    }

    if (!lantai) {
        Swal.fire({
            icon: "warning",
            title: "Lantai Belum Dipilih",
            text: "Mohon pilih jumlah lantai sebelum mensimulasikan rumah!",
        });
        return;
    }

    const payload = {
        panjang: Number(panjang),
        lebar: Number(lebar),
        luasTanah: Number(panjang) * Number(lebar),
        luas: data.luas || 0,
        luasTotal: data.luasTotal || 0,
        lantai: Number(lantai),
        hook: Number(hook),
        carpot: Number(data.carpot || 0),
        rth: Number(data.sisa || 0),
    };

    const btn = document.getElementById("btn-simulasi");
    const btnText = btn.querySelector(".btn-text");
    const btnLoading = btn.querySelector(".btn-loading");

    btn.disabled = true;
    btnText.classList.add("d-none");
    btnLoading.classList.remove("d-none");

    axios
        .post("/getRecommend", payload)
        .then((res) => {
            btn.disabled = false;
            btnText.classList.remove("d-none");
            btnLoading.classList.add("d-none");
            window.location.href = "/hasil";
        })
        .catch((err) => {
            // console.log(err.response?.data);

            btn.disabled = false;
            btnText.classList.remove("d-none");
            btnLoading.classList.add("d-none");

            Swal.fire({
                icon: "error",
                title: "Terjadi Kesalahan",
                text: err.response?.data?.message || "Server error",
            });
        });
}
