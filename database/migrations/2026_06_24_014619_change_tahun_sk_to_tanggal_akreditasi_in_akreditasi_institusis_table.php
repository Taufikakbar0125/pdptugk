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
        Schema::table('akreditasi_institusis', function (Blueprint $table) {
            $table->dropColumn('tahun_sk');
            $table->date('tanggal_akreditasi')->nullable()->after('no_sk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('akreditasi_institusis', function (Blueprint $table) {
            $table->dropColumn('tanggal_akreditasi');
            $table->string('tahun_sk')->nullable()->after('no_sk');
        });
    }
};
