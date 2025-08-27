<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin1234'),
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@customer.com',
            'password' => Hash::make('customer1234'),
        ])->assignRole('customer');
    }
}
