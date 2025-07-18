@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="mb-4">
        <a href="{{ route('dashboard') }}" class="inline-block px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">← Kembali ke Dashboard</a>
    </div>
    <h1 class="text-2xl font-bold mb-6">Keluarga Saya</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if($family)
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold mb-2">{{ $family->family_name }}</h2>
            <p class="text-gray-700 mb-2">Deskripsi: {{ $family->description ?? '-' }}</p>
            <a href="{{ route('family.members.index', $family) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 mb-2">Lihat Anggota Keluarga</a>
            <a href="{{ route('family.edit', $family) }}" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Edit Keluarga</a>
            <form action="{{ route('family.destroy', $family) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Yakin ingin menghapus keluarga ini? Semua data akan hilang!');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus Keluarga</button>
            </form>
        </div>
    @else
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <p class="text-yellow-700">Anda belum memiliki keluarga. Silakan buat keluarga baru.</p>
        </div>
        <a href="{{ route('family.create') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Buat Keluarga</a>
    @endif
</div>
@endsection 