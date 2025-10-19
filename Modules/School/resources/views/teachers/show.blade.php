@extends('school::layouts.app')

@section('title', 'Detail Guru')
@section('header', 'Detail Guru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-start mb-6">
            <h2 class="text-xl font-bold">{{ $teacher->nama_lengkap }}</h2>
            <div class="space-x-2">
                <a href="{{ route('teachers.edit', $teacher) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                <a href="{{ route('teachers.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Kembali</a>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-3 border-b pb-2">Identitas</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-600">NIK:</span> <span class="font-semibold">{{ $teacher->nik }}</span></div>
                <div><span class="text-gray-600">NUPTK:</span> <span class="font-semibold">{{ $teacher->nuptk ?? '-' }}</span></div>
                <div><span class="text-gray-600">NIP:</span> <span class="font-semibold">{{ $teacher->nip ?? '-' }}</span></div>
                <div><span class="text-gray-600">JK:</span> <span class="font-semibold">{{ $teacher->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span></div>
                <div class="col-span-2"><span class="text-gray-600">TTL:</span> <span class="font-semibold">{{ $teacher->tempat_lahir }}, {{ $teacher->tanggal_lahir->format('d F Y') }}</span></div>
                <div><span class="text-gray-600">HP:</span> <span class="font-semibold">{{ $teacher->no_hp }}</span></div>
                <div><span class="text-gray-600">Email:</span> <span class="font-semibold">{{ $teacher->email ?? '-' }}</span></div>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-3 border-b pb-2">Kepegawaian</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-600">Status:</span> <span class="font-semibold">{{ $teacher->status_kepegawaian }}</span></div>
                <div><span class="text-gray-600">Pendidikan:</span> <span class="font-semibold">{{ $teacher->pendidikan_terakhir }}</span></div>
                <div class="col-span-2"><span class="text-gray-600">Jurusan:</span> <span class="font-semibold">{{ $teacher->jurusan_pendidikan ?? '-' }}</span></div>
                <div><span class="text-gray-600">Sertifikasi:</span>
                    <span class="px-2 py-1 rounded text-xs {{ $teacher->is_sertifikasi ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                        {{ $teacher->is_sertifikasi ? 'Sudah' : 'Belum' }}
                    </span>
                </div>
                @if($teacher->is_sertifikasi)
                    <div><span class="text-gray-600">No. Sertifikat:</span> <span class="font-semibold">{{ $teacher->no_sertifikat_pendidik }}</span></div>
                    <div><span class="text-gray-600">Tahun:</span> <span class="font-semibold">{{ $teacher->tahun_sertifikasi }}</span></div>
                @endif
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-3 border-b pb-2">Mata Pelajaran</h3>
            <div class="flex flex-wrap gap-2">
                @forelse($teacher->subjects as $subject)
                    <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded text-sm">{{ $subject->nama_mapel }}</span>
                @empty
                    <p class="text-sm text-gray-500">Belum ada mata pelajaran</p>
                @endforelse
            </div>
        </div>

        <div>
            <h3 class="font-semibold text-lg mb-3 border-b pb-2">Wali Kelas</h3>
            @forelse($teacher->classesAsWali as $class)
                <div class="text-sm mb-2">
                    <span class="font-semibold">{{ $class->nama_kelas }}</span> - {{ $class->tahun_ajaran }}
                </div>
            @empty
                <p class="text-sm text-gray-500">Tidak menjadi wali kelas</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
