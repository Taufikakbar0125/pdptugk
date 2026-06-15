<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tendik;
use Illuminate\Http\Request;

class TendikController extends Controller
{
    public function index()
    {
        $data = Tendik::orderBy('unit_kerja')->orderBy('nama')->get();
        return view('admin.tendik.index', compact('data'));
    }

    public function create()
    {
        return view('admin.tendik.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit_kerja' => 'required|string',
            'nama' => 'required|string',
            'nip' => 'nullable|string',
            'golongan' => 'nullable|string',
            'pangkat' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'status_kepegawaian' => 'required|string',
        ]);

        Tendik::create($validated);
        return redirect()->route('admin.tendik.index')->with('success', 'Data Tendik berhasil ditambahkan.');
    }

    public function edit(Tendik $tendik)
    {
        return view('admin.tendik.edit', compact('tendik'));
    }

    public function update(Request $request, Tendik $tendik)
    {
        $validated = $request->validate([
            'unit_kerja' => 'required|string',
            'nama' => 'required|string',
            'nip' => 'nullable|string',
            'golongan' => 'nullable|string',
            'pangkat' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'status_kepegawaian' => 'required|string',
        ]);

        $tendik->update($validated);
        return redirect()->route('admin.tendik.index')->with('success', 'Data Tendik berhasil diperbarui.');
    }

    public function destroy(Tendik $tendik)
    {
        $tendik->delete();
        return redirect()->route('admin.tendik.index')->with('success', 'Data Tendik berhasil dihapus.');
    }
}
