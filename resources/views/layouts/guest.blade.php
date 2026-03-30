<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yakinori</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root {
            --yk-gold: #f2d08b;
            --yk-gold-soft: rgba(242, 208, 139, 0.72);
            --yk-panel: rgba(17, 10, 10, 0.84);
            --yk-panel-strong: rgba(23, 13, 12, 0.92);
            --yk-border: rgba(242, 208, 139, 0.16);
            --yk-text: #fff2d6;
            --yk-muted: rgba(255, 241, 214, 0.72);
            --yk-danger: #c5382d;
        }

        html {
            min-height: 100%;
        }

        body {
            min-height: 100%;
            margin: 0;
            color: var(--yk-text);
            font-family: 'Kanit', sans-serif;
            background-color: #130c0b;
            background-image: linear-gradient(rgba(0, 0, 0, 0.72), rgba(0, 0, 0, 0.72)),
                url('{{ asset('storage/herobanner.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            overflow-x: hidden;
        }

        .guest-shell {
            min-height: 100vh;
            padding: 48px 0 56px;
        }

        .logo-anchor {
            position: fixed;
            top: 28px;
            left: 28px;
            z-index: 1;
            pointer-events: none;
        }

        .logo-anchor img {
            width: 220px;
            max-width: 100%;
            height: auto;
        }

        .hero-panel {
            position: relative;
            z-index: 3;
            background: linear-gradient(135deg, var(--yk-panel-strong), rgba(41, 22, 18, 0.8));
            border: 1px solid var(--yk-border);
            border-radius: 1.5rem;
            box-shadow: 0 1.25rem 3.5rem rgba(0, 0, 0, 0.34);
            backdrop-filter: blur(10px);
        }

        .hero-panel-soft {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(242, 208, 139, 0.12);
            border-radius: 1.15rem;
        }

        .hero-title {
            color: var(--yk-gold);
            font-weight: 600;
            letter-spacing: 0.02em;
        }

        .hero-kicker {
            color: var(--yk-muted);
            font-size: 0.82rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }

        .btn-yk-outline {
            color: var(--yk-text);
            border-color: rgba(255, 240, 208, 0.22);
            background: rgba(255, 255, 255, 0.05);
        }

        .btn-yk-outline:hover,
        .btn-yk-outline:focus {
            color: #1a110f;
            background: var(--yk-gold);
            border-color: var(--yk-gold);
        }

        .btn-yk-primary {
            color: #fff3db;
            background: linear-gradient(135deg, #7e0f0f, #cd3327);
            border: none;
        }

        .btn-yk-primary:hover,
        .btn-yk-primary:focus {
            color: #fff8ef;
            background: linear-gradient(135deg, #931414, #de4636);
        }

        .table thead th,
        .table tbody td {
            color: var(--yk-text);
            border-color: rgba(242, 208, 139, 0.12);
            background: transparent;
        }

        .table thead th {
            color: var(--yk-muted);
            font-weight: 400;
        }

        .form-control,
        .form-select {
            color: var(--yk-text);
            background-color: rgba(255, 255, 255, 0.08);
            border-color: rgba(242, 208, 139, 0.16);
        }

        .form-select option {
            color: var(--yk-text);
            background-color: #2a1916;
        }

        .form-control:focus,
        .form-select:focus {
            color: var(--yk-text);
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(242, 208, 139, 0.4);
            box-shadow: 0 0 0 0.2rem rgba(242, 208, 139, 0.15);
        }

        .text-gold {
            color: var(--yk-gold) !important;
        }

        .text-muted-yk {
            color: var(--yk-muted) !important;
        }

        .page-link,
        .page-link:hover {
            color: var(--yk-text);
        }

        body::-webkit-scrollbar {
            width: 10px;
        }

        body::-webkit-scrollbar-thumb {
            background: rgba(242, 208, 139, 0.3);
            border-radius: 999px;
        }

        @media (max-width: 991.98px) {
            .guest-shell {
                padding-top: 104px;
            }

            .logo-anchor img {
                width: 170px;
            }
        }
    </style>
    @stack('head')
</head>

<body>
    <a href="{{ url('/') }}" class="logo-anchor">
        <img src="{{ asset('storage/yakinori.png') }}" alt="Yakinori">
    </a>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    @stack('scripts')
</body>

</html>
