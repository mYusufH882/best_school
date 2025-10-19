@extends('school::layouts.app')

@section('title', 'Data Siswa')
@section('header', 'Data Siswa')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-3xl font-bold text-gray-800">Daftar Siswa</h2>
        <p class="text-gray-600 mt-1">Kelola data siswa sekolah</p>
    </div>
    <div class="flex gap-2">
        <!-- Button Import/Export -->
        <button onclick="openModal()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center gap-2 shadow-lg">
            <i class="fas fa-file-import"></i> Import/Export
        </button>

        <a href="{{ route('students.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center gap-2 shadow-lg">
            <i class="fas fa-plus"></i> Tambah Siswa
        </a>
    </div>
</div>

<!-- Alert Messages -->
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
    </div>
@endif

@if(session('warning'))
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg mb-4">
        <i class="fas fa-exclamation-triangle mr-2"></i>{{ session('warning') }}

        @if(session('import_errors'))
            <details class="mt-2">
                <summary class="cursor-pointer font-semibold">Lihat Detail Error</summary>
                <ul class="mt-2 text-sm bg-white p-3 rounded max-h-60 overflow-y-auto">
                    @foreach(session('import_errors') as $error)
                        <li class="mb-2 pb-2 border-b border-yellow-200">
                            <strong>Baris:</strong> {{ json_encode($error['row']) }}<br>
                            <strong class="text-red-600">Error:</strong> {{ implode(', ', $error['errors']) }}
                        </li>
                    @endforeach
                </ul>
            </details>
        @endif
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
        <i class="fas fa-times-circle mr-2"></i>{{ session('error') }}
    </div>
@endif

<!-- Filter -->
<div class="bg-white p-4 rounded-lg shadow mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="md:col-span-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari NISN atau nama siswa..."
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-green-500">
        </div>
        <div>
            <select name="status" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-green-500">
                <option value="">-- Semua Status --</option>
                @foreach(['aktif', 'lulus', 'pindah', 'keluar', 'cuti'] as $st)
                    <option value="{{ $st }}" {{ request('status') == $st ? 'selected' : '' }}>
                        {{ ucfirst($st) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                <i class="fas fa-search mr-2"></i> Filter
            </button>
            <a href="{{ route('students.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                <i class="fas fa-redo"></i>
            </a>
        </div>
    </form>
</div>

<!-- Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gradient-to-r from-green-600 to-emerald-700">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">NISN</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Nama Lengkap</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">JK</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Kelas</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($students as $student)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-mono font-semibold">
                        {{ $student->nisn }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="font-semibold text-gray-900">{{ $student->nama_lengkap }}</div>
                    <div class="text-sm text-gray-500">NIK: {{ $student->nik }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $student->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                        {{ $student->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="text-sm text-gray-600">
                        {{ $student->classes->first()->nama_kelas ?? '-' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        @if($student->status == 'aktif') bg-green-100 text-green-800
                        @elseif($student->status == 'lulus') bg-blue-100 text-blue-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($student->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('students.show', $student) }}" class="px-3 py-1.5 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('students.edit', $student) }}" class="px-3 py-1.5 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-3"></i>
                    <p class="text-lg">Belum ada data siswa</p>
                    <a href="{{ route('students.create') }}" class="text-green-600 hover:underline mt-2 inline-block">
                        Tambah siswa pertama
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $students->links() }}
</div>

<!-- ========== MODAL IMPORT/EXPORT ========== -->
<div id="importExportModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-4 flex justify-between items-center rounded-t-lg">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-exchange-alt mr-3"></i>
                Import/Export Data Siswa
            </h3>
            <button onclick="closeModal()" class="text-white hover:text-gray-200 text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6 space-y-6">

            <!-- Export Section -->
            <div class="border-2 border-green-200 rounded-lg p-5 bg-green-50">
                <h4 class="text-lg font-bold text-green-800 mb-3 flex items-center">
                    <i class="fas fa-download mr-2"></i>
                    Export Data
                </h4>

                @if($students->total() > 0)
                    <p class="text-gray-700 mb-4">
                        Download <strong class="text-green-700">{{ $students->total() }} data siswa</strong> dalam format Excel
                    </p>
                    <a href="{{ route('students.export') }}"
                       class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 shadow-md transition">
                        <i class="fas fa-file-excel mr-2"></i> Download Excel
                    </a>
                @else
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 p-4 rounded">
                        <p class="text-yellow-800">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <strong>Belum ada data untuk diekspor.</strong><br>
                            <a href="{{ route('students.create') }}" class="underline font-semibold">Tambah data siswa</a> terlebih dahulu.
                        </p>
                    </div>
                @endif
            </div>

            <!-- Divider -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500 font-semibold">ATAU</span>
                </div>
            </div>

            <!-- Import Section -->
            <div class="border-2 border-blue-200 rounded-lg p-5 bg-blue-50">
                <h4 class="text-lg font-bold text-blue-800 mb-3 flex items-center">
                    <i class="fas fa-upload mr-2"></i>
                    Import Data
                </h4>

                <!-- Template Download -->
                <div class="bg-white border border-blue-200 rounded-lg p-4 mb-4">
                    <p class="text-sm text-gray-700 mb-2">
                        <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                        Download template CSV untuk memudahkan import data
                    </p>
                    <a href="{{ route('students.template') }}"
                       class="inline-block px-4 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 text-sm font-semibold">
                        <i class="fas fa-file-csv mr-1"></i> Download Template
                    </a>
                </div>

                <!-- Form Upload -->
                <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Pilih File Excel/CSV <span class="text-red-500">*</span>
                        </label>
                        <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                            class="w-full px-3 py-2 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('file')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Validation Info -->
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                        <p class="text-sm font-semibold text-yellow-800 mb-2">
                            <i class="fas fa-shield-alt mr-1"></i> Validasi Dapodik Otomatis:
                        </p>
                        <ul class="text-sm text-yellow-700 space-y-1 ml-5 list-disc">
                            <li>NISN harus 10 digit angka</li>
                            <li>NIK harus 16 digit angka</li>
                            <li>Data duplikat akan diabaikan</li>
                            <li>Format tanggal: YYYY-MM-DD</li>
                        </ul>
                    </div>

                    <button type="submit" class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold shadow-md transition">
                        <i class="fas fa-cloud-upload-alt mr-2"></i> Upload & Import Data
                    </button>
                </form>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="bg-gray-50 px-6 py-4 flex justify-end rounded-b-lg">
            <button onclick="closeModal()"
                    class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 font-semibold">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- JavaScript untuk Modal -->
<script>
function openModal() {
    document.getElementById('importExportModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('importExportModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal ketika klik di luar modal
document.getElementById('importExportModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Close modal dengan ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});
</script>
@endsection
