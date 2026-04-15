<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Form login
    public function showLogin()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = DB::table('users')->where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan']);
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah']);
        }

        session([
            'user_id' => $user->id,
            'user_name' => $user->nama_user,
            'role' => $user->role,
        ]);

        return redirect()->route('dashboard');
    }

    // Logout
    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }

    // Dashboard
    public function dashboard(Request $request)
    {
        if (!session('user_id')) {
            return redirect()->route('login');
        }

        $tanggal = $request->tanggal ?? date('Y-m-d');

        $acaraBerlangsung = DB::table('acaras')->where('status_pemesanan','berlangsung')->count();
        $menungguKonfirmasi = DB::table('acaras')->where('status_pemesanan','menunggu')->count();
        $acaraSelesai = DB::table('acaras')->where('status_pemesanan','selesai')->count();
        $venueTerpakai = 0; // bisa dikembangkan nanti

        $detailPelanggan = DB::table('pemesanan')
            ->whereDate('tanggal_acara', $tanggal)
            ->get()
            ->map(function($item){
                return [
                    'nama_paket' => $item->nama_paket,
                    'nama_pelanggan' => $item->nama_pelanggan,
                    'tanggal_acara' => $item->tanggal_acara,
                    'waktu_mulai' => $item->waktu_mulai,
                    'total_harga' => $item->total_harga,
                    'venue' => $item->venue,
                    'status' => $item->status,
                    'status_label' => ucfirst($item->status),
                ];
            })->toArray();

        return view('dashboard', compact(
            'acaraBerlangsung',
            'menungguKonfirmasi',
            'acaraSelesai',
            'venueTerpakai',
            'detailPelanggan',
            'tanggal'
        ));
    }
}