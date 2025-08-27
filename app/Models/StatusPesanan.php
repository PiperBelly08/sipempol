<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPesanan extends Model
{
    protected $table = 'status_pesanan';

    protected $fillable = [
        'nama_status',
    ];
}
