<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        $search = $request->get('search', '');

        $query = Reservasi::with(['paket', 'user']);
        
        if ($status != 'all') {
            $query->where('status', $status);
        }
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('kode_booking', 'like', "%{$search}%")
                  ->orWhereHas('paket', function($query) use ($search) {
                      $query->where('nama_paket', 'like', "%{$search}%");
                  });
            });
        }

        $allPesanan = $query->latest('created_at')->get();

        $stats = [
            'total' => Reservasi::count(),
            'pending' => Reservasi::where('status', 'pending')->count(),
            'menunggu_pembayaran' => Reservasi::where('status', 'menunggu_pembayaran')->count(),
            'lunas' => Reservasi::where('status', 'lunas')->count(),
            'ditolak' => Reservasi::where('status', 'ditolak')->count(),
        ];

        return view('pesanan.index', compact('allPesanan', 'stats', 'status', 'search'));
    }

    public function approve($id)
    {
        $item = Reservasi::findOrFail($id);
        
        if (!$item->bukti_transfer) {
            return redirect()->back()->with('error', 'Reservasi belum upload bukti transfer!');
        }
        
        $item->update([
            'status' => 'menunggu_pembayaran',
            'status_pembayaran' => 'menunggu_verifikasi'
        ]);
        
        return redirect()->back()->with('success', 'Reservasi disetujui! Menunggu verifikasi pembayaran.');
    }

    public function reject($id)
    {
        $item = Reservasi::findOrFail($id);
        
        $item->update([
            'status' => 'ditolak',
            'status_pembayaran' => 'ditolak'
        ]);
        
        return redirect()->back()->with('success', 'Reservasi ditolak.');
    }

    public function destroy($id)
    {
        $item = Reservasi::findOrFail($id);
        
        if ($item->bukti_transfer) {
            $filePath = public_path($item->bukti_transfer);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        $item->delete();
        
        return redirect()->back()->with('success', 'Reservasi berhasil dihapus.');
    }

    public function show($id)
    {
        $item = Reservasi::with(['paket', 'user'])->findOrFail($id);
        return view('pesanan.show', compact('item'));
    }
}