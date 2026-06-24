<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $data = Dosen::orderBy('nama')->get();
        return view('admin.dosen.index', compact('data'));
    }

    public function create()
    {
        return view('admin.dosen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_pt' => 'nullable|string',
            'nama_pt' => 'nullable|string',
            'nama' => 'required|string',
            'nuptk' => 'nullable|string',
            'nidn' => 'nullable|string',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'nip' => 'nullable|string',
            'nik' => 'nullable|string',
            'tmmd' => 'nullable|string',
            'fakultas' => 'nullable|string',
            'prodi_jurusan' => 'nullable|string',
            'golongan' => 'nullable|string',
            'pangkat' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'status_kepegawaian' => 'required|string',
            'ikatan_kerja' => 'nullable|string',
            'pendidikan_terakhir' => 'nullable|string',
            'tahun_masuk' => 'nullable|string',
            'tahun_lulus' => 'nullable|string',
            'jabatan_awal' => 'nullable|string',
            'tmt_jabatan_awal' => 'nullable|date',
            'jabatan_terakhir' => 'nullable|string',
            'tmt_jabatan_terakhir' => 'nullable|date',
            'pangkat_terakhir' => 'nullable|string',
            'tmt_pangkat_terakhir' => 'nullable|date',
            'masa_kerja_gol_tahun' => 'nullable|string',
            'masa_kerja_gol_bulan' => 'nullable|string',
            'jenis_sertifikasi' => 'nullable|string',
            'tahun_sertifikasi' => 'nullable|string',
            'nomor_sertifikasi' => 'nullable|string',
            'sk_sertifikasi' => 'nullable|string',
            'status_keaktifan' => 'nullable|string',
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
            'kode_pt' => 'nullable|string',
            'nama_pt' => 'nullable|string',
            'nama' => 'required|string',
            'nuptk' => 'nullable|string',
            'nidn' => 'nullable|string',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'nip' => 'nullable|string',
            'nik' => 'nullable|string',
            'tmmd' => 'nullable|string',
            'fakultas' => 'nullable|string',
            'prodi_jurusan' => 'nullable|string',
            'golongan' => 'nullable|string',
            'pangkat' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'status_kepegawaian' => 'required|string',
            'ikatan_kerja' => 'nullable|string',
            'pendidikan_terakhir' => 'nullable|string',
            'tahun_masuk' => 'nullable|string',
            'tahun_lulus' => 'nullable|string',
            'jabatan_awal' => 'nullable|string',
            'tmt_jabatan_awal' => 'nullable|date',
            'jabatan_terakhir' => 'nullable|string',
            'tmt_jabatan_terakhir' => 'nullable|date',
            'pangkat_terakhir' => 'nullable|string',
            'tmt_pangkat_terakhir' => 'nullable|date',
            'masa_kerja_gol_tahun' => 'nullable|string',
            'masa_kerja_gol_bulan' => 'nullable|string',
            'jenis_sertifikasi' => 'nullable|string',
            'tahun_sertifikasi' => 'nullable|string',
            'nomor_sertifikasi' => 'nullable|string',
            'sk_sertifikasi' => 'nullable|string',
            'status_keaktifan' => 'nullable|string',
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
