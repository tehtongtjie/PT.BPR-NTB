{{-- Menginduk ke layout utama anda --}}
@extends('users.layouts.app')

@section('content')
    {{-- Memanggil CSS spesifik halaman mitra melalui Vite --}}
    @vite(['resources/css/pages/mitra.css'])

    <div class="container main-content py-5">
        <div class="row mb-5 text-center">
            <div class="col-lg-8 mx-auto">
                <h2 class="fw-bold text-dark">Mitra UMKM Binaan</h2>
                <p class="text-muted">Mendorong pertumbuhan ekonomi lokal melalui dukungan berkelanjutan bagi pengusaha
                    kreatif di Nusa Tenggara Barat.</p>
                <hr class="mx-auto"
                    style="width: 60px; height: 4px; background: var(--bpr-gold); border: none; border-radius: 10px;">
            </div>
        </div>

        <div class="row">
            @forelse ($umkms as $umkm)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card card-umkm h-100 border-0 shadow-sm">
                        {{-- Bagian Gambar --}}
                        <div class="card-img-wrapper">
                            <img src="{{ asset($umkm['foto']) }}" class="card-img-top" alt="{{ $umkm['nama_usaha'] }}"
                                onerror="this.src='https://via.placeholder.com/400x250?text=No+Image'">
                            <div class="category-badge">
                                <i class="bi bi-patch-check-fill me-1"></i> Mitra Terverifikasi
                            </div>
                        </div>

                        {{-- Bagian Konten --}}
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-1 text-dark text-capitalize">{{ $umkm['nama_usaha'] }}</h5>
                            <p class="text-primary small fw-semibold mb-3">
                                <i class="bi bi-person-circle me-1"></i> {{ $umkm['nama_pemilik'] }}
                            </p>

                            <div class="info-list mb-3">
                                <div class="d-flex align-items-start mb-2 text-muted small">
                                    <i class="bi bi-geo-alt-fill text-danger me-2 mt-1"></i>
                                    <span>{{ $umkm['lokasi'] }}</span>
                                </div>
                                <div class="d-flex align-items-center text-muted small">
                                    <i class="bi bi-telephone-fill text-success me-2"></i>
                                    <span>{{ $umkm['telepon'] }}</span>
                                </div>
                            </div>

                            <p class="card-text text-muted small line-clamp">
                                {{ $umkm['deskripsi'] }}
                            </p>
                        </div>

                        {{-- Bagian Footer Card --}}
                        <div class="card-footer bg-transparent border-0 p-4 pt-0">
                            <div class="d-flex gap-2">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $umkm['telepon']) }}" target="_blank"
                                    class="btn btn-success btn-sm flex-grow-1 rounded-pill fw-bold">
                                    <i class="bi bi-whatsapp me-1"></i> Chat
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-sm flex-grow-1 rounded-pill fw-bold">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-shop text-muted" style="font-size: 3rem;"></i>
                    <p class="mt-3 text-muted">Belum ada data mitra UMKM saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
