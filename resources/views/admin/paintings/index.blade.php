@extends('layouts.admin')
@section('title', 'Admin Lukisan')
@section('admin-title', 'Lukisan — Data & Ratings')
@section('admin-subtitle', 'Kelola daftar lukisan, rating, dan komentar di sini')
@section('admin-content')
<div class="py-6">
    <div class="bg-white rounded shadow p-6">
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 border border-green-100 text-green-700">{{ session('success') }}</div>
    @endif
    <div class="flex items-center justify-between mb-4">
        <div></div>
        <a href="{{ route('admin.paintings.create') }}" class="px-4 py-2 bg-[#a68b5b] text-white rounded">Tambah Lukisan</a>
    </div>
    <div class="overflow-x-auto"> 
        <table class="min-w-full bg-white border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">Slug</th>
                    <th class="px-4 py-2 text-left">Title</th>
                    <th class="px-4 py-2">Continent</th>
                    <th class="px-4 py-2">Avg Rating</th>
                    <th class="px-4 py-2">Votes</th>
                    <th class="px-4 py-2">Comments</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($rows as $row)
                <tr class="border-t">
                    <td class="px-4 py-2 text-sm">{{ $row['slug'] }}</td>
                    <td class="px-4 py-2 text-sm">{{ $row['title'] }}</td>
                    <td class="px-4 py-2 text-sm">{{ $row['continent'] }}</td>
                    <td class="px-4 py-2 text-sm">{{ $row['avg'] }}</td>
                    <td class="px-4 py-2 text-sm">{{ $row['count'] }}</td>
                    <td class="px-4 py-2 text-sm">
                        @if(count($row['comments']))
                            <ul class="list-disc pl-5">
                                @foreach($row['comments'] as $c)
                                    <li><small>{{ $c['time'] }} — {{ \Illuminate\Support\Str::limit($c['comment'], 120) }}</small></li>
                                @endforeach
                            </ul>
                        @else
                            —
                        @endif
                    </td>
                    <td class="px-4 py-2 text-sm">
                        <a class="px-3 py-1 bg-[#a68b5b] text-white rounded text-sm" href="{{ route('admin.paintings.edit', [strtolower($row['continent']), $row['slug']]) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.paintings.destroy', [strtolower($row['continent']), $row['slug']]) }}" style="display:inline;" onsubmit="return confirm('Hapus lukisan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 ml-2 border rounded text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
