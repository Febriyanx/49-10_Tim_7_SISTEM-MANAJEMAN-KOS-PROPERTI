@extends('layouts.app')

@section('title', 'Inventaris Aset & Properti - Sistem Manajemen Kos')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Inventaris Aset &amp; Properti</h1>
        <p class="page-subtitle">Modul D: Pelacakan fasilitas barang, jumlah stok, lokasi penempatan, dan kondisi aset.</p>
    </div>
    <div class="page-actions">
        @if (Auth::user()->hasRole(['admin', 'staff']))
            <a href="{{ route('asets.create') }}" class="btn btn-primary">
                + Tambah Aset Baru
            </a>
        @endif
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Daftar Barang &amp; Perlengkapan</h2>
        <span class="badge badge-slate">{{ $asets->count() }} Item Terdaftar</span>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Aset / Barang</th>
                        <th>Merek / Tipe</th>
                        <th>Lokasi Penempatan</th>
                        <th>Jumlah</th>
                        <th>Kondisi Fisik</th>
                        @if (Auth::user()->hasRole(['admin', 'staff']))
                            <th style="width: 140px; text-align: right;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($asets as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong style="color: var(--text-heading); font-size: 0.92rem;">{{ $item->nama_barang }}</strong>
                            </td>
                            <td>
                                <span class="badge badge-slate">{{ $item->merek ?? '-' }}</span>
                            </td>
                            <td>
                                {{ $item->lokasi }}
                            </td>
                            <td>
                                <strong>{{ $item->jumlah }}</strong> unit
                            </td>
                            <td>
                                @if ($item->kondisi === 'Baik')
                                    <span class="badge badge-success">● Baik</span>
                                @elseif ($item->kondisi === 'Rusak Ringan')
                                    <span class="badge badge-warning">● Rusak Ringan</span>
                                @else
                                    <span class="badge badge-danger">● Rusak Berat</span>
                                @endif
                            </td>
                            @if (Auth::user()->hasRole(['admin', 'staff']))
                                <td style="text-align: right; white-space: nowrap;">
                                    <a href="{{ route('asets.edit', $item) }}" class="btn btn-secondary btn-sm">Edit</a>
                                    <form action="{{ route('asets.destroy', $item) }}" method="POST" style="display: inline;" onsubmit="return confirm('Hapus aset {{ $item->nama_barang }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->hasRole(['admin', 'staff']) ? 7 : 6 }}" style="text-align: center; padding: 2.5rem; color: var(--text-muted);">
                                Belum ada data inventaris aset yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
