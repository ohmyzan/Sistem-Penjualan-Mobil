<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    use HasFactory;

    protected $table = 'merk'; // ⬅️ INI WAJIB DITAMBAHKAN

    public $timestamps = true;

    protected $fillable = [
        'nama_merk',
        'negara_asal'
    ];

    protected $guarded = ['id'];
}
