<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuangModel extends Model
{
    use HasFactory;
    protected $table        = "ruang_kuliah";
    protected $primaryKey   = "id_ruang";
    public $incrementing = false; // Jika kode_ruang bukan auto-increment
    protected $keyType = 'string'; // Jika kode_ruang adalah string
    public $timestamps = false;
    protected $fillable     = ['id_ruang','kode_ruang','jenis_ruang','kapasitas'];
}
