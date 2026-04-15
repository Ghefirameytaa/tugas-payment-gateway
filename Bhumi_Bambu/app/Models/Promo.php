<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'promo';

    protected $fillable = [
        'id_admin',
        'nama_promo',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'diskon',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    public function PaketLayanan()
    {
        return $this->hasMany(PaketLayanan::class, 'id_promo');
    }

    public function Pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'id_promo');
    }
}
