<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('asets')) {
            Schema::create('asets', function (Blueprint $table) {
                $table->id();
                $table->string('nama_barang');
                $table->string('merek')->nullable();
                $table->string('lokasi');
                $table->string('kondisi');
                $table->unsignedInteger('jumlah');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('asets');
    }
};
