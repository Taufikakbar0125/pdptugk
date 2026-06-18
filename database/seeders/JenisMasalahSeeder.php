<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisMasalah;
use App\Models\DokumenPersyaratan;

class JenisMasalahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Perubahan Nama Mahasiswa',
                'docs' => [
                    ['nama' => 'Scan KTP Asli', 'wajib' => true],
                    ['nama' => 'Scan Kartu Keluarga Asli', 'wajib' => true],
                    ['nama' => 'Scan Akta Kelahiran Asli', 'wajib' => true],
                ]
            ],
            [
                'nama' => 'Perubahan Tempat / Tanggal Lahir',
                'docs' => [
                    ['nama' => 'Scan Akta Kelahiran Asli', 'wajib' => true],
                    ['nama' => 'Scan KTP Asli', 'wajib' => true],
                    ['nama' => 'Scan Kartu Keluarga Asli', 'wajib' => false],
                ]
            ],
            [
                'nama' => 'Perubahan NIM (Nomor Induk Mahasiswa)',
                'docs' => [
                    ['nama' => 'Scan Kartu Tanda Mahasiswa (KTM)', 'wajib' => true],
                    ['nama' => 'Scan Surat Keterangan dari Fakultas', 'wajib' => true],
                ]
            ],
            [
                'nama' => 'Perubahan Tanggal Masuk Kuliah (PDDIKTI)',
                'docs' => [
                    ['nama' => 'Scan SK Penerimaan Mahasiswa Baru', 'wajib' => true],
                    ['nama' => 'Scan Bukti Registrasi Semester 1', 'wajib' => false],
                ]
            ],
            [
                'nama' => 'Perubahan Nama Ibu Kandung',
                'docs' => [
                    ['nama' => 'Scan Kartu Keluarga Asli', 'wajib' => true],
                    ['nama' => 'Scan Akta Kelahiran Asli', 'wajib' => true],
                ]
            ],
            [
                'nama' => 'Perbaikan Data Lainnya',
                'docs' => [
                    ['nama' => 'Scan Berkas Resmi Pendukung Akademik', 'wajib' => true],
                ]
            ]
        ];

        foreach ($data as $item) {
            $masalah = JenisMasalah::updateOrCreate(['nama_masalah' => $item['nama']]);
            
            // Hapus requirements lama biar bersih pas seeder jalan
            $masalah->dokumenPersyaratans()->delete();

            foreach ($item['docs'] as $doc) {
                DokumenPersyaratan::create([
                    'jenis_masalah_id' => $masalah->id,
                    'nama_dokumen' => $doc['nama'],
                    'is_wajib' => $doc['wajib'],
                ]);
            }
        }
    }
}
