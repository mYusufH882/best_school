<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            // Identitas Dapodik/EMIS
            $table->string('npsn', 8)->comment('Nomor Pokok Sekolah Nasional');
            $table->string('nss', 12)->nullable()->comment('Nomor Statistik Sekolah');
            $table->string('nama_sekolah');

            // Jenjang - SESUAI REAL
            $table->enum('jenjang', [
                'TK',           // Taman Kanak-kanak
                'RA',           // Raudhatul Athfal (TK Islam)
                'SD',           // Sekolah Dasar
                'MI',           // Madrasah Ibtidaiyah
                'Diniyah',      // Diniyah Takmiliyah
                'SMP',          // Sekolah Menengah Pertama
                'MTs',          // Madrasah Tsanawiyah
                'SMA',          // Sekolah Menengah Atas
                'MA',           // Madrasah Aliyah
                'SMK'           // Sekolah Menengah Kejuruan
            ]);

            $table->enum('status', ['negeri', 'swasta']);
            $table->string('akreditasi', 2)->nullable()->comment('A/B/C/TT');
            $table->string('sk_pendirian')->nullable();
            $table->date('tanggal_sk_pendirian')->nullable();

            // Alamat LENGKAP sesuai Dapodik
            $table->string('alamat_jalan');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->string('dusun')->nullable();
            $table->string('desa_kelurahan');
            $table->string('kecamatan');
            $table->string('kab_kota');
            $table->string('provinsi');
            $table->string('kode_pos', 5);

            // Koordinat GPS
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            // Kontak
            $table->string('telepon', 15)->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            // Kurikulum (bisa lebih dari satu)
            $table->json('kurikulum')->comment('["2013", "merdeka"]');

            // Kepala Sekolah
            $table->string('nama_kepsek');
            $table->string('nip_kepsek', 18)->nullable()->comment('NIP PNS 18 digit');

            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement('CREATE UNIQUE INDEX schools_npsn_unique ON schools (npsn) WHERE deleted_at IS NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
