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
    Schema::create('mobil', function (Blueprint $table) {
        $table->id();
        $table->string('nama_mobil');
        $table->string('brand');
        $table->integer('tahun');
        $table->integer('stok');
        $table->string('warna')->nullable();
        $table->integer('harga')->nullable();
        $table->integer('kapasitas')->nullable();
        $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobil');
    }
};
