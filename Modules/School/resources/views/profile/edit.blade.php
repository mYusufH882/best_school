<!DOCTYPE html>
<html>
<head>
    <title>Edit Profil - {{ $profile->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Edit Profil Sekolah</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="/profile">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Nama Sekolah</label>
                <input type="text" name="name" value="{{ old('name', $profile->name) }}" required
                    class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Tagline</label>
                <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline) }}"
                    class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Tentang Sekolah</label>
                <textarea name="about" rows="4" class="w-full px-3 py-2 border rounded">{{ old('about', $profile->about) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Warna Utama (Hex)</label>
                <input type="text" name="primary_color" value="{{ old('primary_color', $profile->primary_color) }}" required
                    placeholder="#3b82f6"
                    class="w-full px-3 py-2 border rounded">
                <p class="text-sm text-gray-500 mt-1">Contoh: #3b82f6 (biru Tailwind)</p>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Simpan Perubahan
                </button>
                <a href="/dashboard" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                    Batal
                </a>
            </div>
        </form>
    </div>
</body>
</html>
