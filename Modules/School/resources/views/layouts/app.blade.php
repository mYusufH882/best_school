<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .sidebar-transition {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar-transition w-64 bg-white shadow-lg flex flex-col">
            <!-- Sidebar Header -->
            <div class="p-6 border-b bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-graduation-cap text-2xl text-white"></i>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-lg font-bold text-white">{{ tenant('school_name') ?? 'Sekolah' }}</h2>
                        <p class="text-xs text-white/80">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <div class="flex-1 overflow-y-auto">
                @include('school::layouts.sidebar')
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b px-6 py-4">
                <div class="flex justify-between items-center">
                    <!-- Left: Toggle + Title -->
                    <div class="flex items-center gap-4">
                        <!-- Toggle Button -->
                        <button onclick="toggleSidebar()" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-600 hover:bg-gray-100 lg:hidden">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">@yield('header', 'Dashboard')</h1>
                            <p class="text-xs text-gray-500">{{ now()->format('l, d F Y') }}</p>
                        </div>
                    </div>

                    <!-- Right: Profile Dropdown -->
                    <div class="relative">
                        <button onclick="toggleDropdown()" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                            <div class="text-right hidden md:block">
                                <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                            <div class="relative">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold shadow">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                            </div>
                            <i class="fas fa-chevron-down text-sm text-gray-400"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-2xl border border-gray-200 z-50 overflow-hidden">
                            <!-- Dropdown Header -->
                            <div class="px-4 py-4 bg-gradient-to-r from-indigo-500 to-purple-500 text-white">
                                <p class="font-semibold text-lg">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-white/80">{{ Auth::user()->email }}</p>
                            </div>

                            <!-- Menu Items -->
                            <div class="py-2">
                                <a href="/profile" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">
                                    <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-indigo-600"></i>
                                    </div>
                                    <span class="font-medium">Profil Saya</span>
                                </a>
                                <a href="/settings" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition">
                                    <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-cog text-purple-600"></i>
                                    </div>
                                    <span class="font-medium">Pengaturan</span>
                                </a>
                            </div>

                            <!-- Logout -->
                            <div class="border-t border-gray-200">
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                                        <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-sign-out-alt text-red-600"></i>
                                        </div>
                                        <span class="font-medium">Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="flex-1 p-6 overflow-y-auto">
                @if (session('success'))
                    <div class="mb-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm flex items-center">
                        <i class="fas fa-check-circle text-xl mr-3"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm flex items-center">
                        <i class="fas fa-exclamation-circle text-xl mr-3"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-3 mt-0.5"></i>
                            <div>
                                <p class="font-semibold text-red-800 mb-2">Terdapat kesalahan:</p>
                                <ul class="list-disc pl-5 space-y-1 text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="bg-gradient-to-r from-gray-50 to-gray-100 border-t px-6 py-3">
                <div class="flex justify-between items-center text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white text-xs"></i>
                        </div>
                        <span class="font-semibold text-gray-700">{{ tenant('school_name') ?? config('app.name') }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-xs">
                        <span>&copy; {{ date('Y') }}</span>
                        <span class="hidden md:inline text-gray-400">•</span>
                        <span class="px-2 py-0.5 bg-indigo-100 text-indigo-700 rounded font-semibold">v1.0.0</span>
                    </div>
                </div>
            </footer>
        </main>
    </div>

    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('absolute');
            sidebar.classList.toggle('z-40');
        }

        // Toggle Dropdown
        function toggleDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('profileDropdown');
            const button = event.target.closest('button[onclick="toggleDropdown()"]');

            if (!button && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Responsive sidebar
        function checkScreenSize() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth < 1024) {
                sidebar.classList.add('-translate-x-full', 'absolute', 'z-40');
            } else {
                sidebar.classList.remove('-translate-x-full', 'absolute', 'z-40');
            }
        }

        // Initial check
        checkScreenSize();

        // Listen for resize
        window.addEventListener('resize', checkScreenSize);
    </script>
</body>
</html>
