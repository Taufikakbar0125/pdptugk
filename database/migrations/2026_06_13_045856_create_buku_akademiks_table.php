<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buku_akademiks', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('semester')->comment('Gasal, Genap');
            $table->string('tahun_akademik');
            $table->integer('start_year');
            $table->string('file_path')->nullable();
            $table->string('file_size')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku_akademiks');
    }
};
