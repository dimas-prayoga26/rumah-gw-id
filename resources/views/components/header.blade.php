<div class="container mt-4 px-0">
    <nav class="navbar-glass w-100 d-flex fixed-top justify-content-lg-evenly justify-content-between justify-content-sm-between align-items-center">

        <!-- LEFT LOGO -->
        <div class="navbar-logo">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="logoRumahgue">
        </div>

        <!-- CENTER MENU -->
        <div class="me-3 d-lg-inline d-md-none d-sm-none navbar-menu">
            <a href="{{ route('rumahgue') }}" class="text-decoration-none item-nav">Beranda</a>
            <a href="{{ route('rumahgue') }}/#simulasi-rumah" class="text-decoration-none item-nav">Simulasi Rumah</a>
            <a href="{{ route('berita-gue') }}" class="text-decoration-none item-nav">Berita</a>
        </div>

        <script>
            function upcoming() {
                Swal.fire({
                    icon: 'info',
                    title: 'Fitur Segera Hadir',
                    text: 'Fitur ini sedang dalam pengembangan dan akan segera hadir. Terima kasih atas kesabaran Anda!',
                    confirmButtonText: 'OK'
                });
            }
        </script>


        <!-- RIGHT BUTTON -->
        @auth
            <div class="d-flex align-items-center gap-4">
                @if(Auth::user()->is_mitra == 1)

                <div class="dropdown">
                    <button
                        class="btn p-0 border-0 bg-transparent position-relative"
                        type="button"
                        id="notifDropdown"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        onclick="readAllNotif()">

                        <i class="fa-regular fa-bell fs-4"></i>

                        <span id="notif-count"
                            class="position-absolute top-0 start-100 translate-middle
                                badge rounded-pill bg-danger d-none">
                        </span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow"
                        aria-labelledby="notifDropdown"
                        style="width: 320px;"
                        id="notif-list">

                        <li class="dropdown-header fw-semibold">Notifikasi</li>

                        <li class="text-center text-muted py-3 small" id="notif-empty">
                            Tidak ada notifikasi
                        </li>
                    </ul>
                </div>
                <script>
                @if(auth()->check() && auth()->user()->is_mitra == 1)

                function loadNotif() {
                    fetch('/notifikasi')
                        .then(res => res.json())
                        .then(data => {
                            const list = document.getElementById('notif-list');
                            const badge = document.getElementById('notif-count');
                            const empty = document.getElementById('notif-empty');

                            if (!list || !badge || !empty) return;

                            // reset list
                            list.querySelectorAll('.notif-item').forEach(e => e.remove());

                            if (data.length > 0) {

                                // hitung unread
                                const unread = data.filter(n => n.is_read == '0').length;

                                if (unread > 0) {
                                    badge.innerText = unread;
                                    badge.classList.remove('d-none');
                                } else {
                                    badge.classList.add('d-none');
                                }

                                empty.classList.add('d-none');

                                data.forEach(item => {
                                    const li = document.createElement('li');
                                    li.className = 'px-3 py-2 small notif-item';
                                    li.style.cursor = 'pointer';

                                    // style beda antara read/unread
                                    if(item.is_read == '1'){
                                        li.classList.add('text-muted');
                                        li.style.fontWeight = '400';
                                    } else {
                                        li.style.fontWeight = '600';
                                    }

                                    li.innerHTML = `
                                        <span class="fw-semibold ${item.is_read == '0' ? 'text-danger' : ''}">${item.user.nama}</span><br>
                                        <span class="text-muted">${item.message}</span>
                                    `;
                                    const hr = document.createElement('hr');
                                    hr.className = 'dropdown-divider notif-item';
                                    list.appendChild(hr);

                                    list.appendChild(li);

                                });

                            } else {
                                badge.classList.add('d-none');
                                empty.classList.remove('d-none');
                            }
                        });

                }

                function readAllNotif() {
                    fetch('/notif-read', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    }).then(() => loadNotif());
                }

                // load pertama dan polling tiap 5 detik
                loadNotif();
                setInterval(loadNotif, 5000);

                @endif
                </script>
                @endif
                {{-- USER DROPDOWN --}}
                <div class="dropdown">
                    <button class="btn-signin fw-semibold text-white text-decoration-none dropdown-toggle"
                            type="button"
                            id="dropdownMenuButton"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                        {{ Auth::user()->nama }}
                    </button>

                    <ul class="dropdown-menu gap-2" aria-labelledby="dropdownMenuButton">
                        @if (Auth::user()->is_mitra != 0)
                            <li>
                                <a class="dropdown-item"
                                href="{{ route(Auth::user()->is_mitra == 1 ? 'mitra-home' : 'admin-user') }}">
                                    Dashboard
                                </a>
                            </li>
                            <hr class="my-1">
                        @endif

                        <li><a class="dropdown-item d-lg-none d-md-block d-sm-block" href="{{ route('rumahgue') }}">Beranda</a></li>
                        <li><a class="dropdown-item d-lg-none d-md-block d-sm-block" href="{{ route('rumahgue') }}/#simulasi-rumah">Simulasi Rumah</a></li>
                        <li><a class="dropdown-item d-lg-none d-md-block d-sm-block" href="{{ route('berita-gue') }}" >Berita</a></li>
                        <hr class="d-lg-none d-md-block d-sm-block my-1">

                        @if (Auth::user()->is_mitra == 0)
                            <li><a class="dropdown-item" href="{{ route('pengaturan') }}">Pengaturan Akun</a></li>
                            <hr class="my-1">
                        @endif

                        <li><a class="dropdown-item" href="{{ route('logout') }}">Keluar</a></li>
                    </ul>
                </div>
            </div>
        @else
            <button onclick="window.location.href = '{{ route('login') }}';" class="btn-signin text-white text-decoration-none">
                Masuk
            </button>
        @endif

    </nav>
</div>
