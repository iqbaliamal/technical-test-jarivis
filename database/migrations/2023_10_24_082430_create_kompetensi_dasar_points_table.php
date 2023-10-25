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
        Schema::create('kompetensi_dasar_points', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('kompetensi_dasar_detail_id');
            $table->foreign('kompetensi_dasar_detail_id')->references('id')->on('kompetensi_dasar_details')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kompetensi_dasar_points');
    }
};
