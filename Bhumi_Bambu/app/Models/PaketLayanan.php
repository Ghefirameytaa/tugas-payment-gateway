<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketLayanan extends Model
{
    use HasFactory;

    protected $table = 'paket_layanan';

    protected $fillable = [
        'id_admin',
        'nama_paket',
        'venue',
        'harga',
        'fasilitas',
        'deskripsi',
        'kapasitas',
        'gambar_venue',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }
}
