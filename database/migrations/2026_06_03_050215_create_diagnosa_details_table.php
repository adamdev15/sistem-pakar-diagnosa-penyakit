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
        Schema::create('diagnosa_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diagnosa_id')->constrained('diagnosas')->onDelete('cascade');
            $table->foreignId('gejala_id')->constrained('gejalas')->onDelete('cascade');
            $table->decimal('cf_user', 4, 2);
            $table->decimal('cf_pakar', 4, 2);
            $table->decimal('cf_hasil', 4, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosa_details');
    }
};
