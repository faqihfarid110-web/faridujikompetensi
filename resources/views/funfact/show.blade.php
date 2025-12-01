@extends('layouts.app')
@section('title', ($title ?? 'Funfact') . ' — Funfact | Literasi Sejarah')
@section('content')
<div class="container mx-auto py-8 lg:max-w-screen-lg">
    <div class="bg-white rounded-xl shadow-lg border-l-4 border-[#7c6f57] p-6 transition-shadow hover:shadow-2xl">
    {{-- Breadcrumb removed as requested --}}
    {{-- Kembali & Buka Sumber buttons removed per request --}}
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-black leading-tight tracking-tight mb-2" style="font-family: 'Inter', 'Segoe UI', Arial, sans-serif;">{{ $title }}</h1>
            <div class="inline-block mt-2">
                    @php
                        $catColors = [
                            'sains' => '#0ea5e9',
                            'politik' => '#ef4444',
                            'kultur' => '#8b5cf6',
                            'militer' => '#10b981',
                            'ekonomi' => '#f59e0b',
                            'kuno' => '#6b7280',
                            'olahraga' => '#ef4444',
                            'urban' => '#f97316',
                        ];
                        $color = $catColors[strtolower($category ?? '')] ?? '#7c6f57';
                    @endphp
                    <span class="category-badge inline-block px-2 py-1 rounded-full text-xs uppercase tracking-wide mr-2" style="background: {{ $color }}; color: #fff;">{{ strtoupper($category ?? '') }}</span>
                </div>
        </div>
        <div class="flex items-center gap-3 text-sm text-gray-500">
            <a href="#" class="history-link px-2 py-1 rounded hover:bg-[#f3f3f3]">🔖 Bookmark</a>
            <a href="#" class="history-link px-2 py-1 rounded hover:bg-[#f3f3f3]">🔗 Share</a>
        </div>
    </div>
    @php
        $date = $date ?? ($data['date'] ?? ($data['created_at'] ?? date('d F Y')));
    @endphp
    <div class="mt-2 text-base text-black font-medium">oleh Farid Faqih A. | {{ $date }}</div>
    <div class="mt-6 flex justify-center">
        <img src="{{ asset($img) }}" alt="{{ $title }}" class="mx-auto max-w-full h-auto object-cover rounded-md shadow-md hover:scale-105 transition-transform duration-300" />
    </div>
    <style>
        /* Detail page paragraph spacing and fonts */
        .post-content p { margin-bottom: 1.5rem; line-height: 1.9; font-size: 1.05rem; }
        .post-content h2, .post-content h3 { margin-top: 1.25rem; margin-bottom: 0.8rem; }
        .post-content { font-family: 'Inter', 'Segoe UI', Arial, sans-serif; }
    </style>
    <div class="mt-6 text-black space-y-8">
        <p class="mb-4 text-lg font-bold text-gray-800" style="font-family: 'Inter', 'Segoe UI', Arial, sans-serif;">{{ $summary }}</p>
        @php
            // If content contains HTML tags, render as-is (user-provided HTML). Otherwise, convert newlines to paragraphs.
            $renderedContent = '';
            if (is_string($content) && preg_match('/<[a-z][\s\S]*>/i', $content)) {
                $renderedContent = $content;
            } else {
                $parts = preg_split('/\r\n|\r|\n/', trim($content ?? '')) ?: [];
                $parts = array_filter(array_map('trim', $parts));
                if (count($parts)) {
                    $renderedContent = '<p>' . implode('</p><p>', $parts) . '</p>';
                } else {
                    $renderedContent = $content ?? '';
                }
            }
        @endphp
        <div class="post-content prose max-w-none text-lg leading-relaxed font-medium text-gray-900">{!! $renderedContent !!}</div>
    </div>
    </div> <!-- end card wrapper -->

    <!-- Related posts removed per request -->

    <div class="mt-8 text-sm text-gray-500">
        <span class="font-semibold">Sumber:</span> <a href="https://{{ $source ?? 'historia.id' }}" target="_blank" class="underline text-blue-600">historia.id</a>
    </div>

    <!-- Comments & rating section -->
    <section class="mt-12 bg-[#f9f9f8] rounded-md p-6">
        <h3 class="text-lg font-semibold text-[#7c6f57] mb-4">Komentar & Penilaian</h3>
        <div class="mb-3 flex items-center gap-4">
            <div id="average-rating" class="text-2xl font-bold text-gray-900">{{ $average_rating ? number_format($average_rating,1) : '-' }}</div>
            <div class="flex items-center text-[#c98f2b]" aria-hidden="true">
                @php $avg = round($average_rating ?: 0); @endphp
                @for ($i=1; $i <= 5; $i++)
                    <span class="text-xl">@if($i <= $avg) ★ @else ☆ @endif</span>
                @endfor
            </div>
            <div class="text-sm text-gray-500">(<span id="feedback-count">{{ isset($feedbacks) ? $feedbacks->count() : 0 }}</span> penilai)</div>
        </div>
        @if(session('success'))
            <div class="p-3 bg-green-50 border border-green-200 text-green-800 rounded mb-4">{{ session('success') }}</div>
        @endif
        <div id="ajax-feedback" class="hidden p-3 bg-green-50 border border-green-200 text-green-800 rounded mb-4"></div>
        <form action="{{ route('funfact.feedback.store', ['slug' => $slug]) }}" method="POST" class="space-y-4 bg-white rounded-xl shadow p-6 border mt-8">
            @csrf
            <div>
                <label for="name" class="text-sm font-medium text-gray-700">Nama (opsional)</label>
                <input name="name" id="name" class="mt-1 w-full rounded-md border p-2" placeholder="Nama Anda (opsional)">
                @error('name') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-700">Penilaian (bintang) <span id="selected-rating" class="ml-2 text-sm text-gray-700">(0)</span></label>
                <div class="stars mt-1 flex gap-2" role="radiogroup" aria-label="Penilaian">
                    <input type="radio" name="rating" value="1" id="r1" class="hidden"><label for="r1" class="cursor-pointer text-3xl star">★</label>
                    <input type="radio" name="rating" value="2" id="r2" class="hidden"><label for="r2" class="cursor-pointer text-3xl star">★</label>
                    <input type="radio" name="rating" value="3" id="r3" class="hidden"><label for="r3" class="cursor-pointer text-3xl star">★</label>
                    <input type="radio" name="rating" value="4" id="r4" class="hidden"><label for="r4" class="cursor-pointer text-3xl star">★</label>
                    <input type="radio" name="rating" value="5" id="r5" class="hidden"><label for="r5" class="cursor-pointer text-3xl star">★</label>
                </div>
            </div>
            <div>
                <label for="comment" class="text-sm font-medium text-gray-700">Komentar</label>
                <textarea name="comment" id="comment" class="mt-1 w-full rounded-md border min-h-[120px] p-2" placeholder="Tulis komentar Anda..."></textarea>
                @error('comment') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
            </div>
            <div class="flex items-center gap-4">
                <button type="submit" class="bg-[#7c6f57] text-white px-4 py-2 rounded">Kirim Komentar</button>
                @if ($errors->any())
                    <div class="text-sm text-red-600">Terdapat kesalahan input. Mohon perbaiki.</div>
                @endif
                <small class="text-xs text-gray-500">Komentar dan penilaian akan disimpan dan dapat dikelola admin.</small>
            </div>
        </form>

        <div class="mt-8">
            <h4 class="text-base font-semibold mb-3">Komentar</h4>
            @if(isset($feedbacks) && $feedbacks->count())
                <ul id="comments-list" class="space-y-6">
                    @foreach($feedbacks as $fb)
                        <li class="bg-white rounded-lg p-4 border">
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-semibold text-[#7c6f57]">{{ $fb->name ?? 'Anonim' }}</div>
                                <div class="text-xs text-gray-500">{{ $fb->created_at->format('d M Y') }}</div>
                            </div>
                            @if($fb->rating)
                                <div class="text-yellow-500 mt-1">{{ str_repeat('★', $fb->rating) }}{{ str_repeat('☆', 5 - $fb->rating) }}</div>
                            @endif
                            <p class="text-sm text-gray-700 mt-2">{{ $fb->comment }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm text-gray-500">Belum ada komentar — jadi pembuka komentar pertama ya!</p>
            @endif
        </div>
    </section>
    <style>
        /* style star labels */
        .star { color: #c98f2b; font-size: 1.6rem; display:inline-block; }
        .stars label { transition: transform .08s ease; }
        .stars label:hover { transform: translateY(-2px); }
        .selected-star { color: #c98f2b; transform: translateY(-1px); }
        /* make selected star larger */
        input[name="rating"]:checked + label { transform: scale(1.25); }
        input[name="rating"] + label { cursor: pointer; }
        /* post content first letter (drop cap) and reading enhancements */
        .post-content p:first-of-type::first-letter {
            font-size: 3.2rem;
            font-weight: 700;
            float: left;
            margin-right: 0.6rem;
            color: #7c6f57;
            line-height: 1;
        }
        .post-content p { text-align: justify; }
    </style>
    <script>
        (function () {
            const stars = Array.from(document.querySelectorAll('.stars label'));
            const inputs = Array.from(document.querySelectorAll('input[name="rating"]'));
            const SELECTED_CLASS = 'selected-star';
            function setStars(count) {
                stars.forEach((label, idx) => {
                    label.textContent = (idx < count) ? '★' : '☆';
                    label.classList.toggle(SELECTED_CLASS, idx < count);
                });
                const sel = document.getElementById('selected-rating');
                if (sel) sel.textContent = '(' + (count || 0) + ')';
            }
            stars.forEach((label, idx) => {
                label.addEventListener('click', (e) => {
                    e.preventDefault();
                    const i = idx + 1;
                    inputs.forEach(inp => inp.checked = false);
                    const target = document.getElementById('r' + i);
                    if (target) target.checked = true;
                    setStars(i);
                });
                label.addEventListener('mouseenter', () => setStars(idx + 1));
                label.addEventListener('mouseleave', () => {
                    const current = inputs.findIndex(i => i.checked);
                    setStars(current >= 0 ? current + 1 : 0);
                });
            });
            const initial = inputs.findIndex(i => i.checked);
            setStars(initial >= 0 ? initial + 1 : 0);

            // AJAX submit
            const form = document.querySelector('form[action*="/funfact/"]');
            if (form) {
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const formData = new FormData(form);
                    const url = form.getAttribute('action');
                    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    try {
                        const resp = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': token || '{{ csrf_token() }}',
                            },
                            body: formData,
                        });
                        if (resp.ok) {
                            const body = await resp.json();
                            if (body.status === 'ok') {
                                const avgEl = document.getElementById('average-rating');
                                const countEl = document.getElementById('feedback-count');
                                if (avgEl && typeof body.average !== 'undefined') avgEl.textContent = (body.average !== null) ? Number(body.average).toFixed(1) : '-';
                                if (countEl && typeof body.count !== 'undefined') countEl.textContent = body.count;
                                const commentsList = document.getElementById('comments-list');
                                if (commentsList && body.feedback) {
                                    const newLi = document.createElement('li');
                                    newLi.className = 'bg-white rounded-lg p-4 border';
                                    const poster = body.feedback.name ? body.feedback.name : 'Anonim';
                                    const date = new Date().toLocaleDateString();
                                    const ratingStars = body.feedback.rating ? ('<div class="text-[#c98f2b] mt-1">' + '★'.repeat(body.feedback.rating) + '☆'.repeat(5 - body.feedback.rating) + '</div>') : '';
                                    newLi.innerHTML = `<div class="flex items-center justify-between"><div class="text-sm font-semibold text-[#7c6f57]">${poster}</div><div class="text-xs text-gray-500">${date}</div></div> ${ratingStars} <p class="text-sm text-gray-700 mt-2">${body.feedback.comment || ''}</p>`;
                                    commentsList.insertAdjacentElement('afterbegin', newLi);
                                    form.reset();
                                    setStars(0);
                                    const ajaxFeedback = document.getElementById('ajax-feedback');
                                    if (ajaxFeedback) { ajaxFeedback.textContent = body.message || 'Komentar tersimpan.'; ajaxFeedback.classList.remove('hidden'); setTimeout(() => ajaxFeedback.classList.add('hidden'), 4000); }
                                }
                            } else {
                                // not ok
                                const ajaxFeedback = document.getElementById('ajax-feedback');
                                if (ajaxFeedback) { ajaxFeedback.textContent = body.message || 'Terjadi kesalahan saat menyimpan.'; ajaxFeedback.classList.remove('hidden'); setTimeout(() => ajaxFeedback.classList.add('hidden'), 4000); }
                            }
                        } else {
                            const text = await resp.text();
                            console.error('Error response', resp.status, text);
                            const ajaxFeedback = document.getElementById('ajax-feedback');
                            if (ajaxFeedback) { ajaxFeedback.textContent = 'Terjadi kesalahan jaringan. Coba lagi.'; ajaxFeedback.classList.remove('hidden'); setTimeout(() => ajaxFeedback.classList.add('hidden'), 4000); }
                        }
                    } catch (err) {
                        console.error(err);
                        const ajaxFeedback = document.getElementById('ajax-feedback');
                        if (ajaxFeedback) { ajaxFeedback.textContent = 'Terjadi kesalahan. Coba lagi.'; ajaxFeedback.classList.remove('hidden'); setTimeout(() => ajaxFeedback.classList.add('hidden'), 4000); }
                    }
                });
            }
        })();
    </script>
</div>
@endsection
