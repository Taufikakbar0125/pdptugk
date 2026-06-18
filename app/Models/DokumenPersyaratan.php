<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPersyaratan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_masalah_id',
        'nama_dokumen',
        'is_wajib',
    ];

    protected $casts = [
        'is_wajib' => 'boolean',
    ];

    public function jenisMasalah()
    {
        return $this->belongsTo(JenisMasalah::class);
    }
}
