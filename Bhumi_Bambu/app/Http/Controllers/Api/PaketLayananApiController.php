<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaketLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaketLayananApiController extends Controller
{
    // GET /api/paket-layanan
    public function index()
    {
        $paket = PaketLayanan::latest()->get();

        return response()->json([
            'data' => $paket,
            'stats' => [
                'total' => PaketLayanan::count(),
            ],
        ], 200);
    }

    // GET /api/paket-layanan/{id}
    public function show($id)
    {
        $paketLayanan = PaketLayanan::findOrFail($id);

        $jumlahReservasi = DB::table('reservasis')
            ->where('paket_id', $id)
            ->count();

        return response()->json([
            'data' => $paketLayanan,
            'jumlah_reservasi' => $jumlahReservasi,
        ], 200);
    }

    // POST /api/paket-layanan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'venue' => 'nullable|string|max:255',
            'harga' => 'required|integer|min:0',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'gambar_venue' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Upload gambar (kalau ada)
        if ($request->hasFile('gambar_venue')) {
            $file = $request->file('gambar_venue');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $uploadPath = public_path('aset/gambarPaket');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $file->move($uploadPath, $filename);
            $validated['gambar_venue'] = '/aset/gambarPaket/' . $filename;
        }

        $paket = PaketLayanan::create($validated);

        return response()->json([
            'message' => 'Paket layanan berhasil ditambahkan!',
            'data' => $paket,
        ], 201);
    }

    // PUT /api/paket-layanan/{id}
    public function update(Request $request, $id)
    {
        $paketLayanan = PaketLayanan::findOrFail($id);

        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'venue' => 'nullable|string|max:255',
            'harga' => 'required|integer|min:0',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'gambar_venue' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar baru (kalau ada)
        if ($request->hasFile('gambar_venue')) {
            // Hapus gambar lama
            if ($paketLayanan->gambar_venue) {
                $oldFile = public_path($paketLayanan->gambar_venue);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            $file = $request->file('gambar_venue');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $uploadPath = public_path('aset/gambarPaket');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $file->move($uploadPath, $filename);
            $validated['gambar_venue'] = '/aset/gambarPaket/' . $filename;
        } else {
            // kalau tidak upload gambar baru, jangan menimpa field gambar_venue
            unset($validated['gambar_venue']);
        }

        $paketLayanan->update($validated);

        return response()->json([
            'message' => 'Paket layanan berhasil diperbarui!',
            'data' => $paketLayanan,
        ], 200);
    }

    // DELETE /api/paket-layanan/{id}
    public function destroy($id)
    {
        $paketLayanan = PaketLayanan::findOrFail($id);

        $jumlahReservasi = DB::table('reservasis')
            ->where('paket_id', $id)
            ->count();

        if ($jumlahReservasi > 0) {
            return response()->json([
                'message' => 'Paket tidak bisa dihapus karena sedang digunakan di reservasi.',
                'jumlah_reservasi' => $jumlahReservasi,
            ], 409); // conflict
        }

        // Hapus gambar
        if ($paketLayanan->gambar_venue) {
            $file = public_path($paketLayanan->gambar_venue);
            if (file_exists($file)) {
                unlink($file);
            }
        }

        $paketLayanan->delete();

        return response()->json([
            'message' => 'Paket layanan berhasil dihapus!',
        ], 200);
    }
}
