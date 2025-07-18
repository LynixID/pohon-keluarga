@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="mb-4">
        <a href="{{ route('family.members.index', $family) }}" class="inline-block px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">← Kembali ke Daftar Anggota</a>
    </div>
    <h1 class="text-2xl font-bold mb-6">Edit Anggota Keluarga</h1>
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('family.members.update', [$family, $member]) }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Nama</label>
            <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" value="{{ old('name', $member->name) }}" required>
        </div>
        <div class="mb-4">
            <label for="relation" class="block font-semibold mb-1">Hubungan</label>
            <input type="text" name="relation" id="relation" class="w-full border rounded px-3 py-2" value="{{ old('relation', $member->relation) }}" required>
        </div>
        <div class="mb-4">
            <label for="gender" class="block font-semibold mb-1">Jenis Kelamin</label>
            <select name="gender" id="gender" class="w-full border rounded px-3 py-2" required>
                <option value="">Pilih</option>
                <option value="L" @if(old('gender', $member->gender)=='L') selected @endif>Laki-laki</option>
                <option value="P" @if(old('gender', $member->gender)=='P') selected @endif>Perempuan</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="birth_date" class="block font-semibold mb-1">Tanggal Lahir</label>
            <input type="date" name="birth_date" id="birth_date" class="w-full border rounded px-3 py-2" value="{{ old('birth_date', $member->birth_date) }}">
        </div>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Update</button>
        <a href="{{ route('family.members.index', $family) }}" class="ml-2 px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Batal</a>
    </form>
</div>
@endsection 