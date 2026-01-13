@extends('layouts.app')

@section('title', $pinjaman['nama'] . ' - BPR NTB')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/layout/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/pinjaman.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

@section('content')
    <section class="pinjaman-page">
        <div class="container">
            <div class="row g-5">

                {{-- ================= SIDEBAR ================= --}}
                <div class="col-lg-4">
                    @include('partials.sidebar-pinjaman')
                </div>

                {{-- ================= MAIN CONTENT ================= --}}
                <div class="col-lg-8">
                    <div class="main-product-card">

                        {{-- HEADER CARD --}}
                        <div class="product-header">
                            <img src="{{ asset($pinjaman['gambar']) }}" alt="Ilustrasi {{ $pinjaman['nama'] }} BPR NTB"
                                loading="lazy">
                            <h1>{{ $pinjaman['nama'] }}</h1>
                            <p>{{ $pinjaman['subtitle'] }}</p>
                        </div>

                        {{-- BODY --}}
                        <div class="product-body">

                            {{-- DESKRIPSI --}}
                            <p class="product-description">
                                {{ $pinjaman['deskripsi'] }}
                            </p>

                            {{-- KEUNTUNGAN --}}
                            <h2 class="section-title">Keunggulan {{ $pinjaman['nama'] }}</h2>
                            <div class="benefits-grid">
                                @foreach ($pinjaman['keuntungan'] as $item)
                                    <div class="benefit-item">
                                        <i class="bi bi-check-circle" aria-hidden="true"></i>
                                        <div class="benefit-text">
                                            <strong>{{ $item }}</strong>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- JENIS PINJAMAN --}}
                            @if (!empty($pinjaman['jenis']))
                                <h2 class="section-title">Jenis {{ $pinjaman['nama'] }}</h2>
                                <ul class="requirements-list">
                                    @foreach ($pinjaman['jenis'] as $jenis)
                                        <li>
                                            <i class="bi bi-check-circle-fill"></i>
                                            {{ $jenis }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            {{-- CTA --}}
                            <a href="{{ route('simulasi.kredit') }}" class="cta-button" role="button">
                                <i class="bi bi-calculator"></i>
                                Simulasikan {{ $pinjaman['nama'] }} Sekarang
                            </a>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
