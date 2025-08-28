<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanans';

    protected $fillable = [
        'pelanggan_id',
        'layanan_id',
        'status',
        'deskripsi_pesan',
        'file_desain',
        'jumlah_pemesanan',
        'tanggal_pesan',
        'tanggal_selesai',
        'total_harga',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'id');
    }
}
