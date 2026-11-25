<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::orderBy('nomor_kamar', 'asc')->get();
        return view('kamars.index', compact('kamars'));
    }

    public function create()
    {
        return view('kamars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar'   => 'required|unique:kamars,nomor_kamar',
            'nama_penghuni' => 'nullable|string|max:100',
            'tipe_kamar'    => ['required', Rule::in(Kamar::TIPE)],
            'harga'         => 'required|numeric|min:0',
            'fasilitas'     => 'nullable|string',
            'status'        => ['required', Rule::in(Kamar::STATUS)],
            'keterangan'    => 'nullable|string',
        ]);

        Kamar::create($request->all());

        return redirect()->route('kamars.index')->with('sukses', 'Data kamar berhasil ditambahkan!');
    }

    public function edit(Kamar $kamar)
    {
        return view('kamars.edit', compact('kamar'));
    }

    public function update(Request $request, Kamar $kamar)
    {
        $request->validate([
            'nomor_kamar'   => 'required|unique:kamars,nomor_kamar,' . $kamar->id,
            'nama_penghuni' => 'nullable|string|max:100',
            'tipe_kamar'    => ['required', Rule::in(Kamar::TIPE)],
            'harga'         => 'required|numeric|min:0',
            'fasilitas'     => 'nullable|string',
            'status'        => ['required', Rule::in(Kamar::STATUS)],
            'keterangan'    => 'nullable|string',
        ]);

        $kamar->update($request->all());

        return redirect()->route('kamars.index')->with('sukses', 'Data kamar berhasil diperbarui!');
    }

    public function destroy(Kamar $kamar)
    {
        $kamar->delete();
        return redirect()->route('kamars.index')->with('sukses', 'Data kamar berhasil dihapus!');
    }
}
