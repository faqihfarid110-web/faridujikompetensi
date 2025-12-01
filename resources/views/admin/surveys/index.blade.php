@extends('layouts.admin')

@section('title', 'Data Survey')
@section('admin-title', 'Data Survey')
@section('admin-subtitle', 'Hasil submit survey dari pengunjung')
@section('admin-content')
<div class="py-6">
    <div class="bg-white rounded shadow p-6">
            <div class="mb-4 flex items-center justify-between">
                <p class="text-sm text-gray-600">Daftar hasil submit survey dari user.</p>
                @if(session('success'))
                    <div class="text-sm text-green-600">{{ session('success') }}</div>
                @endif
            </div>
        <table class="min-w-full bg-white overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th class="py-2 px-4 text-left">No</th>
            <th class="py-2 px-4 text-left">Nama</th>
            <th class="py-2 px-4 text-left">Email</th>
            <th class="py-2 px-4 text-left">Topik Minat</th>
            <th class="py-2 px-4 text-left">Alasan</th>
            <th class="py-2 px-4 text-left">Ekspektasi</th>
            <th class="py-2 px-4 text-left">Komentar</th>
            <th class="py-2 px-4 text-left">Tanggal</th>
            <th class="py-2 px-4 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($surveys as $i => $survey)
        <tr class="border-b">
            <td class="py-2 px-4">{{ $i+1 }}</td>
            <td class="py-2 px-4">{{ $survey->name ?? '-' }}</td>
            <td class="py-2 px-4">{{ $survey->email ?? '-' }}</td>
            <td class="py-2 px-4">{{ $survey->topic_interest ?? '-' }}</td>
            <td class="py-2 px-4">{{ $survey->reason ? 
                \Illuminate\Support\Str::limit($survey->reason, 120) : '-' }}</td>
            <td class="py-2 px-4">{{ $survey->expected_impact ?? '-' }}</td>
            <td class="py-2 px-4">{{ $survey->comments ?? '-' }}</td>
            <td class="py-2 px-4">{{ $survey->created_at ? $survey->created_at->format('Y-m-d H:i:s') : '-' }}</td>
            <td class="py-2 px-4">
                <form method="POST" action="{{ route('admin.surveys.destroy', $survey->id) }}" onsubmit="return confirm('Hapus survey ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="px-3 py-1 border rounded text-sm text-red-600">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="py-4 text-center text-gray-500">Belum ada data survey.</td>
        </tr>
        @endforelse
    </tbody>
        </table>
    </div>
</div>
@endsection
