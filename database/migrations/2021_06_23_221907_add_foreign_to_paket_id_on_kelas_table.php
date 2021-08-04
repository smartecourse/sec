<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToPaketIdOnKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->integer('paket_id', false, true)->after('id')->change();
            $table->foreign('paket_id', 'kelas_paket_id_foreign')->references('id')->on('paket')->cascadeOnDelete()->cascadeOnUpdate();
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
            $table->integer('paket_id')->after('id');
            $table->dropForeign('kelas_paket_id_foreign');
        });
    }
}
