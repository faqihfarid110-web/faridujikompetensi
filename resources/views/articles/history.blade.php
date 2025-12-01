@extends('layouts.app')
@section('title', $continent['name'] . ' — Sejarah')
@section('content')
<div class="py-8">
    <a href="{{ route('articles.index') }}" class="text-[#7c6f57] hover:underline mb-4 inline-block">&larr; Kembali</a>
    <h2 class="text-2xl font-bold text-[#7c6f57] mb-4">Sejarah: {{ $continent['name'] }}</h2>
    <div class="p-6 rounded-lg bg-white shadow-sm border border-[#e9d8a6]">
        <p class="text-sm text-[#2b2b2b]">{{ $continent['overview'] }}</p>
        <hr class="my-4" />
        <p class="text-sm text-[#6b6b6b]">Halaman ini adalah ringkasan sejarah untuk benua <strong>{{ $continent['name'] }}</strong>. Anda dapat menambahkan artikel terperinci, garis waktu, dan peta interaktif di sini.</p>
        <div class="mt-4 flex gap-3">
            <a href="{{ route('articles.show', ['continent' => $continent['slug']]) }}" class="px-3 py-2 bg-[#7c6f57] text-white rounded-md text-sm">Lihat Negara</a>
            <a href="{{ route('articles.index') }}" class="px-3 py-2 bg-white border border-[#e9d8a6] rounded-md text-sm">Kembali ke Benua</a>
        </div>
    </div>
</div>
@endsection
