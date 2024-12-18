<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuangModel extends Model
{
    use HasFactory;
    protected $table        = "ruang_kuliah";
    protected $primaryKey   = "kode_ruang";
    public $incrementing = false; // Jika kode_ruang bukan auto-increment
    protected $keyType = 'string'; // Jika kode_ruang adalah string
    public $timestamps = false;
    protected $fillable     = ['kode_ruang','kapasitas','id_prodi','status'];

    // Di dalam RuangModel
    public function programStudi()
    {
        return $this->belongsTo(prodi::class, 'id_prodi', 'id_prodi');
    }



}
