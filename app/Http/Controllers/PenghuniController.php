<?php

namespace App\Http\Controllers;

use App\Models\Penghuni;
use Illuminate\Http\Request;

class PenghuniController extends Controller
{
    /**
     * Menampilkan daftar semua penghuni (untuk Admin/Staff)
     * atau menampilkan profil hunian diri sendiri (untuk Penghuni)
     */
    public function index()
    {
        $user = auth()->user();

        // Opsi 2: Penghuni hanya melihat data hunian & sewa miliknya sendiri
        if ($user && $user->isPenghuni()) {
            $penghuni = Penghuni::where('user_id', $user->id)->first() ?? Penghuni::first();
            return view('penghuni.show_mine', compact('penghuni'));
        }

        $penghunis = Penghuni::orderByDesc('id')->get();
        return view('penghuni.index', compact('penghunis'));
    }

    /**
     * Menampilkan form untuk tambah penghuni baru
     */
    public function create()
    {
        $kamars = \App\Models\Kamar::orderBy('nomor_kamar')->get();
        return view('penghuni.create', compact('kamars'));
    }

    /**
     * Menyimpan data penghuni baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nik'            => 'required|digits:16',
            'nama_lengkap'   => 'required',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir'  => 'required|date',
            'pekerjaan'      => 'required',
            'no_hp'          => 'required',
            'nama_darurat'   => 'required',
            'hp_darurat'     => 'required',
            'alamat'         => 'required',
            'nomor_kamar'    => 'required',
            'tanggal_sewa'   => 'required|date',
        ]);

        // Simpan data ke database
        Penghuni::create($request->all());

        return redirect()->route('penghuni.index')->with('sukses', 'Data penghuni berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit data penghuni
     */
    public function edit(Penghuni $penghuni)
    {
        $kamars = \App\Models\Kamar::orderBy('nomor_kamar')->get();
        return view('penghuni.edit', compact('penghuni', 'kamars'));
    }

    /**
     * Menyimpan perubahan data penghuni ke database
     */
    public function update(Request $request, Penghuni $penghuni)
    {
        // Validasi input dari form
        $request->validate([
            'nik'            => 'required|digits:16',
            'nama_lengkap'   => 'required',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir'  => 'required|date',
            'pekerjaan'      => 'required',
            'no_hp'          => 'required',
            'nama_darurat'   => 'required',
            'hp_darurat'     => 'required',
            'alamat'         => 'required',
            'nomor_kamar'    => 'required',
            'tanggal_sewa'   => 'required|date',
        ]);

        // Update data di database
        $penghuni->update($request->all());

        return redirect()->route('penghuni.index')->with('sukses', 'Data penghuni berhasil diperbarui!');
    }

    /**
     * Menghapus data penghuni dari database
     */
    public function destroy(Penghuni $penghuni)
    {
        $penghuni->delete();
        return redirect()->route('penghuni.index')->with('sukses', 'Data penghuni berhasil dihapus!');
    }
}
