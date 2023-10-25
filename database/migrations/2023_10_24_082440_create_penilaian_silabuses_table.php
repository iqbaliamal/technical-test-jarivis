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
        Schema::create('penilaian_silabuses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('penilaian_id');
            $table->foreign('penilaian_id')->references('id')->on('penilaians')->onDelete('cascade');
            $table->uuid('silabus_id');
            $table->foreign('silabus_id')->references('id')->on('silabuses')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('value')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_silabuses');
    }
};
