<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Tampilkan halaman daftar
     */
    public function show()
    {
        return view('daftar');
    }

    /**
     * Proses registrasi user + pelanggan
     */
    public function store(Request $request)
    {
        // VALIDASI INPUT
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|min:6|confirmed',
            'no_hp'          => 'nullable|string|max:30',
            'alamat'         => 'nullable|string|max:255',
        ]);

        /**
         * 1️⃣ BUAT USER (AKUN LOGIN)
         */
        $user = User::create([
            'nama_user' => $validated['nama_pelanggan'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'role'      => 'pelanggan',
            'no_hp'     => $validated['no_hp'] ?? null,
            'alamat'    => $validated['alamat'] ?? null,
        ]);

        /**
         * 2️⃣ BUAT PROFIL PELANGGAN (OTOMATIS)
         */
        Pelanggan::create([
            'id_users' => $user->id,
            'nama_pelanggan'    => $validated['nama_pelanggan'],
            'email'   => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'no_hp'   => $validated['no_hp'] ?? null,
            'alamat'  => $validated['alamat'] ?? null,
        ]);

        /**
         * 3️⃣ LOGIN OTOMATIS (OPSIONAL)
         * kalau mau langsung masuk sistem
         */
        Auth::login($user);

        /**
         * 4️⃣ REDIRECT
         */
        return redirect()->route('beranda')
            ->with('success', 'Pendaftaran berhasil. Selamat datang!');
    }
}
