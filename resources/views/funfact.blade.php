@extends('layouts.app')
@section('title', 'Funfact Sejarah')
@section('content')
<div class="container mx-auto py-12 bg-gradient-to-b from-[#f6f1e6] via-[#efe6d5] to-[#efe9d2]" style="min-height:70vh;">
    <h1 class="text-3xl font-bold mb-6">Funfact Sejarah</h1>
    <nav class="mini-navbar w-full rounded-md px-4 py-3 mb-6 flex flex-wrap gap-2 justify-center items-center relative">
        <a data-filter="politik" href="{{ route('funfact.category', ['topic' => 'politik']) }}" class="filter-btn px-3 py-1 rounded text-sm {{ (isset($category) && $category === 'politik') ? 'active' : '' }}" aria-pressed="false">Politik</a>
        <a data-filter="kultur" href="{{ route('funfact.category', ['topic' => 'kultur']) }}" class="filter-btn px-3 py-1 rounded text-sm {{ (isset($category) && $category === 'kultur') ? 'active' : '' }}" aria-pressed="false">Kultur</a>
        <a data-filter="militer" href="{{ route('funfact.category', ['topic' => 'militer']) }}" class="filter-btn px-3 py-1 rounded text-sm {{ (isset($category) && $category === 'militer') ? 'active' : '' }}" aria-pressed="false">Militer</a>
        <a data-filter="ekonomi" href="{{ route('funfact.category', ['topic' => 'ekonomi']) }}" class="filter-btn px-3 py-1 rounded text-sm {{ (isset($category) && $category === 'ekonomi') ? 'active' : '' }}" aria-pressed="false">Ekonomi</a>
        <a data-filter="kuno" href="{{ route('funfact.category', ['topic' => 'kuno']) }}" class="filter-btn px-3 py-1 rounded text-sm {{ (isset($category) && $category === 'kuno') ? 'active' : '' }}" aria-pressed="false">Kuno</a>
        <a data-filter="olahraga" href="{{ route('funfact.category', ['topic' => 'olahraga']) }}" class="filter-btn px-3 py-1 rounded text-sm {{ (isset($category) && $category === 'olahraga') ? 'active' : '' }}" aria-pressed="false">Olahraga</a>
        <a data-filter="sains" href="{{ route('funfact.category', ['topic' => 'sains']) }}" class="filter-btn px-3 py-1 rounded text-sm {{ (isset($category) && $category === 'sains') ? 'active' : '' }}" aria-pressed="false">Sains</a>
        <a data-filter="urban" href="{{ route('funfact.category', ['topic' => 'urban']) }}" class="filter-btn px-3 py-1 rounded text-sm {{ (isset($category) && $category === 'urban') ? 'active' : '' }}" aria-pressed="false">Urban</a>
    </nav>
    <!-- Navbar dihapus -->
    <div id="breadcrumb" class="mb-6 flex items-center gap-2 text-sm text-[#7c6f57] font-medium">
        <span>Artikel</span>
        <span class="mx-1">&gt;</span>
        <span id="breadcrumb-category">{{ isset($category) ? ucfirst($category) : 'Semua' }}</span>
    </div>
        <!-- Breadcrumb dihapus -->

    <!-- Server-side pagination controls -->
    <div class="mt-6 flex justify-center items-center gap-2 text-sm">
        @php
            $currentPage = $page ?? 1;
            $totalPages = $totalPages ?? 1;
            $qPage = '?page=';
            $base = (isset($category) && $category !== 'all') ? route('funfact.category', ['topic' => $category]) : route('funfact.index');
            $baseUrl = $base . $qPage;
        @endphp
        <div class="flex items-center gap-2">
            @if ($currentPage > 1)
                <a href="{{ $base . $qPage . ($currentPage - 1) }}" class="pagination-btn">&lt;</a>
            @else
                <button class="pagination-btn" disabled>&lt;</button>
            @endif
            @for ($i = 1; $i <= $totalPages; $i++)
                <a href="{{ $base . $qPage . $i }}" class="pagination-btn {{ ($i == $currentPage) ? 'active' : '' }}">{{ $i }}</a>
            @endfor
            @if ($currentPage < $totalPages)
                <a href="{{ $base . $qPage . ($currentPage + 1) }}" class="pagination-btn">&gt;</a>
            @else
                <button class="pagination-btn" disabled>&gt;</button>
            @endif
        </div>
    </div>
    <!-- Mini-navbar stays at top, then slider, then slider navigation at bottom -->
    <!-- Pagination area (shows 5 items per page) -->
    <div id="category-pagination-wrapper" class="mb-6">
        <div class="text-sm md:text-base text-gray-600 mb-2">Menampilkan halaman <span class="font-semibold">{{ $page ?? 1 }}</span> dari <span class="font-semibold">{{ $totalPages ?? 1 }}</span> — total <span class="font-semibold">{{ $total ?? count($items) }}</span> artikel.</div>
    </div>
    <!-- If controller passed in $items, render them; otherwise fall back to demo generation -->
    @php
        $items = $items ?? null;
    @endphp
    @php
        $demoCategories = ['politik','kultur','militer','ekonomi','kuno','olahraga','sains','urban'];
    @endphp
    <div id="funfact-list" class="flex flex-col gap-6">
        <style>
            /* Paragraf lebih renggang dan font lebih nyaman */
            .funfact-card p, .funfact-card .post-content p {
                margin-bottom: 1.5em !important;
                line-height: 2 !important;
                font-family: 'Inter', 'Segoe UI', Arial, sans-serif !important;
                font-size: 1.12rem;
            }
            .funfact-card h3 {
                font-family: 'Inter', 'Segoe UI', Arial, sans-serif !important;
                font-weight: 800;
                letter-spacing: -0.01em;
            }
            .funfact-card {
                transition: box-shadow .18s cubic-bezier(.4,0,.2,1), transform .18s cubic-bezier(.4,0,.2,1);
                box-shadow: 0 4px 24px 0 rgba(124,111,87,0.07), 0 1.5px 4px 0 rgba(0,0,0,0.03);
            }
            .funfact-card:hover {
                box-shadow: 0 8px 32px 0 rgba(124,111,87,0.13), 0 2px 8px 0 rgba(0,0,0,0.06);
                transform: translateY(-2px) scale(1.012);
            }
        </style>
    @if (!empty($items) && is_array($items))
        @foreach ($items as $it)
            @php
                $slug = $it['slug'] ?? '';
                $title = $it['title'] ?? ($it['slug'] ?? 'No Title');
                $summary = $it['summary'] ?? '';
                $img = $it['img'] ?? 'assets/images/courses/courseone.png';
                // normalize img path: if it's just a filename, prepend assets path
                if (!str_starts_with($img, 'assets/') && !str_contains($img, '://')) {
                    $img = 'assets/images/funfact/' . ltrim($img, '/');
                }
                $category = $it['category'] ?? ($category ?? 'umum');
            @endphp
            <article class="funfact-card p-0 rounded-lg bg-white/80 shadow-sm cursor-pointer flex flex-row h-full overflow-hidden" data-category="{{ $category }}" data-title="{{ $title }}" data-summary="{{ $summary }}" data-img="{{ asset($img) }}" data-source="{{ $it['source'] ?? '' }}" data-author="{{ $it['author'] ?? 'Redaksi' }}" data-date="{{ $it['date'] ?? date('d F Y') }}" data-slug="{{ $slug }}">
                <div class="flex-shrink-0 w-40 md:w-56 h-36 md:h-40 bg-gray-200 flex items-center justify-center overflow-hidden">
                    <img loading="lazy" src="{{ asset($img) }}" alt="{{ $title }}" class="object-cover w-full h-full">
                </div>
                <div class="flex flex-col justify-center flex-1 px-4 py-2">
                    <span class="category-badge inline-block px-2 py-1 rounded text-xs font-semibold bg-gray-200 text-gray-800 mb-1">{{ strtoupper($category) }}</span>
                        <h3 class="text-xl md:text-2xl font-extrabold mb-2 font-sans tracking-tight text-gray-900" style="font-family: 'Inter', 'Segoe UI', Arial, sans-serif;">{{ $title }}</h3>
                        <p class="text-base md:text-lg text-gray-800 mb-4 font-normal leading-relaxed font-sans" style="font-family: 'Inter', 'Segoe UI', Arial, sans-serif;">{{ $summary }}</p>
                    <a title="Baca selengkapnya: {{ $title }}" aria-label="Baca selengkapnya: {{ $title }}" class="btn-read read-more-btn self-start" href="{{ route('funfact.show', ['slug' => $slug]) }}">Baca Selengkapnya</a>
                </div>
            </article>
        @endforeach
    @else
        @foreach ($demoCategories as $cat)
            @for ($i = 1; $i <= 10; $i++)
                @php
                    $img = 'assets/images/courses/courseone.png';
                @endphp
                <article class="funfact-card p-0 rounded-lg bg-white/80 shadow-sm cursor-pointer flex flex-row h-full overflow-hidden" data-category="{{ $cat }}" data-title="{{ ucfirst($cat) }} Demo {{ $i }}" data-summary="Ini adalah ringkasan {{ $cat }} demo artikel ke-{{ $i }}." data-img="{{ asset($img) }}" data-source="historia.id/article/{{ $cat }}-{{ $i }}" data-author="Redaksi" data-date="{{ date('d F Y', strtotime('-'.($i).' days')) }}" data-slug="{{ $cat }}-{{ $i }}">
                    <div class="flex-shrink-0 w-40 md:w-56 h-36 md:h-40 bg-gray-200 flex items-center justify-center overflow-hidden">
                        <img loading="lazy" src="{{ asset($img) }}" alt="{{ ucfirst($cat) }} Demo {{ $i }}" class="object-cover w-full h-full">
                    </div>
                    <div class="flex flex-col justify-center flex-1 px-4 py-2">
                        <span class="category-badge inline-block px-2 py-1 rounded text-xs font-semibold bg-gray-200 text-gray-800 mb-1">{{ strtoupper($cat) }}</span>
                            <h3 class="text-xl md:text-2xl font-extrabold mb-2 font-sans tracking-tight text-gray-900" style="font-family: 'Inter', 'Segoe UI', Arial, sans-serif;">{{ ucfirst($cat) }} Demo {{ $i }}</h3>
                            <p class="text-base md:text-lg text-gray-800 mb-4 font-normal leading-relaxed font-sans" style="font-family: 'Inter', 'Segoe UI', Arial, sans-serif;">Ini adalah ringkasan {{ $cat }} demo artikel ke-{{ $i }}.</p>
                        <a title="Baca selengkapnya: {{ ucfirst($cat) }} Demo {{ $i }}" aria-label="Baca selengkapnya: {{ ucfirst($cat) }} Demo {{ $i }}" class="btn-read read-more-btn self-start" href="{{ route('funfact.show', ['slug' => $cat.'-'.$i]) }}">Baca Selengkapnya</a>
                    </div>
                </article>
            @endfor
        @endforeach
    @endif
    </div>

    <!-- Loading indicator (hidden by default) -->
    <div id="funfact-loading" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/20">
        <div class="bg-white p-4 rounded-lg shadow-lg flex items-center gap-3">
            <div class="w-6 h-6 border-4 border-gray-200 border-t-4 border-t-[#7c6f57] rounded-full animate-spin"></div>
            <div class="text-gray-700">Memuat artikel...</div>
        </div>
    </div>

        <!-- Sidebar -->
        <aside class="space-y-6">
            <!-- Removed Soeharto block as requested -->
            <!-- Removed unused wide photo and button per request -->
        </aside>
    </div>

    <!-- Inline CSS for mini-navbar + simple card styles -->
    <style>
        .mini-navbar {
            background: linear-gradient(180deg, rgba(250,249,243,0.9), rgba(245,240,225,0.8));
            -webkit-backdrop-filter: blur(6px);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(255,255,255,0.5);
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            position: sticky;
            top: 72px; /* offset under header */
            z-index: 30;
        }
        .mini-navbar .filter-btn {
            background: white;
            border: 1px solid rgba(0,0,0,0.06);
            color: #4b4b4b;
            padding: .35rem .6rem;
            transition: transform .12s ease-in-out, box-shadow .12s ease-in-out; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.04);
            border-radius: 999px;
        }
        /* mini-navbar active indicator */
    .mini-navbar .filter-btn.active { background: linear-gradient(90deg, rgba(124,111,87,0.18), rgba(160,119,63,0.14)); color: #2b2b2b; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(124,111,87,0.08); border-radius: 999px; }
    .mini-navbar::after { content: ''; position: absolute; height: 3px; left: 12px; right: 12px; bottom: 6px; background: linear-gradient(90deg, rgba(124,111,87,0.28), rgba(160,119,63,0.18)); border-radius: 999px; pointer-events: none; opacity: .8; }
    .mini-navbar .filter-btn { transition: transform .15s ease, box-shadow .15s ease, background-color .12s ease; }
        .mini-navbar .filter-btn:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.06); }
        /* keep gradient style above for active state - removed solid color override */
        .funfact-card { transition: opacity .15s ease, transform .15s ease, box-shadow .12s ease; }
        .funfact-card:hover { transform: translateY(-6px); box-shadow: 0 18px 40px rgba(10,10,10,0.06); }
        .funfact-card[hidden] { display: none !important; }
        /* standard card content layout */
        .funfact-card .flex-1 { display: block; }
        /* read-more button modern style */
        .btn-read { display:inline-flex; align-items:center; gap:.5rem; padding:.5rem .75rem; background:#7c6f57; color:#fff; border-radius:0.375rem; box-shadow: 0 6px 18px rgba(124,111,87,0.08); transition: transform .12s ease, box-shadow .12s ease; }
        .btn-read:hover { transform: translateY(-3px); box-shadow: 0 12px 24px rgba(124,111,87,0.12); }
        .btn-read:active { transform: translateY(-1px); }
        .funfact-card { transition: transform .15s ease, box-shadow .15s; }
        .funfact-card:hover { transform: translateY(-6px); box-shadow: 0 12px 30px rgba(0,0,0,0.08); }
        /* pagination styles */
        #category-pagination-wrapper { background: transparent; }
        #paginated-list { padding: 6px 4px; }
        .pagination-controls { display: flex; gap: .5rem; align-items: center; justify-content: center; }
        .pagination-btn { padding: .4rem .6rem; border: 1px solid rgba(0,0,0,0.06); background: white; color: #4b4b4b; border-radius: .35rem; box-shadow: 0 6px 18px rgba(0,0,0,0.04); min-width: 36px; }
        .pagination-btn.active { background: linear-gradient(90deg, rgba(124,111,87,0.18), rgba(160,119,63,0.14)); color: #241f16; box-shadow: 0 10px 20px rgba(124,111,87,0.08); font-weight: 700; }
        .pagination-btn:hover { transform: translateY(-2px); }
        .pagination-btn:disabled { opacity: 0.45; cursor: not-allowed; transform: none; }
        .pagination-btn:disabled { opacity: .45; pointer-events: none; transform: none; }
    </style>

    <!-- Funfact Detail Modal/Panel -->
    <div id="funfact-detail" class="fixed inset-0 z-50 hidden bg-black/40 flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full mx-4 overflow-hidden relative">
            <button id="close-detail" class="absolute top-3 right-3 text-[#7c6f57] text-2xl font-bold hover:text-red-500">&times;</button>
            <img id="detail-img" src="" alt="" class="w-full h-64 object-cover rounded-t-xl">
            <div class="p-6">
                <div class="flex items-center gap-2 mb-2">
                    <span id="detail-category" class="category-badge px-2 py-1 rounded text-xs font-semibold bg-gray-200 text-gray-800"></span>
                    <span id="detail-date" class="text-xs text-gray-500"></span>
                </div>
                <h2 id="detail-title" class="text-2xl font-bold mb-2 text-[#7c6f57]"></h2>
                <p id="detail-summary" class="text-base text-gray-700 mb-4"></p>
                <div class="text-sm text-gray-500 mb-2">Oleh: <span id="detail-author" class="font-semibold text-[#7c6f57]"></span></div>
                <div class="mb-4 flex items-center gap-3">
                    <span class="font-semibold text-[#7c6f57]">Sumber:</span>
                    <a id="detail-source" href="#" target="_blank" class="underline text-blue-600"></a>
                    <a id="detail-open-source" target="_blank" rel="noopener" class="btn-read inline-flex items-center gap-2 text-sm" href="#">Buka Sumber</a>
                    <a id="detail-open-internal" class="ml-auto btn-read inline-flex items-center gap-2 text-sm" href="#">Baca Selengkapnya</a>
                </div>
                <div class="mt-6">  
                    <h3 class="text-lg font-semibold mb-2 text-[#7c6f57]">Postingan Terkait</h3>
                    <div id="related-posts" class="grid grid-cols-1 sm:grid-cols-2 gap-4"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inline JS for simple client interactivity and detail modal (no heavy pagination on client) -->
    <script>
        // current category set by server (used to keep filter state in JS)
        window.__FUNFACT_CATEGORY = "{{ $category ?? '' }}";
        (function () {
            const buttons = document.querySelectorAll('.filter-btn');
            const cards = document.querySelectorAll('.funfact-card');
            const breadcrumbCategory = document.getElementById('breadcrumb-category');
            const categoryColors = {
                'sains': '#0ea5e9',
                'politik': '#ef4444',
                'kultur': '#8b5cf6',
                'militer': '#10b981',
                'ekonomi': '#f59e0b',
                'kuno': '#6b7280',
                'olahraga': '#ef4444',
                'urban': '#f97316',
            };

            // Colorize initial category badges inline for original cards
            cards.forEach(c => {
                const badge = c.querySelector('.category-badge');
                if (badge) {
                    const cat = c.dataset.category;
                    const color = categoryColors[cat] || '#7c6f57';
                    badge.style.backgroundColor = color;
                    badge.style.color = '#fff';
                    badge.style.fontWeight = '700';
                }
            });
            const detailPanel = document.getElementById('funfact-detail');
            const closeDetail = document.getElementById('close-detail');

            function setActive(btn) {
                buttons.forEach(b => b.classList.remove('active'));
                buttons.forEach(b => b.setAttribute('aria-pressed', 'false'));
                btn.classList.add('active');
                btn.setAttribute('aria-pressed', 'true');
            }

            // Client-side filtering kept for UI, but server-side paginated lists will be generated by the controller when navigating category links.
            function filterCategory(category) {
                if (!category || category === 'all') {
                    cards.forEach(c => c.hidden = false);
                    breadcrumbCategory.textContent = 'Semua';
                    return;
                }
                cards.forEach(c => {
                    c.hidden = (c.dataset.category !== category);
                });
                breadcrumbCategory.textContent = category.charAt(0).toUpperCase() + category.slice(1);
            }

            // Client cache for category+page data (in-memory Map + sessionStorage persistent layer)
            const categoryCache = new Map();
            // sessionStorage key prefix
            const STORAGE_PREFIX = 'funfact_cache_';
            function makeKey(category, page){ return `${category || 'all'}|${page || 1}`; }
            function saveToSession(category, page, data){ try { sessionStorage.setItem(STORAGE_PREFIX + makeKey(category, page), JSON.stringify(data)); } catch(e){ /* ignore storage errors */ } }
            function loadFromSession(category, page){ try { const s = sessionStorage.getItem(STORAGE_PREFIX + makeKey(category, page)); return s ? JSON.parse(s) : null; } catch(e){ return null; } }

            buttons.forEach(btn => {
                // Make clicks navigate to server-side category pages (we allow default link behavior)
                btn.addEventListener('click', (e) => {
                    // respect modifier click behavior
                    if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey || e.button === 1) {
                        return; // let navigation happen (open in new tab)
                    }
                    e.preventDefault();
                    const href = btn.getAttribute('href');
                    const category = btn.dataset.filter || '';
                    if (!href) return;
                    setActive(btn);
                    // Show loading
                    document.getElementById('funfact-loading').classList.remove('hidden');
                    loadCategory(href, category, 1).finally(() => {
                        document.getElementById('funfact-loading').classList.add('hidden');
                    });
                    // update URL
                    if (history.replaceState) history.pushState({category: category, href: href}, '', href);
                });
            });

            // Funfact detail logic (click card to open preview modal)
            cards.forEach(card => {
                card.addEventListener('click', () => {
                    // Fill detail panel
                    document.getElementById('detail-img').src = card.dataset.img;
                    document.getElementById('detail-title').textContent = card.dataset.title;
                    document.getElementById('detail-category').textContent = card.dataset.category.charAt(0).toUpperCase() + card.dataset.category.slice(1);
                    document.getElementById('detail-summary').textContent = card.dataset.summary;
                    document.getElementById('detail-author').textContent = card.dataset.author;
                    document.getElementById('detail-date').textContent = card.dataset.date;
                    document.getElementById('detail-source').href = 'https://' + card.dataset.source;
                    document.getElementById('detail-source').textContent = card.dataset.source;
                    document.getElementById('detail-open-source').href = 'https://' + card.dataset.source;
                    // set internal detail page link using current origin
                        if (card.dataset.slug) {
                            const base = location.origin || (location.protocol + '//' + location.host);
                            document.getElementById('detail-open-internal').href = base + '/funfact/' + card.dataset.slug;
                        } else {
                            document.getElementById('detail-open-internal').href = '#';
                        }

                    // Colorize badges and set modal color: reuse global mapping
                    cards.forEach(c => {
                        const badgeEl = c.querySelector('.category-badge');
                        if (badgeEl) {
                            const cat = c.dataset.category;
                            const color = categoryColors[cat] || '#7c6f57';
                            badgeEl.style.backgroundColor = color;
                            badgeEl.style.color = '#fff';
                            badgeEl.style.fontWeight = '700';
                        }
                    });

                    // Related posts: show 2 random other cards
                    const related = Array.from(cards).filter(c => c !== card).sort(() => Math.random() - 0.5).slice(0,2);
                    const relatedPosts = document.getElementById('related-posts');
                    relatedPosts.innerHTML = '';
                    related.forEach(r => {
                        relatedPosts.innerHTML += `<div class="rounded-lg overflow-hidden shadow border bg-white">
                            <img src="${r.dataset.img}" alt="${r.dataset.title}" class="w-full h-32 object-cover">
                            <div class="p-3">
                                <span class="block text-xs font-semibold mb-1 text-gray-500">${r.dataset.category.charAt(0).toUpperCase() + r.dataset.category.slice(1)}</span>
                                <h4 class="font-bold text-[#7c6f57] text-base mb-1">${r.dataset.title}</h4>
                                <p class="text-sm text-gray-600">${r.dataset.summary}</p>
                            </div>
                        </div>`;
                    });

                    detailPanel.classList.remove('hidden');
                });
                // Prevent click-through when clicking the internal read-more link
                const readMore = card.querySelectorAll('a.read-more-btn');
                readMore.forEach(link => link.addEventListener('click', function (e) {
                    e.stopPropagation();
                    // allow navigation to internal page; we stop propagation so the preview modal doesn't open
                }));
            });
            closeDetail.addEventListener('click', () => {
                detailPanel.classList.add('hidden');
            });
            // Close modal when clicking outside content
            detailPanel.addEventListener('click', (e) => {
                if (e.target === detailPanel) {
                    detailPanel.classList.add('hidden');
                }
            });
            // Close on ESC
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' || e.keyCode === 27) {
                    if (!detailPanel.classList.contains('hidden')) {
                        detailPanel.classList.add('hidden');
                    }
                }
            });

            // No client-side pagination: server-side rendering will supply a paginated set for faster page load.
            // Note: Pagination view replaces old slider toggle functionality.

            // Set initial active button depending on URL hash OR the server-supplied category variable
            const initialHash = location.hash.replace('#', '');
            const serverCategory = (window.__FUNFACT_CATEGORY || '').toLowerCase();
            if (initialHash) {
                const targetBtn = document.querySelector('.filter-btn[data-filter="' + initialHash + '"]');
                if (targetBtn) { setActive(targetBtn); filterCategory(initialHash); }
            } else if (serverCategory) {
                const serverBtn = document.querySelector('.filter-btn[data-filter="' + serverCategory + '"]');
                if (serverBtn) { setActive(serverBtn); filterCategory(serverCategory); }
            } else {
                // fallback: set first link active
                const firstBtn = document.querySelector('.filter-btn');
                if (firstBtn) setActive(firstBtn);
            }

            // Intercept pagination clicks and load via AJAX
            document.addEventListener('click', function (e) {
                const target = e.target.closest('a');
                if (!target) return;
                if (!target.classList.contains('pagination-btn')) return;
                // support new tab/opening
                if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey || e.button === 1) return;
                e.preventDefault();
                const href = target.getAttribute('href');
                if (!href) return;
                // derive category from URL or serverCategory
                const params = new URL(href, location.origin);
                const page = params.searchParams.get('page') || '1';
                const categoryFromUrl = (params.pathname.split('/').pop() || serverCategory);
                document.getElementById('funfact-loading').classList.remove('hidden');
                loadCategory(href, categoryFromUrl, page).finally(() => {
                    document.getElementById('funfact-loading').classList.add('hidden');
                });
                if (history.replaceState) history.pushState({category: categoryFromUrl, href: href, page: page}, '', href);
            });

            // Handle browser back/forward
            window.addEventListener('popstate', function (e) {
                if (!e.state) return; // initial load
                const href = e.state.href || location.href;
                const category = e.state.category || serverCategory;
                document.getElementById('funfact-loading').classList.remove('hidden');
                loadCategory(href, category, e.state.page || 1).finally(() => {
                    document.getElementById('funfact-loading').classList.add('hidden');
                });
            });

            // Core loader: fetch JSON and render cards/pagination
            async function loadCategory(href, category, page) {
                // Use cache key category|page
                const cacheKey = category + '|' + page;
                const cached = categoryCache.has(cacheKey) ? categoryCache.get(cacheKey) : loadFromSession(category, page);
                if (cached) {
                    categoryCache.set(cacheKey, cached);
                    renderFunfacts(cached);
                    return Promise.resolve();
                }
                try {
                    const res = await fetch(href, { headers: { 'Accept': 'application/json' } });
                    if (!res.ok) throw new Error('HTTP ' + res.status);
                    const json = await res.json();
                    categoryCache.set(cacheKey, json);
                    saveToSession(category, page, json);
                    renderFunfacts(json);
                } catch (err) {
                    console.error('Failed to load category', err);
                    // fallback to navigation
                    location.href = href;
                }
            }

            function renderFunfacts(payload) {
                // payload: items, category, page, perPage, total, totalPages
                const rawList = document.getElementById('funfact-list');
                rawList.innerHTML = '';
                // Build DOM via DocumentFragment for better performance
                const fragment = document.createDocumentFragment();
                payload.items.forEach(it => {
                    const div = document.createElement('article');
                    div.className = 'funfact-card p-0 rounded-lg bg-white/80 shadow-sm cursor-pointer flex flex-row h-full overflow-hidden';
                    div.dataset.category = it.category || payload.category;
                    div.dataset.title = it.title || '';
                    div.dataset.summary = it.summary || '';
                    div.dataset.img = it.img ? (it.img.startsWith('assets') ? (window.location.origin + '/' + it.img) : it.img) : '';
                    div.dataset.source = it.source || '';
                    div.dataset.author = it.author || 'Redaksi';
                    div.dataset.date = it.date || new Date().toLocaleDateString();
                    div.dataset.slug = it.slug || '';
                    // Normalize image paths into absolute URLs
                    let imgPath = it.img || 'assets/images/courses/courseone.png';
                    if (imgPath.startsWith('http://') || imgPath.startsWith('https://')) {
                        // fine
                    } else if (imgPath.startsWith('/')) {
                        imgPath = window.location.origin + imgPath;
                    } else if (imgPath.startsWith('assets')) {
                        imgPath = window.location.origin + '/' + imgPath.replace(/^\/+/, '');
                    } else {
                        // relative path -> assume assets
                        imgPath = window.location.origin + '/assets/images/funfact/' + imgPath.replace(/^\/+/, '');
                    }
                    div.innerHTML = `
                        <div class="flex-shrink-0 w-40 md:w-56 h-36 md:h-40 bg-gray-200 flex items-center justify-center overflow-hidden">
                            <img loading="lazy" src="${imgPath}" alt="${it.title || ''}" class="object-cover w-full h-full" onerror="this.src='${window.location.origin}/assets/images/courses/courseone.png'">
                        </div>
                        <div class="flex flex-col justify-center flex-1 px-4 py-2">
                            <span class="category-badge inline-block px-2 py-1 rounded text-xs font-semibold bg-gray-200 text-gray-800 mb-1">${(it.category || payload.category || '').toUpperCase()}</span>
                            <h3 class="text-xl md:text-2xl font-extrabold mb-2 font-sans tracking-tight text-gray-900">${it.title || ''}</h3>
                            <p class="text-base md:text-lg text-gray-800 mb-4 font-normal leading-relaxed font-sans">${it.summary || ''}</p>
                            <a title="Baca selengkapnya: ${it.title || ''}" aria-label="Baca selengkapnya: ${it.title || ''}" class="btn-read read-more-btn self-start" href="/funfact/${it.slug}">Baca Selengkapnya</a>
                        </div>
                    `;
                    // attach click for modal
                    div.addEventListener('click', () => {
                        document.getElementById('detail-img').src = div.dataset.img;
                        document.getElementById('detail-title').textContent = div.dataset.title;
                        document.getElementById('detail-category').textContent = (div.dataset.category || '').charAt(0).toUpperCase() + (div.dataset.category || '').slice(1);
                        document.getElementById('detail-summary').textContent = div.dataset.summary;
                        document.getElementById('detail-author').textContent = div.dataset.author;
                        document.getElementById('detail-date').textContent = div.dataset.date;
                        document.getElementById('detail-source').href = 'https://' + div.dataset.source;
                        document.getElementById('detail-source').textContent = div.dataset.source;
                        document.getElementById('detail-open-source').href = 'https://' + div.dataset.source;
                        document.getElementById('detail-open-internal').href = '/funfact/' + div.dataset.slug;
                        const relatedPosts = document.getElementById('related-posts');
                        // build 2 related cards from currently displayed
                        const children = Array.from(document.querySelectorAll('.funfact-card')).filter(c => c !== div);
                        relatedPosts.innerHTML = '';
                        children.sort(() => Math.random() - 0.5).slice(0,2).forEach(r => {
                            relatedPosts.innerHTML += `<div class="rounded-lg overflow-hidden shadow border bg-white"><img src="${r.dataset.img}" alt="${r.dataset.title}" class="w-full h-32 object-cover"><div class="p-3"><span class="block text-xs font-semibold mb-1 text-gray-500">${r.dataset.category}</span><h4 class="font-bold text-[#7c6f57] text-base mb-1">${r.dataset.title}</h4><p class="text-sm text-gray-600">${r.dataset.summary}</p></div></div>`;
                        });
                        document.getElementById('funfact-detail').classList.remove('hidden');
                    });
                    // ensure read-more link doesn't open modal (stop propagation)
                    const rm = div.querySelector('.read-more-btn');
                    if (rm) rm.addEventListener('click', (ev) => ev.stopPropagation());
                    fragment.appendChild(div);
                    // Preload image to warm browser cache
                    try {
                        const pre = new Image(); pre.src = imgPath; pre.decoding = 'async';
                        // optional decode used when supported
                        if (pre.decode) pre.decode().catch(()=>{});
                    } catch (e) {}
                });
                rawList.appendChild(fragment);
                // rebuild pagination controls
                const paginationContainer = document.querySelector('.mt-6.flex.justify-center');
                if (paginationContainer) paginationContainer.innerHTML = '';
                // show meta
                const info = document.querySelector('#category-pagination-wrapper .text-sm');
                if (info) info.innerHTML = `Menampilkan halaman <span class="font-semibold">${payload.page}</span> dari <span class="font-semibold">${payload.totalPages}</span> — total <span class="font-semibold">${payload.total}</span> artikel.`;
                // numeric controls
                const pc = document.createElement('div'); pc.className = 'flex items-center gap-2';
                const current = payload.page || 1; const totalPages = payload.totalPages || 1;
                const base = (payload.category && payload.category !== 'all') ? '/funfact/category/' + payload.category : '/funfact';
                const q = '?page=';
                const firstBtn = document.createElement('a'); firstBtn.className = 'pagination-btn'; firstBtn.textContent = '<'; firstBtn.href = base + q + Math.max(1, current - 1);
                pc.appendChild(firstBtn);
                for (let i = 1; i <= totalPages; i++) {
                    const a = document.createElement('a'); a.className = 'pagination-btn ' + ((i === current) ? 'active' : ''); a.href = base + q + i; a.textContent = i; pc.appendChild(a);
                }
                const nextBtn = document.createElement('a'); nextBtn.className = 'pagination-btn'; nextBtn.textContent = '>'; nextBtn.href = base + q + Math.min(totalPages, current + 1);
                pc.appendChild(nextBtn);
                if (paginationContainer) paginationContainer.appendChild(pc);
                // colorize badges
                document.querySelectorAll('.category-badge').forEach(b => { const cat = b.textContent.toLowerCase(); const color = categoryColors[cat] || '#7c6f57'; b.style.backgroundColor = color; b.style.color = '#fff'; b.style.fontWeight = '700'; });
                // set active nav button
                if (payload.category) {
                    const navBtn = document.querySelector('.filter-btn[data-filter="' + payload.category + '"]');
                    if (navBtn) setActive(navBtn);
                }
            }
        })();
    </script>
</div>
@endsection
