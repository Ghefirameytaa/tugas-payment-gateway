<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PaketLayananController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfilePelangganController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (BEBAS DIAKSES)
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| USER ROUTES (ROLE: USER)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pelanggan'])->group(function () {

    Route::get('/beranda', [HomeController::class, 'beranda'])->name('beranda');

    // Reservasi
    Route::get('/reservasi/buat', [ReservasiController::class, 'create'])->name('reservasi.create');
    Route::post('/reservasi/store', [ReservasiController::class, 'store'])->name('reservasi.store');
    Route::get('/reservasi/review', [ReservasiController::class, 'review'])->name('reservasi.review');
    Route::post('/reservasi/confirm', [ReservasiController::class, 'confirm'])->name('reservasi.confirm');
    Route::get('/reservasi/payment/{id}', [ReservasiController::class, 'payment'])->name('reservasi.payment');
    Route::get('/reservasi/ticket/{id}', [ReservasiController::class, 'ticket'])->name('reservasi.ticket');
    Route::get('/reservasi/saya', [ReservasiController::class, 'my'])->name('reservasi.saya');
});


/*
|--------------------------------------------------------------------------
| PELANGGAN ROUTES (REGISTER  ATAU DAFTAR)
|--------------------------------------------------------------------------
*/
Route::get('/daftar', [RegisterController::class, 'show'])->name('register');
Route::post('/daftar', [RegisterController::class, 'store'])->name('register.submit');

/*
|--------------------------------------------------------------------------
| PELANGGAN ROUTES (PELANGGAN DAFTAR)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pelanggan'])->group(function () {
    Route::get('/profil', [ProfilePelangganController::class, 'index'])->name('profil');
    Route::get('/profil/edit', [ProfilePelangganController::class, 'edit'])->name('profil.edit');
    Route::post('/profil', [ProfilePelangganController::class, 'update'])->name('profil.update');
});

// ============================================================
// MIDTRANS CALLBACK — HARUS DI LUAR middleware auth
// Midtrans server tidak punya session/auth, tidak bisa masuk
// ke route yang dilindungi middleware
// ============================================================
Route::post('/midtrans/callback', [ReservasiController::class, 'callback']);


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (ROLE: ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Pesanan (Verifikasi Reservasi)
        Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
        Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');
        Route::patch('/pesanan/{id}/approve', [PesananController::class, 'approve'])->name('pesanan.approve');
        Route::patch('/pesanan/{id}/reject', [PesananController::class, 'reject'])->name('pesanan.reject');
        Route::delete('/pesanan/{id}', [PesananController::class, 'destroy'])->name('pesanan.destroy');

        // Pembayaran (Verifikasi Pembayaran)
        Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');
        Route::post('/pembayaran/{id}/verify', [PembayaranController::class, 'verify'])->name('pembayaran.verify');
        Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');

        // Paket Layanan (CRUD)
        Route::get('/paket-layanan', [PaketLayananController::class, 'index'])->name('paket-layanan.index');
        Route::get('/paket-layanan/create', [PaketLayananController::class, 'create'])->name('paket-layanan.create');
        Route::post('/paket-layanan', [PaketLayananController::class, 'store'])->name('paket-layanan.store');
        Route::get('/paket-layanan/{id}/edit', [PaketLayananController::class, 'edit'])->name('paket-layanan.edit');
        Route::put('/paket-layanan/{id}', [PaketLayananController::class, 'update'])->name('paket-layanan.update');
        Route::delete('/paket-layanan/{id}', [PaketLayananController::class, 'destroy'])->name('paket-layanan.destroy');

        // Promo
        Route::get('/promo', [PromoController::class, 'index'])->name('promo.index');
        Route::get('/promo/create', [PromoController::class, 'create'])->name('promo.create');
        Route::post('/promo', [PromoController::class, 'store'])->name('promo.store');
        Route::get('/promo/{id}/edit', [PromoController::class, 'edit'])->name('promo.edit');
        Route::put('/promo/{id}', [PromoController::class, 'update'])->name('promo.update');
        Route::delete('/promo/{id}', [PromoController::class, 'destroy'])->name('promo.destroy');
    });
