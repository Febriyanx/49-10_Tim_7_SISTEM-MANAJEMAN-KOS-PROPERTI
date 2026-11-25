<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kamar;
use App\Models\Penghuni;
use App\Models\Staff;
use App\Models\Aset;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Pengguna (RBAC Demo)
        User::updateOrCreate(
            ['email' => 'admin@kos.com'],
            ['name' => 'Pemilik Kos (Admin)', 'password' => Hash::make('admin123'), 'role' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'staff@kos.com'],
            ['name' => 'Siti (Housekeeper/Staff)', 'password' => Hash::make('staff123'), 'role' => 'staff']
        );

        $userPenghuni = User::updateOrCreate(
            ['email' => 'penghuni@kos.com'],
            ['name' => 'Febriyan (Penghuni)', 'password' => Hash::make('penghuni123'), 'role' => 'penghuni']
        );

        // 2. Data Dummy Kamar (Case A)
        if (Kamar::count() === 0) {
            Kamar::create([
                'nomor_kamar'   => 'A-101',
                'nama_penghuni' => 'Budi Santoso',
                'tipe_kamar'    => 'Deluxe',
                'harga'         => 1500000,
                'fasilitas'     => 'AC, Kamar Mandi Dalam, Kasur Queen, Lemari',
                'status'        => 'Terisi',
                'keterangan'    => 'Lantai 1 dekat pintu keluar',
            ]);
            Kamar::create([
                'nomor_kamar'   => 'A-102',
                'nama_penghuni' => null,
                'tipe_kamar'    => 'Standard',
                'harga'         => 1000000,
                'fasilitas'     => 'Kipas Angin, Kasur Single, Lemari',
                'status'        => 'Tersedia',
                'keterangan'    => 'Lantai 1 menghadap taman',
            ]);
        }

        // 3. Data Dummy Staff (Case C)
        if (Staff::count() === 0) {
            Staff::create([
                'nama'    => 'Siti Rahmawati',
                'kontak'  => '081234567890',
                'area'    => 'Lantai 1',
                'shift'   => 'Pagi',
                'tugas'   => ['Sapu & Pel', 'Bersihkan Kamar Mandi', 'Buang Sampah'],
                'status'  => 'Aktif',
            ]);
            Staff::create([
                'nama'    => 'Agus Prasetyo',
                'kontak'  => '081298765432',
                'area'    => 'Area Umum & Parkir',
                'shift'   => 'Siang',
                'tugas'   => ['Sapu & Pel', 'Buang Sampah'],
                'status'  => 'Aktif',
            ]);
        }

        // 4. Data Dummy Aset (Case D)
        if (Aset::count() === 0) {
            Aset::create([
                'nama_barang' => 'AC Split 1PK',
                'merek'       => 'Panasonic',
                'lokasi'      => 'Kamar A-101',
                'kondisi'     => 'Baik',
                'jumlah'      => 1,
            ]);
            Aset::create([
                'nama_barang' => 'Mesin Cuci 8Kg',
                'merek'       => 'LG',
                'lokasi'      => 'Dapur Bersama Lantai 1',
                'kondisi'     => 'Baik',
                'jumlah'      => 2,
            ]);
            Aset::create([
                'nama_barang' => 'Pompa Air Utama',
                'merek'       => 'Shimizu',
                'lokasi'      => 'Ruang Mesin Belakang',
                'kondisi'     => 'Rusak Ringan',
                'jumlah'      => 1,
            ]);
        }

        // 5. Data Dummy Penghuni (Case B)
        if (Penghuni::count() === 0) {
            Penghuni::create([
                'user_id'       => $userPenghuni->id,
                'nik'           => '3201012304990001',
                'nama_lengkap'  => 'Febriyan Pratama',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '2001-04-23',
                'pekerjaan'     => 'Mahasiswa',
                'no_hp'         => '081387549643',
                'nama_darurat'  => 'Bapak Pratama',
                'hp_darurat'    => '081298765432',
                'alamat'        => 'Jl. Margonda Raya No. 45, Depok',
                'nomor_kamar'   => 'A-101',
                'tanggal_sewa'  => '2026-01-15',
            ]);
        }
    }
}
