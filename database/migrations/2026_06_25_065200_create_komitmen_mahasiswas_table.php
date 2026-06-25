<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komitmen_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim');
            $table->string('program_studi');
            $table->string('nomor_wa');
            $table->string('tindak_lanjut'); // Melanjutkan Studi, Pindah PT, Pengunduran Diri
            $table->string('file_path'); // path file upload lokal
            $table->string('status')->default('menunggu'); // menunggu, diproses, selesai
            $table->text('catatan_admin')->nullable();
            $table->string('gdrive_file_url')->nullable();
            $table->string('gdrive_folder_url')->nullable();
            $table->timestamp('gdrive_pushed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komitmen_mahasiswas');
    }
};
