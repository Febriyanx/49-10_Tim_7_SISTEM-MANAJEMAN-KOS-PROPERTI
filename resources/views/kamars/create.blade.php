@extends('layouts.app')

@section('title', 'Tambah Kamar Baru - Sistem Manajemen Kos')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Tambah Kamar Baru</h1>
        <p class="page-subtitle">Form pendaftaran unit kamar kos baru ke dalam sistem.</p>
    </div>
    <div class="page-actions">
        <a href="{{ route('kamars.index') }}" class="btn btn-secondary">
            &larr; Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card" style="max-width: 680px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Informasi Unit Kamar</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('kamars.store') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="nomor_kamar" class="form-label">Nomor / Kode Kamar <span style="color: var(--danger);">*</span></label>
                    <input type="text" id="nomor_kamar" name="nomor_kamar" class="form-control" value="{{ old('nomor_kamar') }}" placeholder="Contoh: A-101" required>
                </div>

                <div class="form-group">
                    <label for="nama_penghuni" class="form-label">Nama Penghuni (Opsional)</label>
                    <input type="text" id="nama_penghuni" name="nama_penghuni" class="form-control" value="{{ old('nama_penghuni') }}" placeholder="Kosongkan jika belum berpenghuni">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="tipe_kamar" class="form-label">Tipe Kamar <span style="color: var(--danger);">*</span></label>
                    <select id="tipe_kamar" name="tipe_kamar" class="form-select" required>
                        @foreach (\App\Models\Kamar::TIPE as $tipe)
                            <option value="{{ $tipe }}" {{ old('tipe_kamar') == $tipe ? 'selected' : '' }}>{{ $tipe }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="status" class="form-label">Status Ketersediaan <span style="color: var(--danger);">*</span></label>
                    <select id="status" name="status" class="form-select" required>
                        @foreach (\App\Models\Kamar::STATUS as $status)
                            <option value="{{ $status }}" {{ old('status', 'Tersedia') == $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="harga" class="form-label">Tarif Sewa per Bulan (Rp) <span style="color: var(--danger);">*</span></label>
                <input type="number" id="harga" name="harga" class="form-control" value="{{ old('harga') }}" placeholder="Contoh: 1500000" min="0" required>
            </div>

            <div class="form-group">
                <label for="fasilitas" class="form-label">Fasilitas Kamar</label>
                <textarea id="fasilitas" name="fasilitas" class="form-control" rows="3" placeholder="Contoh: AC, Kamar Mandi Dalam, Kasur Springbed, Meja Belajar, WiFi">{{ old('fasilitas') }}</textarea>
            </div>

            <div class="form-group">
                <label for="keterangan" class="form-label">Keterangan Tambahan</label>
                <input type="text" id="keterangan" name="keterangan" class="form-control" value="{{ old('keterangan') }}" placeholder="Catatan khusus unit kamar">
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.5rem; margin-top: 1.5rem;">
                <a href="{{ route('kamars.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Kamar</button>
            </div>
        </form>
    </div>
</div>
@endsection
