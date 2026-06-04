<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Kolom apa saja yang boleh diisi melalui form
    protected $fillable = [
        'user_id',
        'mobil_id',
        'kode_booking',
        'no_hp',
        'alamat_pengiriman',
        'booking_fee',
        'bukti_bayar',
        'snap_token', // tambah ini
        'status',
    ];

    // Relasi: 1 Transaksi ini milik 1 User (Pelanggan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: 1 Transaksi ini untuk memesan 1 Mobil
    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}
