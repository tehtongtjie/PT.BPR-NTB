@extends('users.layouts.app')

@section('title', 'Whistle Blowing System - BPR NTB')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')

        <section class="pengaduan-page">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-8">
                        <div class="main-product-card">

                            {{-- HEADER --}}
                            <div class="product-header text-center">
                                <h1>Whistle Blowing System</h1>
                                <p>Saluran pelaporan pelanggaran yang aman, independen, dan rahasia</p>
                            </div>

                            {{-- BODY --}}
                            <div class="product-body">

                                {{-- ALERT SUCCESS --}}
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                {{-- DESKRIPSI --}}
                                <p class="mb-4">
                                    <strong>Whistle Blowing System (WBS)</strong> merupakan sarana resmi bagi masyarakat,
                                    nasabah, maupun pegawai untuk melaporkan dugaan pelanggaran yang terjadi di lingkungan
                                    <strong>PT BPR NTB (Perseroda)</strong>.
                                    <br><br>
                                    Setiap laporan akan ditangani secara profesional dengan menjamin
                                    <strong>kerahasiaan identitas pelapor</strong>.
                                </p>

                                {{-- FORM --}}
                                <form method="POST" action="{{ route('pengaduan.wbs.store') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Nama Pelapor <span
                                                class="text-muted">(Opsional)</span></label>
                                        <input type="text" name="nama" class="form-control"
                                            placeholder="Isi nama Anda (boleh dikosongkan)">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email <span class="text-muted">(Opsional)</span></label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="email@contoh.com">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">No. Telepon <span
                                                class="text-muted">(Opsional)</span></label>
                                        <input type="tel" name="no_telepon" class="form-control" placeholder="(+62)">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Kategori Pelanggaran</label>
                                        <select name="kategori" class="form-select" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            <option value="fraud">Fraud / Kecurangan</option>
                                            <option value="korupsi">Korupsi</option>
                                            <option value="pelanggaran_etika">Pelanggaran Etika</option>
                                            <option value="penyalahgunaan_wewenang">Penyalahgunaan Wewenang</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nama Terlapor <span class="text-muted"></span></label>
                                        <input type="text" name="nama-terlapor" class="form-control"
                                            placeholder="Isi nama Terlapor">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Lokasi Kejadian <span class="text-muted"></span></label>
                                        <input type="text" name="Lokasi-Kejadian" class="form-control"
                                            placeholder="Isi Lokasi Kejadian">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Waktu Kejadian <span class="text-danger">*</span>
                                        </label>
                                        <input type="datetime-local" name="waktu_kejadian" class="form-control" required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Uraian Laporan</label>
                                        <textarea name="laporan" rows="6" class="form-control"
                                            placeholder="Jelaskan secara detail dugaan pelanggaran yang Anda laporkan..." required></textarea>
                                    </div>

                                    <div class="alert alert-warning small">
                                        <i class="bi bi-shield-lock-fill me-1"></i>
                                        Identitas pelapor dilindungi dan tidak akan disebarluaskan.
                                    </div>

                                    <button type="submit" class="cta-button">
                                        <i class="bi bi-send"></i>
                                        Kirim Laporan
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

@endsection
