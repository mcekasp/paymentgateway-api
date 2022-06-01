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
        'id_vendor',
        'id_ticket',
        'total_pembayaran',
        'status'
    ];

    protected $hidden = [];
}
