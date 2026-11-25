@extends('layouts.app')

@section('title', 'Informasi Hunian Saya - Sistem Manajemen Kos')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Informasi Hunian &amp; Profil Saya</h1>
        <p class="page-subtitle">Rincian status sewa unit kamar, data identitas, dan kontak darurat Anda.</p>
    </div>
    <div class="page-actions">
        <span class="badge badge-success" style="padding: 6px 12px; font-size: 0.82rem;">
            ● Status Sewa: Aktif
        </span>
    </div>
</div>

<!-- Banner Privasi Data -->
<div class="alert alert-warning" style="margin-bottom: 1.5rem; background-color: #fffbeb; border-color: #fde68a; color: #92400e;">
    <span style="font-size: 1.1rem;">🔒</span>
    <div>
        <strong>Privasi Data Terlindungi (Role Access Control)</strong><br>
        <span style="font-size: 0.82rem; color: #78350f;">
            Sebagai penghuni, Anda hanya dapat melihat informasi kamar dan data pribadi milik Anda sendiri. Data penghuni kamar lain tidak dapat diakses demi menjaga kerahasiaan dan keamanan privasi seluruh penghuni kos.
        </span>
    </div>
</div>

@if ($penghuni)
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.5rem; align-items: start;">
        <!-- Kolom Kiri: Ringkasan Kamar & Kontak Cepat -->
        <div style="display: flex; flex-direction: column; gap: 1.25rem;">
            <!-- Kartu Kamar Saya -->
            <div class="card" style="border-top: 4px solid var(--primary); text-align: center; padding: 1.5rem;">
                <span style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Unit Kamar Kos</span>
                <h2 style="font-size: 2.25rem; font-weight: 800; color: var(--primary); margin: 0.35rem 0;">
                    {{ $penghuni->nomor_kamar }}
                </h2>
                <div style="display: flex; justify-content: center; gap: 0.5rem; margin-top: 0.5rem;">
                    <span class="badge badge-primary">Hunian Utama</span>
                    <span class="badge badge-success">Terverifikasi</span>
                </div>

                <div style="margin-top: 1.25rem; padding-top: 1rem; border-top: 1px solid var(--border); font-size: 0.82rem; color: var(--text-muted); text-align: left;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                        <span>Mulai Sewa:</span>
                        <strong style="color: var(--text-heading);">
                            {{ $penghuni->tanggal_sewa ? \Carbon\Carbon::parse($penghuni->tanggal_sewa)->translatedFormat('d F Y') : '-' }}
                        </strong>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Durasi Menghuni:</span>
                        <strong style="color: var(--text-heading);">
                            {{ $penghuni->tanggal_sewa ? \Carbon\Carbon::parse($penghuni->tanggal_sewa)->diffForHumans(null, true) : '-' }}
                        </strong>
                    </div>
                </div>
            </div>

            <!-- Bantuan / Hubungi Admin -->
            <div class="card" style="padding: 1.25rem; background-color: var(--surface);">
                <h3 style="font-size: 0.9rem; font-weight: 700; color: var(--text-heading); margin-bottom: 0.4rem;">
                    Ada Perubahan Data?
                </h3>
                <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.4; margin-bottom: 0.85rem;">
                    Jika nomor kontak Anda berubah atau ingin melaporkan kendala fasilitas kamar, silakan sampaikan ke Pemilik Kos.
                </p>
                <a href="{{ route('kamars.index') }}" class="btn btn-secondary btn-sm" style="width: 100%; justify-content: center;">
                    Lihat Fasilitas Kamar Kos &rarr;
                </a>
            </div>
        </div>

        <!-- Kolom Kanan: Rincian Data Pribadi & Kontak Darurat -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <!-- Kartu Data Pribadi -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Identitas Penghuni</h3>
                    <span class="badge badge-slate">Data Resmi KTP</span>
                </div>
                <div class="card-body">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Nomor KTP (NIK)</span>
                            <p style="font-size: 0.95rem; font-weight: 600; color: var(--text-heading); margin-top: 0.2rem;">
                                <code>{{ $penghuni->nik }}</code>
                            </p>
                        </div>

                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Nama Lengkap</span>
                            <p style="font-size: 0.95rem; font-weight: 700; color: var(--text-heading); margin-top: 0.2rem;">
                                {{ $penghuni->nama_lengkap }}
                            </p>
                        </div>

                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Jenis Kelamin</span>
                            <p style="font-size: 0.9rem; color: var(--text-heading); margin-top: 0.2rem;">
                                {{ $penghuni->jenis_kelamin }}
                            </p>
                        </div>

                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Tanggal Lahir</span>
                            <p style="font-size: 0.9rem; color: var(--text-heading); margin-top: 0.2rem;">
                                {{ $penghuni->tanggal_lahir ? \Carbon\Carbon::parse($penghuni->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                            </p>
                        </div>

                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Pekerjaan / Profesi</span>
                            <p style="font-size: 0.9rem; color: var(--text-heading); margin-top: 0.2rem;">
                                {{ $penghuni->pekerjaan }}
                            </p>
                        </div>

                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">No. WhatsApp / HP</span>
                            <p style="font-size: 0.95rem; font-weight: 600; color: var(--primary); margin-top: 0.2rem;">
                                {{ $penghuni->no_hp }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu Kontak Darurat & Alamat Asal -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kontak Darurat &amp; Alamat Asal</h3>
                </div>
                <div class="card-body">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Nama Kontak Darurat</span>
                            <p style="font-size: 0.95rem; font-weight: 600; color: var(--text-heading); margin-top: 0.2rem;">
                                {{ $penghuni->nama_darurat }}
                            </p>
                            <span style="font-size: 0.75rem; color: var(--text-muted);">Keluarga / Kerabat / Orang Tua</span>
                        </div>

                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">No. HP Darurat</span>
                            <p style="font-size: 0.95rem; font-weight: 600; color: var(--danger); margin-top: 0.2rem;">
                                {{ $penghuni->hp_darurat }}
                            </p>
                            <span style="font-size: 0.75rem; color: var(--text-muted);">Dapat dihubungi pada situasi darurat</span>
                        </div>
                    </div>

                    <div style="padding-top: 1rem; border-top: 1px solid var(--border);">
                        <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Alamat Asal Sesuai KTP</span>
                        <p style="font-size: 0.9rem; color: var(--text-heading); margin-top: 0.35rem; line-height: 1.5;">
                            {{ $penghuni->alamat }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="card" style="padding: 3rem; text-align: center;">
        <h3 style="font-size: 1.1rem; color: var(--text-heading); margin-bottom: 0.5rem;">Data Hunian Belum Terhubung</h3>
        <p style="color: var(--text-muted); max-width: 480px; margin: 0 auto;">
            Akun Anda belum ditautkan ke data kamar kos aktif. Silakan hubungi pengelola / Pemilik Kos untuk menghubungkan kamar hunian Anda.
        </p>
    </div>
@endif
@endsection
