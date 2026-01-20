@extends('admin.layouts.app')

@section('title', 'Tambah Promo')

@section('content')
<div class="admin-page-content">

    <div class="dashboard-card promo-form-card">

        {{-- HEADER --}}
        <div class="promo-form-header">
            <div>
                <h4>Tambah Promo</h4>
                <p class="text-muted mb-0">
                    Tambahkan promo yang akan tampil di homepage
                </p>
            </div>

            <a href="{{ route('admin.main') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- FORM --}}
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">

                {{-- LEFT --}}
                <div class="col-lg-7">

                {{-- JUDUL PROMO --}}
                <div class="form-group">
                    <label class="form-label">
                        Judul Promo <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                        name="title"
                        class="form-control promo-input"
                        placeholder="Contoh: TABUNGANKU"
                        required>
                </div>

                {{-- DESKRIPSI SINGKAT --}}
                <div class="form-group">
                    <label class="form-label">
                        Deskripsi Singkat <span class="text-danger">*</span>
                    </label>

                    <textarea name="short_desc"
                            class="form-control promo-textarea"
                            placeholder="Tuliskan deskripsi singkat promo..."
                            required></textarea>

                    <div class="form-helper">
                        Maksimal ±150 karakter (dipotong di homepage)
                    </div>
                </div>

                </div>

                {{-- RIGHT --}}
                <div class="col-lg-5">

                    {{-- GAMBAR --}}
                    <div class="form-group">
                        <label class="form-label">
                            Gambar Promo <span class="text-danger">*</span>
                        </label>

                        <div class="upload-box">
                            <input type="file"
                                   name="image"
                                   class="form-control"
                                   required>

                            <div class="upload-info">
                                <span>Format: JPG / PNG</span>
                                <span>Ukuran max: 2MB</span>
                                <span>Rasio disarankan: 16:9</span>
                            </div>
                        </div>
                    </div>

                    {{-- STATUS --}}
                    <div class="form-group">
                        <label class="form-label">Status Promo</label>
                        <select name="status" class="form-select">
                            <option value="aktif" selected>Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>

                </div>
            </div>

            {{-- ACTION --}}
            <div class="promo-form-action">
                <a href="{{ route('admin.main') }}" class="btn btn-light">
                    Batal
                </a>
                <button class="btn btn-primary px-4">
                    <i class="bi bi-save"></i> Simpan Promo
                </button>
            </div>

        </form>

    </div>

</div>
@endsection
