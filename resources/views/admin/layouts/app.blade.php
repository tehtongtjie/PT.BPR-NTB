<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin | BPR NTB')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ================= VENDOR ICON ================= -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- ================= VITE ASSETS ================= -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ================= PAGE SPECIFIC CSS ================= -->
    @stack('styles')
</head>

<body class="admin-body">

    <!-- ================= ADMIN TOPBAR ================= -->
    @include('admin.partials.sidebar')

    <!-- ================= ADMIN CONTENT ================= -->
    <main class="admin-main">
        @yield('content')
    </main>

    <!-- ================= PAGE SPECIFIC JS ================= -->
    @stack('scripts')

</body>
</html>
