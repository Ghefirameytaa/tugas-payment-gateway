<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailPaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\DetailPaketLayanan::create([
            'id_paket' => 1,
            'id_pemesanan' => 1,
            'tanggal_acara' => '2025-11-15',
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '16:30:00',
            'jumlah' => 10,
            'total' => 100.000,
        ]);

        \App\Models\DetailPaketLayanan::create([
            'id_paket' => 2,
            'id_pemesanan' => 2,
            'tanggal_acara' => '2025-12-20',
            'jam_mulai' => '09:00:00',
            'jam_selesai' => '17:00:00',
            'jumlah' => 20,
            'total' => 300.000,
        ]);
    }
}
