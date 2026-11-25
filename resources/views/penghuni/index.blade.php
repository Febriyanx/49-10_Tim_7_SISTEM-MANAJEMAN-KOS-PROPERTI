@extends('layouts.app')

@section('title', 'Data Penghuni Kos - Sistem Manajemen Kos')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Data Penghuni Kos</h1>
        <p class="page-subtitle">Modul B: Pencatatan identitas, kamar huni, kontak darurat, dan masa sewa penghuni.</p>
    </div>
    <div class="page-actions">
        @if (Auth::user()->isAdmin())
            <a href="{{ route('penghuni.create') }}" class="btn btn-primary">
                + Tambah Penghuni Baru
            </a>
        @endif
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Daftar Penghuni Aktif</h2>
        <span class="badge badge-slate">{{ $penghunis->count() }} Orang Terdata</span>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Kamar</th>
                        <th>NIK</th>
                        <th>Nama &amp; Pekerjaan</th>
                        <th>L/P</th>
                        <th>Kontak HP</th>
                        <th>Kontak Darurat</th>
                        <th>Mulai Sewa</th>
                        @if (Auth::user()->isAdmin())
                            <th style="width: 140px; text-align: right;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penghunis as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong style="font-size: 0.95rem; color: var(--primary);">
                                    {{ $item->nomor_kamar }}
                                </strong>
                            </td>
                            <td>
                                <code>{{ $item->nik }}</code>
                            </td>
                            <td>
                                <strong style="color: var(--text-heading); font-size: 0.92rem; display: block;">{{ $item->nama_lengkap }}</strong>
                                <span style="font-size: 0.75rem; color: var(--text-muted);">{{ $item->pekerjaan }}</span>
                            </td>
                            <td>
                                <span class="badge badge-slate">{{ $item->jenis_kelamin === 'Laki-laki' ? 'L' : 'P' }}</span>
                            </td>
                            <td>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->no_hp) }}" target="_blank" style="color: var(--primary); text-decoration: none; font-weight: 500;">
                                    {{ $item->no_hp }}
                                </a>
                            </td>
                            <td>
                                <span style="font-size: 0.82rem; font-weight: 600; color: var(--text-heading); display: block;">{{ $item->nama_darurat }}</span>
                                <span style="font-size: 0.75rem; color: var(--text-muted);">{{ $item->hp_darurat }}</span>
                            </td>
                            <td style="color: var(--text-muted); font-size: 0.82rem;">
                                {{ $item->tanggal_sewa ? \Carbon\Carbon::parse($item->tanggal_sewa)->format('d M Y') : '-' }}
                            </td>
                            @if (Auth::user()->isAdmin())
                                <td style="text-align: right; white-space: nowrap;">
                                    <a href="{{ route('penghuni.edit', $item) }}" class="btn btn-secondary btn-sm">Edit</a>
                                    <form action="{{ route('penghuni.destroy', $item) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $item->nama_lengkap }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->isAdmin() ? 9 : 8 }}" style="text-align: center; padding: 2.5rem; color: var(--text-muted);">
                                Belum ada data penghuni yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
