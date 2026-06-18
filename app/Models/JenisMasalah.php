<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisMasalah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_masalah',
    ];

    public function pengajuanValidasi()
    {
        return $this->hasMany(PengajuanValidasi::class);
    }

    public function dokumenPersyaratans()
    {
        return $this->hasMany(DokumenPersyaratan::class);
    }
}
