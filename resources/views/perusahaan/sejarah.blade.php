@extends('layouts.app')

@section('title', 'Sejarah')

@section('content')

<!-- HERO -->
<section class="page-hero">
    <div class="container-fluid px-5">
        <h1 class="page-title">Sejarah</h1>
        <p class="page-breadcrumb">
            <span>Perusahaan</span> - <span class="active">Sejarah</span>
        </p>
    </div>
</section>

<!-- CONTENT -->
<section class="page-content">
    <div class="container-fluid px-5">
        <div class="row">

            <!-- SIDEBAR KIRI -->
            <aside class="col-lg-3">
                <div class="sidebar-box">
                    <h3 class="sidebar-title">Profil</h3>
                    <ul class="sidebar-menu">
                        <li class="active"><a href="#">Sejarah</a></li>
                        <li><a href="#">Visi & Misi</a></li>
                        <li><a href="#">Budaya Perusahaan</a></li>
                        <li><a href="#">Struktur Organisasi</a></li>
                        <li><a href="#">Dewan Komisaris</a></li>
                        <li><a href="#">Direksi</a></li>
                        <li><a href="#">Tata Kelola Perusahaan</a></li>
                    </ul>
                </div>
            </aside>

            <!-- KONTEN KANAN -->
            <div class="col-lg-9">
                <div class="content-box">

                    <img src="{{ asset('images/sejarah-bpr.jpg') }}" 
                         class="img-fluid content-image" 
                         alt="Sejarah BPR NTB">

                    <h2 class="content-title">Sejarah PT BPR NTB PERSERODA</h2>
                    <h5 class="content-subtitle">Sejarah Singkat</h5>

                    <p>
                        PT BPR NTB PERSERODA adalah salah satu Perusahaan Milik Pemerintah Daerah
                        yang bergerak dalam bidang jasa keuangan/perbankan yang berlokasi di
                        wilayah Mataram...
                    </p>

                    <p>
                        Pada tahun 1998 berdasarkan Keputusan Menteri Keuangan Republik Indonesia...
                    </p>

                    <h5 class="content-subtitle mt-4">Komposisi Nama Pemegang Saham</h5>
                    <p>
                        Berdasarkan Peraturan Daerah Nomor 10 Tahun 2016...
                    </p>

                    <h5 class="content-subtitle mt-4">
                        Maksud dan Tujuan didirikan PT BPR NTB PERSERODA
                    </h5>

                    <ol>
                        <li>Menghimpun dana masyarakat dalam bentuk tabungan dan deposito.</li>
                        <li>Memberikan kredit kepada usaha kecil dan mikro.</li>
                        <li>Melakukan kerja sama dengan lembaga keuangan lain.</li>
                        <li>Menjalankan usaha perbankan sesuai peraturan perundang-undangan.</li>
                    </ol>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection
