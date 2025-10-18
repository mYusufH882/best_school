<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - {{ $profile->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow p-4">
            <h2 class="text-xl font-bold mb-6">{{ $profile->name }}</h2>
            <ul>
                <li class="mb-2"><a href="/dashboard" class="text-blue-600 font-medium">Dashboard</a></li>
                <li class="mb-2"><a href="/profile" class="text-gray-700 hover:text-blue-600">Kelola Profil</a></li>
                <li class="mb-2"><a href="/logout" class="text-red-600">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <h1 class="text-2xl font-bold mb-4">Selamat Datang di Dashboard</h1>
            <p class="text-gray-700">Anda login sebagai admin sekolah <strong>{{ $profile->name }}</strong>.</p>
            <div class="mt-6">
                <a href="/profile" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Edit Profil Sekolah
                </a>
            </div>
        </div>
    </div>
</body>
</html>
