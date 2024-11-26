<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_jadwal',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'kelas',
    ];
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kodemk');
    }
    public function ruangKuliah()
    {
        return $this->belongsTo(RuangKuliah::class, 'id_ruang');
    }
}
