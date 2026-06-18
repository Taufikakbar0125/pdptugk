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
        Schema::table('jenis_masalahs', function (Blueprint $table) {
            $table->text('deskripsi_bukti')->nullable()->after('nama_masalah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jenis_masalahs', function (Blueprint $table) {
            $table->dropColumn('deskripsi_bukti');
        });
    }
};
