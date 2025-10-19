@extends('school::layouts.app')

@section('title', 'Edit Guru')
@section('header', 'Edit Guru')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('teachers.update', $teacher) }}">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Identitas Guru</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Sekolah <span class="text-red-500">*</span></label>
                        <select name="school_id" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}" {{ old('school_id', $teacher->school_id) == $school->id ? 'selected' : '' }}>{{ $school->nama_sekolah }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">NIK <span class="text-red-500">*</span></label>
                        <input type="text" name="nik" value="{{ old('nik', $teacher->nik) }}" maxlength="16" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">NUPTK</label>
                        <input type="text" name="nuptk" value="{{ old('nuptk', $teacher->nuptk) }}" maxlength="16" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">NIP</label>
                        <input type="text" name="nip" value="{{ old('nip', $teacher->nip) }}" maxlength="18" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $teacher->nama_lengkap) }}" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="L" {{ old('jenis_kelamin', $teacher->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $teacher->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Status Kepegawaian <span class="text-red-500">*</span></label>
                        <select name="status_kepegawaian" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            @foreach(['PNS', 'PPPK', 'GTY', 'GTT', 'Honorer'] as $status)
                                <option value="{{ $status }}" {{ old('status_kepegawaian', $teacher->status_kepegawaian) == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $teacher->tempat_lahir) }}" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $teacher->tanggal_lahir->format('Y-m-d')) }}" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">No. HP <span class="text-red-500">*</span></label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $teacher->no_hp) }}" maxlength="15" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $teacher->email) }}" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Pendidikan</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Pendidikan Terakhir <span class="text-red-500">*</span></label>
                        <select name="pendidikan_terakhir" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            @foreach(['SMA/Sederajat', 'D1', 'D2', 'D3', 'D4/S1', 'S2', 'S3'] as $pend)
                                <option value="{{ $pend }}" {{ old('pendidikan_terakhir', $teacher->pendidikan_terakhir) == $pend ? 'selected' : '' }}>{{ $pend }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Jurusan Pendidikan</label>
                        <input type="text" name="jurusan_pendidikan" value="{{ old('jurusan_pendidikan', $teacher->jurusan_pendidikan) }}" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Sertifikasi</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_sertifikasi" value="1" {{ old('is_sertifikasi', $teacher->is_sertifikasi) ? 'checked' : '' }} class="rounded">
                            <span class="ml-2">Sudah Sertifikasi</span>
                        </label>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">No. Sertifikat</label>
                        <input type="text" name="no_sertifikat_pendidik" value="{{ old('no_sertifikat_pendidik', $teacher->no_sertifikat_pendidik) }}" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Tahun Sertifikasi</label>
                        <input type="number" name="tahun_sertifikasi" value="{{ old('tahun_sertifikasi', $teacher->tahun_sertifikasi) }}" min="2000" max="{{ date('Y') }}" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Mata Pelajaran</h3>
                <div class="grid grid-cols-3 gap-2 max-h-60 overflow-y-auto border p-3 rounded">
                    @foreach($subjects as $subject)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="subjects[]" value="{{ $subject->id }}"
                                {{ in_array($subject->id, old('subjects', $teacher->subjects->pluck('id')->toArray())) ? 'checked' : '' }} class="rounded">
                            <span class="ml-2 text-sm">{{ $subject->nama_mapel }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Status & Tanggal</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Tanggal Mulai Tugas <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_mulai_tugas" value="{{ old('tanggal_mulai_tugas', $teacher->tanggal_mulai_tugas->format('Y-m-d')) }}" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Status</label>
                        <select name="status" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            @foreach(['aktif', 'cuti', 'pensiun', 'resign'] as $status)
                                <option value="{{ $status }}" {{ old('status', $teacher->status) == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                <a href="{{ route('teachers.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
