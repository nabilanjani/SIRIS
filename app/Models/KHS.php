<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KHS extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'khs';

    // Primary Key
    protected $primaryKey = 'id_irs';

    // Kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'nim',
        'nama',
        'semester',
        'jurusan',
        'kodemk',
        'namamk',
        'sks',
        'nilai_huruf',
        'nilai_angka',
    ];

    // Non-auto-increment primary key (jika ada)
    public $incrementing = true;

    // Tipe primary key
    protected $keyType = 'int';

    // Timestamps (created_at dan updated_at) dinonaktifkan karena tidak ada di tabel
    public $timestamps = false;

    // Relasi ke tabel Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    // Relasi ke tabel Mata Kuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kodemk', 'kodemk');
    }
}
