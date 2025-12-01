@extends('layouts.app')
@section('title', 'Siswa Sejarah')
@section('content')
<div class="container mx-auto lg:max-w-screen-xl px-4">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl history-heading text-[#7c6f57] font-bold">Data Siswa</h1>
            <p class="text-sm text-[#7c6f57]/80 history-font">Manajemen murid yang mempelajari sejarah dalam platform literasi / e-learning.</p>
        </div>
        <div>
            <a href="{{ route('students.create') }}" class="bg-[#7c6f57] text-white px-4 py-2 rounded-md">Tambah Siswa</a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @php use Illuminate\Support\Str; @endphp
        @forelse ($students as $student)
            <div class="bg-[#f5e9da] p-4 rounded-lg border border-[#e9d8a6] shadow">
                <div class="flex flex-col items-center">
                    <img src="{{ $student->photo ?? asset('assets/images/mentor/placeholder.png') }}" alt="{{ $student->name }}" class="w-24 h-24 rounded-full mb-2 object-cover">
                    <h3 class="font-semibold text-[#7c6f57]">{{ $student->name }}</h3>
                    <p class="text-sm text-[#7c6f57]/70">{{ $student->class_year }} — {{ $student->major_interest }}</p>
                    <p class="text-sm text-black/60 mt-2">{{ Str::limit($student->bio, 120) }}</p>
                </div>

                <div class="mt-4 flex justify-between">
                    <a href="{{ route('students.edit', $student) }}" class="px-3 py-2 bg-[#b7b7a4] text-white rounded-md">Edit</a>
                    <form action="{{ route('students.destroy', $student) }}" method="post" onsubmit="return confirm('Hapus siswa ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-2 bg-red-500 text-white rounded-md">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white p-4 rounded-lg">Belum ada siswa terdaftar.</div>
        @endforelse
    </div>

    <div class="mt-4">{{ $students->links() }}</div>
</div>
@endsection
