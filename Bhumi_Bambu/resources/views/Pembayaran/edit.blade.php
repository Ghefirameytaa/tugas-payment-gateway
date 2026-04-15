<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    // List pembayaran (reservasi yang upload bukti)
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        $search = $request->get('search', '');

        // Ambil semua reservasi (yang upload bukti atau tidak)
        $query = Reservasi::with(['paket', 'user'])
            ->latest('updated_at');

        // Filter by status
        if ($status != 'all') {
            $query->where('status', $status);
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

        // Statistik
        $stats = [
            'total' => Reservasi::count(),
            'pending' => Reservasi::where('status', 'pending')->count(),
            'disetujui' => Reservasi::where('status', 'disetujui')->count(),
            'ditolak' => Reservasi::where('status', 'ditolak')->count(),
        ];

        return view('pembayaran.index', compact('pembayaran', 'stats', 'status', 'search'));
    }

    // Form create (admin input manual)
    public function create()
    {
        // Ambil reservasi yang belum ada bukti transfer
        $reservasi = Reservasi::with('paket')
            ->whereNull('bukti_transfer')
            ->where('status', 'pending')
            ->get();

        return view('pembayaran.create', compact('reservasi'));
    }

    // Store pembayaran manual
    public function store(Request $request)
    {
        $request->validate([
            'reservasi_id' => 'required|exists:reservasis,id',
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $reservasi = Reservasi::findOrFail($request->reservasi_id);

        // Upload bukti transfer
        if ($request->hasFile('bukti_transfer')) {
            $path = $request->file('bukti_transfer')->store('bukti-transfer', 'public');
            
            $reservasi->update([
                'bukti_transfer' => 'storage/' . $path,
                'status' => 'pending', // Menunggu verifikasi
            ]);
        }

        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil ditambahkan dan menunggu verifikasi.');
    }

    // Detail pembayaran
    public function show($id)
    {
        $reservasi = Reservasi::with(['paket', 'user'])->findOrFail($id);
        
        return view('pembayaran.show', compact('reservasi'));
    }

    // Form edit
    public function edit($id)
    {
        $reservasi = Reservasi::with('paket')->findOrFail($id);
        
        return view('pembayaran.edit', compact('reservasi'));
    }

    // Update pembayaran
    public function update(Request $request, $id)
    {
        $request->validate([
            'bukti_transfer' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        $reservasi = Reservasi::findOrFail($id);

        $data = [
            'status' => $request->status,
        ];

        // Upload bukti transfer baru (jika ada)
        if ($request->hasFile('bukti_transfer')) {
            // Hapus bukti lama
            if ($reservasi->bukti_transfer) {
                $oldPath = str_replace('storage/', '', $reservasi->bukti_transfer);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('bukti_transfer')->store('bukti-transfer', 'public');
            $data['bukti_transfer'] = 'storage/' . $path;
        }

        $reservasi->update($data);

        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil diperbarui.');
    }

    // Delete pembayaran
    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        // Hapus bukti transfer
        if ($reservasi->bukti_transfer) {
            $path = str_replace('storage/', '', $reservasi->bukti_transfer);
            Storage::disk('public')->delete($path);
        }

        // Hapus reservasi
        $reservasi->delete();

        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }

    // Verifikasi pembayaran (Approve/Reject)
    public function verify(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $action = $request->input('action');

        if ($action === 'approve') {
            $reservasi->update(['status' => 'disetujui']);
            return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi! Reservasi disetujui.');
            
        } elseif ($action === 'reject') {
            $reservasi->update(['status' => 'ditolak']);
            return redirect()->back()->with('success', 'Pembayaran ditolak.');
        }

        return redirect()->back()->with('error', 'Action tidak valid.');
    }
}