@extends('school::layouts.app')

@section('title', 'Tambah Mata Pelajaran')
@section('header', 'Tambah Mata Pelajaran')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Form Mata Pelajaran Baru</h2>
            <a href="{{ route('subjects.index') }}" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <form action="{{ route('subjects.store') }}" method="POST">
            @csrf

            <!-- Kode & Nama -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700">
                        Kode Mata Pelajaran <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kode_mapel" value="{{ old('kode_mapel') }}"
                        placeholder="Contoh: MTK, BIND" maxlength="10" required
                        class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kode_mapel') border-red-500 @enderror">
                    @error('kode_mapel')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700">
                        Kelompok <span class="text-red-500">*</span>
                    </label>
                    <select name="kelompok" required
                        class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kelompok') border-red-500 @enderror">
                        <option value="">-- Pilih Kelompok --</option>
                        <option value="A" {{ old('kelompok') == 'A' ? 'selected' : '' }}>A - Umum (Wajib)</option>
                        <option value="B" {{ old('kelompok') == 'B' ? 'selected' : '' }}>B - Kejuruan</option>
                        <option value="C" {{ old('kelompok') == 'C' ? 'selected' : '' }}>C - Pilihan</option>
                    </select>
                    @error('kelompok')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold mb-2 text-gray-700">
                    Nama Mata Pelajaran <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_mapel" value="{{ old('nama_mapel') }}"
                    placeholder="Contoh: Matematika" required
                    class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama_mapel') border-red-500 @enderror">
                @error('nama_mapel')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jenjang -->
            <div class="mb-6">
                <label class="block text-sm font-semibold mb-3 text-gray-700">
                    Jenjang yang Menggunakan <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-4 gap-3">
                    @foreach(['TK', 'RA', 'SD', 'MI', 'Diniyah', 'SMP', 'MTs', 'SMA', 'MA', 'SMK'] as $jenj)
                    <label class="flex items-center px-4 py-3 border rounded-lg hover:bg-blue-50 cursor-pointer transition @error('jenjang') border-red-500 @enderror">
                        <input type="checkbox" name="jenjang[]" value="{{ $jenj }}"
                            {{ in_array($jenj, old('jenjang', [])) ? 'checked' : '' }}
                            class="rounded text-blue-600 focus:ring-2 focus:ring-blue-500 mr-2">
                        <span class="text-sm font-medium text-gray-700">{{ $jenj }}</span>
                    </label>
                    @endforeach
                </div>
                @error('jenjang')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-info-circle"></i> Pilih minimal 1 jenjang
                </p>
            </div>

            <!-- Info Card -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                <div class="flex">
                    <i class="fas fa-info-circle text-blue-500 mr-3 mt-0.5"></i>
                    <div class="text-sm text-blue-800">
                        <p class="font-semibold mb-1">Panduan Kelompok:</p>
                        <ul class="list-disc ml-4 space-y-1">
                            <li><strong>Kelompok A:</strong> Mata pelajaran umum/wajib (PAI, PKN, Matematika, dll)</li>
                            <li><strong>Kelompok B:</strong> Mata pelajaran kejuruan (Prakarya, Seni Budaya, dll)</li>
                            <li><strong>Kelompok C:</strong> Mata pelajaran pilihan/peminatan (Fisika, Ekonomi, dll)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('subjects.index') }}"
                    class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
