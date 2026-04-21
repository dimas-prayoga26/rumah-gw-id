<link rel="stylesheet" href="{{ asset('assets/css/testimoni.css') }}">

<div class="container testi-section px-0 my-5" id="testimoni-section">
    <div class="image-testi">
        {{-- Layer 1 --}}
        <img src="{{ asset('assets/img/Person/Testimoni.png') }}" alt="Person 1" class="person-testi" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
        {{-- Layer 2 --}}
        <img src="{{ asset('assets/img/Person/Testimoleft.png') }}" alt="Person 2" class="person-testi" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" data-aos-delay="200">
        <img src="{{ asset('assets/img/Person/Testimoright.png') }}" alt="Person 3" class="person-testi" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" data-aos-delay="200">
        {{-- Layer 3 --}}
        <img src="{{ asset('assets/img/Person/Testiright.png') }}" alt="Person 4" class="person-testi" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" data-aos-delay="400">
        <img src="{{ asset('assets/img/Person/Testiright2.png') }}" alt="Person 5" class="person-testi" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" data-aos-delay="600">
        <img src="{{ asset('assets/img/Person/Testileft2.png') }}" alt="Person 7" class="person-testi" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" data-aos-delay="600">
        <img src="{{ asset('assets/img/Person/Testileft.png') }}" alt="Person 6" class="person-testi" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" data-aos-delay="400">
        {{-- Layer 4 --}}
        <img src="{{ asset('assets/img/Person/Testleft.png') }}" alt="Person 8" class="person-testi" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" data-aos-delay="800">
        <img src="{{ asset('assets/img/Person/Testleft2.png') }}" alt="Person 9" class="person-testi" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" data-aos-delay="1000">
        <img src="{{ asset('assets/img/Person/Testleft3.png') }}" alt="Person 10" class="person-testi" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" data-aos-delay="1200">

        <img src="{{ asset('assets/img/Person/TestRight.png') }}" alt="Person 11" class="person-testi" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" data-aos-delay="800">
        <img src="{{ asset('assets/img/Person/Testright2.png') }}" alt="Person 12" class="person-testi" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" data-aos-delay="1000">
        <img src="{{ asset('assets/img/Person/Testright3.png') }}" alt="Person 13" class="person-testi" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" data-aos-delay="1200">
        {{-- Layer 5 --}}
        <img src="{{ asset('assets/img/Person/Tesleft.png') }}" alt="Person 14" class="person-testi" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" data-aos-delay="1400">
        <img src="{{ asset('assets/img/Person/Tesleft2.png') }}" alt="Person 15" class="person-testi" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" data-aos-delay="1600">

        <img src="{{ asset('assets/img/Person/Tesright.png') }}" alt="Person 14" class="person-testi" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" data-aos-delay="1400" data-aos-offset="0">
        <img src="{{ asset('assets/img/Person/Tesright2.png') }}" alt="Person 15" class="person-testi" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true" data-aos-delay="1600" data-aos-offset="0">
    </div>

    <div class="label-testi">
        <p class="label-title mb-0 text-center bg-transparent" data-aos="zoom-out-down" data-aos-duration="1000" data-aos-once="true">Testimoni</p>
        <p class="fw-semibold text-center mt-4 mb-0" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">Percayakan Semuanya Kepada Kami</p>
        <p class="fw-light text-center my-0 mx-auto" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">Lihat bagaimana klien mempercayakan rumah dan proyek mereka kepada kami.</p>
        <p style="color: #f5f5f5" class="fw-semibold mb-0 w-100 text-uppercase testi-huge text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">testimoni</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-12">
        <!-- VIEWPORT -->
        <div class="testimoni-wrapper">
            <!-- TRACK (flex murni) -->
            <div class="testimoni-track" id="testiTrack">

                <!-- ===== CARD ASLI (TIDAK DIUBAH) ===== -->
                <div class="card border-0 w-25 rounded-3 card-testimoni">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <img src="{{ asset('assets/img/Person/Man.png') }}"
                                 class="rounded-circle object-fit-contain"
                                 width="42" height="42" alt="User">
                            <div>
                                <p class="mb-0 identity">Budi Santoso <br><span>Karyawan Swasta</span></p>
                            </div>
                        </div>

                        <hr style="background-color: gray; height: 2px; width: 100%; margin: 8px 2px auto;">

                        <div class="text-danger fs-2">★★★★★</div>

                        <p class="mb-0 text-muted small fw-light lh-1" style="width: 90%">
                            “RumahGue sangat membantu dalam mencarikan tukang yang sesuai kebutuhan. Proses seleksinya jelas dan saya jadi lebih tenang karena tukangnya sudah terverifikasi.”
                        </p>
                    </div>
                </div>

                <div class="card border-0 w-25 card-testimoni">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <img src="{{ asset('assets/img/Person/Girl.png') }}"
                                 class="rounded-circle object-fit-contain"
                                 width="42" height="42" alt="User">
                            <div>
                                <p class="mb-0 identity">Rina Marlina <br><span>Ibu Rumah Tangga</span></p>
                            </div>
                        </div>

                        <hr style="background-color: gray; height: 2px; width: 100%; margin: 8px 2px auto;">

                        <div class="text-danger fs-2">★★★★★</div>

                        <p class="mb-0 text-muted small fw-light lh-1" style="width: 90%">
                            “Lewat RumahGue, saya bisa menemukan arsitek dan tukang tanpa harus cari satu-satu. Semua rekomendasinya profesional dan komunikasinya mudah.”
                        </p>
                    </div>
                </div>

                <div class="card border-0 w-25 card-testimoni">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <img src="{{ asset('assets/img/Person/Boy.png') }}"
                                 class="rounded-circle object-fit-contain"
                                 width="42" height="42" alt="User">
                            <div>
                                <p class="mb-0 identity">Andi Pratama <br><span>Wirausaha</span></p>
                            </div>
                        </div>

                        <hr style="background-color: gray; height: 2px; width: 100%; margin: 8px 2px auto;">

                        <div class="text-danger fs-2">★★★★★</div>

                        <p class="mb-0 text-muted small fw-light lh-1" style="width: 90%">
                            “RumahGue berperan sebagai penghubung yang sangat membantu. Saya bisa membandingkan beberapa tukang dan memilih yang paling cocok dengan budget dan jadwal.”
                        </p>
                    </div>
                </div>

                <div class="card border-0 w-25 card-testimoni">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <img src="{{ asset('assets/img/Person/Testileft.png') }}"
                                 class="rounded-circle object-fit-contain"
                                 width="42" height="42" alt="User">
                            <div>
                                <p class="mb-0 identity">Siti Nurhaliza <br><span>Content Creator</span></p>
                            </div>
                        </div>

                        <hr style="background-color: gray; height: 2px; width: 100%; margin: 8px 2px auto;">

                        <div class="text-danger fs-2">★★★★★</div>

                        <p class="mb-0 text-muted small fw-light lh-1" style="width: 90%">
                            “Sebagai pihak ketiga, RumahGue bikin proses cari tukang jadi aman dan transparan. Informasi harga dan estimasi pekerjaan disampaikan dari awal.”
                        </p>
                    </div>
                </div>

                <!-- ===== CARD CLONE (TIDAK DIUBAH) ===== -->
                <div class="card border-0 w-25 rounded-3 card-testimoni">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <img src="{{ asset('assets/img/Person/Man.png') }}"
                                 class="rounded-circle object-fit-contain"
                                 width="42" height="42" alt="User">
                            <div>
                                <p class="mb-0 identity">Budi Santoso <br><span>Karyawan Swasta</span></p>
                            </div>
                        </div>

                        <hr style="background-color: gray; height: 2px; width: 100%; margin: 8px 2px auto;">

                        <div class="text-danger fs-2">★★★★★</div>

                        <p class="mb-0 text-muted small fw-light lh-1" style="width: 90%">
                            “RumahGue sangat membantu dalam mencarikan tukang yang sesuai kebutuhan. Proses seleksinya jelas dan saya jadi lebih tenang karena tukangnya sudah terverifikasi.”
                        </p>
                    </div>
                </div>

                <div class="card border-0 w-25 card-testimoni">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <img src="{{ asset('assets/img/Person/Girl.png') }}"
                                 class="rounded-circle object-fit-contain"
                                 width="42" height="42" alt="User">
                            <div>
                                <p class="mb-0 identity">Rina Marlina <br><span>Ibu Rumah Tangga</span></p>
                            </div>
                        </div>

                        <hr style="background-color: gray; height: 2px; width: 100%; margin: 8px 2px auto;">

                        <div class="text-danger fs-2">★★★★★</div>

                        <p class="mb-0 text-muted small fw-light lh-1" style="width: 90%">
                            “Lewat RumahGue, saya bisa menemukan arsitek dan tukang tanpa harus cari satu-satu. Semua rekomendasinya profesional dan komunikasinya mudah.”
                        </p>
                    </div>
                </div>

                <div class="card border-0 w-25 card-testimoni">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <img src="{{ asset('assets/img/Person/Boy.png') }}"
                                 class="rounded-circle object-fit-contain"
                                 width="42" height="42" alt="User">
                            <div>
                                <p class="mb-0 identity">Andi Pratama <br><span>Wirausaha</span></p>
                            </div>
                        </div>

                        <hr style="background-color: gray; height: 2px; width: 100%; margin: 8px 2px auto;">

                        <div class="text-danger fs-2">★★★★★</div>

                        <p class="mb-0 text-muted small fw-light lh-1" style="width: 90%">
                            “RumahGue berperan sebagai penghubung yang sangat membantu. Saya bisa membandingkan beberapa tukang dan memilih yang paling cocok dengan budget dan jadwal.”
                        </p>
                    </div>
                </div>

                <div class="card border-0 w-25 card-testimoni">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <img src="{{ asset('assets/img/Person/Testileft.png') }}"
                                 class="rounded-circle object-fit-contain"
                                 width="42" height="42" alt="User">
                            <div>
                                <p class="mb-0 identity">Siti Nurhaliza <br><span>Content Creator</span></p>
                            </div>
                        </div>

                        <hr style="background-color: gray; height: 2px; width: 100%; margin: 8px 2px auto;">

                        <div class="text-danger fs-2">★★★★★</div>

                        <p class="mb-0 text-muted small fw-light lh-1" style="width: 90%">
                            “Sebagai pihak ketiga, RumahGue bikin proses cari tukang jadi aman dan transparan. Informasi harga dan estimasi pekerjaan disampaikan dari awal.”
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
const track = document.getElementById('testiTrack');
const cards = Array.from(track.children);

const speed = 1;
let x = 0;

// karena isi dobel
const singleWidth = track.scrollWidth / 2;

function animate() {
    x -= speed;

    if (x <= -singleWidth) {
        x = 0;
    }

    track.style.transform = `translate3d(${x}px, 0, 0)`;

    const centerX = window.innerWidth / 2;
    const maxDist = 300;

    cards.forEach(card => {
        const rect = card.getBoundingClientRect();
        const cardCenter = rect.left + rect.width / 2;
        const dist = Math.abs(centerX - cardCenter);

        const factor = Math.min(dist / maxDist, 1);
        card.style.transform = `scale(${1 - factor * 0.15})`;
        card.style.opacity = 1 - factor * 0.4;
    });

    requestAnimationFrame(animate);
}

animate();

</script>

