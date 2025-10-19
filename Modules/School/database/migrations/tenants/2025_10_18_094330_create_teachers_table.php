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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('school_id')->constrained()->onDelete('cascade');

            // Identitas
            $table->string('nik', 16)->unique();
            $table->string('nuptk', 16)->nullable()->comment('Nomor Unik PTK - opsional untuk GTT');
            $table->string('nip', 18)->nullable()->comment('NIP PNS 18 digit');
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);

            // TTL
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');

            // Kontak
            $table->string('no_hp', 15);
            $table->string('email')->nullable();

            // Status Kepegawaian
            $table->enum('status_kepegawaian', [
                'PNS',          // Pegawai Negeri Sipil
                'PPPK',         // Pegawai Pemerintah dengan Perjanjian Kerja
                'GTY',          // Guru Tetap Yayasan
                'GTT',          // Guru Tidak Tetap
                'Honorer'
            ]);

            // Pendidikan
            $table->enum('pendidikan_terakhir', [
                'SMA/Sederajat',
                'D1',
                'D2',
                'D3',
                'D4/S1',
                'S2',
                'S3'
            ]);
            $table->string('jurusan_pendidikan')->nullable();

            // Sertifikasi
            $table->boolean('is_sertifikasi')->default(false);
            $table->string('no_sertifikat_pendidik')->nullable();
            $table->smallInteger('tahun_sertifikasi')->unsigned()->nullable();

            // Status
            $table->enum('status', ['aktif', 'cuti', 'pensiun', 'resign'])->default('aktif');
            $table->date('tanggal_mulai_tugas');
            $table->date('tanggal_selesai_tugas')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['school_id', 'nik', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
