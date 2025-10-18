<!DOCTYPE html>
<html>
<head>
    <title>{{ $profile->name }}</title>
    <meta name="description" content="{{ $profile->tagline }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style> :root { --primary: {{ $profile->primary_color }}; } </style>
</head>
<body class="font-sans">
    <header class="border-t-4" style="border-color: var(--primary)">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold">{{ $profile->name }}</h1>
            <p class="text-lg text-gray-600">{{ $profile->tagline }}</p>
        </div>
    </header>
    <main class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-4">Tentang Kami</h2>
        <p>{{ $profile->about }}</p>
        <div class="mt-6">
            <a href="/login" class="px-4 py-2 bg-blue-600 text-white rounded">Login untuk Guru & Orang Tua</a>
        </div>
    </main>
</body>
</html>
