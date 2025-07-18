@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="mb-4">
        <a href="{{ route('family.index') }}" class="inline-block px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">← Kembali ke Keluarga</a>
    </div>
    <h1 class="text-2xl font-bold mb-6">Anggota Keluarga: {{ $family->family_name }}</h1>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('family.members.create', $family) }}" class="mb-4 inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Tambah Anggota</a>
    <div class="bg-white shadow rounded-lg p-6">
        @if($members->count())
            <table class="w-full text-left">
                <thead>
                    <tr>
                        <th class="py-2">Nama</th>
                        <th>Hubungan</th>
                        <th>Gender</th>
                        <th>Tanggal Lahir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                        <tr>
                            <td class="py-2">{{ $member->name }}</td>
                            <td>{{ $member->relation }}</td>
                            <td>{{ $member->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $member->birth_date ? date('d-m-Y', strtotime($member->birth_date)) : '-' }}</td>
                            <td>
                                <a href="{{ route('family.members.edit', [$family, $member]) }}" class="px-2 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">Edit</a>
                                <form action="{{ route('family.members.destroy', [$family, $member]) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus anggota ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
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