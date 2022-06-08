<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Logging extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'logging';
    protected $touches = ['pesanan'];


    protected $fillable = [
        'id_pesanan',
        'nama_pelanggan',
        'id_tiket_hotel',
        'id_tiket_transportasi',
        'metode_pembayaran',
        'total',
        'kode_bayar',
        'status_pembayaran',
        'tanggal_pembayaran'
    ];
    const CREATED_AT = 'tanggal_pesanan';
    const UPDATED_AT = 'tanggal_pembayaran';

    protected $hidden = [];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }
    public function pendapatan()
    {
        return $this->belongsTo(Pesanan::class, 'id_logging', 'id');
    }
}
