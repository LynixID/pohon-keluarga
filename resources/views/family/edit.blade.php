@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="mb-4">
        <a href="{{ route('dashboard') }}" class="inline-block px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">← Kembali ke Dashboard</a>
    </div>
    <h1 class="text-2xl font-bold mb-6">Edit Keluarga</h1>
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
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
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Update</button>
        <a href="{{ route('family.index') }}" class="ml-2 px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Batal</a>
    </form>
</div>
@endsection 