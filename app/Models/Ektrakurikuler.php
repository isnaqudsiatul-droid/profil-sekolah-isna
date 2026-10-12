<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ektrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'ekstrakurikuler';
    protected $primaryKey = 'id_ekskul';

    protected $fillable = [
        'nama_ekskul',
        'slug',
        'id_guru',
        'jadwal_latihan',
        'deskripsi',
        'gambar',
    ];

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }
}