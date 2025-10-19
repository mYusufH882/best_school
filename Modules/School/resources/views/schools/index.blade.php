@extends('school::layouts.app')

@section('title', 'Data Sekolah')
@section('header', 'Data Sekolah')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex justify-between items-center">
            <h1 class="text-2xl font-bold">Data Sekolah</h1>
            <a href="{{ route('schools.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Tambah Sekolah
            </a>
        </div>

        @if (session('success'))
            <div class="mx-6 mt-4 bg-green-50 text-green-700 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NPSN</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Sekolah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenjang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($schools as $school)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-mono">{{ $school->npsn }}</td>
                            <td class="px-6 py-4 text-sm font-medium">{{ $school->nama_sekolah }}</td>
                            <td class="px-6 py-4 text-sm">{{ $school->jenjang }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2 py-1 rounded text-xs {{ $school->status == 'negeri' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($school->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $school->kecamatan }}, {{ $school->kab_kota }}
                            </td>
                            <td class="px-6 py-4 text-sm space-x-2">
                                <a href="{{ route('schools.show', $school) }}" class="text-blue-600 hover:underline">Lihat</a>
                                <a href="{{ route('schools.edit', $school) }}" class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('schools.destroy', $school) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                Belum ada data sekolah
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6">
            {{ $schools->links() }}
        </div>
    </div>
</div>
@endsection
