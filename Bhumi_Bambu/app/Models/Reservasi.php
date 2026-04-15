<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Reservasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_booking',
        'user_id',
        'paket_id',
        'nama_lengkap',
        'nomor_ponsel',
        'email',
        'tanggal_reservasi',
        'jam_acara',
        'jumlah_orang',
        'catatan',
        'bukti_transfer',
        'catatan_pembayaran',
        'status',
        'status_pembayaran',
    ];

    protected $casts = [
        'tanggal_reservasi' => 'date',
    ];

    // Auto-generate kode booking
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($reservasi) {
            if (!$reservasi->kode_booking) {
                $reservasi->kode_booking = 'BKG-' . strtoupper(Str::random(8));
            }
        });
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Paket Layanan
    public function paket()
    {
        return $this->belongsTo(PaketLayanan::class, 'paket_id');
    }

    // Accessor - Total Harga
    public function getTotalHargaAttribute()
    {
        if (!$this->paket) {
            return 0;
        }
        return $this->paket->harga * $this->jumlah_orang;
    }

    // Accessor - Format Harga
    public function getFormattedHargaAttribute()
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }
}