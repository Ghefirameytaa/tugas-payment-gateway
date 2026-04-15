<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class PesananApiController extends Controller
{
    // GET /api/admin/pesanan?status=all|pending|menunggu_pembayaran|lunas|ditolak&search=...
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        $search = $request->get('search', '');

        $query = Reservasi::with(['paket', 'user']);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('kode_booking', 'like', "%{$search}%")
                    ->orWhereHas('paket', function ($sub) use ($search) {
                        $sub->where('nama_paket', 'like', "%{$search}%");
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

        return response()->json([
            'filters' => [
                'status' => $status,
                'search' => $search,
            ],
            'stats' => $stats,
            'data' => $allPesanan,
        ], 200);
    }

    // GET /api/admin/pesanan/{id}
    public function show($id)
    {
        $item = Reservasi::with(['paket', 'user'])->findOrFail($id);

        return response()->json([
            'data' => $item
        ], 200);
    }

    // PATCH /api/admin/pesanan/{id}/approve
    public function approve($id)
    {
        $item = Reservasi::findOrFail($id);

        // NOTE: di controller web kamu cek bukti_transfer.
        // Pastikan nama kolomnya bener (kamu pakai bukti_transfer atau bukti_transer?).
        if (!$item->bukti_transfer) {
            return response()->json([
                'message' => 'Reservasi belum upload bukti transfer!',
            ], 422);
        }

        $item->update([
            'status' => 'menunggu_pembayaran',
            'status_pembayaran' => 'menunggu_verifikasi',
        ]);

        return response()->json([
            'message' => 'Reservasi disetujui! Menunggu verifikasi pembayaran.',
            'data' => $item
        ], 200);
    }

    // PATCH /api/admin/pesanan/{id}/reject
    public function reject($id)
    {
        $item = Reservasi::findOrFail($id);

        $item->update([
            'status' => 'ditolak',
            'status_pembayaran' => 'ditolak',
        ]);

        return response()->json([
            'message' => 'Reservasi ditolak.',
            'data' => $item
        ], 200);
    }

    // DELETE /api/admin/pesanan/{id}
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

        return response()->json([
            'message' => 'Reservasi berhasil dihapus.'
        ], 200);
    }
}
