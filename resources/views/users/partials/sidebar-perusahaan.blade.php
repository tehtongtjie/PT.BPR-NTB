<div class="card shadow-sm sidebar-universal">
    <div class="card-body">

        <h6 class="sidebar-heading">PERUSAHAAN</h6>

        <ul class="sidebar-list">

            <li class="{{ $slug === 'sejarah' ? 'active' : '' }}">
                <a href="{{ route('perusahaan.show', 'sejarah') }}">Sejarah</a>
            </li>

            <li class="{{ $slug === 'visi-misi' ? 'active' : '' }}">
                <a href="{{ route('perusahaan.show', 'visi-misi') }}">Visi & Misi</a>
            </li>

            <li class="{{ $slug === 'budaya' ? 'active' : '' }}">
                <a href="{{ route('perusahaan.show', 'budaya') }}">Budaya Perusahaan</a>
            </li>

            <li class="{{ $slug === 'struktur-organisasi' ? 'active' : '' }}">
                <a href="{{ route('perusahaan.show', 'struktur-organisasi') }}">Struktur Organisasi</a>
            </li>

            <li class="{{ $slug === 'komisaris' ? 'active' : '' }}">
                <a href="{{ route('perusahaan.show', 'komisaris') }}">Dewan Komisaris</a>
            </li>

            <li class="{{ $slug === 'direksi' ? 'active' : '' }}">
                <a href="{{ route('perusahaan.show', 'direksi') }}">Direksi</a>
            </li>

            <li class="{{ $slug === 'tata-kelola' ? 'active' : '' }}">
                <a href="{{ route('perusahaan.show', 'tata-kelola') }}">Tata Kelola Perusahaan</a>
            </li>

        </ul>

    </div>
</div>
