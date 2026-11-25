@extends('layouts.app')

@section('title', 'Master Data Kamar - Sistem Manajemen Kos')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Master Data Kamar</h1>
        <p class="page-subtitle">Modul A: Manajemen ketersediaan, tipe, tarif sewa, dan fasilitas unit kamar kos.</p>
    </div>
    <div class="page-actions">
        @if (Auth::user()->isAdmin())
            <a href="{{ route('kamars.create') }}" class="btn btn-primary">
                + Tambah Kamar Baru
            </a>
        @endif
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Daftar Semua Kamar</h2>
        <span class="badge badge-slate">{{ $kamars->count() }} Unit Terdata</span>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nomor Kamar</th>
                        <th>Tipe Kamar</th>
                        <th>Penghuni Saat Ini</th>
                        <th>Tarif Sewa / Bulan</th>
                        <th>Status</th>
                        <th>Fasilitas</th>
                        @if (Auth::user()->isAdmin())
                            <th style="width: 140px; text-align: right;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kamars as $index => $kamar)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong style="font-size: 0.95rem; color: var(--text-heading);">{{ $kamar->nomor_kamar }}</strong>
                            </td>
                            <td>
                                <span class="badge badge-primary">{{ $kamar->tipe_kamar }}</span>
                            </td>
                            <td>
                                {{ $kamar->nama_penghuni ?? '-' }}
                            </td>
                            <td>
                                <strong>Rp {{ number_format($kamar->harga, 0, ',', '.') }}</strong>
                            </td>
                            <td>
                                @if ($kamar->status === 'Tersedia')
                                    <span class="badge badge-success">● Tersedia</span>
                                @elseif ($kamar->status === 'Terisi')
                                    <span class="badge badge-slate">● Terisi</span>
                                @else
                                    <span class="badge badge-warning">● {{ $kamar->status }}</span>
                                @endif
                            </td>
                            <td style="color: var(--text-muted); font-size: 0.82rem;">
                                {{ $kamar->fasilitas ?? '-' }}
                            </td>
                            @if (Auth::user()->isAdmin())
                                <td style="text-align: right; white-space: nowrap;">
                                    <a href="{{ route('kamars.edit', $kamar) }}" class="btn btn-secondary btn-sm">Edit</a>
                                    <form action="{{ route('kamars.destroy', $kamar) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar {{ $kamar->nomor_kamar }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->isAdmin() ? 8 : 7 }}" style="text-align: center; padding: 2.5rem; color: var(--text-muted);">
                                Belum ada unit kamar yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
