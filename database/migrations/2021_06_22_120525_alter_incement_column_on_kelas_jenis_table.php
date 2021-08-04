<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterIncementColumnOnKelasJenisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelas_jenis', function (Blueprint $table) {
            DB::unprepared("ALTER TABLE kelas_jenis CHANGE id id tinyint(4)AUTO_INCREMENT PRIMARY KEY");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelas_jenis', function (Blueprint $table) {
            //
        });
    }
}
