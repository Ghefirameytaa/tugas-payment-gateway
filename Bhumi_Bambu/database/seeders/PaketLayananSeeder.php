<?php

// namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// class PaketLayananSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         PaketLayanan::create([
//             'id_admin' => 1,
//             'nama_paket' => 'Bhumi Area', 
//             'harga' => 50000,
//             'kapasitas' => 4,
//             'fasilitas' => 'adalah pokoknya',   
//             'venue' => 'Bambu area',
//             'gambar_venue' => 'camping.jpg',
//         ]);
    

//         PaketLayanan::create([
//             'id_admin' => 1,
//             'nama_paket' => 'Bhambu Area', 
//             'harga' => 50000,
//             'kapasitas' => 5,
//             'fasilitas' => 'ada pokoknya',   
//             'venue' => 'Bhumiu area',
//             'gambar_venue' => 'edukasi.jpg',
//         ]);


//         PaketLayanan::create([
//             'id_admin' => 1,
//             'nama_paket' => 'Camping Area',
//             'harga' => 50000,
//             'kapasitas' => 4,
//             'fasilitas' => 'adalah pokoknya',   
//             'venue' => 'Bambu area',
//             'gambar_venue' => 'camping.jpg',
//         ]);
//     }
// }



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaketLayanan;
use Illuminate\Support\Facades\DB;

class PaketLayananSeeder extends Seeder
{
    public function run(): void
    {
        // ambil id user pertama kalau ada, kalau tidak pakai null
        $adminId = DB::table('users')->min('id');

        PaketLayanan::insert([
            [
                'id_admin'     => $adminId, 
                'nama_paket'   => 'Bhumi Area',
                'venue'        => 'Area outdoor dengan pemandangan alam',
                'harga'        => '50000',
                'kapasitas'    => 30,
                'fasilitas'    => "Tenda\nMatras\nMakan & Minum",
                'gambar_venue' => 'default.jpg',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id_admin'     => $adminId,
                'nama_paket'   => 'Bambu Area',
                'venue'        => 'Area camping bambu',
                'harga'        => '60000',
                'kapasitas'    => 25,
                'fasilitas'    => "Tenda\nApi unggun\nMakan malam",
                'gambar_venue' => 'default.jpg',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id_admin'     => $adminId,
                'nama_paket'   => 'Camping Keluarga',
                'venue'        => 'Area camping keluarga',
                'harga'        => '75000',
                'kapasitas'    => 20,
                'fasilitas'    => "Tenda besar\nMatras\nSarapan",
                'gambar_venue' => 'default.jpg',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
