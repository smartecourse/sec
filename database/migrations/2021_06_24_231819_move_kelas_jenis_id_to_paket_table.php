<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveKelasJenisIdToPaketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('kelas_jenis_id');
        });

        Schema::table('paket', function (Blueprint $table) {
            $table->tinyInteger('kelas_jenis_id', false, false)->after('slug');
            $table->foreign('kelas_jenis_id')->references('id')->on('kelas_jenis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->tinyInteger('kelas_jenis_id', false, false)->after('by_author');
            $table->foreign('kelas_jenis_id')->references('id')->on('kelas_jenis')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('paket', function (Blueprint $table) {
            $table->dropConstrainedForeignId('kelas_jenins_id');
        });
    }
}
