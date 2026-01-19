@extends('users.layouts.app')

@section('title', $data['name'])

@vite('resources/css/pages/komisarisdireksi-detail.css')

@section('content')
    <main class="main-content">
        <section class="page-content">
            <div class="container">
                <div class="detail-card">

                    <div class="detail-header text-center">
                        <img src="{{ asset($data['photo']) }}" alt="{{ $data['name'] }}" class="detail-photo mb-4">
                        <h1>{{ $data['name'] }}</h1>
                        <span class="detail-position">{{ $data['position'] }}</span>
                    </div>

                    <div class="detail-body mt-5">
                        {!! nl2br(e($data['profile'])) !!}
                    </div>

                    <div class="detail-footer mt-5">
                        <a href="{{ url('/perusahaan/komisaris') }}" class="btn btn-outline-secondary">
                            ← Kembali ke Dewan Komisaris
                        </a>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
