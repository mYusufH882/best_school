@extends('school::layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-4 gap-6 mb-6">
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Siswa</p>
                <h3 class="text-3xl font-bold text-gray-800">0</h3>
            </div>
            <i class="fas fa-users text-4xl text-blue-500"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Guru</p>
                <h3 class="text-3xl font-bold text-gray-800">0</h3>
            </div>
            <i class="fas fa-chalkboard-teacher text-4xl text-green-500"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Kelas</p>
                <h3 class="text-3xl font-bold text-gray-800">0</h3>
            </div>
            <i class="fas fa-door-open text-4xl text-yellow-500"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Tahun Ajaran</p>
                <h3 class="text-xl font-bold text-gray-800">2024/2025</h3>
            </div>
            <i class="fas fa-calendar text-4xl text-purple-500"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="font-bold text-lg mb-4">Quick Actions</h3>
        <div class="space-y-2">
            <a href="{{ route('schools.index') }}" class="block px-4 py-3 bg-blue-50 text-blue-700 rounded hover:bg-blue-100">
                <i class="fas fa-school mr-2"></i> Kelola Data Sekolah
            </a>
            <a href="#" class="block px-4 py-3 bg-green-50 text-green-700 rounded hover:bg-green-100">
                <i class="fas fa-user-plus mr-2"></i> Tambah Siswa Baru
            </a>
            <a href="#" class="block px-4 py-3 bg-yellow-50 text-yellow-700 rounded hover:bg-yellow-100">
                <i class="fas fa-check-circle mr-2"></i> DapoCheck Validator
            </a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="font-bold text-lg mb-4">Informasi Sistem</h3>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-600">Versi:</span>
                <span class="font-semibold">1.0.0</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Database:</span>
                <span class="font-semibold">{{ config('database.default') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Tenant ID:</span>
                <span class="font-semibold">{{ tenant('id') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
