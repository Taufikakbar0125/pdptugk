<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AkreditasiInternasional;
use Illuminate\Http\Request;

class AkreditasiInternasionalController extends Controller
{
    public function index()
    {
        $data = AkreditasiInternasional::orderBy('jenis')->orderBy('prodi')->get();
        return view('admin.akreditasi-internasional.index', compact('data'));
    }

    public function create()
    {
        return view('admin.akreditasi-internasional.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:ASIC,ASIIN',
            'fakultas' => 'required|string',
            'prodi' => 'required|string',
            'strata' => 'required|string',
            'period' => 'required|string',
            'accreditation_code' => 'nullable|string',
            'status' => 'required|string',
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('file_pdf')) {
            $validated['file_pdf'] = $request->file('file_pdf')->store('akreditasi', 'public');
        }

        AkreditasiInternasional::create($validated);
        return redirect()->route('admin.akreditasi-internasional.index')->with('success', 'Data Akreditasi Internasional berhasil ditambahkan.');
    }

    public function edit(AkreditasiInternasional $akreditasi_internasional)
    {
        return view('admin.akreditasi-internasional.edit', compact('akreditasi_internasional'));
    }

    public function update(Request $request, AkreditasiInternasional $akreditasi_internasional)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:ASIC,ASIIN',
            'fakultas' => 'required|string',
            'prodi' => 'required|string',
            'strata' => 'required|string',
            'period' => 'required|string',
            'accreditation_code' => 'nullable|string',
            'status' => 'required|string',
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('file_pdf')) {
            if ($akreditasi_internasional->file_pdf) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($akreditasi_internasional->file_pdf);
            }
            $validated['file_pdf'] = $request->file('file_pdf')->store('akreditasi', 'public');
        }

        $akreditasi_internasional->update($validated);
        return redirect()->route('admin.akreditasi-internasional.index')->with('success', 'Data Akreditasi Internasional berhasil diperbarui.');
    }

    public function destroy(AkreditasiInternasional $akreditasi_internasional)
    {
        $akreditasi_internasional->delete();
        return redirect()->route('admin.akreditasi-internasional.index')->with('success', 'Data Akreditasi Internasional berhasil dihapus.');
    }
}
