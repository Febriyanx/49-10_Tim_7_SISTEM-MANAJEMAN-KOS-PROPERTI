<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    public function index()
    {
        $dataStaff = Staff::orderByDesc('id')->get();
        return view('staff.index', compact('dataStaff'));
    }

    public function create()
    {
        return view('staff.create', ['staff' => new Staff()]);
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);
        Staff::create($data);

        return redirect()->route('staff.index')->with('sukses', 'Data petugas berhasil ditambahkan!');
    }

    public function edit(Staff $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $data = $this->validasi($request);
        $staff->update($data);

        return redirect()->route('staff.index')->with('sukses', 'Data petugas berhasil diperbarui!');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('sukses', 'Data petugas berhasil dihapus!');
    }

    private function validasi(Request $request): array
    {
        $data = $request->validate([
            'nama'    => ['required', 'string', 'max:100'],
            'kontak'  => ['required', 'string', 'max:30'],
            'area'    => ['required', Rule::in(Staff::AREA)],
            'shift'   => ['required', Rule::in(Staff::SHIFT)],
            'tugas'   => ['nullable', 'array'],
            'tugas.*' => [Rule::in(Staff::TUGAS)],
            'status'  => ['required', Rule::in(Staff::STATUS)],
        ]);

        $data['tugas'] = $data['tugas'] ?? [];
        return $data;
    }
}
