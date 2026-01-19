<aside class="bpr-admin-sidebar">

    {{-- BRAND --}}
    <div class="bpr-admin-brand">
        <img src="{{ asset('images/logo-bpr-ntb.png') }}" alt="BPR NTB">
        <span>Admin Panel</span>
    </div>

    {{-- MENU --}}
    <nav class="bpr-admin-nav">

        <a href="/admin/dashboard"
           class="bpr-admin-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>

        <a href="/admin/articles"
           class="bpr-admin-link {{ request()->is('admin/articles*') ? 'active' : '' }}">
            <i class="bi bi-newspaper"></i>
            <span>Articles</span>
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
