@extends('school::layouts.app')

@section('title', 'Detail Siswa')
@section('header', 'Detail Siswa')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-start mb-6">
            <h2 class="text-xl font-bold">{{ $student->nama_lengkap }}</h2>
            <div class="space-x-2">
                <a href="{{ route('students.edit', $student) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                    Edit
                </a>
                <a href="{{ route('students.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Kembali
                </a>
            </div>
        </div>

        <!-- Identitas -->
        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-3 border-b pb-2">Identitas</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-600">NISN:</span> <span class="font-semibold">{{ $student->nisn }}</span></div>
                <div><span class="text-gray-600">NIK:</span> <span class="font-semibold">{{ $student->nik }}</span></div>
                <div><span class="text-gray-600">Jenis Kelamin:</span> <span class="font-semibold">{{ $student->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span></div>
                <div><span class="text-gray-600">Agama:</span> <span class="font-semibold">{{ $student->agama }}</span></div>
                <div class="col-span-2"><span class="text-gray-600">TTL:</span> <span class="font-semibold">{{ $student->tempat_lahir }}, {{ $student->tanggal_lahir->format('d F Y') }}</span></div>
                <div><span class="text-gray-600">Anak Ke:</span> <span class="font-semibold">{{ $student->anak_ke ?? '-' }}</span></div>
                <div><span class="text-gray-600">Jumlah Saudara:</span> <span class="font-semibold">{{ $student->jumlah_saudara_kandung ?? '-' }}</span></div>
                <div><span class="text-gray-600">Status:</span>
                    <span class="px-2 py-1 rounded text-xs bg-green-100 text-green-700">{{ ucfirst($student->status) }}</span>
                </div>
                <div><span class="text-gray-600">Tanggal Masuk:</span> <span class="font-semibold">{{ $student->tanggal_masuk->format('d/m/Y') }}</span></div>
            </div>
        </div>

        <!-- Alamat -->
        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-3 border-b pb-2">Alamat</h3>
            <p class="text-sm text-gray-700">
                {{ $student->alamat_jalan }}, RT {{ $student->rt }}/RW {{ $student->rw }},
                {{ $student->desa_kelurahan }}, {{ $student->kecamatan }},
                {{ $student->kab_kota }}, {{ $student->provinsi }} {{ $student->kode_pos }}
            </p>
        </div>

        <!-- Orang Tua -->
        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-3 border-b pb-2">Data Orang Tua/Wali</h3>
            @forelse($student->parents as $parent)
                <div class="bg-gray-50 p-4 rounded mb-2">
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div><span class="text-gray-600">Nama:</span> <span class="font-semibold">{{ $parent->nama_lengkap }}</span></div>
                        <div><span class="text-gray-600">Hubungan:</span> <span class="font-semibold">{{ ucfirst($parent->pivot->hubungan) }}</span></div>
                        <div><span class="text-gray-600">NIK:</span> <span class="font-semibold">{{ $parent->nik }}</span></div>
                        <div><span class="text-gray-600">HP:</span> <span class="font-semibold">{{ $parent->no_hp }}</span></div>
                        <div class="col-span-2"><span class="text-gray-600">Pekerjaan:</span> <span class="font-semibold">{{ $parent->pekerjaan ?? '-' }}</span></div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">Belum ada data orang tua</p>
            @endforelse
        </div>

        <!-- Riwayat Kelas -->
        <div>
            <h3 class="font-semibold text-lg mb-3 border-b pb-2">Riwayat Kelas</h3>
            @forelse($student->classes as $class)
                <div class="text-sm mb-2">
                    <span class="font-semibold">{{ $class->nama_kelas }}</span> -
                    {{ $class->pivot->tahun_ajaran }} Semester {{ $class->pivot->semester }}
                </div>
            @empty
                <p class="text-sm text-gray-500">Belum terdaftar di kelas manapun</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
