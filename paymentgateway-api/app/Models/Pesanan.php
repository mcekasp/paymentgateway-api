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
        'id_vendor',
        'id_ticket',
        'id_metode',
        'total',
        'status',
    ];
    public function pendapatan()
    {
        return $this->hasOne(Pendapatan::class);
    }
}
