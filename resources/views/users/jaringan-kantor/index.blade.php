@extends('users.layouts.app')

@section('title', 'Jaringan Kantor - BPR NTB')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
@endpush

@section('content')

    <section class="jaringan-kantor-page page-content">
        <div class="container">

            {{-- ================= HEADER ================= --}}
            <div class="text-center mb-5">
                <h1 class="fw-bold">Jaringan Kantor BPR NTB</h1>
                <p class="text-muted">
                    Temukan kantor BPR NTB di seluruh wilayah Nusa Tenggara Barat
                </p>
            </div>

            {{-- ================= FILTER ================= --}}
            <div class="row align-items-center mb-4">
                <div class="col-md-5 mb-3 mb-md-0">
                    <div class="position-relative">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                        <input type="text" id="searchKantor" class="form-control ps-5"
                            placeholder="Cari kantor berdasarkan nama atau alamat">
                    </div>
                </div>
                <div class="col-md-7 text-md-end">
                    <div class="btn-group">
                        <button class="btn btn-outline-primary filter-btn active" data-filter="all">Semua</button>
                        <button class="btn btn-outline-primary filter-btn" data-filter="pusat">Pusat</button>
                        <button class="btn btn-outline-primary filter-btn" data-filter="cabang">Cabang</button>
                        <button class="btn btn-outline-primary filter-btn" data-filter="kas">Kas</button>
                    </div>
                </div>
            </div>

            {{-- ================= TABLE ================= --}}
            <div class="card shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tipe</th>
                                <th>Nama Kantor</th>
                                <th>Alamat</th>
                                <th class="text-center">Telepon</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="kantorTableBody">
                            @forelse ($kantor as $item)
                                <tr class="kantor-row" data-id="{{ $item['kode'] ?? 'kantor-' . $loop->iteration }}"
                                    data-type="{{ strtolower($item['tipe'] ?? 'cabang') }}"
                                    data-lat="{{ $item['latitude'] ?? '' }}" data-lng="{{ $item['longitude'] ?? '' }}">

                                    <td class="fw-bold text-primary">
                                        {{ ($kantor->currentPage() - 1) * $kantor->perPage() + $loop->iteration }}
                                    </td>

                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ $item['tipe'] ?? 'Cabang' }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="fw-bold kantor-nama">{{ $item['nama'] }}</div>
                                        <small class="text-muted kantor-kode">{{ $item['kode'] ?? '' }}</small>
                                    </td>

                                    <td>
                                        <div class="kantor-alamat">
                                            <i class="bi bi-geo-alt text-danger"></i>
                                            {{ $item['alamat'] ?? '-' }}
                                        </div>
                                        <div class="text-muted kantor-kota">
                                            {{ $item['kota'] ?? 'NTB' }}
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        @if (!empty($item['telepon']))
                                            <a href="tel:{{ $item['telepon'] }}" class="btn btn-sm btn-outline-success">
                                                <i class="bi bi-telephone"></i>
                                                <span class="kantor-telepon">{{ $item['telepon'] }}</span>
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary"
                                            onclick='openMapModal(@json($item))'>
                                            <i class="bi bi-map"></i> Peta
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="bi bi-building-x fs-1 text-muted"></i>
                                        <p class="mt-2">Data kantor tidak ditemukan</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- ================= PAGINATION ================= --}}
                @if ($kantor->hasPages())
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <small class="text-muted">
                                Menampilkan
                                {{ $kantor->firstItem() }} – {{ $kantor->lastItem() }}
                                dari {{ $kantor->total() }} kantor
                            </small>

                            {{ $kantor->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </section>

    {{-- ================= MAP MODAL ================= --}}
    <div class="modal fade" id="mapModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-geo-alt-fill me-2"></i>
                        <span id="modalKantorName"></span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-0">
                    <div id="map"></div>
                    <div class="p-3 bg-light">
                        <h6 class="fw-bold mb-1" id="modalKantorFullName"></h6>
                        <p class="small text-muted mb-2" id="modalKantorAlamat"></p>
                        <div class="row small">
                            <div class="col-6">
                                <i class="bi bi-clock me-1"></i>
                                <span id="modalKantorJam"></span>
                            </div>
                            <div class="col-6 text-end">
                                <i class="bi bi-telephone me-1"></i>
                                <span id="modalKantorTelepon"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary btn-sm" onclick="shareLocation()">
                        <i class="bi bi-share"></i> Share
                    </button>
                    <button class="btn btn-primary btn-sm" onclick="getDirections()">
                        <i class="bi bi-compass"></i> Rute
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @endpush


@endsection
