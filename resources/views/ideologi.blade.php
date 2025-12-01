@extends('layouts.app')
{{--
    Consolidated Sistem Pemerintahan View
    - This file contains both the list (index) and show (detail) layouts for Sistem Pemerintahan pages.
    - To edit the list layout: change the code inside the `@else` branch starting around the big search and grid.
    - To edit the detail layout: change the code inside the `@if(isset($title) && $title)` branch above.
    - All Tailwind CSS and small JS interactions are included in this file for easier editing.
--}}
@section('title', isset($title) ? $title . ' — Sejarah Sistem Pemerintahan' : 'Sejarah Sistem Pemerintahan di Dunia')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-10">
    <div class="max-w-6xl mx-auto px-4">
        @if(isset($title) && $title)
            {{-- DETAIL VIEW MODERN MINIMALIST --}}
            <div class="bg-white rounded-2xl shadow-lg p-4 md:p-8 max-w-3xl mx-auto mb-10 -mt-6">
                <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 mb-4 text-center leading-tight drop-shadow-sm">{{ $title }}</h1>
                <div class="flex flex-col items-center">
                    <img src="{{ asset($img) . '?v=' . (file_exists(public_path($img)) ? filemtime(public_path($img)) : time()) }}" alt="{{ $title }}" class="w-full max-w-lg rounded-xl shadow mb-4 object-cover h-56 md:h-72" />
                </div>
                <div class="prose prose-lg max-w-none text-gray-800 mx-auto leading-relaxed mt-2 space-y-6" style="font-size:1.15rem">
                    @if(isset($content) && preg_match('/<\s*(p|br|ul|ol|li|h[1-6])/i', $content))
                        {{-- content contains HTML tags; output raw so paragraphs/etc render correctly --}}
                        {!! $content !!}
                    @else
                        {{-- content contains no HTML; split into paragraphs and output them so we have consistent spacing --}}
                        @php
                            $paragraphs = preg_split('/\r\n\r\n|\n\n/', trim($content));
                        @endphp
                        @foreach(($paragraphs ?? []) as $p)
                            <p class="mb-6">{!! nl2br(e(trim($p))) !!}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        @else
            <div class="text-center mb-10">
                <h1 class="text-4xl md:text-5xl font-extrabold text-blue-800 mb-3 drop-shadow">Sejarah Sistem Pemerintahan di Dunia</h1>
                <p class="text-lg text-blue-700 mb-2">Tier list dan penjelasan berbagai sistem pemerintahan yang pernah ada di dunia.</p>
                <div class="flex justify-center mt-6">
                    <input id="searchInput" type="text" placeholder="Cari sistem pemerintahan..." class="w-full max-w-md px-4 py-2 border border-blue-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400" />
                </div>
            </div>

            <div id="ideologyGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
            @foreach($items as $item)
                <div class="ideology-card bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-200 p-6 flex flex-col h-full" data-title="{{ strtolower($item['title']) }}" data-category="{{ strtolower($item['category']) }}" data-summary="{{ strtolower($item['summary']) }}">
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">
                            <a href="{{ route('ideologi.show', $item['slug']) }}" class="hover:underline">{{ $item['title'] }}</a>
                        </h2>
                        <div class="text-xs font-semibold text-blue-400 mb-1 uppercase tracking-wide">Kategori: {{ ucfirst($item['category']) }}</div>
                        <p class="text-gray-700 text-sm mb-3">{{ $item['summary'] }}</p>
                    </div>
                    <a href="{{ route('ideologi.show', $item['slug']) }}" class="mt-4 inline-block text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition">Lihat detail</a>
                </div>
            @endforeach
        </div>

        @if(count($items) === 0)
            <div class="text-center text-gray-500 py-8">Belum ada data sistem pemerintahan.</div>
        @endif
        @endif
    </div>
</div>

<script>
    // Fitur pencarian sederhana
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        if (!searchInput) return; // only activate search on the list page
        const cards = document.querySelectorAll('.ideology-card');
        const clearHighlight = (card) => card.classList.remove('ring', 'ring-blue-400');
        searchInput.addEventListener('input', function() {
            const q = this.value.toLowerCase();
            cards.forEach(card => {
                const title = card.getAttribute('data-title');
                const category = card.getAttribute('data-category');
                const summary = card.getAttribute('data-summary');
                if (title.includes(q) || category.includes(q) || summary.includes(q)) {
                    card.style.display = '';
                    // highlight matches
                    clearHighlight(card);
                    if (q.length > 0) card.classList.add('ring', 'ring-blue-400');
                } else {
                    card.style.display = 'none';
                    clearHighlight(card);
                }
            });
        });
    });
</script>

@endsection
