<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->get();

        foreach ($users as $user) {
            Pelanggan::create([
                'nama' => $user->name,
                'email' => $user->email,
                'telepon' => '0812' . rand(10000000, 99999999),
                'alamat' => 'Jl. Contoh Alamat No. ' . rand(1, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
