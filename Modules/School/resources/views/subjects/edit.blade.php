@extends('school::layouts.app')

@section('title', 'Edit Mata Pelajaran')
@section('header', 'Edit Mata Pelajaran')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Edit Mata Pelajaran</h2>
                <p class="text-sm text-gray-600 mt-1">Perbarui informasi mata pelajaran</p>
            </div>
            <a href="{{ route('subjects.index') }}" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <form action="{{ route('subjects.update', $subject) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Kode & Kelompok -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700">
                        Kode Mata Pelajaran <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kode_mapel" value="{{ old('kode_mapel', $subject->kode_mapel) }}"
                        maxlength="10" required
                        class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('kode_mapel') border-red-500 @enderror">
                    @error('kode_mapel')
                        <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Contoh: MTK, BIND, IPA</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-700">
                        Kelompok <span class="text-red-500">*</span>
                    </label>
                    <select name="kelompok" required
                        class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('kelompok') border-red-500 @enderror">
                        <option value="">-- Pilih Kelompok --</option>
                        <option value="A" {{ old('kelompok', $subject->kelompok) == 'A' ? 'selected' : '' }}>
                            A - Umum (Wajib)
                        </option>
                        <option value="B" {{ old('kelompok', $subject->kelompok) == 'B' ? 'selected' : '' }}>
                            B - Kejuruan
                        </option>
                        <option value="C" {{ old('kelompok', $subject->kelompok) == 'C' ? 'selected' : '' }}>
                            C - Pilihan (Peminatan)
                        </option>
                    </select>
                    @error('kelompok')
                        <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Nama Mata Pelajaran -->
            <div class="mb-6">
                <label class="block text-sm font-semibold mb-2 text-gray-700">
                    Nama Mata Pelajaran <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_mapel" value="{{ old('nama_mapel', $subject->nama_mapel) }}"
                    required placeholder="Contoh: Matematika, Bahasa Indonesia"
                    class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('nama_mapel') border-red-500 @enderror">
                @error('nama_mapel')
                    <p class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Jenjang -->
            <div class="mb-6">
                <label class="block text-sm font-semibold mb-3 text-gray-700">
                    Jenjang yang Menggunakan <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @foreach(['TK', 'RA', 'SD', 'MI', 'Diniyah', 'SMP', 'MTs', 'SMA', 'MA', 'SMK'] as $jenj)
                    <label class="flex items-center px-4 py-3 border-2 rounded-lg hover:bg-purple-50 cursor-pointer transition group
                        {{ in_array($jenj, old('jenjang', $subject->jenjang ?? [])) ? 'border-purple-500 bg-purple-50' : 'border-gray-200' }}">
                        <input type="checkbox" name="jenjang[]" value="{{ $jenj }}"
                            {{ in_array($jenj, old('jenjang', $subject->jenjang ?? [])) ? 'checked' : '' }}
                            class="rounded text-purple-600 focus:ring-2 focus:ring-purple-500 mr-2">
                        <span class="text-sm font-medium text-gray-700 group-hover:text-purple-700">{{ $jenj }}</span>
                    </label>
                    @endforeach
                </div>
                @error('jenjang')
                    <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-info-circle text-blue-500"></i> Pilih minimal 1 jenjang yang menggunakan mata pelajaran ini
                </p>
            </div>

            <!-- Info Card -->
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 border-l-4 border-purple-500 p-4 mb-6 rounded-r-lg">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas fa-lightbulb text-purple-500 text-xl mt-0.5"></i>
                    </div>
                    <div class="ml-3 text-sm text-purple-800">
                        <p class="font-semibold mb-2">Panduan Kelompok Kurikulum Merdeka:</p>
                        <ul class="list-disc ml-4 space-y-1">
                            <li><strong>Kelompok A (Umum):</strong> Mata pelajaran wajib untuk semua siswa seperti PAI, PKN, Bahasa Indonesia, Matematika, IPA, IPS</li>
                            <li><strong>Kelompok B (Kejuruan):</strong> Mata pelajaran pengembangan seperti Prakarya, Seni Budaya, PJOK</li>
                            <li><strong>Kelompok C (Pilihan):</strong> Mata pelajaran peminatan seperti Fisika, Kimia, Biologi, Ekonomi, Sosiologi</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Info Guru Pengampu (jika sudah ada) -->
            @if($subject->teachers->count() > 0)
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <div class="flex items-center mb-2">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                    <h4 class="font-semibold text-blue-800">Informasi Terkait</h4>
                </div>
                <p class="text-sm text-blue-700">
                    Mata pelajaran ini saat ini diampu oleh <strong>{{ $subject->teachers->count() }} guru</strong>.
                    Perubahan yang Anda lakukan akan mempengaruhi data pengampu.
                </p>
            </div>
            @endif

            <!-- Buttons -->
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('subjects.index') }}"
                    class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-lg hover:from-purple-600 hover:to-pink-600 font-medium shadow-lg transition">
                    <i class="fas fa-save mr-2"></i> Update Data
                </button>
            </div>
        </form>
    </div>

    <!-- Preview Changes -->
    <div class="mt-6 bg-white rounded-lg shadow-lg p-6">
        <h3 class="font-bold text-lg text-gray-800 mb-4">
            <i class="fas fa-eye text-purple-600 mr-2"></i> Preview Data Saat Ini
        </h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-gray-600">Kode:</span>
                <span class="font-semibold ml-2 px-2 py-1 bg-gray-100 rounded">{{ $subject->kode_mapel }}</span>
            </div>
            <div>
                <span class="text-gray-600">Kelompok:</span>
                <span class="font-semibold ml-2 px-2 py-1 {{ $subject->kelompok_color }} rounded">
                    {{ $subject->kelompok_name }}
                </span>
            </div>
            <div class="col-span-2">
                <span class="text-gray-600">Nama:</span>
                <span class="font-semibold ml-2">{{ $subject->nama_mapel }}</span>
            </div>
            <div class="col-span-2">
                <span class="text-gray-600">Jenjang:</span>
                <div class="inline-flex flex-wrap gap-1 ml-2">
                    @foreach($subject->jenjang ?? [] as $jenj)
                        <span class="px-2 py-0.5 bg-purple-100 text-purple-700 rounded text-xs">{{ $jenj }}</span>
                    @endforeach
                </div>
            </div>
            <div class="col-span-2">
                <span class="text-gray-600">Guru Pengampu:</span>
                <span class="font-semibold ml-2">{{ $subject->teachers->count() }} guru</span>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-update preview when checkbox changes
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[name="jenjang[]"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Visual feedback
            const label = this.closest('label');
            if (this.checked) {
                label.classList.add('border-purple-500', 'bg-purple-50');
                label.classList.remove('border-gray-200');
            } else {
                label.classList.remove('border-purple-500', 'bg-purple-50');
                label.classList.add('border-gray-200');
            }
        });
    });
});
</script>
@endsection
