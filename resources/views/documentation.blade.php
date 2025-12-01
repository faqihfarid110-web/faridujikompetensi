@extends('layouts.app')
@section('title', 'Koleksi Lukisan Sejarah')
@section('content')
<div class="container mx-auto py-12">
    <h1 class="text-3xl font-bold mb-6">Koleksi Lukisan Sejarah</h1>
    <p class="text-gray-700 mb-6">Kumpulan lukisan dan ilustrasi sejarah yang kami arsipkan untuk riset, edukasi, dan inspirasi.</p>

    <!--
        NOTE: Paintings data is loaded per-continent from files under:
        resources/views/documentation/data/*.php
        Edit those files to update sets for each continent.
    -->
    @php
        // Load paintings data per-continent from separate files for easier editing.
        $asia = include resource_path('views/documentation/data/asia.php');
        $afrika = include resource_path('views/documentation/data/afrika.php');
        $eropa = include resource_path('views/documentation/data/eropa.php');
        $amerika = include resource_path('views/documentation/data/amerika.php');
        $australia = include resource_path('views/documentation/data/australia.php');
        $antartika = include resource_path('views/documentation/data/antartika.php');
        $oseania = include resource_path('views/documentation/data/oseania.php');
        $paintings = array_merge($asia, $afrika, $eropa, $amerika, $australia, $antartika, $oseania);
    @endphp

    <div class="mb-4 flex flex-wrap gap-3 items-center">
        <label for="continent-filter" class="font-semibold text-[#7c6f57]">Filter Benua:</label>
        <select id="continent-filter" class="px-3 py-2 border rounded-lg focus:ring-2 focus:ring-[#a68b5b] bg-[#f5ecd7] text-[#7c6f57]">
            <option value="Asia">Asia</option>
            <option value="Afrika">Afrika</option>
            <option value="Eropa">Eropa</option>
            <option value="Amerika">Amerika</option>
            <option value="Australia">Australia</option>
            <option value="Antartika">Antartika</option>
            <option value="Oseania">Oseania</option>
        </select>
    </div>

    <div id="gallery" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>



    <script>
    // Add small style helper for clamping where Tailwind's plugin might not be active
    const style = document.createElement('style');
    style.innerHTML = `
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        .star { font-size: 14px; }
        .star-btn { cursor: pointer; background: transparent; border: none; font-size: 18px; }
        .rating-btn{ cursor:pointer; }
    `;
    document.head.appendChild(style);
    const paintings = @json($paintings);
    const gallery = document.getElementById('gallery');
    const continentFilter = document.getElementById('continent-filter');
    // No modal/detail logic: gallery is pajangan only
    // Classic/earth-tone color palette
    const cardBg = 'bg-gradient-to-br from-[#f5ecd7] via-[#e0cfa4] to-[#bfa77a] border-[#a68b5b]';
    const cardHover = 'hover:shadow-lg hover:scale-[1.02]';
    const titleColor = 'text-[#7c6f57] group-hover:text-[#a68b5b]';

    function renderGallery(continent) {
        gallery.innerHTML = '';
        const filtered = paintings.filter(p => p.continent === continent).slice(0,7);
        for(const p of filtered) {
            const card = document.createElement('div');
            // Uniform card height + flexible content; image box fixed height; content area fixed height to keep symmetry
            card.className = `group card rounded-xl overflow-hidden border shadow transition ${cardBg} ${cardHover} flex flex-col h-96`;
            card.innerHTML = `
                <div class="w-full h-44 sm:h-56 bg-[#efe6d6] flex items-center justify-center p-4">
                    <img loading="lazy" src="/${p.img}" alt="${p.title}" class="object-contain max-h-full max-w-full rounded shadow-sm border border-[#d7cdb3] bg-white" />
                </div>
                <div class="p-3 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold ${titleColor} line-clamp-2 break-words text-center" style="min-height:3rem;">${p.title}</h3>
                        <div class="flex justify-center items-center gap-1 my-1" data-rating="${p.slug}">
                            <span class="star text-yellow-400">&#9733;</span><span class="star text-yellow-400">&#9733;</span><span class="star text-yellow-400">&#9733;</span><span class="star text-yellow-400">&#9733;</span><span class="star text-yellow-400">&#9733;</span>
                            <span class="text-xs text-[#a68b5b] ml-1 rating-value">0.0</span>
                            <button class="ml-2 text-xs text-[#7c6f57] px-2 py-1 border rounded rating-btn">Rate</button>
                        </div>
                        <div class="text-xs text-[#a68b5b] mb-1">${p.artist} · ${p.year}</div>
                        <div class="text-sm text-[#7c6f57] bg-[#f9f3e8] rounded px-2 py-1" style="min-height:3.75rem; margin-top:0;">${p.desc || ''}</div>
                    </div>
                </div>
            `;
            gallery.appendChild(card);
            // attach rating form logic
            (function(card, p){
                const btn = card.querySelector('.rating-btn');
                const ratingValueEl = card.querySelector('.rating-value');
                const starEls = card.querySelectorAll('.star');
                let selected = 5;
                const form = document.createElement('div');
                form.className = 'mt-2 p-2 rounded bg-white/80 border';
                form.style.display = 'none';
                form.innerHTML = `
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-sm">Your rating:</span>
                        <div class="stars flex gap-1">${Array(5).fill(0).map((_,i)=>`<button class=\"star-btn text-yellow-400\" data-val=\"${i+1}\">\u2605</button>`).join('')}</div>
                    </div>
                    <textarea class="w-full p-2 border rounded text-sm" placeholder="Komentar (opsional)" rows="3"></textarea>
                    <div class="flex gap-2 justify-end mt-2"><button class="btn-submit px-3 py-1 rounded bg-[#a68b5b] text-white text-sm">Kirim</button><button class="btn-cancel px-3 py-1 rounded border text-sm">Batal</button></div>
                `;
                // const descEl = card.querySelector('div[role="desc"]'); // not used
                card.querySelector('.p-3').appendChild(form);
                btn.addEventListener('click', function(){ form.style.display = form.style.display === 'none' ? '' : 'none'; });
                form.querySelector('.btn-cancel').addEventListener('click', ()=> form.style.display = 'none');
                // star click
                form.querySelectorAll('.star-btn').forEach(st => {
                    st.addEventListener('click', function(){
                        selected = this.dataset.val;
                        // highlight the stars
                        form.querySelectorAll('.star-btn').forEach((b,i)=> b.style.opacity = (i < selected ? '1' : '0.4'));
                    });
                });
                form.querySelector('.btn-submit').addEventListener('click', function(){
                    const comment = form.querySelector('textarea').value;
                    const token = document.querySelector('meta[name=csrf-token]').content;
                    fetch(`/lukisan/${p.slug}/rate`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
                        body: JSON.stringify({ rating: selected, comment })
                    }).then(r => r.json()).then(json => {
                        if (json && json.success) {
                            ratingValueEl.textContent = json.avg + ' ('+json.count+')';
                            form.style.display = 'none';
                        }
                    }).catch(err => console.error(err));
                });
                // initial fetch stats
                fetch(`/lukisan/${p.slug}/rating`).then(r=>r.json()).then(js=>{
                    ratingValueEl.textContent = js.avg + ' ('+js.count+')';
                });
            })(card, p);
        }
    }
    continentFilter.addEventListener('change', e => renderGallery(e.target.value));
    // Initial render
    renderGallery(continentFilter.value);
    </script>

</div>
@endsection
