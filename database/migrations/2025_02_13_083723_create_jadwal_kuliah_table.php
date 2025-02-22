<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_kuliah', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->foreignId('id_matkul')->constrained('mata_kuliah', 'id_matkul')->onDelete('cascade');
            $table->foreignId('id_dosen')->constrained('dosen', 'id_dosen')->onDelete('cascade');
            $table->string('ruangan');
            $table->year('angkatan');
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_kuliah');
    }
};
