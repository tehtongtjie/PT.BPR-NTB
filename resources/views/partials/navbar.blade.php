<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top bpr-navbar">
    <div class="container-fluid px-lg-5">

        {{-- LOGO --}}
        <a class="navbar-brand d-flex align-items-center py-2" href="{{ url('/') }}">
            <img src="{{ asset('images/logo-bpr-ntb.png') }}" alt="BPR NTB" class="navbar-logo">
        </a>

        {{-- TOGGLER MOBILE --}}
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto fw-semibold align-items-center">

                {{-- BERANDA --}}
                <li class="nav-item">
                    <a class="nav-link nav-link-bpr {{ request()->is('/') ? 'active' : '' }}"
                        href="{{ url('/') }}">
                        Beranda
                    </a>
                </li>

                {{-- PRODUK & LAYANAN --}}
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-bpr dropdown-toggle {{ request()->is('tabungan*') || request()->is('pinjaman*') || request()->is('simulasi*') ? 'active' : '' }}"
                        href="#" role="button" data-bs-toggle="dropdown">
                        Produk & Layanan
                    </a>
                    <ul class="dropdown-menu dropdown-bpr animate slideIn">
                        <li><a class="dropdown-item" href="{{ route('tabungan.show', 'tabunganku') }}">Tabungan</a></li>
                        <li><a class="dropdown-item" href="{{ route('pinjaman.index') }}">Pinjaman</a></li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                                Simulasi <i class="bi bi-chevron-right arrow-sub"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-bpr shadow">
                                <li><a class="dropdown-item" href="{{ route('simulasi.deposito') }}">Simulasi
                                        Deposito</a></li>
                                <li><a class="dropdown-item" href="{{ route('simulasi.kredit') }}">Simulasi Kredit</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                {{-- PERUSAHAAN --}}
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-bpr dropdown-toggle" href="#"
                        data-bs-toggle="dropdown">Perusahaan</a>
                    <ul class="dropdown-menu dropdown-bpr animate slideIn">
                        <li><a class="dropdown-item" href="{{ route('perusahaan.show', 'sejarah') }}">Sejarah</a></li>
                        <li><a class="dropdown-item" href="{{ route('perusahaan.show', 'visi-misi') }}">Visi & Misi</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('perusahaan.show', 'budaya') }}">Budaya
                                Perusahaan</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-bpr dropdown-toggle" href="#"
                        data-bs-toggle="dropdown">Jaringan</a>
                    <ul class="dropdown-menu dropdown-bpr animate slideIn">
                        <li><a class="dropdown-item" href="#">Kantor</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown me-lg-3">
                    <a class="nav-link nav-link-bpr dropdown-toggle" href="#"
                        data-bs-toggle="dropdown">Publikasi</a>
                    <ul class="dropdown-menu dropdown-bpr animate slideIn">
                        <li><a class="dropdown-item" href="#">Berita</a></li>
                        <li><a class="dropdown-item" href="#">Event</a></li>
                    </ul>
                </li>

                {{-- BUTTON PENGADUAN (SPECIAL BUTTON) --}}
                <li class="nav-item mt-3 mt-lg-0">
                    <a class="btn btn-pengaduan d-flex align-items-center px-4 py-2" href="#">
                        <i class="bi bi-chat-dots-fill me-2"></i> Pengaduan
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
