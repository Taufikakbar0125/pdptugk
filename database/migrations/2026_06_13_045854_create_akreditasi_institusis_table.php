<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('akreditasi_institusis', function (Blueprint $table) {
            $table->id();
            $table->string('peringkat');
            $table->string('no_sk');
            $table->string('tahun_sk');
            $table->date('tanggal_kadaluarsa');
            $table->string('status')->default('Aktif');
            $table->string('file_sertifikat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('akreditasi_institusis');
    }
};
