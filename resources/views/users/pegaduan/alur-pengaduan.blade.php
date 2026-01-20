@extends('users.layouts.app')

@section('title', 'Alur Pengaduan Nasabah - BPR NTB')

@vite(['resources/css/app.css'])
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

@section('content')

        <section class="pinjaman-page">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-10">
                        <div class="main-product-card">

                            {{-- HEADER --}}
                            <div class="product-header">
                                <h3>Alur Pengaduan Nasabah</h3>
                                <p>PT. BPR NTB (Perseroda)</p>
                            </div>

                            {{-- BODY --}}
                            <div class="product-body">

                                {{-- DESKRIPSI --}}
                                <p class="product-description">
                                    PT. BPR NTB (Perseroda) menyediakan layanan pengaduan nasabah sebagai bentuk
                                    komitmen dalam menjaga kualitas layanan, transparansi, serta perlindungan
                                    terhadap hak nasabah.
                                </p>

                                {{-- GAMBAR ALUR --}}
                                <div class="text-center my-5">
                                    <img src="{{ asset('images/alur-pengaduan.png') }}" alt="Alur Pengaduan Nasabah BPR NTB"
                                        class="img-fluid rounded-4 shadow-sm">
                                </div>

                                {{-- LANGKAH-LANGKAH --}}
                                <h2 class="section-title">Tahapan Pengaduan</h2>
                                <ul class="requirements-list">
                                    <li>
                                        <i class="bi bi-chat-dots-fill"></i>
                                        Nasabah menyampaikan pengaduan melalui sarana komunikasi yang disediakan
                                        PT. BPR NTB (Perseroda).
                                    </li>
                                    <li>
                                        <i class="bi bi-shield-check"></i>
                                        Petugas melakukan verifikasi dan pemeriksaan kesesuaian data nasabah.
                                    </li>
                                    <li>
                                        <i class="bi bi-clipboard-check"></i>
                                        Pengaduan dicatat dan diproses sesuai ketentuan yang berlaku.
                                    </li>
                                    <li>
                                        <i class="bi bi-receipt"></i>
                                        Nasabah menerima tanda terima pengaduan.
                                    </li>
                                    <li>
                                        <i class="bi bi-gear-fill"></i>
                                        Petugas menindaklanjuti dan menyelesaikan pengaduan sesuai jangka waktu
                                        penyelesaian.
                                    </li>
                                </ul>

                                {{-- DOKUMEN --}}
                                <h2 class="section-title mt-5">Dokumen Terkait Pengaduan</h2>
                                <div class="benefits-grid">
                                    <div class="benefit-item">
                                        <i class="bi bi-person-vcard"></i>
                                        <strong>Identitas diri nasabah / perwakilan</strong>
                                    </div>
                                    <div class="benefit-item">
                                        <i class="bi bi-bank"></i>
                                        <strong>Bukti kepemilikan rekening (Buku Tabungan)</strong>
                                    </div>
                                    <div class="benefit-item">
                                        <i class="bi bi-file-earmark-text"></i>
                                        <strong>Dokumen pendukung (Slip, Resi, Bukti Transaksi, dll)</strong>
                                    </div>
                                </div>

                                {{-- JANGKA WAKTU --}}
                                <h2 class="section-title mt-5">Jangka Waktu Penyelesaian</h2>
                                <ul class="requirements-list">
                                    <li>
                                        <i class="bi bi-clock-history"></i>
                                        Pengaduan secara lisan diselesaikan maksimal <strong>5 hari kerja</strong>.
                                    </li>
                                    <li>
                                        <i class="bi bi-envelope-paper"></i>
                                        Pengaduan secara tertulis diselesaikan maksimal <strong>10 hari kerja</strong>.
                                    </li>
                                    <li>
                                        <i class="bi bi-exclamation-circle"></i>
                                        Apabila belum tercapai kesepakatan, nasabah dapat melanjutkan ke LAPS
                                        atau Pengadilan.
                                    </li>
                                </ul>

                                {{-- CTA --}}
                                <div class="cta-container">
                                    <a href="{{ route('pengaduan.wbs') }}" class="cta-button">
                                        <i class="bi bi-megaphone-fill"></i>
                                        Sampaikan Pengaduan Sekarang
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

@endsection
