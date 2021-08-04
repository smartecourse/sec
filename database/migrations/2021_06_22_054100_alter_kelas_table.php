<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelas', function(Blueprint $table) {
            $table->text('intro')->nullable()->after('deskripsi')->change();
            $table->text('intro_link')->nullable()->after('intro')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelas', function(Blueprint $table) {
            $table->string('intro')->after('deskripsi')->change();
            $table->string('intro_link')->nullable()->change();
        });
    }
}
