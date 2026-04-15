<?php

namespace Database\Seeders;

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
        //Admin
        \App\Models\User::create([
            'nama_user' => 'Ghefira Meyta',
            'email' => 'ghefirameyta@gmail.com',
            'password' => Hash::make('password123'),
            'no_hp' => '082345678901',
            'alamat' => 'Jl. Kenanga No. 12, Bandung',
            'role' => 'admin',
        ]);

        //Pelanggan
        \App\Models\User::create([
            'nama_user' => 'Jaehyun',
            'email' => 'farahrizkipermatasari@gmail.com',
            'password' => Hash::make('password123'),
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Melati No. 45, Jakarta',
            'role' => 'pelanggan',
        ]);
    }
}
