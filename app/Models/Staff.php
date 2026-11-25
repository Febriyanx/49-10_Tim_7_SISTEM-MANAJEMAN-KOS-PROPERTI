<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'nama',
        'kontak',
        'area',
        'shift',
        'tugas',
        'status',
    ];

    protected $casts = [
        'tugas' => 'array',
    ];

    public const AREA = [
        'Lantai 1',
        'Lantai 2',
        'Lantai 3',
        'Area Umum & Parkir',
        'Dapur Bersama',
    ];

    public const SHIFT = ['Pagi', 'Siang', 'Malam'];

    public const TUGAS = [
        'Sapu & Pel',
        'Bersihkan Kamar Mandi',
        'Ganti Sprei',
        'Buang Sampah',
    ];

    public const STATUS = ['Aktif', 'Cuti', 'Nonaktif'];
}
