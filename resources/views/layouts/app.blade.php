<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Kelola Gudang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="app-body">
    <div class="app-bg"></div>

    <div class="layout" id="layout">
        @include('partials.sidebar')

        <div class="main">
            <header class="topbar glass">
                <button class="icon-btn" id="toggleSidebar" aria-label="Buka/tutup menu">
                    <i class="bi bi-list"></i>
                </button>
                <div class="topbar-right">
                    <span class="user"><i class="bi bi-person-circle"></i> AdminGudang</span>
                    <button class="icon-btn" id="toggleFullscreen" aria-label="Layar penuh">
                        <i class="bi bi-arrows-fullscreen"></i>
                    </button>
                </div>
            </header>

            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('modals')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
