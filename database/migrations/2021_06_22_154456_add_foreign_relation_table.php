<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fasilitas_kelas', function (Blueprint $table) {
            $table->foreign('id_kelas')->references('id')->on('kelas')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('kelas_aktif', function (Blueprint $table) {
            $table->integer('kelas_id', false, true)->change();
            $table->bigInteger('user_id', false, true)->change();

            $table->foreign('kelas_id')->references('id')->on('kelas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('materi', function (Blueprint $table) {
            $table->integer('kelas_id', false, true)->change();

            $table->foreign('kelas_id')->references('id')->on('kelas')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('materi_konten', function (Blueprint $table) {
            $table->integer('materi_id', false, true)->change();

            $table->foreign('materi_id')->references('id')->on('materi')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('materi_konten_selesai', function (Blueprint $table) {
            $table->integer('kelas_aktif_id', false, true)->change();
            $table->integer('materi_konten_id', false, true)->change();

            $table->foreign('kelas_aktif_id')->references('id')->on('kelas_aktif')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('materi_konten_id')->references('id')->on('materi_konten')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('materi_post_test', function (Blueprint $table) {
            $table->integer('materi_id', false, true)->change();

            $table->foreign('materi_id')->references('id')->on('materi')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::table('transaksi', function (Blueprint $table) {
            $table->integer('kelas_id', false, true)->change();
            $table->bigInteger('user_id', false, true)->change();
            
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('kelas_id')->references('id')->on('kelas')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
