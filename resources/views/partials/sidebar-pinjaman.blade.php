<div class="card shadow-sm sidebar-universal">
    <div class="card-body">

        <h6 class="sidebar-heading">PINJAMAN</h6>

        <ul class="sidebar-list">

            <li class="{{ request()->is('pinjaman/kredit-modal-kerja') ? 'active' : '' }}">
                <a href="{{ route('pinjaman.show', 'kredit-modal-kerja') }}">
                    Kredit Modal Kerja
                </a>
            </li>

            <li class="{{ request()->is('pinjaman/kredit-konsumtif') ? 'active' : '' }}">
                <a href="{{ route('pinjaman.show', 'kredit-konsumtif') }}">
                    Kredit Konsumtif
                </a>
            </li>

        </ul>

    </div>
</div>
