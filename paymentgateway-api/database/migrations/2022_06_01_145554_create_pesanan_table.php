<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->foreignId('id_pelanggan');
            $table->string('nama_pelanggan');
            $table->foreignId('id_tiket_hotel')->nullable();
            $table->foreignId('id_tiket_transportasi')->nullable();
            $table->foreignId('metode_pembayaran');
            $table->integer('total');
            $table->bigInteger('kode_bayar');
            $table->timestamp('tanggal_pesanan', 0)->nullable();
            $table->timestamp('tanggal_pembayaran', 0)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}
