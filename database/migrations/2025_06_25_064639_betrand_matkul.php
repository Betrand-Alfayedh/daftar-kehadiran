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
        Schema::create('matkul', function (Blueprint $table) {
            $table->id('id_matkul');
            $table->string('nama_matkul');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('matkul');
    }
};
