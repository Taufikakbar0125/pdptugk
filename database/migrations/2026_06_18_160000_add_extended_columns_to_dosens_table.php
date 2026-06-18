<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dosens', function (Blueprint $table) {
            $table->string('kode_pt')->nullable()->after('id');
            $table->string('nama_pt')->nullable()->after('kode_pt');
            $table->string('nuptk')->nullable()->after('nama');
            $table->string('tempat_lahir')->nullable()->after('nidn');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->string('nik')->nullable()->after('nip');
            $table->string('tmmd')->nullable()->after('nik');
            $table->string('ikatan_kerja')->nullable()->after('status_kepegawaian');
            $table->string('pendidikan_terakhir')->nullable()->after('ikatan_kerja');
            $table->string('tahun_masuk')->nullable()->after('pendidikan_terakhir');
            $table->string('tahun_lulus')->nullable()->after('tahun_masuk');
            $table->string('jabatan_awal')->nullable()->after('tahun_lulus');
            $table->date('tmt_jabatan_awal')->nullable()->after('jabatan_awal');
            $table->string('jabatan_terakhir')->nullable()->after('tmt_jabatan_awal');
            $table->date('tmt_jabatan_terakhir')->nullable()->after('jabatan_terakhir');
            $table->string('pangkat_terakhir')->nullable()->after('tmt_jabatan_terakhir');
            $table->date('tmt_pangkat_terakhir')->nullable()->after('pangkat_terakhir');
            $table->string('masa_kerja_gol_tahun')->nullable()->after('tmt_pangkat_terakhir');
            $table->string('masa_kerja_gol_bulan')->nullable()->after('masa_kerja_gol_tahun');
            $table->string('jenis_sertifikasi')->nullable()->after('masa_kerja_gol_bulan');
            $table->string('tahun_sertifikasi')->nullable()->after('jenis_sertifikasi');
            $table->string('nomor_sertifikasi')->nullable()->after('tahun_sertifikasi');
            $table->string('sk_sertifikasi')->nullable()->after('nomor_sertifikasi');
            $table->string('status_keaktifan')->nullable()->after('sk_sertifikasi');
        });
    }

    public function down(): void
    {
        Schema::table('dosens', function (Blueprint $table) {
            $table->dropColumn([
                'kode_pt', 'nama_pt', 'nuptk', 'tempat_lahir', 'tanggal_lahir',
                'nik', 'tmmd', 'ikatan_kerja', 'pendidikan_terakhir',
                'tahun_masuk', 'tahun_lulus', 'jabatan_awal', 'tmt_jabatan_awal',
                'jabatan_terakhir', 'tmt_jabatan_terakhir', 'pangkat_terakhir',
                'tmt_pangkat_terakhir', 'masa_kerja_gol_tahun', 'masa_kerja_gol_bulan',
                'jenis_sertifikasi', 'tahun_sertifikasi', 'nomor_sertifikasi',
                'sk_sertifikasi', 'status_keaktifan',
            ]);
        });
    }
};
