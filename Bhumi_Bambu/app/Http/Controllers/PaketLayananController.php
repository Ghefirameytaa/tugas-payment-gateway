<?php

namespace App\Http\Controllers;

use App\Models\PaketLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaketLayananController extends Controller
{
    public function index(Request $request)
    {
        $paket = PaketLayanan::latest()->get();

        $stats = [
            'total' => PaketLayanan::count(),
        ];

        return view('paketlayanan.index', compact('paket', 'stats' ));
    }

    public function create()
    {
        return view('paketlayanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'venue' => 'nullable|string|max:255',
            'harga' => 'required|integer|min:0',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'gambar_venue' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $data = $request->only([
            'nama_paket',
            'venue',
            'harga',
            'kapasitas',
            'fasilitas',
            'deskripsi',
        ]);

        // Upload gambar ke folder public/aset/gambarPaket 
        if ($request->hasFile('gambar_venue')) {
            $file = $request->file('gambar_venue');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $uploadPath = public_path('aset/gambarPaket');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            // Upload file
            $file->move($uploadPath, $filename);
            
            $data['gambar_venue'] = '/aset/gambarPaket/' . $filename;
        }

        PaketLayanan::create($data);

        return redirect()->route('admin.paket-layanan.index')
            ->with('success', 'Paket layanan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $paketLayanan = PaketLayanan::findOrFail($id);
        
        $jumlahReservasi = DB::table('reservasis')
            ->where('paket_id', $id)
            ->count();
        
        return view('paketlayanan.show', compact('paketLayanan', 'jumlahReservasi'));
    }

    public function edit($id)
    {
        $paketLayanan = PaketLayanan::findOrFail($id);
        
        return view('paketlayanan.edit', compact('paketLayanan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'venue' => 'nullable|string|max:255',
            'harga' => 'required|integer|min:0',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'gambar_venue' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $paketLayanan = PaketLayanan::findOrFail($id);

        $data = $request->only([
            'nama_paket',
            'venue',
            'harga',
            'kapasitas',
            'fasilitas',
            'deskripsi',
        ]);

        // Upload gambar baru
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
            $data['gambar_venue'] = '/aset/gambarPaket/' . $filename;
        }

        $paketLayanan->update($data);

        return redirect()->route('admin.paket-layanan.index')
            ->with('success', 'Paket layanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $paketLayanan = PaketLayanan::findOrFail($id);

        $jumlahReservasi = DB::table('reservasis')
            ->where('paket_id', $id)
            ->count();
        
        if ($jumlahReservasi > 0) {
            return redirect()->back()
                ->with('error', 'Paket tidak bisa dihapus karena sedang digunakan di ' . $jumlahReservasi . ' reservasi!');
        }

        // Hapus gambar
        if ($paketLayanan->gambar_venue) {
            $file = public_path($paketLayanan->gambar_venue);
            if (file_exists($file)) {
                unlink($file);
            }
        }

        $paketLayanan->delete();

        return redirect()->route('admin.paket-layanan.index')
            ->with('success', 'Paket layanan berhasil dihapus!');
    }
}