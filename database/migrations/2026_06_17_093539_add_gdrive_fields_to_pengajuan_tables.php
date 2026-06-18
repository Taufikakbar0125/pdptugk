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
            $table->string('gdrive_folder_url')->nullable()->after('catatan_admin');
            $table->timestamp('gdrive_pushed_at')->nullable()->after('gdrive_folder_url');
        });

        Schema::table('pengajuan_dokumens', function (Blueprint $table) {
            $table->string('gdrive_file_url')->nullable()->after('is_wajib');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_validasis', function (Blueprint $table) {
            $table->dropColumn(['gdrive_folder_url', 'gdrive_pushed_at']);
        });

        Schema::table('pengajuan_dokumens', function (Blueprint $table) {
            $table->dropColumn('gdrive_file_url');
        });
    }
};
