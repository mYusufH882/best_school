@extends('school::layouts.app')

@section('title', 'Data Siswa')
@section('header', 'Data Siswa')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-3xl font-bold text-gray-800">Daftar Siswa</h2>
        <p class="text-gray-600 mt-1">Kelola data siswa sekolah</p>
    </div>
    <a href="{{ route('students.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center gap-2 shadow-lg">
        <i class="fas fa-plus"></i> Tambah Siswa
    </a>
</div>

<!-- Filter -->
<div class="bg-white p-4 rounded-lg shadow mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="md:col-span-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari NISN atau nama siswa..."
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-green-500">
        </div>
        <div>
            <select name="status" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-green-500">
                <option value="">-- Semua Status --</option>
                @foreach(['aktif', 'lulus', 'pindah', 'keluar', 'cuti'] as $st)
                    <option value="{{ $st }}" {{ request('status') == $st ? 'selected' : '' }}>
                        {{ ucfirst($st) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                <i class="fas fa-search mr-2"></i> Filter
            </button>
            <a href="{{ route('students.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                <i class="fas fa-redo"></i>
            </a>
        </div>
    </form>
</div>

<!-- Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gradient-to-r from-green-600 to-emerald-700">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">NISN</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Nama Lengkap</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">JK</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Kelas</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($students as $student)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-mono font-semibold">
                        {{ $student->nisn }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="font-semibold text-gray-900">{{ $student->nama_lengkap }}</div>
                    <div class="text-sm text-gray-500">NIK: {{ $student->nik }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $student->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                        {{ $student->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="text-sm text-gray-600">
                        {{ $student->classes->first()->nama_kelas ?? '-' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @php
                        $statusColors = [
                            'aktif' => 'bg-green-100 text-green-800',
                            'lulus' => 'bg-blue-100 text-blue-800',
                            'pindah' => 'bg-yellow-100 text-yellow-800',
                            'keluar' => 'bg-red-100 text-red-800',
                            'cuti' => 'bg-gray-100 text-gray-800'
                        ];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$student->status] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($student->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('students.show', $student) }}"
                            class="px-3 py-1.5 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('students.edit', $student) }}"
                            class="px-3 py-1.5 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline"
                            onsubmit="return confirm('Yakin hapus data siswa ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-3"></i>
                    <p class="text-lg">Belum ada data siswa</p>
                    <a href="{{ route('students.create') }}" class="text-green-600 hover:underline mt-2 inline-block">
                        Tambah siswa pertama
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $students->links() }}
</div>
@endsection
