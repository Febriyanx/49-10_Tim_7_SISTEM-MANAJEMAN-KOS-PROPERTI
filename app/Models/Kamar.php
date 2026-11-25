<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamars';

    protected $fillable = [
        'nomor_kamar',
        'nama_penghuni',
        'tipe_kamar',
        'harga',
        'fasilitas',
        'status',
        'keterangan',
    ];

    public const TIPE = ['Standard', 'Deluxe', 'VIP'];
    public const STATUS = ['Tersedia', 'Terisi', 'Perbaikan'];
}
