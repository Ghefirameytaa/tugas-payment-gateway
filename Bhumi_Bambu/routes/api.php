<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PaketLayananApiController;
use App\Http\Controllers\Api\PesananApiController;
use App\Http\Controllers\Api\PromoApiController;

// Admin Paket Layanan Routes
Route::get('/paket-layanan', [PaketLayananApiController::class, 'index']);
Route::get('/paket-layanan/{id}', [PaketLayananApiController::class, 'show']);
Route::post('/paket-layanan', [PaketLayananApiController::class, 'store']);
Route::put('/paket-layanan/{id}', [PaketLayananApiController::class, 'update']);
Route::delete('/paket-layanan/{id}', [PaketLayananApiController::class, 'destroy']);

// Admin Pesanan Routes
Route::get('/pesanan', [PesananApiController::class, 'index']);
Route::get('/pesanan/{id}', [PesananApiController::class, 'show']);
Route::patch('/pesanan/{id}/approve', [PesananApiController::class, 'approve']);
Route::patch('/pesanan/{id}/reject', [PesananApiController::class, 'reject']);
Route::delete('/pesanan/{id}', [PesananApiController::class, 'destroy']);

// Admin Promo Routes
Route::get('/promo', [PromoApiController::class, 'index']);
Route::get('/promo/{id}', [PromoApiController::class, 'show']);
Route::post('/promo', [PromoApiController::class, 'store']);
Route::put('/promo/{id}', [PromoApiController::class, 'update']);
Route::delete('/promo/{id}', [PromoApiController::class, 'destroy']);   