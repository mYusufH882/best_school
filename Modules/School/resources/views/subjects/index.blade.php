@extends('school::layouts.app')

@section('title', 'Mata Pelajaran')
@section('header', 'Mata Pelajaran')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-3xl font-bold text-gray-800">Daftar Mata Pelajaran</h2>
        <p class="text-gray-600 mt-1">Kelola mata pelajaran sesuai Kurikulum Merdeka</p>
    </div>
    <a href="{{ route('subjects.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah Mata Pelajaran
    </a>
</div>

<!-- Filter -->
<div class="bg-white p-4 rounded-lg shadow mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari nama/kode mapel..."
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <select name="kelompok" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">-- Semua Kelompok --</option>
                <option value="A" {{ request('kelompok') == 'A' ? 'selected' : '' }}>Kelompok A (Umum)</option>
                <option value="B" {{ request('kelompok') == 'B' ? 'selected' : '' }}>Kelompok B (Kejuruan)</option>
                <option value="C" {{ request('kelompok') == 'C' ? 'selected' : '' }}>Kelompok C (Pilihan)</option>
            </select>
        </div>
        <div>
            <select name="jenjang" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">-- Semua Jenjang --</option>
                @foreach(['SD', 'MI', 'SMP', 'MTs', 'SMA', 'MA', 'SMK'] as $jenj)
                    <option value="{{ $jenj }}" {{ request('jenjang') == $jenj ? 'selected' : '' }}>{{ $jenj }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                <i class="fas fa-search mr-2"></i> Filter
            </button>
            <a href="{{ route('subjects.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                <i class="fas fa-redo"></i>
            </a>
        </div>
    </form>
</div>

<!-- Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gradient-to-r from-blue-600 to-blue-700">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Kode</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Nama Mata Pelajaran</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Kelompok</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Jenjang</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Guru Pengampu</th>
                <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($subjects as $subject)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-mono font-semibold">
                        {{ $subject->kode_mapel }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="font-semibold text-gray-900">{{ $subject->nama_mapel }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @php
                        $kelompokColors = [
                            'A' => 'bg-green-100 text-green-800',
                            'B' => 'bg-yellow-100 text-yellow-800',
                            'C' => 'bg-purple-100 text-purple-800'
                        ];
                        $kelompokNames = [
                            'A' => 'Umum',
                            'B' => 'Kejuruan',
                            'C' => 'Pilihan'
                        ];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $kelompokColors[$subject->kelompok] }}">
                        {{ $kelompokNames[$subject->kelompok] }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex flex-wrap gap-1">
                        @foreach($subject->jenjang as $jenj)
                            <span class="px-2 py-0.5 bg-blue-50 text-blue-700 rounded text-xs">{{ $jenj }}</span>
                        @endforeach
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="text-sm text-gray-600">{{ $subject->teachers->count() }} guru</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('subjects.show', $subject) }}"
                            class="px-3 py-1.5 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('subjects.edit', $subject) }}"
                            class="px-3 py-1.5 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="inline"
                            onsubmit="return confirm('Yakin hapus mata pelajaran ini?')">
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
                    <p class="text-lg">Belum ada mata pelajaran</p>
                    <a href="{{ route('subjects.create') }}" class="text-blue-600 hover:underline mt-2 inline-block">
                        Tambah mata pelajaran pertama
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $subjects->links() }}
</div>
@endsection
