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
        Schema::create('pengajuan_validasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nim_baru')->nullable();
            $table->string('nama_baru')->nullable();
            $table->string('tempat_lahir_baru')->nullable();
            $table->date('tanggal_lahir_baru')->nullable();
            $table->string('jenis_kelamin_baru')->nullable();
            $table->date('tanggal_masuk_baru')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('status')->default('pending'); // pending, disetujui, ditolak
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
