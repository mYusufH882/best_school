<!DOCTYPE html>
<html>
<head>
    <title>Selamat Datang - {{ $profile->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8 text-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">✅ Sekolah Anda Siap!</h1>
        <p class="text-gray-600 mb-6">
            Selamat! Sistem untuk <strong>{{ $profile->name }}</strong> telah aktif.
        </p>
        <div class="space-y-3">
            <a href="/" class="block w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                🌐 Lihat Website Publik
            </a>
            <a href="/login" class="block w-full px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900">
                🔐 Masuk ke Dashboard
            </a>
        </div>
    </div>
</body>
</html>
