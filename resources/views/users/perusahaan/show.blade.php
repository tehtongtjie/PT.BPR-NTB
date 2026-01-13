@extends('layouts.app')

@section('title', 'Perusahaan - ' . ucfirst(str_replace('-', ' ', $slug)))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/perusahaan.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@section('content')
    <section class="page-content">
        <div class="container perusahaan-wrapper">
            <div class="row g-lg-5">

                {{-- ================= SIDEBAR ================= --}}
                <aside class="col-lg-3">
                    <div class="sticky-sidebar">
                        @include('partials.sidebar-perusahaan')
                    </div>
                </aside>

                {{-- ================= CONTENT ================= --}}
                <div class="col-lg-9">
                    <div class="content-box">
                        <div class="image-wrapper mb-5">
                            <img src="{{ asset($data['image']) }}" class="img-fluid content-image"
                                alt="{{ $data['title'] }}">
                        </div>

                        <div class="header-text-group mb-5">
                            <span class="content-subtitle">{{ $data['subtitle'] }}</span>
                            <h2 class="content-title mt-2">{{ $data['title'] }}</h2>
                            <div class="title-accent"></div>
                        </div>

                        {{-- ================= SEJARAH & HALAMAN UMUM ================= --}}
                        @if (isset($data['content']) && is_array($data['content']))
                            <div class="article-body">
                                @foreach ($data['content'] as $paragraph)
                                    <p class="lead-text">{{ $paragraph }}</p>
                                @endforeach

                                @if (isset($data['shareholders']))
                                    <div class="info-card mt-5">
                                        <h5 class="content-subtitle-inner"><i class="fas fa-users-cog me-2"></i> Komposisi
                                            Nama Pemegang Saham</h5>
                                        <p class="shareholder-text">{{ $data['shareholders'] }}</p>
                                    </div>
                                @endif

                                @if (isset($data['purpose']))
                                    <div class="purpose-section mt-5">
                                        <h5 class="content-subtitle-inner"><i class="fas fa-bullseye me-2"></i> Maksud dan
                                            Tujuan</h5>
                                        <p>{{ $data['purpose']['text'] }}</p>

                                        <ul class="custom-list-premium">
                                            @foreach ($data['purpose']['list'] as $item)
                                                <li><i class="fas fa-check-circle text-gold me-2"></i> {{ $item }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                        {{-- ================= VISI & MISI ================= --}}
                        @elseif ($slug === 'visi-misi')
                            <div class="vision-mission-grid">
                                <div class="vision-card mb-5">
                                    <h5 class="content-subtitle-inner"><i class="fas fa-eye me-2"></i> Visi</h5>
                                    <blockquote class="vision-quote">
                                        "{{ $data['visi'] }}"
                                    </blockquote>
                                </div>

                                <div class="mission-card">
                                    <h5 class="content-subtitle-inner"><i class="fas fa-rocket me-2"></i> Misi Kami</h5>
                                    <ol class="premium-ordered-list">
                                        @foreach ($data['misi'] as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>

                        {{-- ================= BUDAYA PERUSAHAAN ================= --}}
                        @elseif ($slug === 'budaya')
                            <div class="culture-section">
                                @foreach ($data['intro'] as $paragraph)
                                    <p>{{ $paragraph }}</p>
                                @endforeach

                                <div class="values-grid mt-5">
                                    <h5 class="content-subtitle-inner mb-4"><i class="fas fa-heart me-2"></i> Nilai-Nilai
                                        Budaya</h5>
                                    <div class="row">
                                        @foreach ($data['values'] as $item)
                                            <div class="col-md-6 mb-4">
                                                <div class="value-item-card">
                                                    <div class="value-icon">
                                                        <i class="fas fa-shield-alt"></i>
                                                    </div>
                                                    <div class="value-content">
                                                        <strong>{{ $item['key'] }}</strong>
                                                        <span>{{ $item['description'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @elseif ($slug === 'komisaris')

                        {{-- DEWAN KOMISARIS --}}
                        <div class="commissioner-section">
                            @foreach ($data['members'] as $member)
                                <div class="commissioner-card">
                                    <div class="commissioner-photo">
                                        <img src="{{ asset($member['photo']) }}" alt="{{ $member['name'] }}">
                                    </div>

                                    <div class="commissioner-info">
                                        <h3>{{ $member['name'] }}</h3>
                                        <span class="commissioner-role">{{ $member['position'] }}</span>

                                        <p>{{ $member['summary'] }}</p>

                                        <a href="#" class="btn-detail">Selengkapnya</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- ================= DEWAN DIREKSI ================= --}}
                        @elseif ($slug === 'direksi')

                        <div class="executive-section">

                            @foreach ($data['members'] as $member)
                                <div class="executive-card">

                                    <div class="executive-photo">
                                        <img src="{{ asset($member['image']) }}" alt="{{ $member['name'] }}">
                                    </div>

                                    <div class="executive-content">
                                        <h3 class="executive-name">{{ $member['name'] }}</h3>
                                        <span class="executive-position">{{ $member['position'] }}</span>

                                        <p class="executive-excerpt">
                                            {{ $member['excerpt'] }}
                                        </p>

                                        <a href="{{ url('/perusahaan/direksi/' . $member['slug']) }}"
                                        class="btn-executive">
                                            Selengkapnya
                                        </a>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                        {{-- ================= TATA KELOLA PERUSAHAAN ================= --}}
                        @elseif ($slug === 'tata-kelola')

                        <div class="governance-section">

                            @foreach ($data['intro'] as $paragraph)
                                <p class="lead-text">{{ $paragraph }}</p>
                            @endforeach

                            <div class="governance-points mt-5">
                                <h5 class="content-subtitle-inner">
                                    <i class="fas fa-balance-scale me-2"></i>
                                    Prinsip Tata Kelola
                                </h5>

                                <ol class="premium-ordered-list mt-4">
                                    @foreach ($data['principles'] as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ol>
                            </div>

                        </div>
                        @endif
                        
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
