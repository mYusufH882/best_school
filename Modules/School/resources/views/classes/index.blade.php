@extends('school::layouts.app')

@section('title', 'Data Kelas')
@section('header', 'Data Kelas')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-3xl font-bold text-gray-800">Daftar Kelas</h2>
        <p class="text-gray-600 mt-1">Kelola data kelas dan rombongan belajar</p>
    </div>
    <a href="{{ route('classes.create') }}" class="px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 flex items-center gap-2 shadow-lg">
        <i class="fas fa-plus"></i> Tambah Kelas
    </a>
</div>

<!-- Filter -->
<div class="bg-white p-4 rounded-lg shadow mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <input type="text" name="tahun_ajaran" value="{{ request('tahun_ajaran') }}"
                placeholder="Tahun Ajaran (2024/2025)"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-pink-500">
        </div>
        <div>
            <input type="text" name="tingkat" value="{{ request('tingkat') }}"
                placeholder="Tingkat (10, 11, 12)"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-pink-500">
        </div>
        <div>
            <select name="status" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-pink-500">
                <option value="">-- Semua Status --</option>
                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="flex-1 px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700">
                <i class="fas fa-search mr-2"></i> Filter
            </button>
            <a href="{{ route('classes.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                <i class="fas fa-redo"></i>
            </a>
        </div>
    </form>
</div>

<!-- Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gradient-to-r from-pink-600 to-rose-700">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Nama Kelas</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Tingkat</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Wali Kelas</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Tahun Ajaran</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Kapasitas</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($classes as $class)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    <div class="font-semibold text-gray-900">{{ $class->nama_kelas }}</div>
                    @if($class->ruang_kelas)
                        <div class="text-xs text-gray-500">Ruang: {{ $class->ruang_kelas }}</div>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-pink-100 text-pink-800 rounded-full text-xs font-semibold">
                        Tingkat {{ $class->tingkat }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900">
                        {{ $class->waliKelas->nama_lengkap ?? '-' }}
                    </div>
                    @if($class->waliKelas)
                        <div class="text-xs text-gray-500">{{ $class->waliKelas->nuptk ?? 'GTT' }}</div>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $class->tahun_ajaran }}</div>
                    <div class="text-xs text-gray-500">Semester {{ $class->semester }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @php
                        $percentage = $class->kapasitas_maksimal > 0
                            ? ($class->jumlah_siswa_saat_ini / $class->kapasitas_maksimal) * 100
                            : 0;
                        $capacityColor = $percentage >= 100 ? 'text-red-600' : ($percentage >= 80 ? 'text-yellow-600' : 'text-green-600');
                    @endphp
                    <div class="flex items-center gap-2">
                        <span class="font-semibold {{ $capacityColor }}">
                            {{ $class->jumlah_siswa_saat_ini }}/{{ $class->kapasitas_maksimal }}
                        </span>
                        <div class="flex-1 bg-gray-200 rounded-full h-2 w-20">
                            <div class="bg-pink-600 h-2 rounded-full" style="width: {{ min($percentage, 100) }}%"></div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $class->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($class->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('classes.show', $class) }}"
                            class="px-3 py-1.5 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('classes.edit', $class) }}"
                            class="px-3 py-1.5 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('classes.destroy', $class) }}" method="POST" class="inline"
                            onsubmit="return confirm('Yakin hapus data kelas ini?')">
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
                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-3"></i>
                    <p class="text-lg">Belum ada data kelas</p>
                    <a href="{{ route('classes.create') }}" class="text-pink-600 hover:underline mt-2 inline-block">
                        Tambah kelas pertama
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $classes->links() }}
</div>
@endsection
