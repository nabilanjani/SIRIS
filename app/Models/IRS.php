<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IRS extends Model
{
    protected $table = 'irs';
    protected $primaryKey = 'id_irs';
    public $timestamps = true;  // Pastikan timestamps diaktifkan
    const UPDATED_AT = 'tanggal_persetujuan'; // Menentukan kolom yang digunakan untuk updated_at
    use HasFactory;
    protected $fillable = [
        'nim',
        'nama',
        'jurusan',
        'semester',
        'kodemk',
        'namamk',
        'kelas',
        'sks',
        // 'hari',
        // 'mulai',
        // 'selesai',
        'status',  // Tambahkan status dengan nilai default 'pending'
        'tanggal_pengajuan',
        'tanggal_persetujuan',
    ];
    // public function mahasiswa(){
    //     return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    // }
    // public function mataKuliah()
    // {
    //     return $this->belongsTo(MataKuliah::class, 'kodemk', 'kodemk');
    // }
    // public function jadwalKuliah()
    // {
    //     return $this->belongsTo(JadwalKuliah::class, 'id_jadwal', 'id_jadwal');
    // }
    // public function dosen()
    // {
    //     return $this->hasOneThrough(
    //         Akademik::class,
    //         JadwalKuliah::class,
    //         'id',
    //         'nidn',
    //         'id_jadwal',
    //         'dosen_nip',
    //     );
    // }
    public function jadwal()
{
    return $this->belongsTo(Jadwal::class, 'id_irs', 'id'); // id_irs di IRS, id di jadwal
}


    protected $attributes = [
        'status' => 'pending',  // status default 'pending'
    ];
}
