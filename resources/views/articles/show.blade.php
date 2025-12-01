@extends('layouts.app')
@section('title', $continent['name'] . ' — Negara')
@section('content')
<div class="py-8">
    <div class="flex items-center justify-between mb-4">
        <div>
            <a href="{{ route('articles.index') }}" class="text-[#7c6f57] hover:underline mb-2 inline-block">&larr; Kembali</a>
            <h2 class="text-2xl font-bold text-[#7c6f57]">{{ $continent['name'] }} — Negara</h2>
        </div>
        <div class="flex items-center gap-3">
            <input id="country-search" type="search" placeholder="Cari negara..." class="text-sm px-3 py-2 rounded-lg border border-[#e9d8a6] bg-white/90 focus:outline-none focus:ring-2 focus:ring-[#e9d8a6]" />
            <button id="sort-az" class="px-3 py-2 bg-white border border-[#e9d8a6] rounded-md text-sm hover:bg-[#f5f1e7] ripple" aria-pressed="false">A–Z</button>
        </div>
    </div>

    @if (empty($continent['countries']))
        <div class="p-6 rounded-lg bg-[#fffdf7] border border-[#e9d8a6]">Belum ada negara yang ditambahkan untuk benua ini.</div>
    @else
        <div class="countries-grid grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
            @foreach ($continent['countries'] as $country)
                <div class="p-4 bg-white rounded-lg shadow-sm flex items-center gap-3 group country-card">
                    <img src="https://flagcdn.com/w40/{{ strtolower($country['code']) }}.png" alt="{{ $country['name'] }} flag" class="w-10 h-6 object-cover rounded-sm border transition-transform duration-200 group-hover:scale-110" />
                    <div class="flex-1">
                        <div class="text-sm font-medium">{{ $country['name'] }}</div>
                        <div class="mt-2">
                            <a href="#" class="inline-block text-xs bg-[#f3ecd9] text-[#7c6f57] px-3 py-1 rounded-md ripple">Pelajari</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
