@extends('layouts.app')

@section('title', 'Jadwal & Data Housekeeper - Sistem Manajemen Kos')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Petugas Housekeeper &amp; Kebersihan</h1>
        <p class="page-subtitle">Modul C: Jadwal kerja, shift, area tanggung jawab, dan checklist tugas petugas.</p>
    </div>
    <div class="page-actions">
        @if (Auth::user()->hasRole(['admin', 'staff']))
            <a href="{{ route('staff.create') }}" class="btn btn-primary">
                + Tambah Petugas / Jadwal
            </a>
        @endif
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Daftar Petugas &amp; Penugasan</h2>
        <span class="badge badge-slate">{{ $dataStaff->count() }} Orang Terjadwal</span>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Petugas</th>
                        <th>No. WhatsApp / HP</th>
                        <th>Shift Kerja</th>
                        <th>Area Tanggung Jawab</th>
                        <th>Daftar Tugas</th>
                        <th>Status</th>
                        @if (Auth::user()->hasRole(['admin', 'staff']))
                            <th style="width: 140px; text-align: right;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataStaff as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong style="color: var(--text-heading); font-size: 0.92rem;">{{ $item->nama }}</strong>
                            </td>
                            <td>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->kontak) }}" target="_blank" style="color: var(--primary); text-decoration: none;">
                                    {{ $item->kontak }}
                                </a>
                            </td>
                            <td>
                                @if ($item->shift === 'Pagi')
                                    <span class="badge badge-warning">Pagi (07:00 - 15:00)</span>
                                @elseif ($item->shift === 'Siang')
                                    <span class="badge badge-primary">Siang (13:00 - 21:00)</span>
                                @else
                                    <span class="badge badge-slate">Malam (21:00 - 07:00)</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-slate">{{ $item->area }}</span>
                            </td>
                            <td>
                                <div style="display: flex; flex-wrap: wrap; gap: 4px; max-width: 280px;">
                                    @if (!empty($item->tugas) && is_array($item->tugas))
                                        @foreach ($item->tugas as $tug)
                                            <span style="background-color: #f1f5f9; color: #475569; font-size: 0.7rem; padding: 2px 6px; border-radius: 4px; border: 1px solid #e2e8f0;">
                                                ✓ {{ $tug }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span style="color: var(--text-muted); font-size: 0.78rem;">-</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if ($item->status === 'Aktif')
                                    <span class="badge badge-success">● Aktif</span>
                                @elseif ($item->status === 'Cuti')
                                    <span class="badge badge-warning">● Cuti</span>
                                @else
                                    <span class="badge badge-danger">● Non-aktif</span>
                                @endif
                            </td>
                            @if (Auth::user()->hasRole(['admin', 'staff']))
                                <td style="text-align: right; white-space: nowrap;">
                                    <a href="{{ route('staff.edit', $item) }}" class="btn btn-secondary btn-sm">Edit</a>
                                    <form action="{{ route('staff.destroy', $item) }}" method="POST" style="display: inline;" onsubmit="return confirm('Hapus data petugas {{ $item->nama }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->hasRole(['admin', 'staff']) ? 8 : 7 }}" style="text-align: center; padding: 2.5rem; color: var(--text-muted);">
                                Belum ada data staf / petugas housekeeper.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
