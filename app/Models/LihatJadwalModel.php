<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LihatJadwalModel extends Model
{
    protected $table = 'jadwal';
    
    protected $primaryKey = 'id'; // Sesuaikan dengan nama primary key di database

    protected $fillable = [
        'mata_kuliah',
        'dosen_pengampu',
        'hari',
        'mulai',
        'selesai',
        'ruang_kuliah',
        'prodi',
        'status'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi', 'id_prodi');
    }
}