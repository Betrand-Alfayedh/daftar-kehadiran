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
    Schema::table('absensi_mahasiswa', function (Blueprint $table) {
        $table->unsignedBigInteger('id_matkul')->after('id_dosen');

        $table->foreign('id_matkul')
              ->references('id_matkul')
              ->on('matkul') // atau 'mata_kuliah' jika itu nama tabel kamu sebenarnya
              ->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('absensi_mahasiswa', function (Blueprint $table) {
        $table->dropForeign(['id_matkul']);
        $table->dropColumn('id_matkul');
    });
}

};
