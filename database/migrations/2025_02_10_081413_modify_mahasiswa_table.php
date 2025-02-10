<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMahasiswaTable extends Migration
{
    public function up()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->string('nim', 20)->change(); // Mengubah tipe data NIM dari integer ke varchar(20)
        });
    }

    public function down()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->integer('nim')->change(); // Rollback ke integer jika dibutuhkan
        });
    }
}
