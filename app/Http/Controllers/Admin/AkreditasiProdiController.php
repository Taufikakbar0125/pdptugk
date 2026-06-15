<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AkreditasiProdi;
use Illuminate\Http\Request;

class AkreditasiProdiController extends Controller
{
    public function index()
    {
        $data = AkreditasiProdi::orderBy('fakultas')->orderBy('prodi')->get();
        return view('admin.akreditasi-prodi.index', compact('data'));
    }

    public function create()
    {
        return view('admin.akreditasi-prodi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fakultas' => 'required|string',
            'prodi' => 'required|string',
            'strata' => 'required|string',
            'peringkat' => 'required|string',
            'no_sertifikat' => 'required|string',
            'penyelenggaraan' => 'required|string',
            'tanggal_akreditasi' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date',
            'status' => 'required|string',
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('file_pdf')) {
            $validated['file_pdf'] = $request->file('file_pdf')->store('akreditasi', 'public');
        }

        AkreditasiProdi::create($validated);
        return redirect()->route('admin.akreditasi-prodi.index')->with('success', 'Data Akreditasi Prodi berhasil ditambahkan.');
    }

    public function edit(AkreditasiProdi $akreditasi_prodi)
    {
        return view('admin.akreditasi-prodi.edit', compact('akreditasi_prodi'));
    }

    public function update(Request $request, AkreditasiProdi $akreditasi_prodi)
    {
        $validated = $request->validate([
            'fakultas' => 'required|string',
            'prodi' => 'required|string',
            'strata' => 'required|string',
            'peringkat' => 'required|string',
            'no_sertifikat' => 'required|string',
            'penyelenggaraan' => 'required|string',
            'tanggal_akreditasi' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date',
            'status' => 'required|string',
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('file_pdf')) {
            if ($akreditasi_prodi->file_pdf) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($akreditasi_prodi->file_pdf);
            }
            $validated['file_pdf'] = $request->file('file_pdf')->store('akreditasi', 'public');
        }

        $akreditasi_prodi->update($validated);
        return redirect()->route('admin.akreditasi-prodi.index')->with('success', 'Data Akreditasi Prodi berhasil diperbarui.');
    }

    public function destroy(AkreditasiProdi $akreditasi_prodi)
    {
        $akreditasi_prodi->delete();
        return redirect()->route('admin.akreditasi-prodi.index')->with('success', 'Data Akreditasi Prodi berhasil dihapus.');
    }
}
