@extends('layouts.app')

@section('title', 'Edit Inventaris Aset - Sistem Manajemen Kos')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Edit Inventaris Aset</h1>
        <p class="page-subtitle">Perbarui data aset: <strong>{{ $aset->nama_barang }}</strong></p>
    </div>
    <div class="page-actions">
        <a href="{{ route('asets.index') }}" class="btn btn-secondary">
            &larr; Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card" style="max-width: 680px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Perbarui Data Barang</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('asets.update', $aset) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="nama_barang" class="form-label">Nama Barang / Aset <span style="color: var(--danger);">*</span></label>
                    <input type="text" id="nama_barang" name="nama_barang" class="form-control" value="{{ old('nama_barang', $aset->nama_barang) }}" required>
                </div>

                <div class="form-group">
                    <label for="merek" class="form-label">Merek / Seri</label>
                    <input type="text" id="merek" name="merek" class="form-control" value="{{ old('merek', $aset->merek) }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="lokasi" class="form-label">Lokasi Penempatan <span style="color: var(--danger);">*</span></label>
                    <input type="text" id="lokasi" name="lokasi" class="form-control" value="{{ old('lokasi', $aset->lokasi) }}" required>
                </div>

                <div class="form-group">
                    <label for="jumlah" class="form-label">Jumlah / Unit <span style="color: var(--danger);">*</span></label>
                    <input type="number" id="jumlah" name="jumlah" class="form-control" value="{{ old('jumlah', $aset->jumlah) }}" min="1" required>
                </div>

                <div class="form-group">
                    <label for="kondisi" class="form-label">Kondisi Fisik <span style="color: var(--danger);">*</span></label>
                    <select id="kondisi" name="kondisi" class="form-select" required>
                        @foreach (\App\Models\Aset::KONDISI as $kond)
                            <option value="{{ $kond }}" {{ old('kondisi', $aset->kondisi) == $kond ? 'selected' : '' }}>{{ $kond }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.5rem; margin-top: 1.5rem;">
                <a href="{{ route('asets.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
