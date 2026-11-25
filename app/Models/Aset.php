<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $table = 'asets';

    protected $fillable = [
        'nama_barang',
        'merek',
        'kondisi',
        'lokasi',
        'jumlah',
    ];

    public const KONDISI = ['Baik', 'Rusak Ringan', 'Rusak Berat'];
}
