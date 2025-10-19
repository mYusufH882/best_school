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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();

            // Identitas
            $table->string('nik', 16)->unique()->comment('NIK Ayah/Ibu/Wali');
            $table->string('nama_lengkap');

            // Kontak
            $table->string('no_hp', 15);
            $table->string('email')->nullable();

            // Pekerjaan & Pendidikan
            $table->string('pekerjaan')->nullable();
            $table->enum('pendidikan_terakhir', [
                'Tidak Sekolah',
                'SD/Sederajat',
                'SMP/Sederajat',
                'SMA/Sederajat',
                'D1',
                'D2',
                'D3',
                'D4/S1',
                'S2',
                'S3'
            ])->nullable();

            $table->bigInteger('penghasilan_bulanan')->nullable()->comment('Dalam rupiah');

            // Alamat (bisa sama dengan siswa atau beda)
            $table->string('alamat_jalan');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->string('dusun')->nullable();
            $table->string('desa_kelurahan');
            $table->string('kecamatan');
            $table->string('kab_kota');
            $table->string('provinsi');
            $table->string('kode_pos', 5)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('nik');
        });

        // Pivot: Relasi siswa dengan orang tua (many-to-many)
        Schema::create('student_parent', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('parent_id')->constrained()->onDelete('cascade');
            $table->enum('hubungan', ['ayah', 'ibu', 'wali']);
            $table->boolean('is_primary')->default(false)->comment('Kontak utama');
            $table->timestamps();

            $table->unique(['student_id', 'parent_id', 'hubungan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_parent');
        Schema::dropIfExists('parents');
    }
};
