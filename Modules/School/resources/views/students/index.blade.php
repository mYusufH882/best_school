@extends('school::layouts.app')

@section('title', 'Data Siswa')
@section('header', 'Data Siswa')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b flex justify-between items-center">
        <div class="flex gap-4">
            <form method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari NISN/Nama..." class="px-3 py-2 border rounded">
                <select name="status" class="px-3 py-2 border rounded">
                    <option value="">Semua Status</option>
                    @foreach(['aktif', 'lulus', 'pindah', 'keluar'] as $s)
                        <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>
                            {{ ucfirst($s) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded">Filter</button>
            </form>
        </div>
        <a href="{{ route('students.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Tambah Siswa
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NISN</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">JK</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">TTL</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($students as $student)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-mono">{{ $student->nisn }}</td>
                        <td class="px-6 py-4 text-sm font-medium">{{ $student->nama_lengkap }}</td>
                        <td class="px-6 py-4 text-sm">{{ $student->jenis_kelamin }}</td>
                        <td class="px-6 py-4 text-sm">{{ $student->tempat_lahir }}, {{ $student->tanggal_lahir->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-2 py-1 rounded text-xs
                                @if($student->status == 'aktif') bg-green-100 text-green-700
                                @elseif($student->status == 'lulus') bg-blue-100 text-blue-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst($student->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <a href="{{ route('students.show', $student) }}" class="text-blue-600 hover:underline">Lihat</a>
                            <a href="{{ route('students.edit', $student) }}" class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            Belum ada data siswa
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-6">
        {{ $students->links() }}
    </div>
</div>
@endsection
