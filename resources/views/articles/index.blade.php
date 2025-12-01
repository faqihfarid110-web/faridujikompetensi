@extends('layouts.app')
@section('title', 'Negara — Literasi Sejarah')
@section('content')
<div class="py-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-[#7c6f57]">Negara — Pilih Benua</h2>
        <div class="flex items-center gap-3">
            <input id="continent-search" type="search" placeholder="Cari benua atau negara..." class="text-sm px-3 py-2 rounded-lg border border-[#e9d8a6] bg-white/90 focus:outline-none focus:ring-2 focus:ring-[#e9d8a6]" />
            <button id="random-continent" class="px-3 py-2 bg-[#7c6f57] text-white rounded-md text-sm hover:scale-[1.02] transition-transform ripple">Acak</button>
        </div>
    </div>
    <div class="articles-index grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($continents as $slug => $c)
            <div data-continent="{{ $slug }}" tabindex="0" role="button" class="block p-6 rounded-xl bg-white shadow-md hover:shadow-lg transition transform hover:-translate-y-1 group overflow-hidden relative continent-card">
                <div class="accent-overlay"></div>
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-lg flex items-center justify-center bg-[#f3ecd9] text-xl font-bold text-[#7c6f57]">{!! $c['logo'] !!}</div>
                    <div>
                        <h3 class="font-semibold text-lg text-[#2b2b2b]">{{ $c['name'] }}</h3>
                        <p class="text-xs text-[#7c6f57]/70 mt-1">Klik untuk melihat negara-negara</p>
                    </div>
                </div>
                <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex justify-end">
                    <button type="button" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-[#f3ecd9] text-[#7c6f57] text-sm font-semibold shadow-sm show-continent-options" aria-expanded="false">Lihat</button>
                </div>
                <div class="continent-options hidden absolute right-4 bottom-4 bg-white border border-[#e9d8a6] rounded-xl shadow-sm py-2 px-3 z-20 w-64">
                    <a href="{{ route('articles.history', ['continent' => $slug]) }}" class="block mb-2 text-sm text-[#2b2b2b] hover:bg-[#f3ecd9] px-3 py-2 rounded-md">1. Sejarah Benua {{ $c['name'] }}</a>
                    <a href="{{ route('articles.show', ['continent' => $slug]) }}" class="block text-sm text-[#2b2b2b] hover:bg-[#f3ecd9] px-3 py-2 rounded-md">2. Sejarah negara-negara di {{ $c['name'] }}</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
