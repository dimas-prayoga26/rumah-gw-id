<link rel="stylesheet" href="{{ asset('assets/css/simulasi.css') }}">

<section id="simulasi-rumah">
    <div class="container my-4">

        <h1 class="text-center fw-bold mb-4">
            Simulasi Bangun Rumah
        </h1>

        <div class="row simulasi-div p-4 rounded-4">

            <!-- FORM -->
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="simulasi-form">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Simulasi Rumahgue.id</h5>

                        <a href="{{ route('hasil-rekomendasi') }}" class="text-dark">
                            <i class="fa-solid fa-arrow-right fa-lg"></i>
                        </a>
                    </div>

                    <form onsubmit="return false;">

                        <div class="mb-3">
                            <label class="form-label">
                                Pilih lokasi strategis :
                            </label>

                            <div class="d-flex gap-2 tombol-lokasi">
                                <button
                                    type="button"
                                    onclick="choiceHook(this,false)"
                                    id="hook-1"
                                    class="btn btn-outline-danger w-50"
                                >
                                    Pinggir Jalan
                                </button>

                                <button
                                    type="button"
                                    onclick="choiceHook(this,true)"
                                    id="hook-2"
                                    class="btn btn-outline-danger w-50"
                                >
                                    Hook Jalan
                                </button>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-6 mb-3">
                                <label>Panjang tanah :</label>

                                <div class="position-relative">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="panjang-tanah"
                                        maxlength="2"
                                        name="panjangTanah"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                    >

                                    <span class="position-absolute end-0 top-50 translate-middle pe-1 text-black-50">
                                        m
                                    </span>
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Lebar tanah :</label>

                                <div class="position-relative">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="inputLebar"
                                        maxlength="2"
                                        name="lebarTanah"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                    >

                                    <span class="position-absolute end-0 top-50 translate-middle pe-1 text-black-50">
                                        m
                                    </span>
                                </div>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label>Luas tanah :</label>

                            <div class="position-relative">
                                <input
                                    type="text"
                                    class="form-control input-simulasi bg-danger-subtle"
                                    id="l-tanah"
                                    readonly
                                >

                                <span class="position-absolute end-0 top-50 translate-middle pe-1 text-black-50">
                                    m<sup>2</sup>
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Luas rekomendasi bangunan :</label>

                            <div class="position-relative">
                                <input
                                    type="text"
                                    class="form-control input-simulasi bg-danger-subtle"
                                    id="l-bangunan"
                                    readonly
                                >

                                <span class="position-absolute end-0 top-50 translate-middle pe-1 text-black-50">
                                    m<sup>2</sup>
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Luas carport :</label>

                            <div class="position-relative">
                                <input
                                    type="text"
                                    id="l-carpot"
                                    class="form-control input-simulasi bg-danger-subtle"
                                    readonly
                                >

                                <span class="position-absolute end-0 top-50 translate-middle pe-1 text-black-50">
                                    m<sup>2</sup>
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Luas ruang terbuka hijau :</label>

                            <div class="position-relative">
                                <input
                                    type="text"
                                    id="l-rth"
                                    class="form-control input-simulasi bg-danger-subtle"
                                    readonly
                                >

                                <span class="position-absolute end-0 top-50 translate-middle pe-1 text-black-50">
                                    m<sup>2</sup>
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Lantai :</label>

                            <div class="input-group">
                                <span class="text-center w-100">

                                    <button
                                        id="lantai-turun"
                                        type="button"
                                        onclick="lantaiChange(this,1)"
                                        class="py-2 px-3 bg-dark-subtle rounded-circle border-0 text-white"
                                        disabled
                                    >
                                        <
                                    </button>

                                    <span id="lantai-rumah" class="mx-3">
                                        Lantai 1
                                        <label id="label-luas">( 0 m<sup>2</sup> )</label>
                                    </span>

                                    <button
                                        id="lantai-naik"
                                        type="button"
                                        onclick="lantaiChange(this,2)"
                                        class="py-2 px-3 bg-danger bg-dark-subtle text-white rounded-circle border-0"
                                        disabled
                                    >
                                        >
                                    </button>

                                </span>
                            </div>
                        </div>

                        <button
                            type="button"
                            onclick="getRecommend()"
                            class="btn btn-danger w-100 simulasi" id="btn-simulasi"
                        >
                            <span class="btn-text">
                                Coba Simulasikan
                            </span>

                            <span class="btn-loading d-none">
                                <span class="spinner-border spinner-border-sm"></span>
                                Loading...
                            </span>
                        </button>

                    </form>

                </div>
            </div>

            <!-- HERO TEXT -->
            <div class="col-lg-7 simulasi-hero d-flex align-items-end">

                <div class="hero-content">

                    <h2>
                        Simulasikan Rumah Impian
                        Loe Sekarang!
                    </h2>

                    <p>
                        RumahGue akan bantu menghitung estimasi biaya pembangunan
                        serta waktu pengerjaan secara jelas, realistis, dan transparan —
                        tanpa tebakan, tanpa kejutan di tengah jalan.
                    </p>

                </div>

            </div>

        </div>

    </div>
</section>

<script src="{{ asset('assets/js/simulasi/simulasi.js') }}"></script>
