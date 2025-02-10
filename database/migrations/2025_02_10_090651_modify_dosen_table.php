<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('dosen', function (Blueprint $table) {
            $table->string('nidn', 20)->change(); 
        });
    }

    public function down()
    {
        Schema::table('dosen', function (Blueprint $table) {
            $table->integer('nidn')->change(); // Rollback ke integer jika dibutuhkan
        });
    }
};
