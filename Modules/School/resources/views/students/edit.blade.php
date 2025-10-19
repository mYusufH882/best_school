@extends('school::layouts.app')

@section('title', 'Edit Siswa')
@section('header', 'Edit Siswa')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('students.update', $student) }}">
            @csrf
            @method('PUT')

            <!-- Data Siswa -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Data Siswa</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Sekolah <span class="text-red-500">*</span></label>
                        <select name="school_id" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Sekolah</option>
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}" {{ old('school_id', $student->school_id) == $school->id ? 'selected' : '' }}>
                                    {{ $school->nama_sekolah }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">NISN <span class="text-red-500">*</span></label>
                        <input type="text" name="nisn" value="{{ old('nisn', $student->nisn) }}" maxlength="10" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">NIK <span class="text-red-500">*</span></label>
                        <input type="text" name="nik" value="{{ old('nik', $student->nik) }}" maxlength="16" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $student->nama_lengkap) }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih</option>
                            <option value="L" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Agama <span class="text-red-500">*</span></label>
                        <select name="agama" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih</option>
                            @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                <option value="{{ $agama }}" {{ old('agama', $student->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $student->tempat_lahir) }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $student->tanggal_lahir->format('Y-m-d')) }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Anak Ke</label>
                        <select name="anak_ke" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih</option>
                            @foreach(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10+'] as $ke)
                                <option value="{{ $ke }}" {{ old('anak_ke', $student->anak_ke) == $ke ? 'selected' : '' }}>{{ $ke }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Jumlah Saudara</label>
                        <input type="number" name="jumlah_saudara_kandung" value="{{ old('jumlah_saudara_kandung', $student->jumlah_saudara_kandung) }}" min="0"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Tanggal Masuk <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $student->tanggal_masuk->format('Y-m-d')) }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Status</label>
                        <select name="status" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            @foreach(['aktif', 'lulus', 'pindah', 'keluar', 'meninggal'] as $status)
                                <option value="{{ $status }}" {{ old('status', $student->status) == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Alamat -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Alamat Siswa</h3>

                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-3">
                        <label class="block text-sm font-medium mb-1">Alamat Jalan <span class="text-red-500">*</span></label>
                        <input type="text" name="alamat_jalan" value="{{ old('alamat_jalan', $student->alamat_jalan) }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">RT <span class="text-red-500">*</span></label>
                        <input type="text" name="rt" value="{{ old('rt', $student->rt) }}" maxlength="3" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">RW <span class="text-red-500">*</span></label>
                        <input type="text" name="rw" value="{{ old('rw', $student->rw) }}" maxlength="3" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Dusun</label>
                        <input type="text" name="dusun" value="{{ old('dusun', $student->dusun) }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Desa/Kelurahan <span class="text-red-500">*</span></label>
                        <input type="text" name="desa_kelurahan" value="{{ old('desa_kelurahan', $student->desa_kelurahan) }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Kecamatan <span class="text-red-500">*</span></label>
                        <input type="text" name="kecamatan" value="{{ old('kecamatan', $student->kecamatan) }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Kab/Kota <span class="text-red-500">*</span></label>
                        <input type="text" name="kab_kota" value="{{ old('kab_kota', $student->kab_kota) }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Provinsi <span class="text-red-500">*</span></label>
                        <input type="text" name="provinsi" value="{{ old('provinsi', $student->provinsi) }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Kode Pos</label>
                        <input type="text" name="kode_pos" value="{{ old('kode_pos', $student->kode_pos) }}" maxlength="5"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Data Orang Tua -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Data Orang Tua/Wali</h3>
                @php
                    $parent = $student->parents->first();
                @endphp

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">NIK Orang Tua</label>
                        <input type="text" name="parent_nik" value="{{ old('parent_nik', $parent->nik ?? '') }}" maxlength="16"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                        <input type="text" name="parent_nama" value="{{ old('parent_nama', $parent->nama_lengkap ?? '') }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">No. HP</label>
                        <input type="text" name="parent_hp" value="{{ old('parent_hp', $parent->no_hp ?? '') }}" maxlength="15"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Hubungan</label>
                        <select name="parent_hubungan" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="ayah" {{ old('parent_hubungan', $parent->pivot->hubungan ?? 'ayah') == 'ayah' ? 'selected' : '' }}>Ayah</option>
                            <option value="ibu" {{ old('parent_hubungan', $parent->pivot->hubungan ?? '') == 'ibu' ? 'selected' : '' }}>Ibu</option>
                            <option value="wali" {{ old('parent_hubungan', $parent->pivot->hubungan ?? '') == 'wali' ? 'selected' : '' }}>Wali</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium mb-1">Pekerjaan</label>
                        <input type="text" name="parent_pekerjaan" value="{{ old('parent_pekerjaan', $parent->pekerjaan ?? '') }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Update
                </button>
                <a href="{{ route('students.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
