<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Promo::create([
            'id_admin' => 1,
            'nama_promo' => 'BAMBUSTART',
            'deskripsi' => 'Diskon Khusus Pengguna Baru! Hemat Hingga 10%!',
            'tanggal_mulai' => '2025-12-01',
            'tanggal_selesai' => '2026-12-01',
            'diskon' => 10,
        ]);

        \App\Models\Promo::create([
            'id_admin' => 2,
            'nama_promo' => 'BAMBUSHOCK',
            'deskripsi' => 'Flash Sale! Harga Spesial Untuk Libur NATARU',
            'tanggal_mulai' => '2025-12-24',
            'tanggal_selesai' => '2026-01-01',
            'diskon' => 15,
        ]);

        \App\Models\Promo::create([
            'id_admin' => 3,
            'nama_promo' => 'BAMBUFEST',
            'deskripsi' => 'Promo Akhir Tahun.',
            'tanggal_mulai' => '2025-12-30',
            'tanggal_selesai' => '2025-12-31',
            'diskon' => 20,
        ]);
    }
}
