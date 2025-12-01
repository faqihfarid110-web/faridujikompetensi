@extends('layouts.app')
@section('title', 'Tambah Siswa')
@section('content')
<div class="container mx-auto lg:max-w-screen-xl px-4">
    <div class="mb-4">
        <h1 class="text-2xl history-heading text-[#7c6f57] font-bold">Tambah Siswa</h1>
    </div>
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded-lg border">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full p-2 border rounded" required />
            </div>
            <div>
                <label class="block mb-1">Angkatan / Tahun</label>
                <input type="text" name="class_year" value="{{ old('class_year') }}" class="w-full p-2 border rounded" />
            </div>
            <div>
                <label class="block mb-1">Minat</label>
                <input type="text" name="major_interest" value="{{ old('major_interest') }}" class="w-full p-2 border rounded" />
            </div>
            <div>
                <label class="block mb-1">Foto (opsional)</label>
                <input type="file" name="photo" class="w-full p-2 border rounded" accept="image/*" />
            </div>
            <div class="md:col-span-2">
                <label class="block mb-1">Bio singkat</label>
                <textarea name="bio" class="w-full p-2 border rounded" rows="4">{{ old('bio') }}</textarea>
            </div>
        </div>
        <div class="mt-4">
            <button class="px-4 py-2 bg-[#7c6f57] text-white rounded">Simpan</button>
            <a href="{{ route('students.index') }}" class="px-4 py-2 border rounded ml-2">Batal</a>
        </div>
    </form>
</div>
@endsection
