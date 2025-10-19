@extends('school::layouts.app')

@section('title', 'Data Sekolah')
@section('header', 'Data Sekolah')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-6">Tambah Data Sekolah</h1>

        @if ($errors->any())
            <div class="bg-red-50 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('schools.store') }}">
            @csrf

            <!-- Identitas Sekolah -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Identitas Sekolah</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">NPSN <span class="text-red-500">*</span></label>
                        <input type="text" name="npsn" value="{{ old('npsn') }}" maxlength="8" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500"
                            placeholder="8 digit">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">NSS</label>
                        <input type="text" name="nss" value="{{ old('nss') }}" maxlength="12"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500"
                            placeholder="12 digit (opsional)">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium mb-1">Nama Sekolah <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah') }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Jenjang <span class="text-red-500">*</span></label>
                        <select name="jenjang" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Jenjang</option>
                            @foreach(['TK', 'RA', 'SD', 'MI', 'Diniyah', 'SMP', 'MTs', 'SMA', 'MA', 'SMK'] as $j)
                                <option value="{{ $j }}" {{ old('jenjang') == $j ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Status <span class="text-red-500">*</span></label>
                        <select name="status" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Status</option>
                            <option value="negeri" {{ old('status') == 'negeri' ? 'selected' : '' }}>Negeri</option>
                            <option value="swasta" {{ old('status') == 'swasta' ? 'selected' : '' }}>Swasta</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Akreditasi</label>
                        <select name="akreditasi" class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih</option>
                            @foreach(['A', 'B', 'C', 'TT'] as $a)
                                <option value="{{ $a }}" {{ old('akreditasi') == $a ? 'selected' : '' }}>{{ $a }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Kurikulum</label>
                        <div class="flex gap-4 mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="kurikulum[]" value="2013" class="rounded">
                                <span class="ml-2">K13</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="kurikulum[]" value="merdeka" class="rounded">
                                <span class="ml-2">Merdeka</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alamat -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Alamat Lengkap</h3>

                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-3">
                        <label class="block text-sm font-medium mb-1">Alamat Jalan <span class="text-red-500">*</span></label>
                        <input type="text" name="alamat_jalan" value="{{ old('alamat_jalan') }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">RT <span class="text-red-500">*</span></label>
                        <input type="text" name="rt" value="{{ old('rt') }}" maxlength="3" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">RW <span class="text-red-500">*</span></label>
                        <input type="text" name="rw" value="{{ old('rw') }}" maxlength="3" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Dusun</label>
                        <input type="text" name="dusun" value="{{ old('dusun') }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Desa/Kelurahan <span class="text-red-500">*</span></label>
                        <input type="text" name="desa_kelurahan" value="{{ old('desa_kelurahan') }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Kecamatan <span class="text-red-500">*</span></label>
                        <input type="text" name="kecamatan" value="{{ old('kecamatan') }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Kab/Kota <span class="text-red-500">*</span></label>
                        <input type="text" name="kab_kota" value="{{ old('kab_kota') }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Provinsi <span class="text-red-500">*</span></label>
                        <input type="text" name="provinsi" value="{{ old('provinsi') }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Kode Pos <span class="text-red-500">*</span></label>
                        <input type="text" name="kode_pos" value="{{ old('kode_pos') }}" maxlength="5" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Latitude</label>
                        <input type="text" name="latitude" value="{{ old('latitude') }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500"
                            placeholder="-6.200000">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Longitude</label>
                        <input type="text" name="longitude" value="{{ old('longitude') }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500"
                            placeholder="106.816666">
                    </div>
                </div>
            </div>

            <!-- Kontak & Kepala Sekolah -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Kontak & Kepala Sekolah</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Telepon</label>
                        <input type="text" name="telepon" value="{{ old('telepon') }}" maxlength="15"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium mb-1">Website</label>
                        <input type="url" name="website" value="{{ old('website') }}"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Nama Kepala Sekolah <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_kepsek" value="{{ old('nama_kepsek') }}" required
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">NIP Kepala Sekolah</label>
                        <input type="text" name="nip_kepsek" value="{{ old('nip_kepsek') }}" maxlength="18"
                            class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500"
                            placeholder="18 digit (PNS)">
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Simpan
                </button>
                <a href="{{ route('schools.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
