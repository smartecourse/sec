<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeKontenOnMateriKontenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materi_konten', function (Blueprint $table) {
            $table->text('konten')->nullable()->after('deskripsi')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('materi_konten', function (Blueprint $table) {
            $table->string('konten')->after('deskripsi')->change();
        });
    }
}
