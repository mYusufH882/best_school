<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="max-w-4xl mx-auto p-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start mb-6">
                <h1 class="text-2xl font-bold">Detail Sekolah</h1>
                <div class="space-x-2">
                    <a href="{{ route('schools.edit', $school) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        Edit
                    </a>
                    <a href="{{ route('schools.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Identitas -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Identitas Sekolah</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">NPSN:</span>
                        <span class="font-semibold">{{ $school->npsn }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">NSS:</span>
                        <span class="font-semibold">{{ $school->nss ?? '-' }}</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-gray-600">Nama Sekolah:</span>
                        <span class="font-semibold text-lg">{{ $school->nama_sekolah }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Jenjang:</span>
                        <span class="font-semibold">{{ $school->jenjang }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Status:</span>
                        <span class="font-semibold">{{ ucfirst($school->status) }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Akreditasi:</span>
                        <span class="font-semibold">{{ $school->akreditasi ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Kurikulum:</span>
                        <span class="font-semibold">{{ implode(', ', $school->kurikulum) }}</span>
                    </div>
                </div>
            </div>

            <!-- Alamat -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Alamat</h3>
                <p class="text-gray-700">{{ $school->alamat_lengkap }}</p>
                @if($school->latitude && $school->longitude)
                    <p class="text-sm text-gray-600 mt-2">
                        GPS: {{ $school->latitude }}, {{ $school->longitude }}
                    </p>
                @endif
            </div>

            <!-- Kontak -->
            <div class="mb-6">
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Kontak</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Telepon:</span>
                        <span class="font-semibold">{{ $school->telepon ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Email:</span>
                        <span class="font-semibold">{{ $school->email ?? '-' }}</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-gray-600">Website:</span>
                        <span class="font-semibold">{{ $school->website ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Kepala Sekolah -->
            <div>
                <h3 class="font-semibold text-lg mb-3 border-b pb-2">Kepala Sekolah</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Nama:</span>
                        <span class="font-semibold">{{ $school->nama_kepsek }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">NIP:</span>
                        <span class="font-semibold">{{ $school->nip_kepsek ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
