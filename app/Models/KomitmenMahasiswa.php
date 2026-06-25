<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomitmenMahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nim',
        'program_studi',
        'nomor_wa',
        'tindak_lanjut',
        'file_path',
        'status',
        'catatan_admin',
        'gdrive_file_url',
        'gdrive_folder_url',
        'gdrive_pushed_at',
    ];

    protected $casts = [
        'gdrive_pushed_at' => 'datetime',
    ];
}
