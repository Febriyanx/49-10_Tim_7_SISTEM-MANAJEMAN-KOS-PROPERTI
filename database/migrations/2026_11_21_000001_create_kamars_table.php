<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('kamars')) {
            Schema::create('kamars', function (Blueprint $table) {
                $table->id();
                $table->string('nomor_kamar')->unique();
                $table->string('nama_penghuni')->nullable();
                $table->string('tipe_kamar');
                $table->decimal('harga', 12, 2);
                $table->text('fasilitas')->nullable();
                $table->string('status'); // Tersedia, Terisi, Perbaikan
                $table->text('keterangan')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
