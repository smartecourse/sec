<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveSomeKelasFieldToPaketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropColumn('harga');
            $table->dropColumn('diskon');
            $table->dropColumn('deadline');
            $table->dropColumn('link_zoom');
        });

        Schema::table('paket', function (Blueprint $table) {
            $table->text('cover')->nullable()->after('slug');
            $table->smallInteger('diskon')->default(0)->after('cover');
            $table->bigInteger('harga')->default(0)->after('diskon');
            $table->integer('deadline', false, true)->after('harga');
            $table->text('link_zoom')->nullable()->after('deadline');
            $table->text('group_whatsapp')->nullable()->after('link_zoom');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paket', function (Blueprint $table) {
            $table->dropColumn('cover');
            $table->dropColumn('diskon');
            $table->dropColumn('harga');
            $table->dropColumn('deadline');
            $table->dropColumn('link_zoom');
            $table->dropColumn('group_whatsapp');
        });
    }
}
