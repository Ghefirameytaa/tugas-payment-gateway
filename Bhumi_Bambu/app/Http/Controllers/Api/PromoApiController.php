<?php

namespace App\Http\Controllers\Api;

use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PromoApiController extends Controller
{
    public function index()
    {
        $promos = Promo::with('admin')->latest()->get();
        
        $stats = [
            'total' => Promo::count(),
            'aktif' => Promo::where('tanggal_selesai', '>=', now())->count(),
            'kadaluarsa' => Promo::where('tanggal_selesai', '<', now())->count(),
        ];
        
        return response()->json([
            'data' => $promos,
            'stats' => $stats,
        ], 200);
    }

    public function create()
    {
        return response()->json(['message' => 'Create promo page'], 200 );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_promo' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'diskon' => 'required|numeric|min:1|max:100',
        ]);

        Promo::create([
            'id_admin' => Auth::id(),
            'nama_promo' => $request->nama_promo,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'diskon' => $request->diskon,
        ]);

        return redirect()->route('admin.promo.index')
            ->with('success', 'Promo berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $promo = Promo::findOrFail($id);
        return response()->json(['promo' => $promo]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_promo' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'diskon' => 'required|numeric|min:1|max:100',
        ]);

        $promo = Promo::findOrFail($id);
        $promo->update($request->all());

        return redirect()->route('admin.promo.index')
            ->with('success', 'Promo berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);
        $promo->delete();
        
        return redirect()->route('admin.promo.index')
            ->with('success', 'Promo berhasil dihapus!');
    }
}