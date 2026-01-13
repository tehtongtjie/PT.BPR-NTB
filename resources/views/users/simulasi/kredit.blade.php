@extends('layouts.app')

@section('title', 'Simulasi Kredit')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/simulasi/simulasi-kredit.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@section('content')
    <section class="simulasi-section">
        <div class="container-fluid px-5">
            <div class="simulasi-box">
                <div class="simulasi-left">
                    <div class="input-group-custom">
                        <label class="form-label-custom">Jumlah Pinjaman (Plafond)</label>
                        <input type="text" id="pinjaman" class="form-control-premium" placeholder="Rp 0">
                        <small id="pinjaman-error" class="text-danger d-none">
                            <i class="fas fa-exclamation-circle"></i> <span id="error-msg"></span>
                        </small>
                    </div>

                    <div class="input-group-custom mt-3">
                        <label class="form-label-custom">Jenis Kredit</label>
                        <select id="jenis_kredit" class="form-control-premium">
                            <option value="" selected disabled>Pilih Jenis Kredit</option>
                            <option value="konsumtif">Kredit Konsumtif</option>
                            <option value="agunan">Modal Kerja - Dengan Agunan</option>
                            <option value="tanpa_agunan">Modal Kerja - Tanpa Agunan</option>
                        </select>
                    </div>

                    <div class="input-group-custom mt-3" id="sistem-bunga-wrapper">
                        <label class="form-label-custom">Metode Angsuran</label>
                        <select id="sistem_bunga" class="form-control-premium">
                            <option value="" selected disabled>Pilih Sistem Bunga</option>
                            <option value="flat">Bunga Flat (Tetap)</option>
                            <option value="anuitas">Bunga Anuitas (Efektif)</option>
                        </select>
                    </div>

                    <div class="simulasi-row mt-3">
                        <div class="flex-grow-1">
                            <label class="form-label-custom">Tenor (Bulan)</label>
                            <select id="tenor" class="form-control-premium">
                                <option value="" selected disabled>Tenor</option>
                                @foreach ([6, 12, 18, 24, 36, 48, 60, 72, 84, 96, 108, 120, 132, 144] as $t)
                                    <option value="{{ $t }}">{{ $t }} Bulan</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-grow-1">
                            <label class="form-label-custom">Suku Bunga</label>
                            <div id="bunga-info" class="form-control-premium readonly-bg">Suku Bunga (%)</div>
                        </div>
                    </div>
                </div>

                <div class="simulasi-right">
                    <div class="result-card">
                        <div class="result-item">
                            <label>Estimasi Angsuran / Bulan</label>
                            <h2 id="display_angsuran">Rp 0</h2>
                            <input type="hidden" id="angsuran">
                        </div>
                        <div class="result-divider"></div>
                        <div class="result-summary">
                            <div class="summary-line">
                                <span>Plafond</span>
                                <strong id="summary_plafond">Rp 0</strong>
                            </div>
                            <div class="summary-line">
                                <span>Total Bunga</span>
                                <strong id="summary_bunga">Rp 0</strong>
                            </div>
                        </div>
                    </div>

                    <div id="anuitas-info" class="simulasi-warning d-none">
                        <i class="fas fa-info-circle me-1"></i> Sistem <b>Anuitas</b>: Porsi bunga besar di awal dan
                        mengecil setiap bulan seiring berkurangnya sisa pokok.
                    </div>

                    <a href="{{ route('simulasi.permintaan', 'kredit') }}" class="simulasi-btn">
                        <i class="fas fa-paper-plane me-2"></i> Ajukan Pinjaman
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

