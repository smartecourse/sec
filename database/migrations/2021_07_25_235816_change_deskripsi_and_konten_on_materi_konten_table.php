<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDeskripsiAndKontenOnMateriKontenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materi_konten', function (Blueprint $table) {
            $table->binary('deskripsi')->nullable()->after('slug')->change();
            $table->binary('konten')->nullable()->after('deskripsi')->change();
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
            $table->text('deskripsi')->nullable()->after('slug')->change();
            $table->text('konten')->nullable()->after('deskripsi')->change();
        });
    }
}
