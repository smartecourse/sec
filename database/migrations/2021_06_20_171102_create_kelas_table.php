<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->increments('id', 10);
            $table->string('kode_kelas', 7)->unique();
            $table->text('judul_kelas');
            $table->text('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->string('intro');
            $table->string('intro_link')->nullable();
            $table->string('cover')->nullable();
            $table->string('by_author');
            /* $table->enum('jenis_kelas', ['reguler', 'private']); */
            $table->tinyInteger('kelas_jenis_id');
            $table->smallInteger('diskon')->nullable();
            $table->text('fasilitas');
            $table->enum('tipe_kelas', ['ebook', 'video']);
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
        Schema::dropIfExists('kelas');
    }
}
