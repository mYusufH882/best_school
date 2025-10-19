@extends('school::layouts.app')

@section('title', 'Detail Kelas')
@section('header', 'Detail Kelas')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="text-xl font-bold">{{ $class->nama_kelas }}</h2>
                <p class="text-gray-600">{{ $class->tahun_ajaran }} Semester {{ $class->semester }}</p>
            </div>
            <div class="space-x-2">
                <a href="{{ route('classes.edit', $class) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                <a href="{{ route('classes.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Kembali</a>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-blue-50 p-4 rounded">
                <p class="text-sm text-gray-600">Wali Kelas</p>
                <p class="font-semibold">{{ $class->waliKelas->nama_lengkap ?? '-' }}</p>
            </div>
            <div class="bg-green-50 p-4 rounded">
                <p class="text-sm text-gray-600">Jumlah Siswa</p>
                <p class="font-semibold">{{ $class->jumlah_siswa_saat_ini }}/{{ $class->kapasitas_maksimal }}</p>
            </div>
            <div class="bg-purple-50 p-4 rounded">
                <p class="text-sm text-gray-600">Ruang</p>
                <p class="font-semibold">{{ $class->ruang_kelas ?? '-' }}</p>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-3 border-b pb-2">Daftar Siswa</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left">NISN</th>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-left">JK</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($class->activeStudents as $student)
                            <tr>
                                <td class="px-4 py-2">{{ $student->nisn }}</td>
                                <td class="px-4 py-2">{{ $student->nama_lengkap }}</td>
                                <td class="px-4 py-2">{{ $student->jenis_kelamin }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="px-4 py-4 text-center text-gray-500">Belum ada siswa</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <h3 class="font-semibold text-lg mb-3 border-b pb-2">Jadwal Mengajar</h3>
            @forelse($class->teachers as $teacher)
                <div class="mb-2 text-sm">
                    <span class="font-semibold">{{ $teacher->nama_lengkap }}</span> -
                    {{ $teacher->subjects->pluck('nama_mapel')->join(', ') }}
                </div>
            @empty
                <p class="text-sm text-gray-500">Belum ada jadwal mengajar</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
