@extends('layouts.admin')
@section('title', 'Edit Lukisan')
@section('admin-title', 'Edit Lukisan')
@section('admin-subtitle', 'Perbarui data lukisan dengan hati-hati')
@section('admin-content')
<div class="py-6">
    <div class="bg-white rounded shadow p-6">
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-100">
            <ul class="list-disc pl-5 text-sm text-red-600">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.paintings.update', [$continent, $p['slug']]) }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold">Benua</label>
                <select name="continent" class="w-full border p-2 rounded" disabled>
                    @foreach($continents as $c)
                        <option value="{{ $c }}" {{ strtolower($c) === $continent ? 'selected' : '' }}>{{ ucfirst($c) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold">Slug</label>
                <input name="slug" value="{{ $p['slug'] }}" class="w-full border p-2 rounded" />
            </div>
            <div>
                <label class="block text-sm font-semibold">Title</label>
                <input name="title" value="{{ $p['title'] }}" class="w-full border p-2 rounded" required />
            </div>
            <div>
                <label class="block text-sm font-semibold">Artist</label>
                <input name="artist" value="{{ $p['artist'] }}" class="w-full border p-2 rounded" />
            </div>
            <div>
                <label class="block text-sm font-semibold">Year</label>
                <input name="year" value="{{ $p['year'] }}" class="w-full border p-2 rounded" />
            </div>
            <div>
                <label class="block text-sm font-semibold">Image path</label>
                <input name="img" value="{{ $p['img'] }}" class="w-full border p-2 rounded" placeholder="assets/images/asia1.jpg" />
            </div>
        </div>
        <div class="mt-4">
            <label class="block text-sm font-semibold">Description</label>
            <textarea class="w-full border p-2 rounded" name="desc" rows="4">{{ $p['desc'] }}</textarea>
        </div>
        <div class="mt-4">
            <button class="px-4 py-2 bg-[#a68b5b] text-white rounded">Simpan Perubahan</button>
            <a href="{{ route('admin.paintings.index') }}" class="ml-2 text-sm">Batal</a>
        </div>
    </form>
    </div>
</div>
@endsection
