<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'BPR NTB')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ================= VENDOR CSS ================= -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- ================= VITE ASSETS ================= -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ================= PAGE SPECIFIC CSS ================= -->
    @stack('styles')
</head>

<body>

    <!-- ================= HEADER FIXED ================= -->
    <header class="header-fixed">
        @include('partials.topbar')
        @include('partials.navbar')
    </header>

    <!-- ================= CONTENT ================= -->
    <main class="site-main pt-navbar">
        @yield('content')
    </main>

    <!-- ================= FOOTER ================= -->
    @include('partials.footer')

    <!-- ================= VENDOR JS ================= -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ================= PAGE SPECIFIC JS ================= -->
    @stack('scripts')

</body>
</html>
