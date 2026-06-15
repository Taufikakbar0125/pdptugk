<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AkreditasiInstitusi;
use Illuminate\Http\Request;

class AkreditasiInstitusiController extends Controller
{
    public function index()
    {
        $data = AkreditasiInstitusi::orderBy('tahun_sk', 'desc')->get();
        return view('admin.akreditasi-institusi.index', compact('data'));
    }

    public function create()
    {
        return view('admin.akreditasi-institusi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'peringkat' => 'required|string',
            'no_sk' => 'required|string',
            'tahun_sk' => 'required|string',
            'tanggal_kadaluarsa' => 'required|date',
            'status' => 'required|string',
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('file_pdf')) {
            $validated['file_pdf'] = $request->file('file_pdf')->store('akreditasi', 'public');
        }

        AkreditasiInstitusi::create($validated);
        return redirect()->route('admin.akreditasi-institusi.index')->with('success', 'Data Akreditasi Institusi berhasil ditambahkan.');
    }

    public function edit(AkreditasiInstitusi $akreditasi_institusi)
    {
        return view('admin.akreditasi-institusi.edit', compact('akreditasi_institusi'));
    }

    public function update(Request $request, AkreditasiInstitusi $akreditasi_institusi)
    {
        $validated = $request->validate([
            'peringkat' => 'required|string',
            'no_sk' => 'required|string',
            'tahun_sk' => 'required|string',
            'tanggal_kadaluarsa' => 'required|date',
            'status' => 'required|string',
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('file_pdf')) {
            if ($akreditasi_institusi->file_pdf) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($akreditasi_institusi->file_pdf);
            }
            $validated['file_pdf'] = $request->file('file_pdf')->store('akreditasi', 'public');
        }

        $akreditasi_institusi->update($validated);
        return redirect()->route('admin.akreditasi-institusi.index')->with('success', 'Data Akreditasi Institusi berhasil diperbarui.');
    }

    public function destroy(AkreditasiInstitusi $akreditasi_institusi)
    {
        $akreditasi_institusi->delete();
        return redirect()->route('admin.akreditasi-institusi.index')->with('success', 'Data Akreditasi Institusi berhasil dihapus.');
    }
}
