<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\PaketLayanan;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    //form reservasi pelanggan
    public function create()
    {
        $pakets = PaketLayanan::all();
        return view('reservasi.create', compact('pakets'));
    }

    //simpan data ke session dan redirect ke review
    public function store(Request $request)
    {
        $validated = $request->validate([
            'paket_id' => ['required', 'exists:paket_layanan,id'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'nomor_ponsel' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'tanggal_reservasi' => ['required', 'date', 'after_or_equal:today'],
            'jam_acara' => ['required'],
            'jumlah_orang' => ['required', 'integer', 'min:1'],
            'catatan' => ['nullable', 'string'],
        ]);

        // Ambil data paket
        $paket = PaketLayanan::findOrFail($validated['paket_id']);

        // Simpan ke session untuk review
        session([
            'reservasi' => [
                'paket_id' => $validated['paket_id'],
                'paket_nama' => $paket->nama_paket,
                'paket_harga' => $paket->harga,
                'nama_lengkap' => $validated['nama_lengkap'],
                'nomor_ponsel' => $validated['nomor_ponsel'],
                'email' => $validated['email'],
                'tanggal_reservasi' => $validated['tanggal_reservasi'],
                'jam_acara' => $validated['jam_acara'],
                'jumlah_orang' => $validated['jumlah_orang'],
                'catatan' => $validated['catatan'] ?? null,
            ]
        ]);

        return redirect()->route('reservasi.review');
    }

    // Tampilkan halaman review
    public function review()
    {
        // Cek apakah ada data di session
        if (!session()->has('reservasi')) {
            return redirect()->route('reservasi.create')->with('error', 'Silakan isi form terlebih dahulu.');
        }

        return view('reservasi.review');
    }

    // Konfirmasi dan simpan ke database, lalu ke halaman pembayaran
    public function confirm()
    {
        // Cek apakah ada data di session
        if (!session()->has('reservasi')) {
            return redirect()->route('reservasi.create')->with('error', 'Silakan isi form terlebih dahulu.');
        }

        $data = session('reservasi');

        // Simpan ke database
        $reservasi = Reservasi::create([
            'user_id' => auth()->id(),
            'paket_id' => $data['paket_id'],
            'nama_lengkap' => $data['nama_lengkap'],
            'nomor_ponsel' => $data['nomor_ponsel'],
            'email' => $data['email'],
            'tanggal_reservasi' => $data['tanggal_reservasi'],
            'jam_acara' => $data['jam_acara'],
            'jumlah_orang' => $data['jumlah_orang'],
            'catatan' => $data['catatan'],
            'status' => 'pending',
        ]);

        // Hapus session
        session()->forget('reservasi');

        // ✅ UBAH INI: Redirect ke halaman pembayaran, bukan beranda
        return redirect()->route('reservasi.payment', $reservasi->id);
    }

    // ✅ TAMBAH METHOD INI: Halaman pembayaran
    public function payment($id)
    {
        $reservasi = Reservasi::with('paket')->findOrFail($id);
        
        // Cek apakah reservasi milik user yang login
        if ($reservasi->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('reservasi.payment', compact('reservasi'));
    }

    // ✅ TAMBAH METHOD INI: Upload bukti transfer
    public function uploadPayment(Request $request)
{
    // Ambil reservasi_id dari request
    $reservasiId = $request->input('reservasi_id');
    
    // Validasi
    $request->validate([
        'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Cari reservasi
    $reservasi = Reservasi::findOrFail($reservasiId);

    // Cek apakah reservasi milik user yang login
    if ($reservasi->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    // Upload gambar
    if ($request->hasFile('bukti_transfer')) {
        $file = $request->file('bukti_transfer');
        $namaFile = 'bukti_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        
        $tujuan = public_path('aset/bukti_transfer');
        if (!is_dir($tujuan)) {
            mkdir($tujuan, 0755, true);
        }
        
        $file->move($tujuan, $namaFile);
        
        // Update reservasi
        $reservasi->update([
            'bukti_transfer' => 'aset/bukti_transfer/' . $namaFile,
        ]);
    }

    return redirect()->route('reservasi.ticket', $reservasi->id);
}

    // ✅ TAMBAH METHOD INI: Halaman e-ticket
    public function ticket($id)
{
    $reservasi = Reservasi::with('paket')->findOrFail($id);
    
    // Cek apakah reservasi milik user yang login
    if ($reservasi->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    // Pastikan paket ada
    if (!$reservasi->paket) {
        return redirect()->route('beranda')->with('error', 'Data paket tidak ditemukan.');
    }

    return view('reservasi.ticket', compact('reservasi'));
}

    //tampilkan daftar reservasi pelanggan
    public function my()
    {
        $reservasis = Reservasi::where('user_id', auth()->id())
            ->with('paket')
            ->latest()
            ->get();
        return view('reservasi.my', compact('reservasis'));
    }
}