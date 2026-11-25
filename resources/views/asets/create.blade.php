@extends('layouts.app')

@section('title', 'Tambah Inventaris Aset - Sistem Manajemen Kos')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Tambah Inventaris Aset</h1>
        <p class="page-subtitle">Pencatatan barang, perabot, dan fasilitas kos ke dalam inventaris.</p>
    </div>
    <div class="page-actions">
        <a href="{{ route('asets.index') }}" class="btn btn-secondary">
            &larr; Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card" style="max-width: 680px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Form Data Barang / Aset</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('asets.store') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="nama_barang" class="form-label">Nama Barang / Aset <span style="color: var(--danger);">*</span></label>
                    <input type="text" id="nama_barang" name="nama_barang" class="form-control" value="{{ old('nama_barang') }}" placeholder="Contoh: AC 1/2 PK, Kasur Busa" required>
                </div>

                <div class="form-group">
                    <label for="merek" class="form-label">Merek / Seri</label>
                    <input type="text" id="merek" name="merek" class="form-control" value="{{ old('merek') }}" placeholder="Contoh: Daikin, Inoac">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="lokasi" class="form-label">Lokasi Penempatan <span style="color: var(--danger);">*</span></label>
                    <input type="text" id="lokasi" name="lokasi" class="form-control" value="{{ old('lokasi') }}" placeholder="Contoh: Kamar 101, Lobby" required>
                </div>

                <div class="form-group">
                    <label for="jumlah" class="form-label">Jumlah / Unit <span style="color: var(--danger);">*</span></label>
                    <input type="number" id="jumlah" name="jumlah" class="form-control" value="{{ old('jumlah', 1) }}" min="1" required>
                </div>

                <div class="form-group">
                    <label for="kondisi" class="form-label">Kondisi Fisik <span style="color: var(--danger);">*</span></label>
                    <select id="kondisi" name="kondisi" class="form-select" required>
                        @foreach (\App\Models\Aset::KONDISI as $kond)
                            <option value="{{ $kond }}" {{ old('kondisi', 'Baik') == $kond ? 'selected' : '' }}>{{ $kond }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.5rem; margin-top: 1.5rem;">
                <a href="{{ route('asets.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Data Aset</button>
            </div>
        </form>
    </div>
</div>
@endsection
