@extends('admin.layouts.app')

@section('content')
<div class="admin-page-content">

    {{-- ================= BANNER ================= --}}
    <div class="dashboard-card mb-4">
        <div class="card-header-admin">
            <h4>Banner Homepage</h4>
            <a href="#" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Tambah Banner
            </a>
        </div>

        <div class="table-responsive">
            <table class="table admin-table align-middle">
                <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th>Preview</th>
                        <th width="140">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($banners as $banner)
                        <tr>
                            <td>{{ $banner->id }}</td>
                            <td>
                                <img src="{{ asset('storage/'.$banner->image) }}" class="table-img">
                            </td>
                            <td>
                                <div class="table-action">
                                    <a href="#" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="#" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Belum ada banner
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= PROMO ================= --}}
    <div class="dashboard-card mb-4">

        {{-- HEADER --}}
        <div class="card-header-admin d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Promo Homepage</h4>
            <a href="{{ route('admin.main.promo.create') }}"
            class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Tambah Promo
            </a>
        </div>

        {{-- TABLE --}}
        <div class="table-responsive">
            <table class="table admin-table align-middle">
                <thead>
                    <tr>
                        <th width="70">ID</th>
                        <th width="140">Gambar</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th width="100">Status</th>
                        <th width="140">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($promos as $promo)
                        <tr>
                            <td>{{ $promo->id }}</td>

                            {{-- GAMBAR --}}
                            <td>
                                <img src="{{ asset($promo->image) }}"
                                    alt="{{ $promo->title }}"
                                    class="table-img">
                            </td>

                            {{-- JUDUL --}}
                            <td class="fw-semibold">
                                {{ $promo->title }}
                            </td>

                            {{-- DESKRIPSI --}}
                            <td class="text-muted">
                                {{ Str::limit($promo->short_desc, 60) }}
                            </td>

                            {{-- STATUS --}}
                            <td>
                                @if($promo->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td>
                                <div class="table-action d-flex gap-1">
                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.main.promo.edit', $promo->id) }}"
                                    class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.main.promo.destroy', $promo->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus promo ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada promo
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION (jika pakai paginate) --}}
        @if(method_exists($promos, 'links'))
            <div class="mt-3">
                {{ $promos->links() }}
            </div>
        @endif

    </div>

    {{-- ================= ARTICLES ================= --}}
    <div class="dashboard-card">
        <div class="card-header-admin">
            <h4>Articles</h4>
            <a href="#" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Tambah Article
            </a>
        </div>

        <div class="table-responsive">
            <table class="table admin-table align-middle">
                <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th width="100">Status</th>
                        <th width="140">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>{{ $article->title }}</td>
                            <td>
                                <img src="{{ asset('storage/'.$article->image) }}" class="table-img">
                            </td>
                            <td>
                                <span class="badge bg-secondary">Draft</span>
                            </td>
                            <td>
                                <div class="table-action">
                                    <a href="#" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="#" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Belum ada artikel
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
