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
        Schema::create('hasil_diagnosas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diagnosa_id')->constrained('diagnosas')->onDelete('cascade');
            $table->foreignId('penyakit_id')->constrained('penyakits')->onDelete('cascade');
            $table->decimal('nilai_cf', 8, 4);
            $table->decimal('persentase', 8, 2);
            $table->integer('ranking');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_diagnosas');
    }
};
