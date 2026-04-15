<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats Cards
        $acaraBerlangsung = Reservasi::where('status', 'lunas')
            ->whereDate('tanggal_reservasi', today())
            ->count();
        
        $menungguKonfirmasi = Reservasi::whereIn('status', ['pending', 'menunggu_pembayaran'])
            ->count();
        
        $acaraSelesai = Reservasi::where('status', 'lunas')
            ->whereDate('tanggal_reservasi', '<', today())
            ->count();
        
        $totalReservasi = Reservasi::count();

        // Detail Pelanggan - Semua reservasi
        $detailPelanggan = Reservasi::with('paket')
            ->latest('created_at')
            ->get();

        return view('dashboard', compact(
            'acaraBerlangsung',
            'menungguKonfirmasi',
            'acaraSelesai',
            'totalReservasi',
            'detailPelanggan'
        ));
    }
}