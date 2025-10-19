@extends('school::layouts.app')

@section('title', 'Edit Profil Sekolah')
@section('header', 'Edit Profil Sekolah')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="/profile">
            @csrf
            @method('PUT')

            <!-- Data Sekolah Utama -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Data Sekolah</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-sm font-medium mb-1">Nama Sekolah <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah', $school->nama_sekolah) }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">NPSN</label>
                        <input type="text" name="npsn" value="{{ old('npsn', $school->npsn) }}" maxlength="8"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">NSS</label>
                        <input type="text" name="nss" value="{{ old('nss', $school->nss) }}" maxlength="12"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Jenjang <span class="text-red-500">*</span></label>
                        <select name="jenjang" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            @foreach(['TK', 'RA', 'SD', 'MI', 'Diniyah', 'SMP', 'MTs', 'SMA', 'MA', 'SMK'] as $jenjang)
                                <option value="{{ $jenjang }}" {{ old('jenjang', $school->jenjang) == $jenjang ? 'selected' : '' }}>{{ $jenjang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Status <span class="text-red-500">*</span></label>
                        <select name="status" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="negeri" {{ old('status', $school->status) == 'negeri' ? 'selected' : '' }}>Negeri</option>
                            <option value="swasta" {{ old('status', $school->status) == 'swasta' ? 'selected' : '' }}>Swasta</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Akreditasi</label>
                        <select name="akreditasi" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="">Belum Terakreditasi</option>
                            @foreach(['A', 'B', 'C', 'TT'] as $akreditasi)
                                <option value="{{ $akreditasi }}" {{ old('akreditasi', $school->akreditasi) == $akreditasi ? 'selected' : '' }}>{{ $akreditasi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Alamat -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Alamat Sekolah</h3>

                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-3">
                        <label class="block text-sm font-medium mb-1">Alamat Jalan</label>
                        <input type="text" name="alamat_jalan" value="{{ old('alamat_jalan', $school->alamat_jalan) }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">RT</label>
                        <input type="text" name="rt" value="{{ old('rt', $school->rt) }}" maxlength="3"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">RW</label>
                        <input type="text" name="rw" value="{{ old('rw', $school->rw) }}" maxlength="3"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Dusun</label>
                        <input type="text" name="dusun" value="{{ old('dusun', $school->dusun) }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Desa/Kelurahan</label>
                        <input type="text" name="desa_kelurahan" value="{{ old('desa_kelurahan', $school->desa_kelurahan) }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Kecamatan</label>
                        <input type="text" name="kecamatan" value="{{ old('kecamatan', $school->kecamatan) }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Kab/Kota</label>
                        <input type="text" name="kab_kota" value="{{ old('kab_kota', $school->kab_kota) }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Provinsi</label>
                        <input type="text" name="provinsi" value="{{ old('provinsi', $school->provinsi) }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Kode Pos</label>
                        <input type="text" name="kode_pos" value="{{ old('kode_pos', $school->kode_pos) }}" maxlength="5"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Kontak -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Kontak</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Telepon</label>
                        <input type="text" name="telepon" value="{{ old('telepon', $school->telepon) }}" maxlength="15"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $school->email) }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium mb-1">Website</label>
                        <input type="url" name="website" value="{{ old('website', $school->website) }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <!-- Profil Website -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Profil Website</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Tagline</label>
                        <input type="text" name="tagline" value="{{ old('tagline', $school->profile->tagline) }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500"
                            placeholder="Sekolah Unggulan di Kota Kami">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Tentang Sekolah</label>
                        <textarea name="about" rows="4" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">{{ old('about', $school->profile->about) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Warna Utama <span class="text-red-500">*</span></label>
                        <input type="color" name="primary_color" value="{{ old('primary_color', $school->profile->primary_color) }}" required
                            class="w-20 h-10 border rounded">
                        <p class="text-sm text-gray-500 mt-1">Warna tema untuk website publik</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Simpan Perubahan
                </button>
                <a href="/dashboard" class="px-6 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
