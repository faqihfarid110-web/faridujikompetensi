@extends('layouts.app')
@section('title', 'Survey Literasi Sejarah')
@section('content')

<div class="container mx-auto lg:max-w-screen-md px-4 py-10">
    <div class="bg-[#f5e9da] p-8 rounded-xl border border-[#e9d8a6] shadow-lg transition-shadow hover:shadow-2xl">
        <h1 class="text-3xl history-heading font-bold text-[#7c6f57] mb-2">Form Survei: Minat Belajar Sejarah</h1>
        <p class="history-font text-[#7c6f57]/80 mb-6">Isi form singkat ini agar kami bisa menyesuaikan materi dan layanan pembelajaran di platform—a.k.a. lebih terfokus untuk kebutuhanmu.</p>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif

        <form action="{{ route('survey.store') }}" method="post" class="grid grid-cols-1 gap-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="relative">
                    <input type="text" name="name" id="name" class="peer w-full px-4 py-3 border border-[#e9d8a6] rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-[#7c6f57] transition" placeholder=" " />
                    <label for="name" class="absolute left-3 -top-4 text-sm text-[#7c6f57]/70 bg-[#f5e9da] px-1 transition-all duration-200 pointer-events-none peer-focus:-top-4 peer-focus:text-sm peer-[:not(:placeholder-shown)]:-top-4 peer-[:not(:placeholder-shown)]:text-sm">Nama</label>
                </div>
                <div class="relative">
                    <input type="email" name="email" id="email" class="peer w-full px-4 py-3 border border-[#e9d8a6] rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-[#7c6f57] transition" placeholder=" " />
                    <label for="email" class="absolute left-3 -top-4 text-sm text-[#7c6f57]/70 bg-[#f5e9da] px-1 transition-all duration-200 pointer-events-none peer-focus:-top-4 peer-focus:text-sm peer-[:not(:placeholder-shown)]:-top-4 peer-[:not(:placeholder-shown)]:text-sm">Email (opsional)</label>
                </div>
            </div>

            <div class="relative">
                <label class="block text-base font-semibold text-[#a68b5b] mb-2">Beritahu kami topik yang ingin Anda pelajari</label>
                <div class="flex items-center gap-2 mb-3">
                    <input id="topic-filter" type="search" placeholder="Cari topik (mis. Politik, Sains)" class="px-3 py-2 border border-[#e9d8a6] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7c6f57] w-full text-sm bg-white" />
                </div>
                <div id="topic-buttons" class="flex flex-wrap gap-3">
                    @php
                        $topics = [
                            'politik' => 'Politik',
                            'ekonomi' => 'Ekonomi',
                            'kultur' => 'Kultur',
                            'militer' => 'Militer',
                            'kuno' => 'Kuno',
                            'olahraga' => 'Olahraga',
                            'sains' => 'Sains',
                            'urban' => 'Urban',
                        ];
                    @endphp
                    @foreach ($topics as $key => $label)
                        <label class="topic-item">
                            <input type="radio" name="topic_interest" value="{{ $label }}" class="peer hidden topic-radio" required>
                            <span class="inline-block px-4 py-2 rounded-md border border-[#a68b5b] bg-white text-[#7c6f57] font-semibold cursor-pointer transition-all duration-150 peer-checked:bg-[#7c6f57] peer-checked:text-white peer-checked:border-[#7c6f57] hover:bg-[#f5e9da]">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="relative">
                <textarea name="reason" id="reason" rows="3" class="peer w-full px-4 py-3 border border-[#e9d8a6] rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-[#7c6f57] transition resize-none" placeholder=" "></textarea>
                <label for="reason" class="absolute left-3 -top-4 text-sm text-[#7c6f57]/70 bg-[#f5e9da] px-1 transition-all duration-200 pointer-events-none peer-focus:-top-4 peer-focus:text-sm peer-[:not(:placeholder-shown)]:-top-4 peer-[:not(:placeholder-shown)]:text-sm">Mengapa ingin mempelajari topik ini?</label>
            </div>

            <div class="relative">
                <textarea name="expected_impact" id="expected_impact" rows="3" class="peer w-full px-4 py-3 border border-[#e9d8a6] rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-[#7c6f57] transition resize-none" placeholder=" "></textarea>
                <label for="expected_impact" class="absolute left-3 -top-4 text-sm text-[#7c6f57]/70 bg-[#f5e9da] px-1 transition-all duration-200 pointer-events-none peer-focus:-top-4 peer-focus:text-sm peer-[:not(:placeholder-shown)]:-top-4 peer-[:not(:placeholder-shown)]:text-sm">Dampak yang diharapkan setelah belajar di platform ini</label>
            </div>

            <div class="relative">
                <textarea name="comments" id="comments" rows="3" class="peer w-full px-4 py-3 border border-[#e9d8a6] rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-[#7c6f57] transition resize-none" placeholder=" "></textarea>
                <label for="comments" class="absolute left-3 -top-4 text-sm text-[#7c6f57]/70 bg-[#f5e9da] px-1 transition-all duration-200 pointer-events-none peer-focus:-top-4 peer-focus:text-sm peer-[:not(:placeholder-shown)]:-top-4 peer-[:not(:placeholder-shown)]:text-sm">Komentar / Catatan lain</label>
            </div>

            <div>
                <button type="submit" class="px-6 py-3 bg-[#7c6f57] text-white rounded-lg font-bold shadow-md hover:bg-[#a68b5b] hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#7c6f57]">Kirim Tanggapan</button>
            </div>
        </form>
    </div>
</div>
<script>
    (function () {
        const filter = document.getElementById('topic-filter');
        const container = document.getElementById('topic-buttons');
        if (!filter || !container) return;
        filter.addEventListener('input', function () {
            const q = (this.value || '').trim().toLowerCase();
            const items = container.querySelectorAll('.topic-item');
            items.forEach(it => {
                const text = it.textContent.trim().toLowerCase();
                if (!q) it.style.display = '';
                else it.style.display = text.includes(q) ? '' : 'none';
            });
        });
    })();
</script>
@endsection
