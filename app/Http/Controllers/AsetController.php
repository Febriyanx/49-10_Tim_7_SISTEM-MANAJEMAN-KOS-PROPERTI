<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AsetController extends Controller
{
    private function rules(): array
    {
        return [
            'nama_barang' => 'required|string|max:255',
            'merek'       => 'nullable|string|max:255',
            'lokasi'      => 'required|string|max:255',
            'jumlah'      => 'required|integer|min:1',
            'kondisi'     => ['required', Rule::in(Aset::KONDISI)],
        ];
    }

    public function index()
    {
        $asets = Aset::orderByDesc('id')->get();
        return view('asets.index', compact('asets'));
    }

    public function create()
    {
        return view('asets.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        Aset::create($data);

        return redirect()->route('asets.index')->with('sukses', 'Barang inventaris berhasil ditambahkan!');
    }

    public function edit(Aset $aset)
    {
        return view('asets.edit', compact('aset'));
    }

    public function update(Request $request, Aset $aset)
    {
        $data = $request->validate($this->rules());
        $aset->update($data);

        return redirect()->route('asets.index')->with('sukses', 'Barang inventaris berhasil diperbarui!');
    }

    public function destroy(Aset $aset)
    {
        $aset->delete();
        return redirect()->route('asets.index')->with('sukses', 'Barang inventaris berhasil dihapus!');
    }
}
