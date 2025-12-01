@extends('layouts.app')
@section('title', 'Literasi Sejarah')
@section('content')
        <section id="home-section" class="bg-gradient-to-br from-[#f5e9da] via-[#e9d8a6] to-[#b7b7a4] relative rounded-xl p-8 overflow-hidden">
            <!-- History effect overlay -->
            <div class="absolute inset-0 pointer-events-none z-0" style="background: url('{{ asset('assets/images/banner/history-overlay.svg') }}'); opacity: 0.12; mix-blend-mode: multiply;"></div>
            <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4 pt-6 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 items-center gap-6">
                    <div class="col-span-6 flex flex-col gap-4">
                        <div class="flex gap-2">
                            <img src="{{ asset('assets/images/banner/check-circle.svg') }}" alt="check" class="w-6 h-6">
                            <p class="text-success text-sm font-semibold">Portal Literasi Sejarah</p>
                        </div>
                        <h1 class="text-4xl sm:text-5xl font-extrabold mb-2 text-[#7c6f57] drop-shadow-lg history-heading">Literasi Sejarah Indonesia & Dunia</h1>
                        <h3 class="text-[#7c6f57]/80 text-lg mb-4 italic history-font">Situs ini disusun guna membantu rekan-rekan menambah kecakapan berliterasi serta memahami ihwal perjalanan sejarah melalui himpunan risalah, pelajaran, bimbingan, perhimpunan, dan catatan yang tertata rapi.</h3>
                        <div class="relative pt-4 w-full flex items-center justify-center">
                            <input type="text" name="q" class="py-4 pl-5 pr-20 text-lg w-full text-black rounded-full focus:outline-none border-2 border-[#e9d8a6] focus:border-[#7c6f57] focus:ring-2 focus:ring-[#7c6f57]/40 transition-all duration-300 bg-[#f5e9da]/60 shadow-lg placeholder:text-[#a68b5b]/60" placeholder="Cari topik sejarah..." autocomplete="off" />
                            <button class="absolute right-4 top-1/2 -translate-y-1/2 bg-gradient-to-br from-[#a68b5b] via-[#7c6f57] to-[#e9d8a6] p-3 rounded-full text-white shadow-lg border-2 border-[#e9d8a6] hover:scale-110 hover:shadow-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#7c6f57] flex items-center justify-center" aria-label="Cari">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="11" cy="11" r="8" stroke-width="2"/><line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2"/></svg>
                            </button>
                        </div>
                        <div class="pt-4">
                            <!-- Link now focuses survey topic input by using a fragment anchor and has a ripple class for JS effect -->
                            <a href="{{ route('survey.create') }}#topic_interest" class="inline-block bg-[#7c6f57] text-white px-4 py-2 rounded-md shadow hover:scale-105 transition-transform duration-200 history-link ripple">Beritahu kami topik yang ingin Anda pelajari</a>
                        </div>
                        <div class="flex items-center justify-between pt-6">
                            <div class="flex gap-2 items-center group">
                                <img src="{{ asset('assets/images/banner/check-circle.svg') }}" alt="check" class="w-6 h-6">
                                <p class="text-sm sm:text-lg font-semibold text-[#7c6f57]">Literasi Sejarah</p>
                            </div>
                            <div class="flex gap-2 items-center group">
                                <img src="{{ asset('assets/images/banner/check-circle.svg') }}" alt="check" class="w-6 h-6">
                                <p class="text-sm sm:text-lg font-semibold text-[#7c6f57]">Pengetahuan Sejarah</p>
                            </div>
                            <div class="flex gap-2 items-center group">
                                <img src="{{ asset('assets/images/banner/check-circle.svg') }}" alt="check" class="w-6 h-6">
                                <p class="text-sm sm:text-lg font-semibold text-[#7c6f57]">Diskusi Sejarah</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6 flex justify-center">
                        @php
                            $shipJpg = public_path('assets/images/banner/mahila-ship.jpg');
                        @endphp
                        @if (file_exists($shipJpg))
                            <div class="hero-img-container relative w-full h-auto overflow-hidden rounded-xl">
                                <img src="{{ asset('assets/images/banner/mahila-ship.jpg') }}" alt="hero-map" class="hero-kenburns-premium w-full h-auto drop-shadow-2xl rounded-xl border-4 border-[#e9d8a6] bg-[#f5e9da]/60" loading="lazy" style="filter: sepia(0.18) saturate(1.1) contrast(1.05); object-fit: cover; max-height: 420px; will-change: transform;">
                                <!-- subtle wispy overlay for historical look -->
                                <div class="absolute inset-0 pointer-events-none" style="background: linear-gradient(120deg, rgba(245,233,218,0.16), rgba(190,170,140,0.06)); mix-blend-mode: overlay;"></div>
                            </div>
                        @else
                            <img src="{{ asset('assets/images/banner/mahila-ship.svg') }}" alt="hero-map" class="w-full h-auto drop-shadow-xl rounded-xl border-4 border-[#e9d8a6] bg-[#f5e9da]/60" loading="lazy" style="filter: sepia(0.25) saturate(0.9) contrast(0.95); object-fit: cover; max-height: 420px;">
                        @endif
                    </div>
                </div>
            </div>
        </section>

            <!-- Courses -->
            <section id="courses" class="pt-6">
                <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
                    <div class="flex flex-col gap-3 mb-4">
                        <div class="flex items-baseline justify-between">
                            <div>
                                <h2 class="text-[#7c6f57] text-4xl lg:text-5xl font-extrabold mb-0 drop-shadow history-heading" style="font-family: 'Cinzel', 'EB Garamond', Georgia, serif;">Today is History</h2>
                                <p class="text-lg text-[#7c6f57]/80 history-date">{{ \Carbon\Carbon::now()->format('d F Y') }} — Jenis: Sejarah</p>
                            </div>
                            <a href="/ideologi" class="text-[#7c6f57] text-lg font-medium no-underline hover:no-underline">Telusuri Sistem Pemerintahan &gt;</a>
                        </div>
                        <p class="text-[#7c6f57]/60 text-sm mt-1">Berikut dua kolom: Sejarah Indonesia & Sejarah Dunia — gerak ke kanan otomatis. Klik judul untuk melihat sinopsis (disiapkan kemudian).</p>
                    </div>

                    <!-- Today is History rows -->
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Sejarah Indonesia row -->
                        <div class="bg-[#f5e9da]/60 rounded-2xl px-3 py-4 border border-[#e9d8a6]">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-[#7c6f57] font-semibold history-heading">Today is History — Sejarah Indonesia</h3>
                                  <span class="text-sm text-[#7c6f57]/70"></span>
                            </div>
                            <div class="autoscroll-container flex gap-4 overflow-x-auto hide-scrollbar px-2 py-2 items-center" data-scroll-speed="0.6" data-type="indonesia">
                                <!-- 6 item placeholder Indonesia -->
                                <article class="history-item flex-none bg-white/70 rounded-lg p-3 shadow-sm border border-[#e9d8a6] w-64">
                                    <img src="{{ asset('assets/images/courses/courseone.png') }}" alt="article 1" class="w-full object-cover rounded-md" loading="lazy">
                                    <h4 class="text-lg font-semibold text-[#7c6f57] mt-2">Sejak Proklamasi</h4>
                                    <p class="text-sm text-[#7c6f57]/70 mt-1">Ringkasan singkat (sinopsis akan ditambahkan kemudian).</p>
                                </article>
                                <article class="history-item flex-none bg-white/70 rounded-lg p-3 shadow-sm border border-[#e9d8a6] w-64">
                                    <img src="{{ asset('assets/images/courses/coursetwo.png') }}" alt="article 2" class="w-full object-cover rounded-md" loading="lazy">
                                    <h4 class="text-lg font-semibold text-[#7c6f57] mt-2">Perjuangan Kemerdekaan</h4>
                                    <p class="text-sm text-[#7c6f57]/70 mt-1">Ringkasan singkat (sinopsis akan ditambahkan kemudian).</p>
                                </article>
                                <article class="history-item flex-none bg-white/70 rounded-lg p-3 shadow-sm border border-[#e9d8a6] w-64">
                                    <img src="{{ asset('assets/images/courses/coursethree.png') }}" alt="article 3" class="w-full object-cover rounded-md" loading="lazy">
                                    <h4 class="text-lg font-semibold text-[#7c6f57] mt-2">Era Reformasi</h4>
                                    <p class="text-sm text-[#7c6f57]/70 mt-1">Ringkasan singkat (sinopsis akan ditambahkan kemudian).</p>
                                </article>
                                <article class="history-item flex-none bg-white/70 rounded-lg p-3 shadow-sm border border-[#e9d8a6] w-64">
                                    <img src="{{ asset('assets/images/courses/courseone.png') }}" alt="article 4" class="w-full object-cover rounded-md" loading="lazy">
                                    <h4 class="text-lg font-semibold text-[#7c6f57] mt-2">Orde Lama</h4>
                                    <p class="text-sm text-[#7c6f57]/70 mt-1">Ringkasan singkat (sinopsis akan ditambahkan kemudian).</p>
                                </article>
                                <article class="history-item flex-none bg-white/70 rounded-lg p-3 shadow-sm border border-[#e9d8a6] w-64">
                                    <img src="{{ asset('assets/images/courses/coursetwo.png') }}" alt="article 5" class="w-full object-cover rounded-md" loading="lazy">
                                    <h4 class="text-lg font-semibold text-[#7c6f57] mt-2">Orde Baru</h4>
                                    <p class="text-sm text-[#7c6f57]/70 mt-1">Ringkasan singkat (sinopsis akan ditambahkan kemudian).</p>
                                </article>
                                <article class="history-item flex-none bg-white/70 rounded-lg p-3 shadow-sm border border-[#e9d8a6] w-64">
                                    <img src="{{ asset('assets/images/courses/coursethree.png') }}" alt="article 6" class="w-full object-cover rounded-md" loading="lazy">
                                    <h4 class="text-lg font-semibold text-[#7c6f57] mt-2">Indonesia Modern</h4>
                                    <p class="text-sm text-[#7c6f57]/70 mt-1">Ringkasan singkat (sinopsis akan ditambahkan kemudian).</p>
                                </article>
                            </div>
                        </div>

                        <!-- Sejarah Dunia row -->
                        <div class="bg-[#f5e9da]/60 rounded-2xl px-3 py-4 border border-[#e9d8a6]">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-[#7c6f57] font-semibold history-heading">Today is History — Sejarah Dunia</h3>
                                  <span class="text-sm text-[#7c6f57]/70"></span>
                            </div>
                            <div class="autoscroll-container flex gap-4 overflow-x-auto hide-scrollbar px-2 py-2 items-center" data-scroll-speed="0.45" data-type="world">
                                <!-- 6 item placeholder Dunia -->
                                <article class="history-item flex-none bg-white/70 rounded-lg p-3 shadow-sm border border-[#e9d8a6] w-64">
                                    <img src="{{ asset('assets/images/courses/courseone.png') }}" alt="article 1" class="w-full object-cover rounded-md" loading="lazy">
                                    <h4 class="text-lg font-semibold text-[#7c6f57] mt-2">1929</h4>
                                    <p class="text-sm text-[#7c6f57]/70 mt-1">Richard E. Byrd memimpin penerbangan pertama melintasi Kutub Selatan — pencapaian penting dalam eksplorasi dan sejarah penerbangan dunia (sinopsis akan ditambahkan kemudian).</p>
                                </article>
                                <article class="history-item flex-none bg-white/70 rounded-lg p-3 shadow-sm border border-[#e9d8a6] w-64">
                                    <img src="{{ asset('assets/images/courses/coursetwo.png') }}" alt="article 2" class="w-full object-cover rounded-md" loading="lazy">
                                    <h4 class="text-lg font-semibold text-[#7c6f57] mt-2">Revolusi Industri</h4>
                                    <p class="text-sm text-[#7c6f57]/70 mt-1">Ringkasan singkat (sinopsis akan ditambahkan kemudian).</p>
                                </article>
                                <article class="history-item flex-none bg-white/70 rounded-lg p-3 shadow-sm border border-[#e9d8a6] w-64">
                                    <img src="{{ asset('assets/images/courses/coursethree.png') }}" alt="article 3" class="w-full object-cover rounded-md" loading="lazy">
                                    <h4 class="text-lg font-semibold text-[#7c6f57] mt-2">Zaman Penjelajahan</h4>
                                    <p class="text-sm text-[#7c6f57]/70 mt-1">Ringkasan singkat (sinopsis akan ditambahkan kemudian).</p>
                                </article>
                                <article class="history-item flex-none bg-white/70 rounded-lg p-3 shadow-sm border border-[#e9d8a6] w-64">
                                    <img src="{{ asset('assets/images/courses/courseone.png') }}" alt="article 4" class="w-full object-cover rounded-md" loading="lazy">
                                    <h4 class="text-lg font-semibold text-[#7c6f57] mt-2">Perang Dunia II</h4>
                                    <p class="text-sm text-[#7c6f57]/70 mt-1">Ringkasan singkat (sinopsis akan ditambahkan kemudian).</p>
                                </article>
                                <article class="history-item flex-none bg-white/70 rounded-lg p-3 shadow-sm border border-[#e9d8a6] w-64">
                                    <img src="{{ asset('assets/images/courses/coursetwo.png') }}" alt="article 5" class="w-full object-cover rounded-md" loading="lazy">
                                    <h4 class="text-lg font-semibold text-[#7c6f57] mt-2">Penemuan Internet</h4>
                                    <p class="text-sm text-[#7c6f57]/70 mt-1">Ringkasan singkat (sinopsis akan ditambahkan kemudian).</p>
                                </article>
                                <article class="history-item flex-none bg-white/70 rounded-lg p-3 shadow-sm border border-[#e9d8a6] w-64">
                                    <img src="{{ asset('assets/images/courses/coursethree.png') }}" alt="article 6" class="w-full object-cover rounded-md" loading="lazy">
                                    <h4 class="text-lg font-semibold text-[#7c6f57] mt-2">Dekolonisasi Asia-Afrika</h4>
                                    <p class="text-sm text-[#7c6f57]/70 mt-1">Ringkasan singkat (sinopsis akan ditambahkan kemudian).</p>
                                </article>
                            </div>
                        </div>
                    </div>
                        <!-- 3 foto besar di bawah dihapus -->
                    </div>
                </div>
            </section>

            <!-- Mentor -->
            <section class="pt-12">
                <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
                    <h2 class="text-[#7c6f57] text-3xl font-semibold mb-6 drop-shadow history-heading">Pakar & Peneliti Sejarah</h2>
                    <div class="mentor-slider grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="flex gap-4 items-center bg-[#f5e9da] p-4 rounded-xl shadow border border-[#e9d8a6]">
                                     @php $hered = public_path('assets/images/mentor/heredotus.jpg'); $heredSvg = public_path('assets/images/mentor/heredotus.svg'); @endphp
                                     @if (file_exists($hered))
                                         <img src="{{ asset('assets/images/mentor/heredotus.jpg') }}" alt="Heredotus" class="w-20 h-20 rounded-full object-cover" loading="lazy">
                                     @elseif (file_exists($heredSvg))
                                         <img src="{{ asset('assets/images/mentor/heredotus.svg') }}" alt="Heredotus" class="w-20 h-20 rounded-full object-cover" loading="lazy">
                                     @else
                                         <img src="{{ asset('assets/images/mentor/placeholder.png') }}" alt="Heredotus" class="w-20 h-20 rounded-full object-cover" loading="lazy">
                                     @endif
                            <div>
                                <h3 class="font-semibold text-lg text-[#7c6f57]">Heredotus</h3>
                                <p class="text-sm text-[#7c6f57]/60">Bapak Sejarah Dunia</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-center bg-[#f5e9da] p-4 rounded-xl shadow border border-[#e9d8a6]">
                                     @php $sart = public_path('assets/images/mentor/sartono.jpg'); $sartSvg = public_path('assets/images/mentor/sartono.svg'); @endphp
                                     @if (file_exists($sart))
                                         <img src="{{ asset('assets/images/mentor/sartono.jpg') }}" alt="Prof. Dr. Aloysius Sartono Kartodirdjo" class="w-20 h-20 rounded-full object-cover" loading="lazy">
                                     @elseif (file_exists($sartSvg))
                                         <img src="{{ asset('assets/images/mentor/sartono.svg') }}" alt="Prof. Dr. Aloysius Sartono Kartodirdjo" class="w-20 h-20 rounded-full object-cover" loading="lazy">
                                     @else
                                         <img src="{{ asset('assets/images/mentor/placeholder.png') }}" alt="Prof. Dr. Aloysius Sartono Kartodirdjo" class="w-20 h-20 rounded-full object-cover" loading="lazy">
                                     @endif
                            <div>
                                <h3 class="font-semibold text-lg text-[#7c6f57]">Prof. Dr. Aloysius Sartono Kartodirdjo</h3>
                                <p class="text-sm text-[#7c6f57]/60">Bapak Sejarah Indonesia</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-center bg-[#f5e9da] p-4 rounded-xl shadow border border-[#e9d8a6]">
                                     @php $ibnu = public_path('assets/images/mentor/ibnu-khaldun.jpg'); $ibnuSvg = public_path('assets/images/mentor/ibnu-khaldun.svg'); @endphp
                                     @if (file_exists($ibnu))
                                         <img src="{{ asset('assets/images/mentor/ibnu-khaldun.jpg') }}" alt="Ibnu Khaldun" class="w-20 h-20 rounded-full object-cover" loading="lazy">
                                     @elseif (file_exists($ibnuSvg))
                                         <img src="{{ asset('assets/images/mentor/ibnu-khaldun.svg') }}" alt="Ibnu Khaldun" class="w-20 h-20 rounded-full object-cover" loading="lazy">
                                     @else
                                         <img src="{{ asset('assets/images/mentor/placeholder.png') }}" alt="Ibnu Khaldun" class="w-20 h-20 rounded-full object-cover" loading="lazy">
                                     @endif
                            <div>
                                <h3 class="font-semibold text-lg text-[#7c6f57]">Ibnu Khaldun</h3>
                                <p class="text-sm text-[#7c6f57]/60">Bapak Filsafat Sejarah</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Testimonials -->
            <section class="pt-12 pb-8">
                <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4 text-center">
                    <h2 class="text-[#7c6f57] text-3xl font-semibold mb-6 drop-shadow history-heading">Suara Pembaca & Sejarawan</h2>
                    <div class="testimonial-slider grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-[#f5e9da] shadow rounded-lg p-6 border border-[#e9d8a6]">
                                     <img src="{{ asset('assets/images/testimonial/userone.png') }}" alt="user1" class="w-16 h-16 rounded-full mx-auto" loading="lazy">
                            <p class="mt-4">Great platform, excellent instructors.</p>
                            <p class="text-sm mt-3 text-[#7c6f57]/70">— Alvin</p>
                        </div>
                        <div class="bg-[#f5e9da] shadow rounded-lg p-6 border border-[#e9d8a6]">
                                     <img src="{{ asset('assets/images/testimonial/usertwo.png') }}" alt="user2" class="w-16 h-16 rounded-full mx-auto" loading="lazy">
                            <p class="mt-4">I was able to get a new job after the course.</p>
                            <p class="text-sm mt-3 text-[#7c6f57]/70">— Monica</p>
                        </div>
                        <div class="bg-[#f5e9da] shadow rounded-lg p-6 border border-[#e9d8a6]">
                                     <img src="{{ asset('assets/images/testimonial/userthree.png') }}" alt="user3" class="w-16 h-16 rounded-full mx-auto" loading="lazy">
                            <p class="mt-4">Highly recommend for practical learning.</p>
                            <p class="text-sm mt-3 text-[#7c6f57]/70">— Rahma</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Newsletter -->
            <section class="py-12 bg-[#e9d8a6]/40">
                <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
                    <div class="text-center">
                        <h2 class="text-2xl font-semibold mb-2 text-[#7c6f57]">Berlangganan Buletin Sejarah</h2>
                        <p class="text-[#7c6f57]/70 mb-4 italic">Dapatkan artikel, arsip, dan cerita sejarah terkini langsung ke kotak masukmu.</p>
                        <form class="max-w-xl mx-auto">
                            <div class="flex items-center gap-2">
                                <input type="email" name="email" placeholder="Email address" class="w-full p-4 rounded-xl bg-[#f5e9da]/60" />
                                <button type="submit" class="bg-[#7c6f57] text-white px-6 py-3 rounded-xl">Berlangganan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

@endsection