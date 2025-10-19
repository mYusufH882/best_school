@extends('school::layouts.app')

@section('title', 'Tambah Kelas')
@section('header', 'Tambah Kelas')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('classes.store') }}">
            @csrf

            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Informasi Kelas</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Sekolah <span class="text-red-500">*</span></label>
                        <select name="school_id" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Sekolah</option>
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}" {{ old('school_id') == $school->id ? 'selected' : '' }}>{{ $school->nama_sekolah }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Nama Kelas <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" placeholder="7A, X IPA 1">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Tingkat <span class="text-red-500">*</span></label>
                        <input type="text" name="tingkat" value="{{ old('tingkat') }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" placeholder="7, X">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Jurusan</label>
                        <input type="text" name="jurusan" value="{{ old('jurusan') }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" placeholder="IPA, IPS, TKJ">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Rombel <span class="text-red-500">*</span></label>
                        <input type="text" name="rombel" value="{{ old('rombel') }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" placeholder="A, 1">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Ruang Kelas</label>
                        <input type="text" name="ruang_kelas" value="{{ old('ruang_kelas') }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" placeholder="Ruang 7A">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Tahun Ajaran <span class="text-red-500">*</span></label>
                        <input type="text" name="tahun_ajaran" value="{{ old('tahun_ajaran', date('Y') . '/' . (date('Y')+1)) }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" placeholder="2024/2025">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Semester <span class="text-red-500">*</span></label>
                        <select name="semester" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="1" {{ old('semester', '1') == '1' ? 'selected' : '' }}>Ganjil (1)</option>
                            <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>Genap (2)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Kapasitas Maksimal <span class="text-red-500">*</span></label>
                        <input type="number" name="kapasitas_maksimal" value="{{ old('kapasitas_maksimal', 36) }}" required min="1"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Wali Kelas</label>
                        <select name="wali_kelas_id" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Wali Kelas</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('wali_kelas_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Status</label>
                        <select name="status" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            @foreach(['aktif', 'lulus', 'nonaktif'] as $status)
                                <option value="{{ $status }}" {{ old('status', 'aktif') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                <a href="{{ route('classes.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
