<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';

    protected $fillable = [
        'nama',
        'alamat',
        'telepon',
        'email',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'pelanggan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
