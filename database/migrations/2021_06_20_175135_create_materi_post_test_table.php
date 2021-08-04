<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriPostTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materi_post_test', function (Blueprint $table) {
            $table->increments('id', 10);
            $table->integer('materi_id');
            $table->text('judul_post_test');
            $table->text('slug');
            $table->text('embed_link');
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
        Schema::dropIfExists('materi_post_test');
    }
}
