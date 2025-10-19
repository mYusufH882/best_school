<?php

namespace Modules\School\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\School\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            // Kelompok A - Umum (Semua Jenjang)
            ['kode_mapel' => 'PAI', 'nama_mapel' => 'Pendidikan Agama Islam', 'kelompok' => 'A', 'jenjang' => ['SD', 'MI', 'SMP', 'MTs', 'SMA', 'MA', 'SMK']],
            ['kode_mapel' => 'PKN', 'nama_mapel' => 'Pendidikan Kewarganegaraan', 'kelompok' => 'A', 'jenjang' => ['SD', 'MI', 'SMP', 'MTs', 'SMA', 'MA', 'SMK']],
            ['kode_mapel' => 'BIND', 'nama_mapel' => 'Bahasa Indonesia', 'kelompok' => 'A', 'jenjang' => ['SD', 'MI', 'SMP', 'MTs', 'SMA', 'MA', 'SMK']],
            ['kode_mapel' => 'MTK', 'nama_mapel' => 'Matematika', 'kelompok' => 'A', 'jenjang' => ['SD', 'MI', 'SMP', 'MTs', 'SMA', 'MA', 'SMK']],
            ['kode_mapel' => 'IPA', 'nama_mapel' => 'Ilmu Pengetahuan Alam', 'kelompok' => 'A', 'jenjang' => ['SD', 'MI', 'SMP', 'MTs']],
            ['kode_mapel' => 'IPS', 'nama_mapel' => 'Ilmu Pengetahuan Sosial', 'kelompok' => 'A', 'jenjang' => ['SD', 'MI', 'SMP', 'MTs']],
            ['kode_mapel' => 'BING', 'nama_mapel' => 'Bahasa Inggris', 'kelompok' => 'A', 'jenjang' => ['SMP', 'MTs', 'SMA', 'MA', 'SMK']],

            // SD/MI Spesifik
            ['kode_mapel' => 'SBDP', 'nama_mapel' => 'Seni Budaya dan Prakarya', 'kelompok' => 'B', 'jenjang' => ['SD', 'MI']],
            ['kode_mapel' => 'PJOK', 'nama_mapel' => 'Pendidikan Jasmani Olahraga dan Kesehatan', 'kelompok' => 'B', 'jenjang' => ['SD', 'MI', 'SMP', 'MTs', 'SMA', 'MA', 'SMK']],

            // SMP/MTs Spesifik
            ['kode_mapel' => 'PRAKARYA', 'nama_mapel' => 'Prakarya', 'kelompok' => 'B', 'jenjang' => ['SMP', 'MTs']],
            ['kode_mapel' => 'SENBUD', 'nama_mapel' => 'Seni Budaya', 'kelompok' => 'B', 'jenjang' => ['SMP', 'MTs', 'SMA', 'MA']],

            // SMA/MA - Peminatan IPA
            ['kode_mapel' => 'FIS', 'nama_mapel' => 'Fisika', 'kelompok' => 'C', 'jenjang' => ['SMA', 'MA']],
            ['kode_mapel' => 'KIM', 'nama_mapel' => 'Kimia', 'kelompok' => 'C', 'jenjang' => ['SMA', 'MA']],
            ['kode_mapel' => 'BIO', 'nama_mapel' => 'Biologi', 'kelompok' => 'C', 'jenjang' => ['SMA', 'MA']],

            // SMA/MA - Peminatan IPS
            ['kode_mapel' => 'GEO', 'nama_mapel' => 'Geografi', 'kelompok' => 'C', 'jenjang' => ['SMA', 'MA']],
            ['kode_mapel' => 'SEJ', 'nama_mapel' => 'Sejarah', 'kelompok' => 'C', 'jenjang' => ['SMA', 'MA']],
            ['kode_mapel' => 'EKO', 'nama_mapel' => 'Ekonomi', 'kelompok' => 'C', 'jenjang' => ['SMA', 'MA']],
            ['kode_mapel' => 'SOS', 'nama_mapel' => 'Sosiologi', 'kelompok' => 'C', 'jenjang' => ['SMA', 'MA']],

            // SMK - Contoh Produktif
            ['kode_mapel' => 'PRODIK', 'nama_mapel' => 'Dasar Program Keahlian', 'kelompok' => 'C', 'jenjang' => ['SMK']],
            ['kode_mapel' => 'KK', 'nama_mapel' => 'Konsentrasi Keahlian', 'kelompok' => 'C', 'jenjang' => ['SMK']],

            // Madrasah Spesifik
            ['kode_mapel' => 'QURAN', 'nama_mapel' => 'Al-Quran Hadits', 'kelompok' => 'A', 'jenjang' => ['MI', 'MTs', 'MA']],
            ['kode_mapel' => 'AKIDAH', 'nama_mapel' => 'Akidah Akhlak', 'kelompok' => 'A', 'jenjang' => ['MI', 'MTs', 'MA']],
            ['kode_mapel' => 'FIQIH', 'nama_mapel' => 'Fikih', 'kelompok' => 'A', 'jenjang' => ['MI', 'MTs', 'MA']],
            ['kode_mapel' => 'SKI', 'nama_mapel' => 'Sejarah Kebudayaan Islam', 'kelompok' => 'A', 'jenjang' => ['MI', 'MTs', 'MA']],
            ['kode_mapel' => 'BARAB', 'nama_mapel' => 'Bahasa Arab', 'kelompok' => 'A', 'jenjang' => ['MI', 'MTs', 'MA']],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
