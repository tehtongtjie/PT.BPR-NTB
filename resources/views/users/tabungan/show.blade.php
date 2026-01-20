@extends('users.layouts.app')

@section('title', $tabungan['nama'] . ' - BPR NTB')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/layout/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/tabungan.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

@section('content')
    <main class="main-content">
        <section class="tabungan-page">
            <div class="container">
                <div class="row g-5">

                {{-- ================= SIDEBAR ================= --}}
                <div class="col-lg-4">
                    @include('users.partials.sidebar-produk')
                </div>

                    <div class="col-lg-8">
                        <div class="main-product-card">

                            <div class="product-header">
                                <img src="{{ asset($tabungan['gambar']) }}" alt="Ilustrasi {{ $tabungan['nama'] }} BPR NTB"
                                    loading="lazy">
                                <h1>{{ $tabungan['nama'] }}</h1>
                                <p>{{ $tabungan['subtitle'] }}</p>
                            </div>

                            <div class="product-body">
                                <p class="product-description">
                                    {{ $tabungan['deskripsi'] }}
                                </p>

                                <h2 class="section-title">Keuntungan {{ $tabungan['nama'] }}</h2>
                                <div class="benefits-grid">
                                    @foreach ($tabungan['keuntungan'] as $item)
                                        <div class="benefit-item">
                                            <i class="bi bi-check-circle"></i>
                                            <strong>{{ $item }}</strong>
                                        </div>
                                    @endforeach
                                </div>

                                <h2 class="section-title">Syarat Pengajuan</h2>
                                <ul class="requirements-list">
                                    <li>WNI</li>
                                    <li>KTP berlaku</li>
                                    <li>Isi formulir</li>
                                </ul>

                                <a href="/hubungi-kami" class="cta-button">
                                    Ajukan {{ $tabungan['nama'] }}
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
