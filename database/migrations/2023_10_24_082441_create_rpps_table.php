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
        Schema::create('rpps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('kelas_id');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->uuid('jadwal_pendidik_id');
            $table->foreign('jadwal_pendidik_id')->references('id')->on('jadwal_pendidiks')->onDelete('cascade');
            $table->uuid('kompetensi_dasar_id');
            $table->foreign('kompetensi_dasar_id')->references('id')->on('kompetensi_dasars')->onDelete('cascade');
            $table->uuid('alokasi_waktu_id');
            $table->foreign('alokasi_waktu_id')->references('id')->on('alokasi_waktus')->onDelete('cascade');
            $table->string('materi')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('kegiatan')->nullable();
            $table->string('alat')->nullable();
            $table->string('sumber')->nullable();
            $table->string('pendahuluan')->nullable();
            $table->string('pentupan')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rpps');
    }
};
