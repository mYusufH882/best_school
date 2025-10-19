<nav class="p-4">
    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded hover:bg-blue-50 {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700' : '' }}">
        <i class="fas fa-home mr-3"></i> Dashboard
    </a>

    <a href="{{ route('schools.index') }}" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded hover:bg-blue-50 {{ request()->routeIs('schools.*') ? 'bg-blue-100 text-blue-700' : '' }}">
        <i class="fas fa-school mr-3"></i> Data Sekolah
    </a>

    <a href="{{ route('students.index') }}" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded hover:bg-blue-50 {{ request()->routeIs('students.*') ? 'bg-blue-100 text-blue-700' : '' }}">
        <i class="fas fa-users mr-3"></i> Siswa
    </a>

    <a href="{{ route('teachers.index') }}" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded hover:bg-blue-50">
        <i class="fas fa-chalkboard-teacher mr-3"></i> Guru
    </a>

    <a href="{{ route('classes.index') }}" class="flex items-center px-4 py-3 mb-2 text-gray-700 rounded hover:bg-blue-50">
        <i class="fas fa-door-open mr-3"></i> Kelas
    </a>

    <hr class="my-4">

    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="flex items-center w-full px-4 py-3 text-red-600 rounded hover:bg-red-50">
            <i class="fas fa-sign-out-alt mr-3"></i> Logout
        </button>
    </form>
</nav>
