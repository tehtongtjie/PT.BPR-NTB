@extends('layouts.app')

@section('title', 'Deposito - BPR NTB')

@push('styles')
    {{-- CSS khusus deposito (kosong dulu / minimal) --}}
    <link rel="stylesheet" href="{{ asset('css/pages/deposito.css') }}">
@endpush

@section('content')

    {{-- ================= HERO / HEADER PLACEHOLDER ================= --}}
    <section class="deposito-hero">
        <div class="container">
            <h1>Deposito BPR NTB</h1>
            <p>Solusi simpanan berjangka yang aman dan menguntungkan</p>
        </div>
    </section>

    {{-- ================= BODY (PLACEHOLDER) ================= --}}
    <section class="deposito-body">
        <div class="container">
            <div class="deposito-placeholder">
                <p>Konten deposito akan ditambahkan di tahap berikutnya.</p>
            </div>
        </div>
    </section>

@endsection
