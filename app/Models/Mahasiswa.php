<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'alamat',
        'no_telp',
        'email',
        'angkatan',
        'jalur_masuk',
        'status',
        'ipk',
        'ips',
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function mataKuliahDiambil()
    {
    return $this->hasMany(MataKuliah::class, 'nim'); // Sesuaikan dengan tabel Anda
    }

    public function irs()
{
    return $this->hasMany(IRS::class, 'nim', 'nim');
}

    
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'jurusan', 'nama');
    }

    public function khs()
    {
        return $this->hasMany(KHS::class);
    }
}
