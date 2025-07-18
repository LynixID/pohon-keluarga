@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="mb-6 flex items-center">
        <a href="{{ route('family.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            Kembali ke Keluarga
        </a>
    </div>
    <h1 class="text-3xl font-bold mb-8 text-indigo-800">Anggota Keluarga: {{ $family->family_name }}</h1>
    @if(session('success'))
        <div class="flex items-center bg-green-50 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    <a href="{{ route('family.members.create', $family) }}" class="mb-4 inline-flex items-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
        Tambah Anggota
    </a>
    <div class="bg-white shadow rounded-lg p-6 overflow-x-auto">
        @if($members->count())
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="text-gray-600 border-b">
                        <th class="py-2 font-semibold">Nama</th>
                        <th class="font-semibold">Hubungan</th>
                        <th class="font-semibold">Gender</th>
                        <th class="font-semibold">Tanggal Lahir</th>
                        <th class="font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2">{{ $member->name }}</td>
                            <td>{{ $member->relation }}</td>
                            <td>{{ $member->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $member->birth_date ? date('d-m-Y', strtotime($member->birth_date)) : '-' }}</td>
                            <td>
                                <a href="{{ route('family.members.edit', [$family, $member]) }}" class="inline-flex items-center px-2 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13h3l8-8a2.828 2.828 0 10-4-4l-8 8v3z" /></svg>
                                    Edit
                                </a>
                                <form action="{{ route('family.members.destroy', [$family, $member]) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus anggota ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600">Belum ada anggota keluarga.</p>
        @endif
    </div>
</div>
@endsection 