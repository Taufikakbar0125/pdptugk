<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tendiks', function (Blueprint $table) {
            $table->id();
            $table->string('unit_kerja');
            $table->string('nama');
            $table->string('nip')->nullable();
            $table->string('golongan')->nullable();
            $table->string('pangkat')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('status_kepegawaian')->comment('PNS, CPNS, Kontrak');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tendiks');
    }
};
