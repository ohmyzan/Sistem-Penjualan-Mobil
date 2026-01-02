<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'mobil'; // nama tabel di database

    protected $fillable = [
    'nama_mobil',
    'brand',
    'tahun',
    'stok',
    'warna',
    'harga',
    'kapasitas',
    ];
}
