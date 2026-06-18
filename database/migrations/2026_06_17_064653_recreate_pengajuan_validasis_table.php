<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('pengajuan_validasis');

        Schema::create('pengajuan_validasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('nim');
            $table->string('prodi');
            $table->string('fakultas');
            $table->string('angkatan');
            $table->string('no_hp');
            $table->string('email');
            $table->foreignId('jenis_masalah_id')->constrained('jenis_masalahs')->onDelete('cascade');
            $table->string('file_bukti');
            $table->text('keterangan')->nullable();
            $table->string('status')->default('pengajuan'); // pengajuan, proses, selesai
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_validasis');
    }
};
