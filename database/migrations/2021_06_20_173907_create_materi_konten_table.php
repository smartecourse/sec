<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriKontenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materi_konten', function (Blueprint $table) {
            $table->increments('id', 10);
            $table->integer('materi_id');
            $table->text('judul_konten_materi');
            $table->text('slug');
            $table->text('deskripsi')->nullable();
            $table->string('konten');
            $table->integer('urutan');
            $table->enum('is_active', ['active', 'deactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materi_konten');
    }
}
