@extends('school::layouts.app')

@section('title', 'Data Guru')
@section('header', 'Data Guru')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-3xl font-bold text-gray-800">Daftar Guru</h2>
        <p class="text-gray-600 mt-1">Kelola data guru dan tenaga pendidik</p>
    </div>
    <a href="{{ route('teachers.create') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 flex items-center gap-2 shadow-lg">
        <i class="fas fa-plus"></i> Tambah Guru
    </a>
</div>

<!-- Filter -->
<div class="bg-white p-4 rounded-lg shadow mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="md:col-span-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari NIK, NUPTK, atau nama guru..."
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500">
        </div>
        <div>
            <select name="status" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-purple-500">
                <option value="">-- Semua Status --</option>
                @foreach(['aktif', 'cuti', 'pensiun', 'resign'] as $s)
                    <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>
                        {{ ucfirst($s) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="flex-1 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                <i class="fas fa-search mr-2"></i> Filter
            </button>
            <a href="{{ route('teachers.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                <i class="fas fa-redo"></i>
            </a>
        </div>
    </form>
</div>

<!-- Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gradient-to-r from-purple-600 to-purple-700">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">NIK/NUPTK</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Nama Guru</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Status Kepegawaian</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Mata Pelajaran</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($teachers as $teacher)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    <div class="text-xs font-mono font-semibold text-gray-800 bg-gray-100 px-2 py-1 rounded inline-block">
                        {{ $teacher->nik }}
                    </div>
                    @if($teacher->nuptk)
                        <div class="text-xs text-gray-500 mt-1">NUPTK: {{ $teacher->nuptk }}</div>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="font-semibold text-gray-900">{{ $teacher->nama_lengkap }}</div>
                    <div class="text-sm text-gray-500">{{ $teacher->email ?? '-' }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @php
                        $kepegColors = [
                            'PNS' => 'bg-blue-100 text-blue-800',
                            'PPPK' => 'bg-green-100 text-green-800',
                            'GTY' => 'bg-yellow-100 text-yellow-800',
                            'GTT' => 'bg-orange-100 text-orange-800',
                            'Honorer' => 'bg-gray-100 text-gray-800'
                        ];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $kepegColors[$teacher->status_kepegawaian] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ $teacher->status_kepegawaian }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex flex-wrap gap-1 max-w-xs">
                        @forelse($teacher->subjects->take(3) as $subject)
                            <span class="px-2 py-0.5 bg-purple-50 text-purple-700 rounded text-xs">
                                {{ $subject->nama_mapel }}
                            </span>
                        @empty
                            <span class="text-xs text-gray-400">Belum ada mapel</span>
                        @endforelse
                        @if($teacher->subjects->count() > 3)
                            <span class="px-2 py-0.5 bg-gray-200 text-gray-600 rounded text-xs">
                                +{{ $teacher->subjects->count() - 3 }}
                            </span>
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @php
                        $statusColors = [
                            'aktif' => 'bg-green-100 text-green-800',
                            'cuti' => 'bg-yellow-100 text-yellow-800',
                            'pensiun' => 'bg-blue-100 text-blue-800',
                            'resign' => 'bg-red-100 text-red-800'
                        ];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$teacher->status] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($teacher->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('teachers.show', $teacher) }}"
                            class="px-3 py-1.5 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('teachers.edit', $teacher) }}"
                            class="px-3 py-1.5 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="inline"
                            onsubmit="return confirm('Yakin hapus data guru ini?')">
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
                    <p class="text-lg">Belum ada data guru</p>
                    <a href="{{ route('teachers.create') }}" class="text-purple-600 hover:underline mt-2 inline-block">
                        Tambah guru pertama
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $teachers->links() }}
</div>
@endsection
