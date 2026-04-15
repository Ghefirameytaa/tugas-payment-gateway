<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;

class ProfilePelangganController extends Controller
{
    // Tampilkan profil pelanggan
    public function index()
    
    {
        $user = Auth::user();
        $pelanggan = Pelanggan::where('email', $user->email)->first();

        // dd($user->email, $pelanggan);

        return view('profil.index', compact('pelanggan'));
    }

    // Form edit profil
    public function edit()
    {
        $pelanggan = Pelanggan::where('email', Auth::user()->email)->first();

        return view('pelanggan.edit-profile', compact('pelanggan'));
    }

    // Update data profil
    public function update(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required',
            'alamat' => 'nullable|string',
        ]);

        $pelanggan = Pelanggan::where('email', Auth::user()->email)->first();

        $pelanggan->update([
            'nama_pelanggan' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('pelanggan.profile')
                         ->with('success', 'Profil berhasil diperbarui');
    }
}
