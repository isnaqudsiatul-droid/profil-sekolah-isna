<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    use HasFactory;

    protected $table = 'profil_sekolah';
    protected $primaryKey = 'id_profil';

    protected $fillable = [
        'nama_sekolah',
        'nama_kepala_sekolah',
        'foto_kepala_sekolah',
        'foto',
        'logo',
        'npsn',
        'alamat',
        'kontak',
        'tiktok',
        'instagram',
        'facebook',
        'youtube',
        'visi',
        'misi',
        'tahun_berdiri',
        'deskripsi',
    ];
}
