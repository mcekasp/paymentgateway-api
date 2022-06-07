<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoggingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logging', function (Blueprint $table) {
            $table->id('id_logging');
            $table->foreignId('id_pesanan');
            $table->string('nama_pelanggan');
            $table->foreignId('id_tiket_hotel')->nullable();
            $table->foreignId('id_tiket_transportasi')->nullable();
            $table->string('metode_pembayaran');
            $table->integer('total');
            $table->bigInteger('kode_bayar');
            $table->boolean('status_pembayaran')->default(false);
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
        Schema::dropIfExists('logging');
    }
}
