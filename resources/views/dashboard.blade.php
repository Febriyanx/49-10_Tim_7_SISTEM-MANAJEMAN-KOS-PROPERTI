@extends('layouts.app')

@section('title', 'Dashboard - Sistem Manajemen Kos & Properti')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Ringkasan Operasional Kos</h1>
        <p class="page-subtitle">Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>. Anda masuk dengan hak akses <strong style="text-transform: capitalize;">{{ Auth::user()->role }}</strong>.</p>
    </div>
    <div class="page-actions">
        <span class="badge badge-slate" style="padding: 6px 12px; font-size: 0.82rem;">
            {{ now()->translatedFormat('l, d F Y') }}
        </span>
    </div>
</div>

<!-- 4 Stat Summary Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 2rem;">
    <!-- Case A: Kamar -->
    <div class="card" style="border-left: 4px solid var(--primary);">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <span style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Modul A &bull; Kamar</span>
                    <h3 style="font-size: 2rem; font-weight: 700; color: var(--text-heading); margin-top: 0.25rem;">{{ $totalKamar }}</h3>
                    <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.2rem;">Total unit kamar terdaftar</p>
                </div>
                <div style="background-color: var(--primary-light); color: var(--primary); width: 44px; height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    🚪
                </div>
            </div>
            <div style="margin-top: 1rem; padding-top: 0.75rem; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ route('kamars.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 600; font-size: 0.82rem;">Lihat Kamar &rarr;</a>
                @if (Auth::user()->isAdmin())
                    <a href="{{ route('kamars.create') }}" class="btn btn-secondary btn-sm">+ Tambah</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Case B: Penghuni -->
    <div class="card" style="border-left: 4px solid #0284c7;">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <span style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Modul B &bull; Penghuni</span>
                    <h3 style="font-size: 2rem; font-weight: 700; color: var(--text-heading); margin-top: 0.25rem;">{{ $totalPenghuni }}</h3>
                    <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.2rem;">Penghuni aktif saat ini</p>
                </div>
                <div style="background-color: #e0f2fe; color: #0284c7; width: 44px; height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    👥
                </div>
            </div>
            <div style="margin-top: 1rem; padding-top: 0.75rem; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ route('penghuni.index') }}" style="color: #0284c7; text-decoration: none; font-weight: 600; font-size: 0.82rem;">
                    {{ Auth::user()->isPenghuni() ? 'Lihat Hunian Saya →' : 'Lihat Penghuni →' }}
                </a>
                @if (Auth::user()->isAdmin())
                    <a href="{{ route('penghuni.create') }}" class="btn btn-secondary btn-sm">+ Tambah</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Case C: Housekeeper / Staff -->
    <div class="card" style="border-left: 4px solid #d97706;">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <span style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Modul C &bull; Housekeeper</span>
                    <h3 style="font-size: 2rem; font-weight: 700; color: var(--text-heading); margin-top: 0.25rem;">{{ $totalStaff }}</h3>
                    <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.2rem;">Petugas kebersihan &amp; rawat</p>
                </div>
                <div style="background-color: #fef3c7; color: #d97706; width: 44px; height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    🧹
                </div>
            </div>
            <div style="margin-top: 1rem; padding-top: 0.75rem; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ route('staff.index') }}" style="color: #d97706; text-decoration: none; font-weight: 600; font-size: 0.82rem;">Lihat Jadwal &rarr;</a>
                @if (Auth::user()->hasRole(['admin', 'staff']))
                    <a href="{{ route('staff.create') }}" class="btn btn-secondary btn-sm">+ Tambah</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Case D: Inventaris Aset -->
    <div class="card" style="border-left: 4px solid #059669;">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <span style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Modul D &bull; Inventaris</span>
                    <h3 style="font-size: 2rem; font-weight: 700; color: var(--text-heading); margin-top: 0.25rem;">{{ $totalAset }}</h3>
                    <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.2rem;">Barang aset properti tercatat</p>
                </div>
                <div style="background-color: #ecfdf5; color: #059669; width: 44px; height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    📦
                </div>
            </div>
            <div style="margin-top: 1rem; padding-top: 0.75rem; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ route('asets.index') }}" style="color: #059669; text-decoration: none; font-weight: 600; font-size: 0.82rem;">Lihat Aset &rarr;</a>
                @if (Auth::user()->hasRole(['admin', 'staff']))
                    <a href="{{ route('asets.create') }}" class="btn btn-secondary btn-sm">+ Tambah</a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Info Matriks Hak Akses (Role Access Control) -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Matriks Otorisasi Peran (Role-Based Access Control)</h2>
        <span class="badge {{ Auth::user()->role }}">Status Anda: {{ strtoupper(Auth::user()->role) }}</span>
    </div>
    <div class="card-body">
        <p style="color: var(--text-muted); margin-bottom: 1rem;">
            Aplikasi ini telah menggabungkan 4 modul fungsional dari tim dengan pembatasan hak akses berjenjang:
        </p>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Modul Sistem</th>
                        <th>Penanggung Jawab</th>
                        <th>Hak Akses Admin</th>
                        <th>Hak Akses Staff / Housekeeper</th>
                        <th>Hak Akses Penghuni</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Master Kamar (Case A)</strong></td>
                        <td>Raihanah</td>
                        <td><span class="badge badge-success">Penuh (CRUD)</span></td>
                        <td><span class="badge badge-slate">Lihat Saja (Read-Only)</span></td>
                        <td><span class="badge badge-slate">Lihat Saja (Read-Only)</span></td>
                    </tr>
                    <tr>
                        <td><strong>Data Penghuni (Case B)</strong></td>
                        <td>Febriyan</td>
                        <td><span class="badge badge-success">Penuh (CRUD)</span></td>
                        <td><span class="badge badge-slate">Lihat Saja (Read-Only)</span></td>
                        <td><span class="badge badge-slate">Lihat Saja (Read-Only)</span></td>
                    </tr>
                    <tr>
                        <td><strong>Housekeeper / Staff (Case C)</strong></td>
                        <td>Syarinah</td>
                        <td><span class="badge badge-success">Penuh (CRUD)</span></td>
                        <td><span class="badge badge-success">Penuh (CRUD)</span></td>
                        <td><span class="badge badge-slate">Lihat Jadwal (Read-Only)</span></td>
                    </tr>
                    <tr>
                        <td><strong>Inventaris Aset (Case D)</strong></td>
                        <td>Winy Juliana</td>
                        <td><span class="badge badge-success">Penuh (CRUD)</span></td>
                        <td><span class="badge badge-success">Penuh (CRUD)</span></td>
                        <td><span class="badge badge-slate">Lihat Saja (Read-Only)</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
