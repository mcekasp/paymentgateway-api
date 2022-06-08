<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendapatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendapatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_logging');
            $table->foreignId('id_tiket_hotel')->nullable();
            $table->foreignId('id_tiket_transportasi')->nullable();
            $table->integer('tarif_transaksi');
            $table->boolean('status_pembayaran')->default(false);
            $table->softDeletes();
            $table->timestamp('tanggal_pesanan', 0)->nullable();
            $table->timestamp('tanggal_pembayaran', 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendapatan');
    }
}
