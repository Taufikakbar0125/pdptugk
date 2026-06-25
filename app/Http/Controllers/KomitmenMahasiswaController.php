<?php

namespace App\Http\Controllers;

use App\Models\KomitmenMahasiswa;
use Illuminate\Http\Request;

class KomitmenMahasiswaController extends Controller
{
    /**
     * Tampilkan halaman form komitmen mahasiswa.
     */
    public function showForm()
    {
        return view('komitmen-mahasiswa.form');
    }

    /**
     * Simpan data komitmen mahasiswa.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required|string|max:255',
            'nim'            => 'required|string|max:50',
            'program_studi'  => 'required|string|max:255',
            'nomor_wa'       => 'required|string|max:30',
            'tindak_lanjut'  => 'required|in:Melanjutkan Studi,Pindah PT,Pengunduran Diri',
            'file_berkas'    => 'required|file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx',
        ], [
            'nama.required'          => 'Nama wajib diisi.',
            'nim.required'           => 'NIM wajib diisi.',
            'program_studi.required' => 'Program Studi wajib dipilih.',
            'nomor_wa.required'      => 'Nomor WA wajib diisi.',
            'tindak_lanjut.required' => 'Tindak lanjut wajib dipilih.',
            'tindak_lanjut.in'       => 'Pilihan tindak lanjut tidak valid.',
            'file_berkas.required'   => 'Upload berkas wajib diisi.',
            'file_berkas.max'        => 'Ukuran file maksimal 10 MB.',
            'file_berkas.mimes'      => 'Format file harus PDF, JPG, PNG, DOC, atau DOCX.',
        ]);

        // Upload file
        $file = $request->file('file_berkas');
        $fileName = time() . '_' . $request->nim . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('komitmen-mahasiswa', $fileName, 'public');

        KomitmenMahasiswa::create([
            'nama'          => $request->nama,
            'nim'           => $request->nim,
            'program_studi' => $request->program_studi,
            'nomor_wa'      => $request->nomor_wa,
            'tindak_lanjut' => $request->tindak_lanjut,
            'file_path'     => $filePath,
            'status'        => 'menunggu',
        ]);

        return redirect()->route('komitmen-mahasiswa.form')
            ->with('success', 'Terima kasih! Data komitmen Anda berhasil dikirim. Tim akademik akan meninjau pengajuan Anda.');
    }
}
