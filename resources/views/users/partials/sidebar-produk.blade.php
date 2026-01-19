<div class="card shadow-sm sidebar-universal">
    <div class="card-body">

        <h6 class="sidebar-heading">TABUNGAN</h6>

        <ul class="sidebar-list">

            <li class="{{ request()->is('tabungan/tabunganku') ? 'active' : '' }}">
                <a href="{{ route('tabungan.show', 'tabunganku') }}">
                    Tabunganku
                </a>
            </li>

            <li class="{{ request()->is('tabungan/tabungan-sukses') ? 'active' : '' }}">
                <a href="{{ route('tabungan.show', 'tabungan-sukses') }}">
                    Tabungan Sukses
                </a>
            </li>

            <li class="{{ request()->is('tabungan/simbada') ? 'active' : '' }}">
                <a href="{{ route('tabungan.show', 'simbada') }}">
                    SIMBADA
                </a>
            </li>

            <li class="{{ request()->is('tabungan/tabungan-simpel') ? 'active' : '' }}">
                <a href="{{ route('tabungan.show', 'tabungan-simpel') }}">
                    Tabungan Simpel
                </a>
            </li>

            <li class="{{ request()->is('tabungan/tabungan-siswa') ? 'active' : '' }}">
                <a href="{{ route('tabungan.show', 'tabungan-siswa') }}">
                    Tabungan Siswa
                </a>
            </li>

        </ul>


    </div>
</div>
