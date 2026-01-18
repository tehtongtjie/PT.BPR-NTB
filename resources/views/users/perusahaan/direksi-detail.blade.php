@extends('layouts.app')

@section('title', $data['name'])

@vite('resources/css/pages/komisarisdireksi-detail.css')

@section('content')
    <main class="main-content">
        <section class="page-content">
            <div class="container">
                <div class="detail-card">

                    <div class="detail-header text-center">
                        <img src="{{ asset($data['image']) }}" alt="{{ $data['name'] }}" class="detail-photo mb-4">
                        <h1>{{ $data['name'] }}</h1>
                        <span class="detail-position">{{ $data['position'] }}</span>
                    </div>

                    <div class="detail-body mt-5">
                        {!! nl2br(e($data['profile'] ?? $data['excerpt'])) !!}
                    </div>

                    <div class="detail-footer mt-5">
                        <a href="{{ url('/perusahaan/direksi') }}" class="btn btn-outline-secondary">
                            ← Kembali ke Dewan Direksi
                        </a>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
