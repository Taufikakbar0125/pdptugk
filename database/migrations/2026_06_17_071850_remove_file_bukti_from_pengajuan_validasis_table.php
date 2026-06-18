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
        Schema::table('pengajuan_validasis', function (Blueprint $table) {
            if (Schema::hasColumn('pengajuan_validasis', 'file_bukti')) {
                $table->dropColumn('file_bukti');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_validasis', function (Blueprint $table) {
            $table->string('file_bukti')->after('jenis_masalah_id');
        });
    }
};
