@extends('layouts.app')

@section('title', 'Permintaan Informasi Lanjutan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/simulasi/permintaan.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@section('content')

    <div class="permintaan-banner">
        <div class="container-fluid px-5">
            <div class="banner-content">
                <h2 class="banner-title">Layanan Informasi</h2>
            </div>
        </div>
    </div>

    <section class="permintaan-section">
        <div class="container-fluid px-5">

            <div class="form-wrapper-premium">
                <div class="form-header-premium">
                    <div class="icon-circle">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h2 class="form-main-title">PERMINTAAN INFORMASI LANJUTAN</h2>
                    <p class="form-subtitle">Lengkapi data diri Anda, petugas kami akan segera menghubungi Anda untuk
                        memberikan penjelasan lebih detail.</p>
                </div>

                <div class="form-card-premium">
                    <form action="{{ route('simulasi.permintaan.submit') }}" method="POST">
                        @csrf

                        <input type="hidden" name="jenis" value="{{ $jenis }}">

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="input-label-premium">Nama Lengkap</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-user"></i>
                                    <input type="text" name="nama" class="input-premium"
                                        placeholder="Masukkan nama sesuai KTP" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="input-label-premium">Nomor Telepon / WhatsApp</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-phone-alt"></i>
                                    <input type="text" name="telepon" class="input-premium"
                                        placeholder="Contoh: 08123456789" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="input-label-premium">Alamat Email</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" name="email" class="input-premium"
                                        placeholder="Contoh: nama@email.com" required>
                                </div>
                            </div>
                        </div>

                        <div class="privacy-notice-wrapper">
                            <label class="custom-checkbox-container">
                                <input type="checkbox" required>
                                <span class="checkmark"></span>
                                <span class="privacy-text">
                                    Saya bersedia dihubungi oleh petugas Bank untuk memperoleh informasi
                                    dan penawaran produk sesuai dengan <strong>Kebijakan Privasi</strong> yang berlaku.
                                </span>
                            </label>
                        </div>

                        <div class="form-action-center">
                            <button type="submit" class="btn-submit-premium">
                                Kirim Permintaan <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>

@endsection
