@extends('school::layouts.app')

@section('title', 'Data Guru')
@section('header', 'Data Guru')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b flex justify-between items-center">
        <div class="flex gap-4">
            <form method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari NIK/NUPTK/Nama..." class="px-3 py-2 border rounded">
                <select name="status" class="px-3 py-2 border rounded">
                    <option value="">Semua Status</option>
                    @foreach(['aktif', 'cuti', 'pensiun', 'resign'] as $s)
                        <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded">Filter</button>
            </form>
        </div>
        <a href="{{ route('teachers.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">+ Tambah Guru</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIK/NUPTK</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status Kepegawaian</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mata Pelajaran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($teachers as $teacher)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm">
                            <div class="font-mono">{{ $teacher->nik }}</div>
                            @if($teacher->nuptk)
                                <div class="text-xs text-gray-500">{{ $teacher->nuptk }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">{{ $teacher->nama_lengkap }}</td>
                        <td class="px-6 py-4 text-sm">{{ $teacher->status_kepegawaian }}</td>
                        <td class="px-6 py-4 text-sm">
                            <div class="max-w-xs truncate">{{ $teacher->subjects->pluck('nama_mapel')->join(', ') }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 rounded text-xs
                                @if($teacher->status == 'aktif') bg-green-100 text-green-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst($teacher->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <a href="{{ route('teachers.show', $teacher) }}" class="text-blue-600 hover:underline">Lihat</a>
                            <a href="{{ route('teachers.edit', $teacher) }}" class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada data guru</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-6">{{ $teachers->links() }}</div>
</div>
@endsection
