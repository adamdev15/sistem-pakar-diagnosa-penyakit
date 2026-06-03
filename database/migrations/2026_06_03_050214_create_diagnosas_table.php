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
        Schema::create('diagnosas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_diagnosa', 30)->unique();
            $table->string('nama_pasien', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->integer('umur');
            $table->dateTime('tanggal_diagnosa');
            $table->foreignId('hasil_penyakit_id')->nullable()->constrained('penyakits')->onDelete('set null');
            $table->decimal('nilai_cf', 8, 4)->nullable();
            $table->decimal('persentase', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosas');
    }
};
