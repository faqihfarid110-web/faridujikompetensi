@extends('layouts.app')
@section('title', 'Masuk — Literasi Sejarah')
@section('content')
<div class="min-h-screen flex items-start justify-center login-page-hero relative pt-16">
    <!-- background image removed for creative concept -->
    <div class="w-full max-w-lg p-8 sm:p-10 rounded-2xl border-2 border-[#e9d8a6] shadow-md login-card-lg login-card-classic bg-white/95 relative z-10 overflow-hidden transition-all duration-300 hover:shadow-lg">
        <!-- decorative corner ornaments (SVG inline for light weight) -->
        <svg class="corner-ornament top-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" aria-hidden="true"><path d="M6 29c0-3 4-7 11-11 7-4 22-8 30-8" stroke="#a68b5b" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <svg class="corner-ornament bottom-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" aria-hidden="true"><path d="M6 29c0-3 4-7 11-11 7-4 22-8 30-8" stroke="#a68b5b" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <div class="mb-4 relative z-10">
            <h1 id="login-heading" class="history-heading text-3xl sm:text-4xl font-bold text-[#7c6f57] leading-tight">Masuk ke Literasi Sejarah</h1>
            <p class="text-[#7c6f57]/80 mt-2 text-base sm:text-lg font-medium">Masuk untuk mengelola profil, berinteraksi dengan komunitas, dan mengakses sumber sejarah.</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login.post') }}" method="post" class="grid gap-6" aria-labelledby="login-heading">
            @csrf
            <div class="relative input-with-icon transition-all duration-300 group-focus-within:ring-2 group-focus-within:ring-[#a68b5b]">
                <label for="email" class="block text-base sm:text-lg text-[#7c6f57] mb-2 font-semibold transition-colors duration-200">Email <span class="text-xs text-[#a68b5b]">(contoh: demo@literasi.com)</span></label>
                <div class="relative">
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email" class="w-full pl-4 pr-4 py-4 rounded-lg border-2 border-[#e9d8a6] focus:outline-none focus:ring-2 focus:ring-[#a68b5b]/60 transition-all duration-300 text-lg bg-white/80 placeholder-[#a68b5b]/60" placeholder="demo@literasi.com" />
                </div>
            </div>
            <p class="sr-only">Gunakan email terdaftar di Literasi Sejarah untuk masuk.</p>

            <div class="relative input-with-icon transition-all duration-300 group-focus-within:ring-2 group-focus-within:ring-[#a68b5b]">
                <label for="password" class="block text-base sm:text-lg text-[#7c6f57] mb-2 font-semibold transition-colors duration-200">Kata Sandi <span class="text-xs text-[#a68b5b]">(contoh: password123)</span></label>
                <div class="relative">
                    <input id="password" name="password" type="password" required autocomplete="current-password" class="w-full px-4 pr-4 py-4 rounded-lg border-2 border-[#e9d8a6] focus:outline-none focus:ring-2 focus:ring-[#a68b5b]/60 transition-all duration-300 text-lg bg-white/80 placeholder-[#a68b5b]/60" placeholder="password123" />
                </div>
            </div>

            <div class="flex items-center justify-between text-sm mt-2">
                <label class="inline-flex items-center gap-2 text-[#7c6f57]/90"><input type="checkbox" name="remember" class="rounded border-[#e9d8a6] accent-[#a68b5b]" /> Ingat saya</label>
                <a href="#" class="text-[#7c6f57]/80 hover:underline transition-colors duration-200 hover:text-[#a68b5b]">Lupa kata sandi?</a>
            </div>

            <div class="mt-4">
                <button type="submit" class="w-full bg-gradient-to-r from-[#7c6f57] to-[#a68b5b] text-white px-4 py-3 rounded-xl font-bold shadow-lg ripple transition-all duration-300 hover:scale-105 hover:from-[#a68b5b] hover:to-[#7c6f57]">Masuk</button>
            </div>
        </form>

        <div class="text-center text-sm mt-6 text-[#7c6f57]/90">Belum memiliki akun? <a href="/register" class="underline hover:text-[#a68b5b] transition-colors duration-200">Daftar</a></div>
    </div>
</div>
@endsection
