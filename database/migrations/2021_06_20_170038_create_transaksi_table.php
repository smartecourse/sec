<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi', 10)->unique();
            $table->bigInteger('user_id');
            $table->integer('kelas_id');
            $table->enum('metode_pembayaran', ['midtrans']);
            $table->bigInteger('grand_total');
            $table->enum('status', ['disetujui', 'sedang diproses', 'ditolak']);
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
        Schema::dropIfExists('transaksi');
    }
}
