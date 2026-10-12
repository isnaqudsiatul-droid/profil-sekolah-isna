<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Ektrakurikuler;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $primaryKey = 'id_guru';

    protected $fillable = [
        'nama_guru',
        'slug',
        'nip',
        'mapel',
        'foto',
    ];

    public function ekstrakurikuler(): HasMany
    {
        return $this->hasMany(Ektrakurikuler::class,'id_guru','id_guru');
    }
}