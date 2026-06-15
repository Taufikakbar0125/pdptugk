<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('akreditasi_internasionals', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['ASIC', 'ASIIN']);
            $table->string('fakultas');
            $table->string('prodi');
            $table->string('strata');
            $table->string('period');
            $table->string('accreditation_code')->nullable();
            $table->string('status')->default('Aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('akreditasi_internasionals');
    }
};
