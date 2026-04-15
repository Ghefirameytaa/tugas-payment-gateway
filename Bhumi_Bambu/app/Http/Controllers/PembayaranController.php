<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        $search = $request->get('search', '');

        // PERBAIKAN: Ambil yang SUDAH UPLOAD bukti transfer
        $query = Reservasi::with(['paket', 'user'])
            ->whereNotNull('bukti_transfer')  // ← Harus ada bukti
            ->latest('updated_at');

        // Filter by status_pembayaran (bukan status!)
        if ($status != 'all') {
            $query->where('status_pembayaran', $status);
        }

        // Search
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('kode_booking', 'like', "%{$search}%");
            });
        }

        $pembayaran = $query->get();

        // Stats - PERBAIKAN: Hitung dari yang ada bukti transfer
        $stats = [
            'total' => Reservasi::whereNotNull('bukti_transfer')->count(),
            'menunggu_verifikasi' => Reservasi::whereNotNull('bukti_transfer')
                ->where('status_pembayaran', 'menunggu_verifikasi')->count(),
            'lunas' => Reservasi::where('status_pembayaran', 'lunas')->count(),
            'ditolak' => Reservasi::where('status_pembayaran', 'ditolak')->count(),
        ];

        return view('pembayaran.index', compact('pembayaran', 'stats', 'status', 'search'));
    }

    public function show($id)
    {
        $reservasi = Reservasi::with(['paket', 'user'])->findOrFail($id);
        
        if (!$reservasi->bukti_transfer) {
            return redirect()->route('admin.pembayaran.index')
                ->with('error', 'Reservasi ini belum upload bukti transfer.');
        }

        return view('pembayaran.show', compact('reservasi'));
    }

    public function verify(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
            'catatan_pembayaran' => 'nullable|string',
        ]);

        $reservasi = Reservasi::findOrFail($id);
        $action = $request->input('action');
        $catatan = $request->input('catatan_pembayaran');

        if ($action === 'approve') {
            // PERBAIKAN: Update KEDUA status
            $reservasi->update([
                'status' => 'lunas',
                'status_pembayaran' => 'lunas',
                'catatan_pembayaran' => $catatan ?? 'Pembayaran terverifikasi',
            ]);
            
            return redirect()->back()->with('success', 'Pembayaran terverifikasi! Reservasi lunas.');
            
        } elseif ($action === 'reject') {
            // PERBAIKAN: Update KEDUA status
            $reservasi->update([
                'status' => 'pending',
                'status_pembayaran' => 'ditolak',
                'catatan_pembayaran' => $catatan ?? 'Bukti pembayaran tidak valid',
            ]);
            
            return redirect()->back()->with('success', 'Pembayaran ditolak. Customer diminta upload ulang.');
        }

        return redirect()->back()->with('error', 'Action tidak valid.');
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        // Hapus file bukti transfer
        if ($reservasi->bukti_transfer) {
            $path = str_replace('storage/', '', $reservasi->bukti_transfer);
            Storage::disk('public')->delete($path);
        }

        // RESET status pembayaran, tapi reservasi TETAP ADA
        $reservasi->update([
            'bukti_transfer' => null,
            'status' => 'pending',
            'status_pembayaran' => 'belum_bayar',
            'catatan_pembayaran' => null,
        ]);

        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Bukti pembayaran berhasil dihapus. Reservasi dikembalikan ke status pending.');
    }
}