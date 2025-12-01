<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Literasi Sejarah')</title>
    <!-- Classic/history fonts (Cinzel & EB Garamond) for a historical look -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=EB+Garamond:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Apply default serif font for historic vibes */
        .history-font { font-family: 'EB Garamond', Georgia, 'Times New Roman', serif; }
        .history-heading { font-family: 'Cinzel', 'EB Garamond', Georgia, serif; }
        /* subtle flaired link style to fit historical theme */
        a.history-link { text-decoration: none; }
        a.history-link:hover { text-decoration: none; }
    </style>
</head>
<body class="bg-white text-gray-900 min-h-screen history-font">
    @if (!Request::is('login'))
        @include('partials.header')
    @endif
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>
</body>
</html>
