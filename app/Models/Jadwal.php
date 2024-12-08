<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'prodi',
        'namamk',
        'kodemk',
        'jenis_mata_kuliah',
        'jenis_pertemuan',
        'jenis_kelas',
        'kelas',
        'sks',
        'semester',
        'ruang_kuliah',
        'dosen_pengampu',
        'koordinator',
        'hari',
        'mulai',
        'selesai',
        'kuota',
        'kurikulum',
    ];
}