<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - Literasi Sejarah')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .history-font { font-family: 'EB Garamond', Georgia, 'Times New Roman', serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    @include('admin.partials.sidebar')
    <!-- Main Content -->
    <main class="flex-1 bg-gray-50 p-6">
        <div class="max-w-7xl w-full ml-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">@yield('admin-title', 'Admin Panel')</h1>
                    @hasSection('admin-subtitle')
                        <p class="text-sm text-gray-500 mt-1">@yield('admin-subtitle')</p>
                    @endif
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm px-3 py-1 rounded-lg bg-gray-800 text-white">Keluar</button>
                </form>
            </div>
            @yield('admin-content')
        </div>
    </main>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const btn = document.getElementById('admin-sidebar-toggle');
    const aside = document.querySelector('aside.w-64');
    if(btn && aside){
        btn.addEventListener('click', function(){
            aside.classList.toggle('hidden');
        });
    }
});
</script>
</body>
</html>
