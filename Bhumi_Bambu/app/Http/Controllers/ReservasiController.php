<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;
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

        
        return redirect()->route('reservasi.payment', $reservasi->id);
    }

    
    public function payment($id)
    {
        $reservasi = Reservasi::with('paket')->findOrFail($id);

        // keamanan
        if ($reservasi->user_id !== auth()->id()) {
        abort(403);
        }

        // kalau sudah bayar
        if ($reservasi->status_pembayaran === 'lunas') {
            return redirect()->route('reservasi.ticket', $reservasi->id);
        }

        // config midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $totalHarga = $reservasi->paket->harga * $reservasi->jumlah_orang;

        $midtransPayload = [
            'transaction_details' => [
                'order_id' => $reservasi->kode_booking,
                'gross_amount' => (int) $totalHarga,
            ],
            'customer_details' => [
                'first_name' => $reservasi->nama_lengkap,
                'email' => $reservasi->email,
                'phone' => $reservasi->nomor_ponsel,
            ],
            'item_details' => [
                [
                'id' => 'paket_' . $reservasi->paket_id,
                'price' => (int) $reservasi->paket->harga,
                'quantity' => (int) $reservasi->jumlah_orang,
                'name' => $reservasi->paket->nama_paket,
                ]
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($midtransPayload);

        return view('reservasi.payment', [
            'reservasi' => $reservasi,
            'snapToken' => $snapToken
        ]);
    }

    public function callback(Request $request)
    {
        \Log::info('Callback Midtrans diterima', $request->all());

        $orderId     = trim($request->input('order_id'));
        $statusCode  = $request->input('status_code');
        $amount      = $request->input('gross_amount');
        $status      = $request->input('transaction_status');
        $fraud       = $request->input('fraud_status');
        $signature   = $request->input('signature_key');

        // validasi signature
        $serverKey = config('midtrans.server_key');
        $expected  = hash('sha512', $orderId . $statusCode . $amount . $serverKey);

        if ($signature !== $expected) {
            \Log::warning('Signature tidak valid', ['order_id' => $orderId]);
            return response()->json(['message' => 'invalid'], 403);
        }

        $reservasi = Reservasi::where('kode_booking', $orderId)->first();

        if (!$reservasi) {
            \Log::error('Reservasi tidak ditemukan', ['order_id' => $orderId]);
            return response()->json(['message' => 'not found'], 404);
        }

        // biar nggak keupdate dua kali
        if ($reservasi->status_pembayaran === 'lunas') {
            return response()->json(['message' => 'already processed']);
        }

        // mapping status
        switch ($status) {
            case 'settlement':
                $reservasi->status_pembayaran = 'lunas';
                $reservasi->status = 'lunas';
                break;

            case 'pending':
                $reservasi->status_pembayaran = 'menunggu_verifikasi';
                $reservasi->status = 'menunggu_pembayaran';
                break;

            case 'capture':
                if ($fraud === 'challenge') {
                    $reservasi->status_pembayaran = 'menunggu_verifikasi';
                    $reservasi->status = 'menunggu_pembayaran';
                } else {
                    $reservasi->status_pembayaran = 'lunas';
                    $reservasi->status = 'lunas';
                }
                break;

            case 'deny':
            case 'expire':
            case 'cancel':
                $reservasi->status_pembayaran = 'belum_bayar';
                $reservasi->status = 'pending';
                break;
        }

        $reservasi->save();

        \Log::info('Status pembayaran diperbarui', [
            'kode_booking' => $orderId,
            'status' => $status
        ]);

        return response()->json(['message' => 'ok']);
    }

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