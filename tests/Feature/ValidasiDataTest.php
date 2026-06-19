<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\JenisMasalah;
use App\Models\DokumenPersyaratan;
use App\Models\PengajuanValidasi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ValidasiDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_submit_request_and_admin_can_update_status()
    {
        // 1. Setup Student and Admin users
        $student = User::factory()->create([
            'role' => 'mahasiswa',
            'email' => 'mahasiswa@example.com',
            'password' => bcrypt('password'),
        ]);

        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // 2. Setup JenisMasalah and DokumenPersyaratan
        $jenisMasalah = JenisMasalah::create([
            'nama_masalah' => 'Perubahan Nama',
            'deskripsi_bukti' => 'Bukti perubahan nama',
        ]);

        $docWajib = DokumenPersyaratan::create([
            'jenis_masalah_id' => $jenisMasalah->id,
            'nama_dokumen' => 'KTP',
            'is_wajib' => true,
        ]);

        $docOptional = DokumenPersyaratan::create([
            'jenis_masalah_id' => $jenisMasalah->id,
            'nama_dokumen' => 'Surat Pengantar',
            'is_wajib' => false,
        ]);

        // 3. Create a request directly with status 'data dikembalikan untuk diperbarui'
        $pengajuan = PengajuanValidasi::create([
            'user_id' => $student->id,
            'nama' => 'Student One',
            'nim' => '12345678',
            'prodi' => 'Informatika',
            'fakultas' => 'Teknik',
            'angkatan' => '2022',
            'no_hp' => '0812345678',
            'email' => 'student@example.com',
            'jenis_masalah_id' => $jenisMasalah->id,
            'keterangan' => 'Salah ketik nama',
            'status' => 'data dikembalikan untuk diperbarui',
            'catatan_admin' => 'Perbaiki berkas KTP',
        ]);

        // Add an existing document
        $pengajuan->pengajuanDokumens()->create([
            'nama_dokumen' => 'KTP',
            'file_path' => 'uploads/bukti/ktp.pdf',
            'is_wajib' => true,
        ]);

        // 4. Test Student Access to Edit Page
        $response = $this->actingAs($student)
            ->get(route('validasi-data.pengajuan.edit', $pengajuan->id));

        $response->assertStatus(200);
        $response->assertSee('Revisi Pengajuan Validasi');
        $response->assertSee('Perbaiki berkas KTP');

        // 5. Test Student Update Request (with no new file, since KTP already exists)
        $response = $this->actingAs($student)
            ->put(route('validasi-data.pengajuan.update', $pengajuan->id), [
                'nama' => 'Student One Revised',
                'nim' => '12345678',
                'prodi' => 'Informatika',
                'fakultas' => 'Teknik',
                'angkatan' => '2022',
                'no_hp' => '0812345678',
                'email' => 'student@example.com',
                'jenis_masalah_id' => $jenisMasalah->id,
                'keterangan' => 'Sudah diperbaiki',
            ]);

        $response->assertRedirect(route('validasi-data.dashboard'));
        
        // Assert status was reset to 'data di terima'
        $pengajuan->refresh();
        $this->assertEquals('data di terima', $pengajuan->status);
        $this->assertEquals('Student One Revised', $pengajuan->nama);

        // 6. Test Admin Update Status to "data di tinjau", "data di proses", "pengajuan selesai"
        $response = $this->actingAs($admin)
            ->put(route('admin.pengajuan-validasi.update', $pengajuan->id), [
                'status' => 'pengajuan selesai',
                'catatan_admin' => 'Sudah diproses',
            ]);

        $response->assertRedirect(route('admin.pengajuan-validasi.index'));
        $pengajuan->refresh();
        $this->assertEquals('pengajuan selesai', $pengajuan->status);
    }
}
