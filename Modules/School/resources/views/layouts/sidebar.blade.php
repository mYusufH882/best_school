<nav class="p-4">
    <!-- Dashboard -->
    <a href="/dashboard" class="group flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 {{ request()->is('dashboard') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/50' : 'text-gray-700 hover:bg-blue-50 hover:translate-x-1' }}">
        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->is('dashboard') ? 'bg-white/20' : 'bg-blue-100 group-hover:bg-blue-200' }}">
            <i class="fas fa-home text-lg {{ request()->is('dashboard') ? 'text-white' : 'text-blue-600' }}"></i>
        </div>
        <span class="font-semibold">Dashboard</span>
        @if(request()->is('dashboard'))
            <i class="fas fa-chevron-right ml-auto"></i>
        @endif
    </a>

    <!-- Section Header -->
    <div class="mt-6 mb-3 px-2">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Data Master</p>
    </div>

    <!-- Siswa -->
    <a href="/students" class="group flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 {{ request()->is('students*') ? 'bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-lg shadow-green-500/50' : 'text-gray-700 hover:bg-green-50 hover:translate-x-1' }}">
        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->is('students*') ? 'bg-white/20' : 'bg-green-100 group-hover:bg-green-200' }}">
            <i class="fas fa-user-graduate text-lg {{ request()->is('students*') ? 'text-white' : 'text-green-600' }}"></i>
        </div>
        <span class="font-semibold">Siswa</span>
        @if(request()->is('students*'))
            <i class="fas fa-chevron-right ml-auto"></i>
        @endif
    </a>

    <!-- Guru -->
    <a href="/teachers" class="group flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 {{ request()->is('teachers*') ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg shadow-purple-500/50' : 'text-gray-700 hover:bg-purple-50 hover:translate-x-1' }}">
        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->is('teachers*') ? 'bg-white/20' : 'bg-purple-100 group-hover:bg-purple-200' }}">
            <i class="fas fa-chalkboard-teacher text-lg {{ request()->is('teachers*') ? 'text-white' : 'text-purple-600' }}"></i>
        </div>
        <span class="font-semibold">Guru</span>
        @if(request()->is('teachers*'))
            <i class="fas fa-chevron-right ml-auto"></i>
        @endif
    </a>

    <!-- Mata Pelajaran -->
    <a href="/subjects" class="group flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 {{ request()->is('subjects*') ? 'bg-gradient-to-r from-orange-500 to-red-600 text-white shadow-lg shadow-orange-500/50' : 'text-gray-700 hover:bg-orange-50 hover:translate-x-1' }}">
        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->is('subjects*') ? 'bg-white/20' : 'bg-orange-100 group-hover:bg-orange-200' }}">
            <i class="fas fa-book text-lg {{ request()->is('subjects*') ? 'text-white' : 'text-orange-600' }}"></i>
        </div>
        <span class="font-semibold">Mata Pelajaran</span>
        @if(request()->is('subjects*'))
            <i class="fas fa-chevron-right ml-auto"></i>
        @endif
    </a>

    <!-- Kelas -->
    <a href="/classes" class="group flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 {{ request()->is('classes*') ? 'bg-gradient-to-r from-pink-500 to-rose-600 text-white shadow-lg shadow-pink-500/50' : 'text-gray-700 hover:bg-pink-50 hover:translate-x-1' }}">
        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->is('classes*') ? 'bg-white/20' : 'bg-pink-100 group-hover:bg-pink-200' }}">
            <i class="fas fa-door-open text-lg {{ request()->is('classes*') ? 'text-white' : 'text-pink-600' }}"></i>
        </div>
        <span class="font-semibold">Kelas</span>
        @if(request()->is('classes*'))
            <i class="fas fa-chevron-right ml-auto"></i>
        @endif
    </a>

    <!-- Divider -->
    <div class="my-4 border-t border-gray-200"></div>

    <!-- Section Header -->
    <div class="mb-3 px-2">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pengaturan</p>
    </div>

    <!-- Profil Sekolah -->
    <a href="/profile" class="group flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 {{ request()->is('profile*') ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg shadow-cyan-500/50' : 'text-gray-700 hover:bg-cyan-50 hover:translate-x-1' }}">
        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->is('profile*') ? 'bg-white/20' : 'bg-cyan-100 group-hover:bg-cyan-200' }}">
            <i class="fas fa-school text-lg {{ request()->is('profile*') ? 'text-white' : 'text-cyan-600' }}"></i>
        </div>
        <span class="font-semibold">Profil Sekolah</span>
        @if(request()->is('profile*'))
            <i class="fas fa-chevron-right ml-auto"></i>
        @endif
    </a>

    <!-- Logout -->
    <form action="/logout" method="POST" class="mt-6">
        @csrf
        <button type="submit" class="group flex items-center w-full px-4 py-3 rounded-lg transition-all duration-200 text-red-600 hover:bg-red-50 hover:translate-x-1">
            <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 bg-red-100 group-hover:bg-red-200">
                <i class="fas fa-sign-out-alt text-lg text-red-600"></i>
            </div>
            <span class="font-semibold">Logout</span>
        </button>
    </form>

    <!-- Version Info -->
    <div class="mt-6 px-4 py-3 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                <span class="text-xs text-gray-600 font-medium">Online</span>
            </div>
            <span class="text-xs font-bold text-gray-700 bg-white px-2 py-1 rounded">v1.0.0</span>
        </div>
    </div>
</nav>
