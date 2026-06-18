<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisMasalah;
use Illuminate\Http\Request;

class JenisMasalahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = JenisMasalah::with('dokumenPersyaratans')->orderBy('id', 'desc')->get();
        return view('admin.jenis-masalah.index', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_masalah' => 'required|string|max:255|unique:jenis_masalahs,nama_masalah',
            'docs'         => 'required|array|min:1',
            'docs.*.nama'  => 'required|string|max:255',
        ], [
            'nama_masalah.required' => 'Nama kategori masalah wajib diisi.',
            'nama_masalah.unique'   => 'Nama kategori masalah sudah terdaftar.',
            'docs.required'         => 'Minimal harus menambahkan 1 dokumen pendukung.',
            'docs.min'              => 'Minimal harus menambahkan 1 dokumen pendukung.',
            'docs.*.nama.required'  => 'Nama berkas dokumen pendukung wajib diisi.',
        ]);

        $masalah = JenisMasalah::create([
            'nama_masalah' => $request->nama_masalah
        ]);

        foreach ($request->docs as $doc) {
            $masalah->dokumenPersyaratans()->create([
                'nama_dokumen' => $doc['nama'],
                'is_wajib'     => isset($doc['is_wajib']) || (isset($doc['wajib_val']) && $doc['wajib_val'] == '1'),
            ]);
        }

        return redirect()->route('admin.jenis-masalah.index')->with('success', 'Kategori masalah dan berkas pendukung berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_masalah' => 'required|string|max:255|unique:jenis_masalahs,nama_masalah,' . $id,
            'docs'         => 'required|array|min:1',
            'docs.*.nama'  => 'required|string|max:255',
        ], [
            'nama_masalah.required' => 'Nama kategori masalah wajib diisi.',
            'nama_masalah.unique'   => 'Nama kategori masalah sudah terdaftar.',
            'docs.required'         => 'Minimal harus menambahkan 1 dokumen pendukung.',
            'docs.min'              => 'Minimal harus menambahkan 1 dokumen pendukung.',
            'docs.*.nama.required'  => 'Nama berkas dokumen pendukung wajib diisi.',
        ]);

        $masalah = JenisMasalah::findOrFail($id);
        $masalah->update([
            'nama_masalah' => $request->nama_masalah
        ]);

        $masalah->dokumenPersyaratans()->delete();
        foreach ($request->docs as $doc) {
            $masalah->dokumenPersyaratans()->create([
                'nama_dokumen' => $doc['nama'],
                'is_wajib'     => isset($doc['is_wajib']) || (isset($doc['wajib_val']) && $doc['wajib_val'] == '1'),
            ]);
        }

        return redirect()->route('admin.jenis-masalah.index')->with('success', 'Kategori masalah dan berkas pendukung berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = JenisMasalah::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Kategori masalah berhasil dihapus.');
    }
}
