<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration (membuat tabel)
     */
    public function up(): void
    {
        Schema::create('penghunis', function (Blueprint $table) {
            $table->id();                           // kolom id (auto increment)
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nik', 16);              // Nomor KTP 16 digit
            $table->string('nama_lengkap', 100);    // Nama lengkap
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // Jenis kelamin
            $table->date('tanggal_lahir');           // Tanggal lahir
            $table->string('pekerjaan', 100);        // Pekerjaan
            $table->string('no_hp', 20);             // Nomor HP penghuni
            $table->string('nama_darurat', 100);     // Nama kontak darurat
            $table->string('hp_darurat', 20);        // HP kontak darurat
            $table->text('alamat');                  // Alamat asal
            $table->string('nomor_kamar', 20);       // Nomor kamar
            $table->date('tanggal_sewa');            // Tanggal mulai sewa
            $table->timestamps();                    // created_at & updated_at otomatis
        });
    }

    /**
     * Batalkan migration (hapus tabel)
     */
    public function down(): void
    {
        Schema::dropIfExists('penghunis');
    }
};
