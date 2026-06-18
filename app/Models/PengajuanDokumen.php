<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanDokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_validasi_id',
        'nama_dokumen',
        'file_path',
        'is_wajib',
        'gdrive_file_url',
    ];

    protected $casts = [
        'is_wajib' => 'boolean',
    ];

    public function pengajuanValidasi()
    {
        return $this->belongsTo(PengajuanValidasi::class);
    }
}
