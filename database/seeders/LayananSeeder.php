<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Layanan::create([
            'nama' => 'Spanduk',
            'deskripsi' => 'Layanan pembuatan spanduk dengan berbagai ukuran dan desain sesuai kebutuhan Anda.',
            'harga' => 30000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
