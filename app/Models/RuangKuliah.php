<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuangKuliah extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_ruang',
        'nama_ruang',
    ];
    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class, 'id_ruang');
    }
}
