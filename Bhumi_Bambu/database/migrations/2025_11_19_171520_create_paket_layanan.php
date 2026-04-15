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
         Schema::create('paket_layanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_admin')->nullable()->change();
            $table->string('nama_paket');
            $table->string('venue');
            $table->string('harga');
            $table->string('fasilitas');
            $table->string('deskripsi');
            $table->integer('kapasitas');
            $table->string('gambar_venue');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
