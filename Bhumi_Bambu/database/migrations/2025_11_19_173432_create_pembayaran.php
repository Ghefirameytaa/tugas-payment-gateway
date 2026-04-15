<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaran extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_id')->nullable();
            $table->date('tanggal_pembayaran')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('nama_pengirim')->nullable();
            $table->integer('jumlah_bayar')->nullable();
            $table->string('status_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
}