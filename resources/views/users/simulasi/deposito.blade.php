@extends('layouts.app')

@section('title', 'Simulasi Deposito')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/simulasi/simulasi-deposito.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@section('content')

    <section class="simulasi-section">
        <div class="container-fluid px-5">
            <div class="simulasi-box">
                <div class="simulasi-left">
                    <div class="input-group-custom">
                        <label class="form-label-custom">Nominal Deposito</label>
                        <input type="text" id="nominal" class="form-control-premium" placeholder="Contoh: 10.000.000">
                        <small id="nominal-error" class="text-danger d-none mt-1">
                            <i class="fas fa-exclamation-circle"></i> Minimal nominal deposito adalah Rp 5.000.000
                        </small>
                    </div>

                    <div class="simulasi-row mt-3">
                        <div class="flex-grow-1">
                            <label class="form-label-custom">Jangka Waktu (Tenor)</label>
                            <select id="tenor" class="form-control-premium">
                                <option value="" selected disabled>Pilih Tenor</option>
                                <option value="1">1 Bulan</option>
                                <option value="3">3 Bulan</option>
                                <option value="6">6 Bulan</option>
                                <option value="12">12 Bulan</option>
                            </select>
                        </div>
                        <div class="flex-grow-1">
                            <label class="form-label-custom">Suku Bunga (% p.a)</label>
                            <input type="text" id="bunga" class="form-control-premium" value="5.00" readonly>
                        </div>
                    </div>

                    <div class="simulasi-warning mt-4">
                        <i class="fas fa-info-circle me-2"></i>
                        <span>Suku bunga dapat berubah sewaktu-waktu sesuai ketentuan Bank. Pajak bunga 20% berlaku untuk
                            deposito di atas Rp 7.500.000.</span>
                    </div>
                </div>

                <div class="simulasi-right">
                    <div class="result-card">
                        <div class="result-item">
                            <span>Estimasi Bunga (Netto)</span>
                            <h4 id="display_bunga">Rp 0</h4>
                        </div>
                        <hr class="result-divider">
                        <div class="result-item">
                            <span>Total Dana Saat Jatuh Tempo</span>
                            <h2 id="display_total" class="text-gold">Rp 0</h2>
                        </div>
                    </div>

                    <a href="{{ route('simulasi.permintaan', 'deposito') }}" class="simulasi-btn w-100 text-center mt-3">
                        <i class="fas fa-paper-plane me-2"></i> Ajukan Deposito Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection