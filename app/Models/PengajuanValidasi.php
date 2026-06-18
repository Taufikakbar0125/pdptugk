<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanValidasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'nim',
        'prodi',
        'fakultas',
        'angkatan',
        'no_hp',
        'email',
        'jenis_masalah_id',
        'keterangan',
        'status',
        'catatan_admin',
        'gdrive_folder_url',
        'gdrive_pushed_at',
    ];

    protected $casts = [
        'gdrive_pushed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jenisMasalah()
    {
        return $this->belongsTo(JenisMasalah::class);
    }

    public function pengajuanDokumens()
    {
        return $this->hasMany(PengajuanDokumen::class);
    }
}
