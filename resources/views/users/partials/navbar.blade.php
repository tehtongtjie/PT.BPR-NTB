<nav class="navbar navbar-expand-lg navbar-light bg-white bpr-navbar">
    <div class="container-fluid px-lg-5">

        {{-- LOGO --}}
        <a class="navbar-brand d-flex align-items-center py-2" href="{{ url('/') }}">
            <img src="{{ asset('images/logo-bpr-ntb.png') }}" alt="BPR NTB" class="navbar-logo" style="height: 50px;">
        </a>

        {{-- TOGGLER MOBILE --}}
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav mx-auto fw-semibold align-items-center">

                {{-- BERANDA --}}
                <li class="nav-item">
                    <a class="nav-link nav-link-bpr {{ request()->is('/') ? 'active' : '' }}"
                        href="{{ url('/') }}">Beranda</a>
                </li>

                {{-- PRODUK & LAYANAN (Manual Toggle untuk Anti-Konflik) --}}
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-bpr dropdown-toggle {{ request()->is(['tabungan*', 'deposito*', 'pinjaman*', 'simulasi*', 'umkm-mitra']) ? 'active' : '' }}"
                        href="javascript:void(0)" role="button">
                        Produk & Layanan
                    </a>
                    <ul class="dropdown-menu dropdown-bpr shadow-lg border-0">
                        <li>
                            <a class="dropdown-item" href="{{ route('tabungan.show', 'tabunganku') }}">Tabungan</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('deposito.index') }}">Deposito</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('pinjaman.index') }}">Pinjaman</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('umkm.mitra') }}">UMKM Mitra</a>
                        </li>

                        <hr class="dropdown-divider">

                        {{-- SUBMENU SIMULASI --}}
                        <li class="dropdown-submenu">
                            <a class="dropdown-item d-flex justify-content-between align-items-center"
                                href="javascript:void(0)">
                                Simulasi
                                <i class="bi bi-chevron-right ms-2 d-none d-lg-block"></i>
                                <i class="bi bi-chevron-down d-lg-none"></i>
                            </a>
                            <ul class="dropdown-menu shadow border-0">
                                <li>
                                    <a class="dropdown-item" href="{{ route('simulasi.deposito') }}">Simulasi
                                        Deposito</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('simulasi.kredit') }}">Simulasi Kredit</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                {{-- PERUSAHAAN --}}
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-bpr dropdown-toggle" href="javascript:void(0)">Perusahaan</a>
                    <ul class="dropdown-menu dropdown-bpr shadow border-0">
                        <li><a class="dropdown-item" href="{{ route('perusahaan.show', 'sejarah') }}">Sejarah</a></li>
                        <li><a class="dropdown-item" href="{{ route('perusahaan.show', 'visi-misi') }}">Visi & Misi</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('perusahaan.show', 'budaya-perusahaan') }}">Budaya
                                Perusahaan</a></li>
                        <li><a class="dropdown-item" href="{{ route('perusahaan.show', 'komisaris') }}">Dewan
                                Komisaris</a></li>
                        <li><a class="dropdown-item" href="{{ route('perusahaan.show', 'direksi') }}">Direksi</a></li>
                        <li><a class="dropdown-item" href="{{ route('perusahaan.show', 'tata-kelola') }}">Tata Kelola
                                Perusahaan</a></li>
                    </ul>
                </li>

                {{-- JARINGAN & PUBLIKASI --}}
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-bpr dropdown-toggle
        {{ request()->routeIs('jaringan.kantor') ? 'active' : '' }}"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Jaringan
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('jaringan.kantor') ? 'is-active' : '' }}"
                                href="{{ route('jaringan.kantor') }}">
                                Kantor
                            </a>
                        </li>
                    </ul>
                </li>

                <ul class="dropdown-menu dropdown-bpr shadow border-0">
                    <li>
                        <a class="dropdown-item {{ request()->routeIs('jaringan.kantor') ? 'active' : '' }}"
                            href="{{ route('jaringan.kantor') }}">
                            Kantor
                        </a>
                    </li>
                </ul>
                </li>

                <li class="nav-item dropdown me-lg-3">
                    <a class="nav-link nav-link-bpr dropdown-toggle" href="javascript:void(0)">Publikasi</a>
                    <ul class="dropdown-menu dropdown-bpr shadow border-0">
                        <li><a class="dropdown-item" href="#">Berita</a></li>
                        <li><a class="dropdown-item" href="#">Event</a></li>
                        <li><a class="dropdown-item" href="#">Lelang</a></li>
                        <li><a class="dropdown-item" href="#">Laporan</a></li>
                    </ul>
                </li>

                {{-- PENGADUAN --}}
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-bpr dropdown-toggle" href="javascript:void(0)">Pengaduan</a>
                    <ul class="dropdown-menu dropdown-bpr shadow border-0">
                        <li><a class="dropdown-item" href="{{ route('pengaduan.alur') }}">Alur Pengaduan</a></li>
                        <li><a class="dropdown-item" href="{{ route('pengaduan.wbs') }}">Whistle Blowing System</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
