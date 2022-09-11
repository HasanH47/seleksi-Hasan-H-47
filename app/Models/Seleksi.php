<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seleksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nbarang',
        'lokasi',
        'harga',
    ];

    protected $casts = [
        'harga' => 'int',
    ];
}
