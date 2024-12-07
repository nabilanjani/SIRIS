<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IRS extends Model
{
    use HasFactory;

    protected $table = 'irs';
    protected $primaryKey = 'id_irs';
    public $timestamps = true;  // Pastikan timestamps diaktifkan
    const UPDATED_AT = 'tanggal_persetujuan'; // Menentukan kolom yang digunakan untuk updated_at

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'nim',
        'nama',
        'jurusan',
        'semester',
        'kodemk',
        'namamk',
        'kelas',
        'sks',
        'hari',
        'mulai',
        'selesai',
        'status',  // Tambahkan status dengan nilai default 'pending'
        'tanggal_pengajuan',
        'tanggal_persetujuan',
    ];

    // Menentukan default untuk kolom status
    protected $attributes = [
        'status' => 'pending',  // status default 'pending'
    ];
    public function jadwal()
    {
        return $this->hasOne(Jadwal::class, 'kodemk', 'kodemk');
    }

}

