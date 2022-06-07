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
        'id_pesanan',
        'id_tiket_hotel',
        'id_tiket_transportasi',
        'tarif_transaksi',
    ];
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }
}
