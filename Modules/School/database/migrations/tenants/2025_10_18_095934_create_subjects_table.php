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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mapel', 10)->unique()->comment('Kode Dapodik');
            $table->string('nama_mapel');
            $table->enum('kelompok', ['A', 'B', 'C'])->comment('Kurikulum Merdeka: A=Umum, B=Kejuruan, C=Pilihan');
            $table->json('jenjang')->comment('["SD", "SMP"] - bisa multi jenjang');
            $table->timestamps();
        });

        // Relasi guru ↔ mapel (many-to-many)
        Schema::create('subject_teacher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['teacher_id', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_teacher');
        Schema::dropIfExists('subjects');
    }
};
