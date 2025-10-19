<nav class="p-4">
    <a href="/dashboard" class="flex items-center px-4 py-3 mb-2 rounded {{ request()->is('dashboard') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-blue-50' }}">
        <i class="fas fa-home mr-3"></i> Dashboard
    </a>

    <a href="/students" class="flex items-center px-4 py-3 mb-2 rounded {{ request()->is('students*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-blue-50' }}">
        <i class="fas fa-users mr-3"></i> Siswa
    </a>

    <a href="/teachers" class="flex items-center px-4 py-3 mb-2 rounded {{ request()->is('teachers*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-blue-50' }}">
        <i class="fas fa-chalkboard-teacher mr-3"></i> Guru
    </a>

    <a href="/classes" class="flex items-center px-4 py-3 mb-2 rounded {{ request()->is('classes*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-blue-50' }}">
        <i class="fas fa-door-open mr-3"></i> Kelas
    </a>

    <hr class="my-4">

    <a href="/profile" class="flex items-center px-4 py-3 mb-2 rounded {{ request()->is('profile*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-blue-50' }}">
        <i class="fas fa-school mr-3"></i> Profil Sekolah
    </a>

    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="flex items-center w-full px-4 py-3 text-red-600 rounded hover:bg-red-50">
            <i class="fas fa-sign-out-alt mr-3"></i> Logout
        </button>
    </form>
</nav>
