<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Metode_Pembayaran extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'metode_pembayaran';
    protected $fillable = [
        'nama_penyedia',
        'tarif_transaksi',
    ];

    protected $hidden = [];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'metode_pembayaran', 'id');
    }
}
