<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('school_id')->constrained()->onDelete('cascade');

            // Identitas Kelas
            $table->string('nama_kelas')->comment('Contoh: 7A, 8 IPA 1, X TKJ 2');
            $table->string('tingkat')->comment('Contoh: 7, 8, 9 atau X, XI, XII');
            $table->string('jurusan')->nullable()->comment('IPA/IPS/Bahasa/TKJ/AKL - kosong untuk SD/SMP');
            $table->string('rombel')->comment('A, B, C, 1, 2, 3');

            // Tahun Ajaran
            $table->string('tahun_ajaran', 9)->comment('Format: 2024/2025');
            $table->enum('semester', ['1', '2'])->default('1');

            // Kapasitas
            $table->integer('kapasitas_maksimal')->default(36);
            $table->integer('jumlah_siswa_saat_ini')->default(0);

            // Wali Kelas
            $table->foreignId('wali_kelas_id')->nullable()->constrained('teachers')->onDelete('set null');

            // Ruangan
            $table->string('ruang_kelas')->nullable()->comment('Contoh: Ruang 7A, Lab Komputer 1');

            // Status
            $table->enum('status', ['aktif', 'lulus', 'nonaktif'])->default('aktif');

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['school_id', 'nama_kelas', 'tahun_ajaran', 'semester']);
            $table->index(['school_id', 'tingkat', 'tahun_ajaran', 'status']);
        });

        // Pivot: Siswa di kelas (many-to-many karena siswa bisa pindah kelas)
        Schema::create('class_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('tahun_ajaran', 9);
            $table->enum('semester', ['1', '2']);
            $table->date('tanggal_masuk_kelas');
            $table->date('tanggal_keluar_kelas')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['class_id', 'is_active']);
            $table->index(['student_id', 'tahun_ajaran', 'semester']);
        });

        // Relasi: Guru mengajar di kelas (jadwal mapel)
        Schema::create('class_teacher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->string('mata_pelajaran');
            $table->integer('jam_per_minggu')->default(2);
            $table->string('tahun_ajaran', 9);
            $table->enum('semester', ['1', '2']);
            $table->timestamps();

            $table->unique(['class_id', 'teacher_id', 'mata_pelajaran', 'tahun_ajaran', 'semester'], 'class_teacher_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_teacher');
        Schema::dropIfExists('class_student');
        Schema::dropIfExists('classes');
    }
};
