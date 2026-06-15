<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $data = Dosen::orderBy('fakultas')->orderBy('nama')->get();
        return view('admin.dosen.index', compact('data'));
    }

    public function create()
    {
        return view('admin.dosen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fakultas' => 'required|string',
            'nama' => 'required|string',
            'nip' => 'nullable|string',
            'nidn' => 'nullable|string',
            'golongan' => 'nullable|string',
            'pangkat' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'status_kepegawaian' => 'required|string',
        ]);

        Dosen::create($validated);
        return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen)
    {
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'fakultas' => 'required|string',
            'nama' => 'required|string',
            'nip' => 'nullable|string',
            'nidn' => 'nullable|string',
            'golongan' => 'nullable|string',
            'pangkat' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'status_kepegawaian' => 'required|string',
        ]);

        $dosen->update($validated);
        return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen berhasil dihapus.');
    }
}
