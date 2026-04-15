<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $fillable = [
        'nama_pemesan',
        'id_pelanggan',
        'id_paket',
        'id_promo',
        'tanggal_pesanan',
        'status_pesanan',
        'total_harga',
    ];

    // Relasi (kalau modelnya ada)
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function paket()
    {
        return $this->belongsTo(PaketLayanan::class, 'id_paket');
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class, 'id_promo');
    }
}