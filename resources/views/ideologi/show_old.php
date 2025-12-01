<?php
// backup of resources/views/ideologi/show.blade.php
// DO NOT EDIT - Backup file

?>
@extends('layouts.app')
@section('title', $title . ' — Sistem Pemerintahan')
@section('content')
<style>
	/* Lightweight linen texture background using CSS pseudo-element (no animation) */
	#ideologi-detail-page { position: relative; background-image: linear-gradient(#f5efe0, #efe6d5); }
	#ideologi-detail-page::before { content: ''; position: absolute; inset: 0; pointer-events: none; opacity: .06; background-image: repeating-linear-gradient(0deg, rgba(0,0,0,0.02) 0px, rgba(0,0,0,0.02) 1px, transparent 1px, transparent 20px), repeating-linear-gradient(90deg, rgba(0,0,0,0.02) 0px, rgba(0,0,0,0.02) 1px, transparent 1px, transparent 20px); }
	/* Remove heavy shadow and borders: prefer subtle spacings */
	.history-heading { font-weight: 700; }
</style>
<div id="ideologi-detail-page" class="relative min-h-screen w-full bg-[#f5efe0] overflow-hidden">
	<div class="container mx-auto py-12 lg:max-w-screen-xl relative z-10">
		<div class="py-8">
			<nav class="text-sm text-gray-500 mb-2"><a href="/" class="hover:underline">Beranda</a> &gt; <a href="/ideologi" class="hover:underline">Sistem Pemerintahan</a> &gt; <span class="text-gray-800 font-semibold">{{ \Illuminate\Support\Str::limit($title, 40) }}</span></nav>
			<h1 class="text-3xl lg:text-4xl font-bold text-[#3a372d] history-heading mb-4 text-center">{{ $title }}</h1>
			<div class="flex flex-col items-center">
				<img src="{{ asset($img) }}" alt="{{ $title }}" class="w-[280px] md:w-[320px] lg:w-[300px] h-auto object-cover rounded-sm mb-4" loading="lazy">
				<!-- Area galeri foto tambahan -->
				<div id="gallery" class="flex flex-wrap gap-4 justify-center mb-6"></div>
			</div>
			<p class="text-base text-[#7c6f57] font-semibold mb-6 text-center">{{ $summary }}</p>
			<div class="prose max-w-none text-gray-800 mb-6 mx-auto">{!! nl2br(e($content)) !!}</div>
		</div>
	</div>
</div>
<script>
// Background is now static to reduce CPU usage and keep a light layout
</script>
@endsection
