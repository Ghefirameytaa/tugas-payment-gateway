<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pesanan;
use App\Models\User;


class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'pemesanan_id',
        'tanggal_pembayaran',
        'metode_pembayaran',
        'nama_bank',
        'nama_pengirim',
        'jumlah_bayar',
        'status_pembayaran',
        'bukti_pembayaran',
        'catatan_admin',
        'waktu_verifikasi',
        'verifikasi_oleh',
    ];

    protected $casts = [
        'tanggal_pembayaran' => 'datetime',
        'waktu_verifikasi'   => 'datetime',
        'jumlah_bayar'       => 'integer',
    ];

    /* ================= RELATION ================= */

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pemesanan_id');
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'verifikasi_oleh');
    }

    /* ================= STATUS HELPER ================= */

    public function isPending()
    {
        return in_array(strtolower($this->status_pembayaran), [
            'pending', 'menunggu', 'menunggu verifikasi'
        ]);
    }

    public function isApproved()
    {
        return in_array(strtolower($this->status_pembayaran), [
            'approved', 'berhasil', 'success'
        ]);
    }

    public function isRejected()
    {
        return in_array(strtolower($this->status_pembayaran), [
            'rejected', 'dibatalkan', 'ditolak'
        ]);
    }

    public function getStatusBadgeClass()
    {
        if ($this->isPending()) return 'pending';
        if ($this->isApproved()) return 'success';
        if ($this->isRejected()) return 'cancel';
        return 'pending';
    }

    public function getStatusLabel()
    {
        if ($this->isPending()) return 'Menunggu Verifikasi';
        if ($this->isApproved()) return 'Berhasil';
        if ($this->isRejected()) return 'Dibatalkan';
        return ucfirst($this->status_pembayaran);
    }

    /* ================= FORMAT HELPER ================= */

    public function getFormattedAmount()
    {
        return 'Rp ' . number_format($this->jumlah_bayar, 0, ',', '.');
    }

    public function getFormattedDate()
    {
        return optional($this->tanggal_pembayaran)->format('d/m/Y') ?? '-';
    }
}
