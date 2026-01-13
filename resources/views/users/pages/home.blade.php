@extends('layouts.app')

@section('title', 'Beranda - BPR NTB')

@section('content')

    <section class="hero-section">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="hero-slide" style="background-image: url('{{ asset('images/SimbadaHero.png') }}');"></div>
                </div>
                <div class="carousel-item">
                    <div class="hero-slide" style="background-image: url('{{ asset('images/tabungan-hero.png') }}');"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. PRODUK UNGGULAN (PROMO) --}}
    <section class="promo-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="fw-bold">Produk Unggulan Kami</h2>
                <div class="header-line mx-auto"></div>
                <p class="text-muted mt-3">Solusi perbankan terpercaya untuk masyarakat Nusa Tenggara Barat.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card promo-card shadow-sm h-100">
                        <img src="{{ asset('images/tabunganku.png') }}" alt="TabunganKU">
                        <div class="card-body">
                            <h5 class="fw-bold">TabunganKU</h5>
                            <p class="small text-muted">Setoran awal ringan, bebas biaya administrasi bulanan.</p>
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card promo-card featured shadow h-100">
                        <img src="{{ asset('images/simbada-card.png') }}" alt="SIMBADA">
                        <div class="card-body">
                            <h5 class="fw-bold text-primary">SIMBADA</h5>
                            <p class="small text-muted">Simpanan Berhadiah Anda. Dapatkan peluang memenangkan hadiah
                                menarik.</p>
                            <a href="#" class="btn btn-sm btn-primary rounded-pill">Detail Produk</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card promo-card shadow-sm h-100">
                        <img src="{{ asset('images/tabungan-sukses.png') }}" alt="Deposito">
                        <div class="card-body">
                            <h5 class="fw-bold">Tabungan Sukses</h5>
                            <p class="small text-muted">Investasi aman dengan suku bunga kompetitif dan dijamin LPS.</p>
                            <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. SUKU BUNGA --}}
    <section class="suku-bunga-section">
        <div class="container">

            <div class="sb-card-wrapper">

                {{-- LEFT PANEL --}}
                <div class="sb-left-panel">
                    <span>TINGKAT BUNGA PENJAMINAN (LPS)</span>

                    <h2 class="sb-value">6.00%</h2>

                    <p>
                        Suku bunga BPR sebesar <strong>6.00%</strong>
                        sesuai ketentuan penjaminan LPS.
                        Simpanan dijamin hingga Rp 2 Miliar.
                    </p>

                    <a href="https://apps.lps.go.id/BankPesertaLPSRate" target="_blank" rel="noopener"
                        class="btn btn-light btn-sm rounded-pill px-4 mt-3">
                        Cek LPS Rate Resmi
                    </a>
                </div>

                {{-- RIGHT PANEL --}}
                <div class="sb-right-panel">

                    <h3 class="sb-right-title">Rincian Suku Bunga</h3>

                    {{-- DROPDOWN TABUNGAN --}}
                    <div class="sb-dropdown active">
                        <button class="sb-dropdown-header" type="button">
                            <span>Suku Bunga Tabungan</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>

                        <div class="sb-dropdown-content">
                            <div class="sb-row">
                                <span>Simbada</span>
                                <span>5.00%</span>
                            </div>
                            <div class="sb-row">
                                <span>TabunganKU</span>
                                <span>3.00%</span>
                            </div>
                            <div class="sb-row">
                                <span>Tabungan Siswa</span>
                                <span>4.00%</span>
                            </div>
                        </div>
                    </div>

                    {{-- DROPDOWN DEPOSITO --}}
                    <div class="sb-dropdown">
                        <button class="sb-dropdown-header" type="button">
                            <span>Suku Bunga Deposito</span>
                            <i class="bi bi-chevron-down"></i>
                        </button>

                        <div class="sb-dropdown-content">
                            <div class="sb-row">
                                <span>1 Bulan</span>
                                <span>5.00% p.a</span>
                            </div>
                            <div class="sb-row">
                                <span>6 Bulan</span>
                                <span>5.50% p.a</span>
                            </div>
                            <div class="sb-row">
                                <span>12 Bulan</span>
                                <span>6.00% p.a</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- 4. BERITA TERKINI --}}
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold m-0">Berita Terkini</h2>
                <a href="#" class="btn btn-link text-primary fw-bold text-decoration-none">Berita Lainnya →</a>
            </div>
            <div class="row g-4">
                @for ($i = 0; $i < 3; $i++)
                    <div class="col-md-4">
                        <div class="berita-card shadow-sm">
                            <img src="{{ asset('images/berita.png') }}" alt="Berita BPR NTB">
                            <div class="berita-overlay">
                                <h5 class="text-white fw-bold">Rapat Koordinasi Tahunan PT. BPR NTB (Perseroda)</h5>
                                <p class="text-white-50 small mb-0">Membangun sinergi untuk memperkuat ekonomi daerah...
                                </p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- PRESTASI --}}
    <section class="prestasi-section">
        <div class="container">
            <div class="info-box-custom">
                <div class="info-box-img-wrapper">
                    <img src="{{ asset('images/penghargaan-infobank.png') }}" class="info-box-img" alt="Prestasi">
                </div>
                <div class="info-box-content">
                    <span class="info-label label-prestasi">Penghargaan</span>
                    <h2>Sangat Bagus: Infobank Award 2025</h2>
                    <p>PT BPR NTB (Perseroda) kembali mengukir prestasi nasional dengan meraih predikat kinerja keuangan
                        "Sangat Bagus" dari Infobank.</p>
                    <a href="#" class="info-link link-prestasi">Selengkapnya <i
                            class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>

    {{-- LELANG --}}
    <section class="lelang-section">
        <div class="container">
            <div class="info-box-custom flex-md-row-reverse">
                <div class="info-box-img-wrapper">
                    <img src="{{ asset('images/lelang-pengadaan.png') }}" class="info-box-img" alt="Lelang">
                </div>
                <div class="info-box-content">
                    <span class="info-label label-lelang">E-Procurement</span>
                    <h2>Lelang Pengadaan Jasa Audit 2025</h2>
                    <p>Kami mengundang Kantor Akuntan Publik (KAP) profesional untuk berpartisipasi dalam proses pengadaan
                        jasa audit laporan keuangan tahun buku 2025.</p>
                    <a href="#" class="info-link link-lelang">Baca Pengumuman <i
                            class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. KONTAK & TESTIMONI --}}
    <section class="kontak-section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <h2 class="fw-bold mb-4">Apa Kata Nasabah?</h2>
                    <div class="testimoni-card shadow">
                        <i class="bi bi-quote fs-1 text-primary opacity-25"></i>
                        <p class="mb-4">"Menjadi nasabah BPR NTB sangat memudahkan usaha kecil saya. Proses kreditnya
                            cepat dan bunganya sangat bersaing. Sangat membantu UMKM!"</p>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-primary rounded-circle" style="width: 50px; height: 50px;"></div>
                            </div>
                            <div class="ms-3 text-dark">
                                <h6 class="fw-bold mb-0">H. Ahmad Fauzi</h6>
                                <small class="text-muted">Pengusaha Lokal</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <h2 class="fw-bold mb-4">Butuh Bantuan?</h2>
                    <form class="form-custom">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Nama Lengkap">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Email Anda">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" placeholder="Subjek Pertanyaan">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" rows="4" placeholder="Tuliskan pesan atau pertanyaan Anda di sini..."></textarea>
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-warning px-5 py-2 fw-bold rounded-pill">Kirim
                                    Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
