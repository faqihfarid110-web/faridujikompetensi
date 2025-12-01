<header class="glass-header fixed top-0 z-40 w-full pb-1 transition-all duration-300 bg-transparent shadow-lg py-1 backdrop-blur-lg overflow-hidden history-font history-heading" style="background-image: linear-gradient(180deg, rgba(124,111,87,0.60) 0%, rgba(124,111,87,0.44) 100%), url('{{ asset('assets/images/banner/nav-history-bg.svg') }}'); background-size: cover; background-position: center;">
    <!-- Mobile fallback: use solid color instead of background image to save bandwidth and guarantee contrast -->
    <div class="absolute inset-0 sm:hidden bg-[#7c6f57] opacity-95 pointer-events-none"></div>
    <div class="lg:py-0 py-2">
        <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md flex items-center justify-between px-4">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3 hover:scale-105 transition-transform duration-200 text-white">
                <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="logo" class="h-8 inline-block drop-shadow-md" />
                <div class="flex flex-col leading-tight">
                    <span class="font-bold text-lg hidden sm:inline text-[#7c6f57] drop-shadow">Literasi Sejarah</span>
                </div>
            </a>

                <nav class="hidden lg:flex flex-grow items-center gap-6 justify-center text-sm">
                <a href="/" class="text-sm font-semibold px-2 py-1 rounded-lg text-[#7c6f57] transition-colors duration-200 drop-shadow history-link">Beranda</a>
                <a href="{{ route('articles.index') }}" class="text-sm font-semibold px-2 py-1 rounded-lg text-[#7c6f57] transition-colors duration-200 drop-shadow history-link">Negara</a>
                <a href="/ideologi" class="text-sm font-semibold px-2 py-1 rounded-lg text-[#7c6f57] transition-colors duration-200 drop-shadow history-link">Sistem Pemerintahan</a>
                <a href="{{ route('survey.create') }}" class="text-sm font-semibold px-2 py-1 rounded-lg text-[#7c6f57] transition-colors duration-200 drop-shadow history-link">Survey</a>
                <a href="/group" class="text-sm font-semibold px-2 py-1 rounded-lg text-[#7c6f57] transition-colors duration-200 drop-shadow history-link">Komunitas</a>
                <a href="/funfact" class="text-sm font-semibold px-2 py-1 rounded-lg text-[#7c6f57] transition-colors duration-200 drop-shadow history-link">Funfact</a>
                <a href="/documentation" class="text-sm font-semibold px-2 py-1 rounded-lg text-[#7c6f57] transition-colors duration-200 drop-shadow history-link">Lukisan</a>
            </nav>

                <div class="flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" id="sign-in-btn" class="hidden lg:inline-block bg-[#7c6f57] text-white px-4 py-1.5 rounded-full text-sm font-semibold shadow-input-shadow hover:scale-105 hover:bg-[#9b8d6f] transition-all duration-200">Masuk</a>
                    <a href="/register" id="sign-up-btn" class="hidden lg:inline-block bg-white/10 hover:bg-white text-white px-4 py-1.5 rounded-full text-sm font-semibold shadow-input-shadow hover:scale-105 transition-all duration-200">Gabung</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-semibold px-3 py-1 rounded-lg hover:bg-white/10 text-white transition-colors duration-200 drop-shadow">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-semibold px-3 py-1 rounded-lg bg-[#a68b5b] text-white">Keluar</button>
                    </form>
                @endauth

                <button id="hamburger-btn" class="block lg:hidden p-2 rounded-lg hover:bg-white/10 transition-colors duration-200" aria-label="Toggle mobile menu">
                    <span class="block w-6 h-0.5 bg-white"></span>
                    <span class="block w-6 h-0.5 bg-white mt-1.5"></span>
                    <span class="block w-6 h-0.5 bg-white mt-1.5"></span>
                </button>
            </div>
        </div>

        {{-- Sign in/up modals (hidden by default) --}}
        <div id="modal-signin" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                <div class="bg-white rounded-lg p-6 w-11/12 max-w-md">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Masuk</h3>
                    <button id="modal-signin-close" class="text-xl">✕</button>
                </div>
                <p class="mb-4 text-sm text-gray-600">Masuk untuk melihat kursus dan arsip.</p>
                <!-- You can replace this with a real form or include a Blade partial -->
            </div>
        </div>

        <div id="modal-signup" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-lg p-6 w-11/12 max-w-md">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Gabung</h3>
                    <button id="modal-signup-close" class="text-xl">✕</button>
                </div>
                <p class="mb-4 text-sm text-gray-600">Gabung untuk akses ke fitur komunitas dan kursus.</p>
            </div>
        </div>

        <div id="mobile-menu" class="lg:hidden fixed top-0 right-0 h-full w-full bg-white shadow-lg transform transition-transform duration-300 max-w-xs translate-x-full z-50">
            <div class="flex items-center justify-between p-3">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2">
                    <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="logo" class="h-8 inline-block" />
                </a>
                <button id="mobile-close" class="p-2">✕</button>
            </div>

            <nav class="flex flex-col items-start p-3 gap-3">
                <a href="/" class="text-sm font-medium w-full">Beranda</a>
                <a href="/ideologi" class="text-sm font-medium w-full">Sistem Pemerintahan</a>
                <a href="{{ route('articles.index') }}" class="text-sm font-medium w-full">Negara</a>
                <a href="#survey" class="text-sm font-medium w-full">Survey</a>
                <a href="#portfolio" class="text-sm font-medium w-full">Komunitas</a>
                <a href="/funfact" class="text-sm font-medium w-full">Funfact</a>
                <a href="/documentation" class="text-sm font-medium w-full">Lukisan</a>

                <div class="mt-4 w-full flex flex-col gap-2">
                    <a id="mobile-signin" href="{{ route('login') }}" class="w-full inline-block text-center border border-[#7c6f57] text-[#7c6f57] px-4 py-2 rounded-lg">Masuk</a>
                    <a id="mobile-signup" href="/register" class="w-full inline-block text-center bg-[#7c6f57] text-white px-4 py-2 rounded-lg">Gabung</a>
                </div>
            </nav>
        </div>
    </div>
    <style>
        /* glass header style: subtle translucent/blur effect to mimic frosted glass */
        .glass-header {
            background: rgba(255,255,255,0.06) !important; /* subtle light glass */
            -webkit-backdrop-filter: blur(8px);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            min-height: 48px;
            padding-top: 0.25rem !important;
            padding-bottom: 0.25rem !important;
        }
        @media (prefers-color-scheme: dark) {
            .glass-header { background: rgba(12,12,12,0.2) !important; border-bottom-color: rgba(255,255,255,0.03); }
        }
    </style>
</header>
