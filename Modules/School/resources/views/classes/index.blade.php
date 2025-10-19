@extends('school::layouts.app')

@section('title', 'Data Kelas')
@section('header', 'Data Kelas')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b flex justify-between items-center">
        <form method="GET" class="flex gap-2">
            <input type="text" name="tahun_ajaran" value="{{ request('tahun_ajaran') }}" placeholder="Tahun Ajaran" class="px-3 py-2 border rounded">
            <input type="text" name="tingkat" value="{{ request('tingkat') }}" placeholder="Tingkat" class="px-3 py-2 border rounded w-24">
            <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded">Filter</button>
        </form>
        <a href="{{ route('classes.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">+ Tambah Kelas</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kelas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tingkat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Wali Kelas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tahun Ajaran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Siswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($classes as $class)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium">{{ $class->nama_kelas }}</td>
                        <td class="px-6 py-4 text-sm">{{ $class->tingkat }}</td>
                        <td class="px-6 py-4 text-sm">{{ $class->waliKelas->nama_lengkap ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm">{{ $class->tahun_ajaran }} Sem {{ $class->semester }}</td>
                        <td class="px-6 py-4 text-sm">{{ $class->jumlah_siswa_saat_ini }}/{{ $class->kapasitas_maksimal }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 rounded text-xs {{ $class->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                {{ ucfirst($class->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <a href="{{ route('classes.show', $class) }}" class="text-blue-600 hover:underline">Lihat</a>
                            <a href="{{ route('classes.edit', $class) }}" class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('classes.destroy', $class) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-6 py-8 text-center text-gray-500">Belum ada data kelas</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-6">{{ $classes->links() }}</div>
</div>
@endsection
