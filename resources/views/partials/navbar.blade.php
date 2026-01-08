<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-0">
    <div class="container-fluid px-5">

        {{-- LOGO --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/logo-bpr-ntb.png') }}" alt="BPR NTB" class="navbar-logo me-2">
        </a>

        {{-- TOGGLER MOBILE --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto fw-semibold">

                {{-- BERANDA --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active text-danger' : '' }}" href="{{ url('/') }}">
                        Beranda
                    </a>
                </li>

                {{-- ================= PRODUK & LAYANAN ================= --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button">
                        Produk & Layanan
                    </a>

                    <ul class="dropdown-menu dropdown-bpr">

                        {{-- TABUNGAN (TANPA SUBDROPDOWN) --}}
                        <li>
                            <a class="dropdown-item {{ request()->is('tabungan*') ? 'active' : '' }}"
                                href="{{ route('tabungan.show', 'tabunganku') }}">
                                Tabungan
                            </a>
                        </li>

                        {{-- PINJAMAN --}}
                        <li>
                            <a class="dropdown-item" href="{{ route('pinjaman.index') }}">
                                Pinjaman
                            </a>
                        </li>

                        {{-- SIMULASI (SUB DROPDOWN MASIH BOLEH) --}}
                        <li class="dropdown-submenu">
                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                                Simulasi
                                <span class="arrow">›</span>
                            </a>
                            <ul class="dropdown-menu dropdown-bpr">
                                <li>
                                    <a class="dropdown-item" href="{{ route('simulasi.deposito') }}">
                                        Simulasi Deposito
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('simulasi.kredit') }}">
                                        Simulasi Kredit
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- UMKM --}}
                        <li>
                            <a class="dropdown-item" href="#">
                                UMKM Mitra
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- ================= PERUSAHAAN ================= --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle
                        {{ request()->is('perusahaan/*') ? 'active text-danger' : '' }}"
                    href="#">
                        Perusahaan
                    </a>

                    <ul class="dropdown-menu dropdown-bpr">

                        <li>
                            <a class="dropdown-item
                                {{ request()->routeIs('perusahaan.show') && request('slug') == 'sejarah' ? 'active' : '' }}"
                            href="{{ route('perusahaan.show', 'sejarah') }}">
                                Sejarah
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item"
                            href="{{ route('perusahaan.show', 'visi-misi') }}">
                                Visi & Misi
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item"
                            href="{{ route('perusahaan.show', 'budaya') }}">
                                Budaya Perusahaan
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item"
                            href="{{ route('perusahaan.show', 'struktur-organisasi') }}">
                                Struktur Organisasi
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item"
                            href="{{ route('perusahaan.show', 'komisaris') }}">
                                Dewan Komisaris
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item"
                            href="{{ route('perusahaan.show', 'direksi') }}">
                                Direksi
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item"
                            href="{{ route('perusahaan.show', 'tata-kelola') }}">
                                Tata Kelola Perusahaan
                            </a>
                        </li>

                    </ul>
                </li>
                
                {{-- JARINGAN --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#">
                        Jaringan
                    </a>
                    <ul class="dropdown-menu dropdown-bpr">
                        <li><a class="dropdown-item" href="#">Kantor</a></li>
                    </ul>
                </li>

                {{-- PUBLIKASI --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#">
                        Publikasi
                    </a>
                    <ul class="dropdown-menu dropdown-bpr">
                        <li><a class="dropdown-item" href="#">Berita</a></li>
                        <li><a class="dropdown-item" href="#">Pengumuman & Lelang</a></li>
                        <li><a class="dropdown-item" href="#">Event</a></li>
                        <li><a class="dropdown-item" href="#">Edukasi</a></li>
                        <li><a class="dropdown-item" href="#">Galeri</a></li>
                    </ul>
                </li>

                {{-- PENGADUAN --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#">
                        Pengaduan
                    </a>
                    <ul class="dropdown-menu dropdown-bpr">
                        <li><a class="dropdown-item" href="#">Penanganan Pengaduan</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
