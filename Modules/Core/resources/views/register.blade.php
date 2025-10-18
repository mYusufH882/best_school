<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sekolah - Best School</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Buat Akun Sekolah</h1>
            <p class="text-gray-600 mt-2">Dapatkan website & sistem sekolah dalam 2 menit</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 text-red-700 p-3 rounded-md text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('core.register.store') }}">
            @csrf

            <div class="mb-5">
                <label for="school_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Sekolah</label>
                <input
                    type="text"
                    id="school_name"
                    name="school_name"
                    value="{{ old('school_name') }}"
                    required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    placeholder="Contoh: SMP Harapan Bangsa"
                >
                <p class="mt-1 text-xs text-gray-500">Nama ini akan jadi alamat website Anda: <span class="font-mono text-blue-600">best_school.namasekolahmu.id</span></p>
            </div>

            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Admin</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    placeholder="admin@sekolah.sch.id"
                >
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    minlength="8"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    placeholder="Minimal 8 karakter"
                >
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200 shadow-md"
            >
                <i class="fas fa-school mr-2"></i> Daftar Sekolah Sekarang
            </button>

            <div class="mt-6 text-center text-sm text-gray-600">
                Sudah punya akun? <a href="#" class="text-blue-600 hover:underline">Login di sini</a>
            </div>
        </form>
    </div>
</body>
</html>
