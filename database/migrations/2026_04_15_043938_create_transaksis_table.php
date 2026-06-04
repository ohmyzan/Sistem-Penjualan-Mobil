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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('mobil_id')->constrained('mobils')->onDelete('cascade');
            $table->string('kode_booking')->unique();
            $table->string('no_hp');
            $table->text('alamat_pengiriman');
            $table->integer('booking_fee')->default(5000000);
            $table->string('bukti_bayar')->nullable();
            $table->string('snap_token')->nullable(); // tambah ini
            $table->enum('status', ['Pending', 'Diproses', 'Selesai', 'Batal'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
