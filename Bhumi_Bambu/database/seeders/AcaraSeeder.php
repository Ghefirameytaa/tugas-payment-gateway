<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Acara;

class AcaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Acara::create([
            'nama' => 'Workshop Laravel',
            'tanggal' => '2025-12-25',
            'status' => 'berlangsung',
        ]);

        Acara::create([
            'nama' => 'Seminar UI/UX',
            'tanggal' => '2025-12-28',
            'status' => 'selesai',
        ]);

        Acara::create([
            'nama' => 'Pelatihan Figma',
            'tanggal' => '2025-12-30',
            'status' => 'berlangsung',
        ]);
    }
}
