<?php

namespace Database\Seeders;

use App\Models\Pesanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pesanan::create([
            'pelanggan_id' => 1,
            'layanan_id' => 1,
            // 'status' => 'Pending',
            'deskripsi_pesan' => 'Deskripsi',
            'file_desain' => null,
            // 'jumlah_pemesanan' => rand(1, 10),
            'tanggal_pesan' => now(),
            'tanggal_selesai' => now()->addDays(rand(3, 10)),
            'total_harga' => 0,
        ]);
    }
}
