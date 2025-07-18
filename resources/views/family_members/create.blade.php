@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="mb-6 flex items-center">
        <a href="{{ route('family.members.index', $family) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            Kembali ke Daftar Anggota
        </a>
    </div>
    <h1 class="text-3xl font-bold mb-8 text-indigo-800">Tambah Anggota Keluarga</h1>
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
    <form action="{{ route('family.members.store', $family) }}" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Nama</label>
            <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" value="{{ old('name') }}" required>
        </div>
        <div class="mb-4">
            <label for="relation" class="block font-semibold mb-1">Hubungan</label>
            <input type="text" name="relation" id="relation" class="w-full border rounded px-3 py-2" value="{{ old('relation') }}" required>
        </div>
        <div class="mb-4">
            <label for="gender" class="block font-semibold mb-1">Jenis Kelamin</label>
            <select name="gender" id="gender" class="w-full border rounded px-3 py-2" required>
                <option value="">Pilih</option>
                <option value="L" @if(old('gender')=='L') selected @endif>Laki-laki</option>
                <option value="P" @if(old('gender')=='P') selected @endif>Perempuan</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="birth_date" class="block font-semibold mb-1">Tanggal Lahir</label>
            <input type="date" name="birth_date" id="birth_date" class="w-full border rounded px-3 py-2" value="{{ old('birth_date') }}">
        </div>
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
            Simpan
        </button>
        <a href="{{ route('family.members.index', $family) }}" class="ml-2 px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Batal</a>
    </form>
</div>
@endsection 