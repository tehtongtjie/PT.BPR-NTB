@extends('layouts.app')

@section('title', $tabungan['nama'] . ' - BPR NTB')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/layout/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/tabungan.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

@section('content')
    <section class="tabungan-page">
        <div class="container">
            <div class="row g-5">

                {{-- ================= SIDEBAR ================= --}}
                <div class="col-lg-4">
                    @include('partials.sidebar-produk')
                </div>

                {{-- ================= MAIN CONTENT ================= --}}
                <div class="col-lg-8">
                    <div class="main-product-card">

                        {{-- HEADER CARD --}}
                        <div class="product-header">
                            <img src="{{ asset($tabungan['gambar']) }}" alt="Ilustrasi {{ $tabungan['nama'] }} BPR NTB"
                                loading="lazy">
                            <h1>{{ $tabungan['nama'] }}</h1>
                            <p>{{ $tabungan['subtitle'] }}</p>
                        </div>

                        {{-- BODY --}}
                        <div class="product-body">

                            {{-- DESKRIPSI --}}
                            <p class="product-description">
                                {{ $tabungan['deskripsi'] }}
                            </p>

                            {{-- KEUNTUNGAN --}}
                            <h2 class="section-title">Keuntungan {{ $tabungan['nama'] }}</h2>
                            <div class="benefits-grid">
                                @foreach ($tabungan['keuntungan'] as $item)
                                    <div class="benefit-item">
                                        <i class="bi bi-check-circle" aria-hidden="true"></i>
                                        <div class="benefit-text">
                                            <strong>{{ $item }}</strong>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- SYARAT --}}
                            <h2 class="section-title">Syarat Pengajuan</h2>
                            <ul class="requirements-list">
                                <li><i class="bi bi-check-circle-fill"></i> Warga Negara Indonesia (WNI)</li>
                                <li><i class="bi bi-check-circle-fill"></i> Fotokopi KTP yang masih berlaku</li>
                                <li><i class="bi bi-check-circle-fill"></i> Mengisi formulir pembukaan rekening</li>
                            </ul>

                            {{-- CTA --}}
                            <a href="/hubungi-kami" class="cta-button" role="button">
                                <i class="bi bi-telephone-forward"></i>
                                Ajukan {{ $tabungan['nama'] }} Sekarang
                            </a>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
