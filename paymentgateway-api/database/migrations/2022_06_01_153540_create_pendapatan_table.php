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
            $table->id('id_pendapatan');
            $table->foreignId('id_pesanan');
            $table->foreignId('id_tiket_hotel')->nullable();
            $table->foreignId('id_tiket_transportasi')->nullable();
            $table->timestamp('tanggal_pembayaran');
            $table->integer('tarif_transaksi');
            $table->softDeletes();
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
        Schema::dropIfExists('pendapatan');
    }
}
