<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'BPR NTB')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Vendor CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Page Specific CSS -->
    @stack('styles')
</head>

<body>

    <!-- ================= HEADER FIXED ================= -->
    <header class="header-fixed">
        @include('partials.topbar')
        @include('partials.navbar')
    </header>

    <!-- ================= CONTENT (OFFSET DARI HEADER) ================= -->
    <main class="site-main pt-navbar">
        @yield('content')
    </main>

    <!-- ================= FOOTER ================= -->
    @include('partials.footer')

    <!-- Vendor JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Page Specific JS -->
    @stack('scripts')

</body>

</html>
