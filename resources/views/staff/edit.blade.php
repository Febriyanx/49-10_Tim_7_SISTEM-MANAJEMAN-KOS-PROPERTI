@extends('layouts.app')

@section('title', 'Edit Petugas Housekeeper - Sistem Manajemen Kos')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Edit Petugas Housekeeper</h1>
        <p class="page-subtitle">Perbarui data petugas: <strong>{{ $staff->nama }}</strong></p>
    </div>
    <div class="page-actions">
        <a href="{{ route('staff.index') }}" class="btn btn-secondary">
            &larr; Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card" style="max-width: 680px; margin: 0 auto;">
    <div class="card-header">
        <h2 class="card-title">Perbarui Penugasan Petugas</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('staff.update', $staff) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="nama" class="form-label">Nama Lengkap Petugas <span style="color: var(--danger);">*</span></label>
                    <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $staff->nama) }}" required>
                </div>

                <div class="form-group">
                    <label for="kontak" class="form-label">Nomor WhatsApp / Kontak <span style="color: var(--danger);">*</span></label>
                    <input type="text" id="kontak" name="kontak" class="form-control" value="{{ old('kontak', $staff->kontak) }}" required>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="shift" class="form-label">Shift Kerja <span style="color: var(--danger);">*</span></label>
                    <select id="shift" name="shift" class="form-select" required>
                        @foreach (\App\Models\Staff::SHIFT as $sh)
                            <option value="{{ $sh }}" {{ old('shift', $staff->shift) == $sh ? 'selected' : '' }}>{{ $sh }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="area" class="form-label">Area Tanggung Jawab <span style="color: var(--danger);">*</span></label>
                    <select id="area" name="area" class="form-select" required>
                        @foreach (\App\Models\Staff::AREA as $ar)
                            <option value="{{ $ar }}" {{ old('area', $staff->area) == $ar ? 'selected' : '' }}>{{ $ar }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="status" class="form-label">Status Petugas <span style="color: var(--danger);">*</span></label>
                    <select id="status" name="status" class="form-select" required>
                        @foreach (\App\Models\Staff::STATUS as $st)
                            <option value="{{ $st }}" {{ old('status', $staff->status) == $st ? 'selected' : '' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Daftar Tanggung Jawab Tugas</label>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 0.5rem; background: var(--surface-muted); padding: 0.85rem; border-radius: var(--radius-sm); border: 1px solid var(--border);">
                    @php
                        $currentTugas = is_array(old('tugas')) ? old('tugas') : ($staff->tugas ?? []);
                    @endphp
                    @foreach (\App\Models\Staff::TUGAS as $tug)
                        <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.82rem; cursor: pointer;">
                            <input type="checkbox" name="tugas[]" value="{{ $tug }}" {{ in_array($tug, $currentTugas) ? 'checked' : '' }}>
                            {{ $tug }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.5rem; margin-top: 1.5rem;">
                <a href="{{ route('staff.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
