<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPaketLayanan extends Model
{
    protected $table = 'detail_paket_layanan';

    protected $fillable = [
        'id_paket',
        'id_pemesanan',
        'tanggal_acara',
        'jam_mulai',
        'jam_selesai',
        'jumlah',
        'total',
    ];

    public function PaketLayanan()
    {
        return $this->belongsTo(PaketLayanan::class, 'id_paket');
    }
}
