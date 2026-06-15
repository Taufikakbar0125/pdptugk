<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('akreditasi_prodis', function (Blueprint $table) {
            $table->id();
            $table->string('fakultas');
            $table->string('prodi');
            $table->string('strata');
            $table->string('peringkat');
            $table->string('no_sertifikat');
            $table->string('penyelenggaraan');
            $table->date('tanggal_akreditasi')->nullable();
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->string('status')->default('Aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('akreditasi_prodis');
    }
};
