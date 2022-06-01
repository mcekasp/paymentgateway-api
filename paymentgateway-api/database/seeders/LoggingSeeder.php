<?php

namespace Database\Seeders;

use App\Models\Logging;
use Illuminate\Database\Seeder;

class LoggingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Logging::create([
            'id_pesanan' => '551',
            'id_vendor' => '111',
            'id_ticket' => '001',
            'total_pembayaran' => '500000',
            'tanggal_pembayaran' => current_timestamp(),
            'status' => '1'
        ]);

        Logging::create([
            'id_pesanan' => 552,
            'id_vendor' => 112,
            'id_ticket' => 002,
            'total_pembayaran' => 600000,
            'tanggal_pembayaran' => current_timestamp(),
            'status' => 1
        ]);

        Logging::create([
            'id_pesanan' => 553,
            'id_vendor' => 113,
            'id_ticket' => 003,
            'total_pembayaran' => 700000,
            'tanggal_pembayaran' => current_timestamp(),
            'status' => 1
        ]);

        Logging::create([
            'id_pesanan' => 554,
            'id_vendor' => 114,
            'id_ticket' => 004,
            'total_pembayaran' => 800000,
            'tanggal_pembayaran' => current_timestamp(),
            'status' => 1
        ]);

        Logging::create([
            'id_pesanan' => 555,
            'id_vendor' => 115,
            'id_ticket' => 005,
            'total_pembayaran' => 900000,
            'tanggal_pembayaran' => current_timestamp(),
            'status' => 1
        ]);
    }
}
