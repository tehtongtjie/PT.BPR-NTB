@extends('users.layouts.app')

@section('title', $deposito['nama'] . ' - BPR NTB')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/deposito.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

@section('content')

        <section class="deposito-page page-content">
            <div class="container">
                <div class="row g-5 justify-content-center">

                    {{-- ================= MAIN CONTENT ================= --}}
                    <div class="col-lg-8">
                        <div class="main-product-card">

                            {{-- HEADER CARD --}}
                            <div class="product-header">
                                <img src="{{ asset($deposito['gambar']) }}" alt="Ilustrasi {{ $deposito['nama'] }} BPR NTB"
                                    loading="lazy">

                                <h1>{{ $deposito['nama'] }}</h1>
                                <p>{{ $deposito['subtitle'] }}</p>
                            </div>

                            {{-- BODY --}}
                            <div class="product-body">

                                <p class="product-description">
                                    {{ $deposito['deskripsi'] }}
                                </p>

                                <h2 class="section-title">Keunggulan {{ $deposito['nama'] }}</h2>
                                <div class="benefits-grid">
                                    @foreach ($deposito['keuntungan'] as $item)
                                        <div class="benefit-item">
                                            <i class="bi bi-check-circle"></i>
                                            <strong>{{ $item }}</strong>
                                        </div>
                                    @endforeach
                                </div>

                                <h2 class="section-title">Suku Bunga Deposito</h2>
                                <ul class="requirements-list">
                                    @foreach ($deposito['suku_bunga'] as $bulan => $bunga)
                                        <li>
                                            <i class="bi bi-percent"></i>
                                            Jangka Waktu {{ $bulan }} Bulan
                                            <strong>{{ $bunga }} / Tahun</strong>
                                        </li>
                                    @endforeach
                                </ul>

                                <h2 class="section-title">Contoh Perolehan Bunga (per bulan)</h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nominal Deposito</th>
                                                <th>1 Bulan</th>
                                                <th>3 Bulan</th>
                                                <th>6 Bulan</th>
                                                <th>12 Bulan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($deposito['simulasi_bunga'] as $nominal => $simulasi)
                                                <tr>
                                                    <td>Rp {{ number_format($nominal, 0, ',', '.') }}</td>
                                                    <td>Rp {{ number_format($simulasi[1], 0, ',', '.') }}</td>
                                                    <td>Rp {{ number_format($simulasi[3], 0, ',', '.') }}</td>
                                                    <td>Rp {{ number_format($simulasi[6], 0, ',', '.') }}</td>
                                                    <td>Rp {{ number_format($simulasi[12], 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <h2 class="section-title">Persyaratan Deposito</h2>

                                <h5 class="mt-3">Perorangan</h5>
                                <ul class="requirements-list">
                                    @foreach ($deposito['persyaratan']['perorangan'] as $syarat)
                                        <li>
                                            <i class="bi bi-check-circle-fill"></i>
                                            {{ $syarat }}
                                        </li>
                                    @endforeach
                                </ul>

                                <h5 class="mt-3">Badan Usaha</h5>
                                <ul class="requirements-list">
                                    @foreach ($deposito['persyaratan']['badan_usaha'] as $syarat)
                                        <li>
                                            <i class="bi bi-check-circle-fill"></i>
                                            {{ $syarat }}
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="alert alert-info mt-4">
                                    <ul class="mb-0">
                                        @foreach ($deposito['catatan'] as $note)
                                            <li>{{ $note }}</li>
                                        @endforeach
                                    </ul>
                                </div>

                                <a href="{{ route('simulasi.deposito') }}" class="cta-button">
                                    <i class="bi bi-calculator"></i>
                                    Simulasikan Deposito Sekarang
                                </a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

@endsection
