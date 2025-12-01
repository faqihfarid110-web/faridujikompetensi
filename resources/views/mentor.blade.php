@extends('layouts.app')
@section('title', 'Mentor Sejarah')
@section('content')
<div class="container mx-auto py-12">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl history-heading font-bold text-[#7c6f57] mb-2">Mentor & Siswa Sejarah</h1>
            <p class="history-font text-[#7c6f57]/80">Halaman mentor diganti menjadi manajemen siswa untuk kebutuhan e-learning dan literasi sejarah.</p>
        </div>
        <div>
            <a href="{{ route('students.index') }}" class="bg-[#7c6f57] text-white px-4 py-2 rounded-md">Kelola Siswa</a>
        </div>
    </div>
    <div class="mt-6">
        <p class="text-[#7c6f57]/70">Klik "Kelola Siswa" untuk membuka CRUD Siswa (Tambah/Edit/Hapus). Halaman ini menyesuaikan tema sejarah dan akan menampilkan daftar siswa yang mendaftar di kelas serta minat mereka terhadap topik sejarah.</p>
    </div>
</div>
@endsection
