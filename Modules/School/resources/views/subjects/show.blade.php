@extends('school::layouts.app')

@section('title', 'Detail Mata Pelajaran')
@section('header', 'Detail Mata Pelajaran')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-8 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="px-3 py-1 bg-white/20 rounded-full text-sm font-mono font-semibold">
                            {{ $subject->kode_mapel }}
                        </span>
                        @php
                            $kelompokNames = ['A' => 'Umum', 'B' => 'Kejuruan', 'C' => 'Pilihan'];
                        @endphp
                        <span class="px-3 py-1 bg-white/20 rounded-full text-xs">
                            Kelompok {{ $kelompokNames[$subject->kelompok] }}
                        </span>
                    </div>
                    <h2 class="text-3xl font-bold mb-2">{{ $subject->nama_mapel }}</h2>
                    <div class="flex gap-2 flex-wrap">
                        @foreach($subject->jenjang as $jenj)
                            <span class="px-2 py-1 bg-white/20 rounded text-sm">{{ $jenj }}</span>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('subjects.index') }}" class="px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg text-white">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <!-- Guru Pengampu -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800">
                        <i class="fas fa-chalkboard-teacher text-blue-600 mr-2"></i>
                        Guru Pengampu
                    </h3>
                    <span class="text-sm text-gray-600">
                        {{ $subject->teachers->count() }} guru
                    </span>
                </div>

                @if($subject->teachers->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($subject->teachers as $teacher)
                    <div class="border rounded-lg p-4 hover:shadow-md transition">
                        <div class="flex items-start gap-3">
                            <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                                {{ strtoupper(substr($teacher->nama_lengkap, 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">{{ $teacher->nama_lengkap }}</h4>
                                <p class="text-sm text-gray-600">NUPTK: {{ $teacher->nuptk ?? '-' }}</p>
                                <div class="mt-2">
                                    @if($teacher->is_sertifikasi)
                                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">
                                            <i class="fas fa-check-circle"></i> Sertifikasi
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('teachers.show', $teacher) }}"
                                class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12 bg-gray-50 rounded-lg">
                    <i class="fas fa-user-slash text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">Belum ada guru yang mengampu mata pelajaran ini</p>
                </div>
                @endif
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('subjects.edit', $subject) }}"
                    class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <form action="{{ route('subjects.destroy', $subject) }}" method="POST"
                    onsubmit="return confirm('Yakin hapus mata pelajaran ini?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        <i class="fas fa-trash mr-2"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
