<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BukuAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuAkademikController extends Controller
{
    public function index()
    {
        $data = BukuAkademik::orderBy('start_year', 'desc')->orderBy('semester')->get();
        return view('admin.buku-akademik.index', compact('data'));
    }

    public function create()
    {
        return view('admin.buku-akademik.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'semester' => 'required|string',
            'tahun_akademik' => 'required|string',
            'start_year' => 'required|integer',
            'file_dokumen' => 'nullable|file|mimes:pdf|max:10240', // Max 10MB
        ]);

        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $path = $file->store('buku_akademik', 'public');
            $size = round($file->getSize() / 1048576, 2) . ' MB';
            
            $validated['file_path'] = $path;
            $validated['file_size'] = $size;
        }

        BukuAkademik::create($validated);
        return redirect()->route('admin.buku-akademik.index')->with('success', 'Buku Akademik berhasil ditambahkan.');
    }

    public function edit(BukuAkademik $buku_akademik)
    {
        return view('admin.buku-akademik.edit', compact('buku_akademik'));
    }

    public function update(Request $request, BukuAkademik $buku_akademik)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'semester' => 'required|string',
            'tahun_akademik' => 'required|string',
            'start_year' => 'required|integer',
            'file_dokumen' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('file_dokumen')) {
            // Delete old file
            if ($buku_akademik->file_path) {
                Storage::disk('public')->delete($buku_akademik->file_path);
            }

            $file = $request->file('file_dokumen');
            $path = $file->store('buku_akademik', 'public');
            $size = round($file->getSize() / 1048576, 2) . ' MB';
            
            $validated['file_path'] = $path;
            $validated['file_size'] = $size;
        }

        $buku_akademik->update($validated);
        return redirect()->route('admin.buku-akademik.index')->with('success', 'Buku Akademik berhasil diperbarui.');
    }

    public function destroy(BukuAkademik $buku_akademik)
    {
        if ($buku_akademik->file_path) {
            Storage::disk('public')->delete($buku_akademik->file_path);
        }
        $buku_akademik->delete();
        return redirect()->route('admin.buku-akademik.index')->with('success', 'Buku Akademik berhasil dihapus.');
    }
}
