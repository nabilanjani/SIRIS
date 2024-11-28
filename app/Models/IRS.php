<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IRS extends Model
{
    use HasFactory;
    protected $fillable = [
        'nim',
        'kodemk',
        'nama_mk',
        'id_jadwal',
        'nama_dosen',
    ];
    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kodemk', 'kodemk');
    }
    public function jadwalKuliah()
    {
        return $this->belongsTo(JadwalKuliah::class, 'id_jadwal', 'id_jadwal');
    }
    public function dosen()
    {
        return $this->hasOneThrough(
            Akademik::class,
            JadwalKuliah::class,
            'id',
            'nidn',
            'id_jadwal',
            'dosen_nip',
        );
    }
}
