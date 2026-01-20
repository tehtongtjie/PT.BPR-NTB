@extends('admin.layouts.app')

@section('title', 'Edit Promo')

@section('content')
<div class="admin-page-content">

    <div class="dashboard-card">

        {{-- HEADER --}}
        <div class="card-header-admin mb-4">
            <h4>Edit Promo</h4>
            <a href="{{ route('admin.main') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- FORM --}}
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- PREVIEW GAMBAR --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Gambar Saat Ini</label><br>
                <img src="{{ asset($promo->image) }}"
                     alt="{{ $promo->title }}"
                     style="max-width:200px;border-radius:12px;">
            </div>

            {{-- GANTI GAMBAR --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Ganti Gambar (Opsional)</label>
                <input type="file" name="image" class="form-control">
            </div>

            {{-- JUDUL --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Judul Promo</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       value="{{ $promo->title }}"
                       required>
            </div>

            {{-- DESKRIPSI --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Deskripsi Singkat</label>
                <textarea name="short_desc"
                          class="form-control"
                          rows="4"
                          required>{{ $promo->short_desc }}</textarea>
            </div>

            {{-- STATUS --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select">
                    <option value="aktif" {{ $promo->status == 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="nonaktif" {{ $promo->status == 'nonaktif' ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>
            </div>

            {{-- ACTION --}}
            <div class="d-flex gap-2">
                <button class="btn btn-primary">
                    <i class="bi bi-save"></i> Update Promo
                </button>
                <a href="{{ route('admin.main') }}" class="btn btn-outline-secondary">
                    Batal
                </a>
            </div>

        </form>
    </div>

</div>
@endsection
