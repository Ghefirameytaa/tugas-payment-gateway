<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('paket_id')->constrained('paket_layanan')->cascadeOnDelete();
            $table->string('nama_lengkap');
            $table->string('nomor_ponsel');
            $table->string('email');
            $table->date('tanggal_reservasi');
            $table->time('jam_acara');
            $table->unsignedInteger('jumlah_orang');
            $table->text('catatan')->nullable();
            $table->string('bukti_transer');
            $table->text('catatan_pembayaran');
            $table->enum('status', ['pending', 'menunggu_pembayaran', 'lunas'])->default('pending');
            $table->enum('status_pembayaran', ['belum_bayar', 'menunggu_verifikasi', 'lunas'])->default('belum_bayar');
            $table->string('kode_booking', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
