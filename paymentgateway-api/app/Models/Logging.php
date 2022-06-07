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
    // protected $guarded = [
    //     'id_logging',
    //     'id_pesanan',
    //     'id_vendor',
    //     'id_ticket'
    // ];

    protected $fillable = [
        'id_pesanan',
        'nama_pelanggan',
        'id_tiket_hotel',
        'id_tiket_transportasi',
        'metode_pembayaran',
        'total',
        'kode_bayar'
    ];
    const CREATED_AT = 'tanggal_pesanan';
    const UPDATED_AT = 'tanggal_pembayaran';

    protected $hidden = [];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }
}
