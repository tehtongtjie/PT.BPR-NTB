@extends('layouts.app')

@section('title', 'Perusahaan - ' . ucfirst(str_replace('-', ' ', $slug)))

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/perusahaan.css') }}">
@endpush

@section('content')
<section class="page-content">
    <div class="container perusahaan-wrapper">
        <div class="row">

            {{-- ================= SIDEBAR ================= --}}
            <aside class="col-lg-3">
                    @include('partials.sidebar-perusahaan')
            </aside>

            {{-- ================= CONTENT ================= --}}
            <div class="col-lg-9">
                <div class="content-box">

                    {{-- HEADER --}}
                    <img src="{{ asset($data['image']) }}" class="img-fluid content-image">

                    <h2 class="content-title">{{ $data['title'] }}</h2>
                    <h5 class="content-subtitle">{{ $data['subtitle'] }}</h5>

                    {{-- ================= SEJARAH & HALAMAN ARTIKEL ================= --}}
                    @if (isset($data['content']) && is_array($data['content']))

                        @foreach ($data['content'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach

                        @if (isset($data['shareholders']))
                            <h5 class="content-subtitle mt-4">Komposisi Nama Pemegang Saham</h5>
                            <p>{{ $data['shareholders'] }}</p>
                        @endif

                        @if (isset($data['purpose']))
                            <h5 class="content-subtitle mt-4">Maksud dan Tujuan</h5>
                            <p>{{ $data['purpose']['text'] }}</p>

                            <ol>
                                @foreach ($data['purpose']['list'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ol>
                        @endif


                    {{-- ================= VISI & MISI ================= --}}
                    @elseif ($slug === 'visi-misi')

                        <h5 class="content-subtitle mt-4">Visi</h5>
                        <p>{{ $data['visi'] }}</p>

                        <h5 class="content-subtitle mt-4">Misi</h5>
                        <ol>
                            @foreach ($data['misi'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ol>


                    {{-- ================= BUDAYA PERUSAHAAN ================= --}}
                    @elseif ($slug === 'budaya')

                        @foreach ($data['intro'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach

                    <ol class="budaya-nilai">
                        @foreach ($data['values'] as $item)
                            <li>
                                <strong>{{ $item['key'] }}</strong>
                                – {{ $item['description'] }}
                            </li>
                        @endforeach
                    </ol>

                    @endif


                </div>
            </div>

        </div>
    </div>
</section>
@endsection
