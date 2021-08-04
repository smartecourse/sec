<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeIdKelasOnFasilitasKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fasilitas_kelas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_kelas');
            $table->integer('id_paket', false, true)->after('id');

            $table->foreign('id_paket')->references('id')->on('paket')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fasilitas_kelas', function (Blueprint $table) {
            
        });
    }
}
