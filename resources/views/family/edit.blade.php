@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="mb-6 flex items-center">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            Kembali ke Dashboard
        </a>
    </div>
    <h1 class="text-3xl font-bold mb-8 text-indigo-800">Edit Keluarga</h1>
    @if($errors->any())
        <div class="flex items-center bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('family.update', $family) }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="family_name" class="block font-semibold mb-1">Nama Keluarga</label>
            <input type="text" name="family_name" id="family_name" class="w-full border rounded px-3 py-2" value="{{ old('family_name', $family->family_name) }}" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Deskripsi (opsional)</label>
            <textarea name="description" id="description" class="w-full border rounded px-3 py-2">{{ old('description', $family->description) }}</textarea>
        </div>
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13h3l8-8a2.828 2.828 0 10-4-4l-8 8v3z" /></svg>
            Update
        </button>
        <a href="{{ route('family.index') }}" class="ml-2 px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Batal</a>
    </form>
</div>
@endsection 