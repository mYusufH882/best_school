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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->foreignId('school_id')->constrained()->onDelete('cascade');

            // Identitas Siswa
            $table->string('nisn', 10)->unique()->comment('Nomor Induk Siswa Nasional');
            $table->string('nik', 16)->unique()->comment('Nomor Induk Kependudukan');
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);

            // Tempat Tanggal Lahir
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');

            // Agama
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);

            // Alamat Lengkap
            $table->string('alamat_jalan');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->string('dusun')->nullable();
            $table->string('desa_kelurahan');
            $table->string('kecamatan');
            $table->string('kab_kota');
            $table->string('provinsi');
            $table->string('kode_pos', 5)->nullable();

            // Data Tambahan
            $table->enum('anak_ke', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10+'])->nullable();
            $table->integer('jumlah_saudara_kandung')->nullable();

            // Status
            $table->enum('status', ['aktif', 'lulus', 'pindah', 'keluar', 'meninggal'])->default('aktif');
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar')->nullable();

            // Tracking
            $table->unsignedBigInteger('ppdb_registration_id')->nullable()->comment('Track dari PPDB');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['school_id', 'nisn', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
