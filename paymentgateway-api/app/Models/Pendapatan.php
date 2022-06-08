<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pendapatan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pendapatan';
    protected $fillable = [
        'id_logging',
        'id_tiket_hotel',
        'id_tiket_transportasi',
        'tarif_transaksi',
        'status_pembayaran'
    ];

    const CREATED_AT = 'tanggal_pesanan';
    const UPDATED_AT = 'tanggal_pembayaran';

    
    public function logging()
    {
        return $this->hasOne(Logging::class, 'id_logging', 'id');
    }
}
