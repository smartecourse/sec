<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_kelas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user', false, true);
            $table->integer('id_kelas', false, true);
            $table->smallInteger('rating', false, false)->default(0);
            $table->text('review');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_kelas')->references('id')->on('kelas')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_kelas');
    }
}
