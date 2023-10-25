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
        Schema::create('kegiatan_intis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('rpp_id');
            $table->foreign('rpp_id')->references('id')->on('rpps')->onDelete('cascade');
            $table->uuid('pertemuan_id');
            $table->foreign('pertemuan_id')->references('id')->on('pertemuans')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_intis');
    }
};
