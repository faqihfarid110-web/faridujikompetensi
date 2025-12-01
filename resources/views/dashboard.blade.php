@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container mx-auto lg:max-w-screen-lg px-4 py-10">
    <div class="bg-[#f5e9da] p-6 rounded-xl border border-[#e9d8a6] shadow">
        <h1 class="text-2xl history-heading font-bold text-[#7c6f57] mb-2">Dashboard</h1>
        <p class="mb-4">Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong>!</p>
        <p class="mb-4">Di sini Anda dapat mengakses kursus, arsip, dan materi yang dilindungi.</p>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="bg-[#a68b5b] text-white px-4 py-2 rounded">Keluar</button>
        </form>
    </div>
</div>
@endsection
