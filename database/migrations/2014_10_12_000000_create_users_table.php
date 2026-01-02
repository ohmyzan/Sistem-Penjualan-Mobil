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
        Schema::create('user', function (Blueprint $table) {
    $table->id();
    $table->string('nama');                      // nama pengguna (admin / customer)
    $table->string('email')->unique();           // email login
    $table->enum('role', [0, 1, 2])->default(2); // 0 = Admin, 1 = Sales, 2 = Customer
    $table->boolean('status')->default(1);       // 1 = aktif, 0 = nonaktif
    $table->string('password');                  // kata sandi
    $table->string('no_hp', 13);                 // nomor HP (biar rapi ganti 'hp' jadi 'no_hp')
    $table->string('alamat')->nullable();        // alamat customer / dealer
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
