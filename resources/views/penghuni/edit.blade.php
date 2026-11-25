@extends('layouts.app')

@section('title', 'Edit Data Penghuni - Sistem Manajemen Kos')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Edit Data Penghuni</h1>
        <p class="page-subtitle">Perbarui data penghuni: <strong>{{ $penghuni->nama_lengkap }}</strong></p>
    </div>
    <div class="page-actions">
        <a href="{{ route('penghuni.index') }}" class="btn btn-secondary">
            &larr; Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card" style="max-width: 760px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Perbarui Identitas Penghuni</h2>
        <span class="badge badge-slate">* Wajib diisi</span>
    </div>
    <div class="card-body">
        <form action="{{ route('penghuni.update', $penghuni) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Bagian 1: Identitas Pribadi -->
            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 0.95rem; font-weight: 700; color: var(--text-heading); margin-bottom: 0.85rem; padding-bottom: 0.4rem; border-bottom: 1px solid var(--border);">
                    1. Identitas Pribadi
                </h3>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK) <span style="color: var(--danger);">*</span></label>
                        <input type="text" id="nik" name="nik" class="form-control" value="{{ old('nik', $penghuni->nik) }}" placeholder="16 digit angka NIK KTP" maxlength="16" pattern="\d{16}" required>
                        <div class="form-hint">Harus 16 digit angka sesuai KTP.</div>
                    </div>

                    <div class="form-group">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap <span style="color: var(--danger);">*</span></label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $penghuni->nama_lengkap) }}" placeholder="Nama lengkap sesuai KTP" required>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span style="color: var(--danger);">*</span></label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $penghuni->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $penghuni->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span style="color: var(--danger);">*</span></label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $penghuni->tanggal_lahir ? \Carbon\Carbon::parse($penghuni->tanggal_lahir)->format('Y-m-d') : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="pekerjaan" class="form-label">Pekerjaan / Profesi <span style="color: var(--danger);">*</span></label>
                        <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" value="{{ old('pekerjaan', $penghuni->pekerjaan) }}" required>
                    </div>
                </div>
            </div>

            <!-- Bagian 2: Kontak & Kontak Darurat -->
            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 0.95rem; font-weight: 700; color: var(--text-heading); margin-bottom: 0.85rem; padding-bottom: 0.4rem; border-bottom: 1px solid var(--border);">
                    2. Informasi Kontak &amp; Darurat
                </h3>

                <div class="form-group">
                    <label for="no_hp" class="form-label">Nomor WhatsApp / HP Penghuni <span style="color: var(--danger);">*</span></label>
                    <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ old('no_hp', $penghuni->no_hp) }}" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label for="nama_darurat" class="form-label">Nama Kontak Darurat <span style="color: var(--danger);">*</span></label>
                        <input type="text" id="nama_darurat" name="nama_darurat" class="form-control" value="{{ old('nama_darurat', $penghuni->nama_darurat) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="hp_darurat" class="form-label">No. HP Kontak Darurat <span style="color: var(--danger);">*</span></label>
                        <input type="text" id="hp_darurat" name="hp_darurat" class="form-control" value="{{ old('hp_darurat', $penghuni->hp_darurat) }}" required>
                    </div>
                </div>
            </div>

            <!-- Bagian 3: Alamat & Penempatan Hunian -->
            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 0.95rem; font-weight: 700; color: var(--text-heading); margin-bottom: 0.85rem; padding-bottom: 0.4rem; border-bottom: 1px solid var(--border);">
                    3. Alamat Asal &amp; Penempatan Kamar
                </h3>

                <div class="form-group">
                    <label for="alamat" class="form-label">Alamat Asal Lengkap <span style="color: var(--danger);">*</span></label>
                    <textarea id="alamat" name="alamat" class="form-control" rows="2" required>{{ old('alamat', $penghuni->alamat) }}</textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label for="nomor_kamar" class="form-label">Nomor Kamar <span style="color: var(--danger);">*</span></label>
                        <input type="text" id="nomor_kamar" name="nomor_kamar" list="kamar_options" class="form-control" value="{{ old('nomor_kamar', $penghuni->nomor_kamar) }}" required>
                        <datalist id="kamar_options">
                            @if(isset($kamars))
                                @foreach($kamars as $kmr)
                                    <option value="{{ $kmr->nomor_kamar }}">{{ $kmr->nomor_kamar }} ({{ $kmr->tipe_kamar }} - {{ $kmr->status }})</option>
                                @endforeach
                            @endif
                        </datalist>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_sewa" class="form-label">Tanggal Mulai Sewa <span style="color: var(--danger);">*</span></label>
                        <input type="date" id="tanggal_sewa" name="tanggal_sewa" class="form-control" value="{{ old('tanggal_sewa', $penghuni->tanggal_sewa ? \Carbon\Carbon::parse($penghuni->tanggal_sewa)->format('Y-m-d') : '') }}" required>
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.5rem; margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--border);">
                <a href="{{ route('penghuni.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
