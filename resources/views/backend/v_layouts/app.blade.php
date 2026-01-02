<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul ?? 'Dashboard' }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- icon mobil -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('img/site.webmanifest') }}">
<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}"> 
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
    <style>
        /* ======= THEME WARNA ======= */
        :root {
            --navy: #001437;
            --blue: #7898FB;
            --aqua: #5CE5D5;
            --white: #ffffff;
        }

        body {
            background: #f5f7fa;
        }

        /* ======= SIDEBAR ======= */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: var(--navy);
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 0px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #d9e1ffff;
            text-decoration: none;
            font-size: 15px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: var(--blue);
            color: white;
        }

        .sidebar .active {
            background: var(--blue);
            color: white;
        }

        /* ======= NAVBAR ======= */
        .main-navbar {
            height: 60px;
            background: var(--navy);
            padding-left: 260px;
            display: flex;
            align-items: center;
            padding-right: 20px;
            color: white;
            justify-content: space-between;
        }

        /* ======= KONTEN ======= */
        .content-wrapper {
            margin-left: 260px;
            margin-top: 20px;
            padding: 20px;
        }

        .footer {
            margin-left: 260px;
            margin-top: 40px;
            padding: 15px;
            background: #eee;
            text-align: center;
            font-size: 14px;
        }
    </style>

</head>

<body>

    {{-- NAVBAR --}}
    @include('backend.v_layouts.navbar')

    {{-- SIDEBAR --}}
    @include('backend.v_layouts.sidebar')

    <div class="content-wrapper">
        @yield('content')
    </div>

    <div class="footer">
        © {{ date('Y') }} Penjualan Mobil • Tema Biru Laut Modern
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
