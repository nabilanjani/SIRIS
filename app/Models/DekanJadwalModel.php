<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DekanJadwalModel extends Model
{
    protected $table = 'jadwal_setuju';
    protected $primaryKey = 'id_jadwalsetuju';
    
    protected $fillable = [
        'id_prodi',
        'status'
    ];

    // Cast status to integer
    protected $casts = [
        'status' => 'integer'
    ];

    public function programStudi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }
}