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
        Schema::create('kompetensi_dasars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('silabus_id');
            $table->foreign('silabus_id')->references('id')->on('silabuses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('materi_pokok')->nullable();
            $table->text('description')->nullable();
            $table->string('kegiatan_pembelajaran')->nullable();
            $table->string('sumber_belajar')->nullable();
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
        Schema::dropIfExists('kompetensi_dasars');
    }
};
