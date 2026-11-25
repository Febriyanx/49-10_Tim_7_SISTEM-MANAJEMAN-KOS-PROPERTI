<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    // Nama tabel di database
    protected $table = 'penghunis';

    // Kolom-kolom yang boleh diisi lewat form (mass assignment)
    protected $fillable = [
        'user_id',
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'pekerjaan',
        'no_hp',
        'nama_darurat',
        'hp_darurat',
        'alamat',
        'nomor_kamar',
        'tanggal_sewa',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
