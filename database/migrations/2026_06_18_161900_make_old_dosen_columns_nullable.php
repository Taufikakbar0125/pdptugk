<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dosens', function (Blueprint $table) {
            $table->string('fakultas')->nullable()->change();
            $table->string('golongan')->nullable()->change();
            $table->string('pangkat')->nullable()->change();
            $table->string('jabatan')->nullable()->change();
            $table->string('status_kepegawaian')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('dosens', function (Blueprint $table) {
            $table->string('fakultas')->nullable(false)->change();
            $table->string('status_kepegawaian')->nullable(false)->change();
        });
    }
};
