<aside class="bpr-admin-sidebar">

    {{-- BRAND --}}
    <div class="bpr-admin-brand">
        <img src="{{ asset('images/logo-bpr-ntb.png') }}" alt="BPR NTB">
        <span>Admin Panel</span>
    </div>

    {{-- MENU --}}
    <nav class="bpr-admin-nav">

        <a href="/admin/main"
        class="bpr-admin-link {{ request()->is('admin/main') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i>
            <span>Main</span>
        </a>

        <a href="/admin/produk"
        class="bpr-admin-link {{ request()->is('admin/produk*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i>
            <span>Produk</span>
        </a>

        <a href="/admin/perusahaan"
        class="bpr-admin-link {{ request()->is('admin/perusahaan*') ? 'active' : '' }}">
            <i class="bi bi-building"></i>
            <span>Perusahaan</span>
        </a>

        <a href="/admin/jaringan"
        class="bpr-admin-link {{ request()->is('admin/jaringan*') ? 'active' : '' }}">
            <i class="bi bi-diagram-3"></i>
            <span>Jaringan</span>
        </a>

        <a href="/admin/publikasi"
        class="bpr-admin-link {{ request()->is('admin/publikasi*') ? 'active' : '' }}">
            <i class="bi bi-megaphone"></i>
            <span>Publikasi</span>
        </a>

        <div class="bpr-admin-divider"></div>

        <a href="/admin/logout"
           class="bpr-admin-link danger"
           onclick="return confirm('Logout admin?')">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </a>

    </nav>

</aside>
