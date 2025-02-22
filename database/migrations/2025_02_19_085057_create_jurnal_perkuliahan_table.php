<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('jurnal_perkuliahan', function (Blueprint $table) {
            $table->id('id_jurnal');
            $table->unsignedBigInteger('id_jadwal');
            $table->unsignedBigInteger('id_dosen');
            $table->string('materi');
            $table->date('tanggal');
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_jadwal')->references('id_jadwal')->on('jadwal_kuliah')->onDelete('cascade');
            $table->foreign('id_dosen')->references('id_dosen')->on('dosen')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jurnal_perkuliahan');
    }
};
