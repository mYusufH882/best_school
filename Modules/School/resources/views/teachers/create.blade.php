@extends('school::layouts.app')

@section('title', 'Tambah Guru')
@section('header', 'Tambah Guru')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('teachers.store') }}">
            @csrf

            <!-- Identitas -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Identitas Guru</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Sekolah <span class="text-red-500">*</span></label>
                        <select name="school_id" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Sekolah</option>
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}" {{ old('school_id') == $school->id ? 'selected' : '' }}>
                                    {{ $school->nama_sekolah }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">NIK <span class="text-red-500">*</span></label>
                        <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" placeholder="16 digit">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">NUPTK</label>
                        <input type="text" name="nuptk" value="{{ old('nuptk') }}" maxlength="16"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" placeholder="16 digit (opsional)">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">NIP</label>
                        <input type="text" name="nip" value="{{ old('nip') }}" maxlength="18"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500" placeholder="18 digit (PNS)">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Status Kepegawaian <span class="text-red-500">*</span></label>
                        <select name="status_kepegawaian" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih</option>
                            @foreach(['PNS', 'PPPK', 'GTY', 'GTT', 'Honorer'] as $status)
                                <option value="{{ $status }}" {{ old('status_kepegawaian') == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">No. HP <span class="text-red-500">*</span></label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" maxlength="15" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Pendidikan -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Pendidikan</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Pendidikan Terakhir <span class="text-red-500">*</span></label>
                        <select name="pendidikan_terakhir" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih</option>
                            @foreach(['SMA/Sederajat', 'D1', 'D2', 'D3', 'D4/S1', 'S2', 'S3'] as $pend)
                                <option value="{{ $pend }}" {{ old('pendidikan_terakhir') == $pend ? 'selected' : '' }}>{{ $pend }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Jurusan Pendidikan</label>
                        <input type="text" name="jurusan_pendidikan" value="{{ old('jurusan_pendidikan') }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Sertifikasi -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Sertifikasi</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_sertifikasi" value="1" {{ old('is_sertifikasi') ? 'checked' : '' }} class="rounded">
                            <span class="ml-2">Sudah Sertifikasi</span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">No. Sertifikat Pendidik</label>
                        <input type="text" name="no_sertifikat_pendidik" value="{{ old('no_sertifikat_pendidik') }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Tahun Sertifikasi</label>
                        <input type="number" name="tahun_sertifikasi" value="{{ old('tahun_sertifikasi') }}" min="2000" max="{{ date('Y') }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Mata Pelajaran -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Mata Pelajaran yang Diampu</h3>

                <div class="grid grid-cols-3 gap-2 max-h-60 overflow-y-auto border p-3 rounded">
                    @foreach($subjects as $subject)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="subjects[]" value="{{ $subject->id }}"
                                {{ in_array($subject->id, old('subjects', [])) ? 'checked' : '' }} class="rounded">
                            <span class="ml-2 text-sm">{{ $subject->nama_mapel }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Status & Tanggal -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Status & Tanggal</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Tanggal Mulai Tugas <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_mulai_tugas" value="{{ old('tanggal_mulai_tugas') }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Status</label>
                        <select name="status" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            @foreach(['aktif', 'cuti', 'pensiun', 'resign'] as $status)
                                <option value="{{ $status }}" {{ old('status', 'aktif') == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                <a href="{{ route('teachers.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
