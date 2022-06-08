<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pesanan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pesanan';
    protected $fillable = [
        'id_pelanggan',
        'nama_pelanggan',
        'id_tiket_hotel',
        'id_tiket_transportasi',
        'metode_pembayaran',
        'total',
        'kode_bayar'
    ];
    
    const CREATED_AT = 'tanggal_pesanan';
    const UPDATED_AT = 'tanggal_pembayaran';

    public function metode_pembayaran()
    {
        return $this->belongsTo(Metode_Pembayaran::class,'id_metode','id');
    }
    public function logging()
    {
        return $this->hasOne(Logging::class,'id_pesanan','id_pesanan');
    }
}
