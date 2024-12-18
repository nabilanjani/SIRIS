<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prodi extends Model
{
    use HasFactory;
    protected $table        = "prodi";
    protected $primaryKey = 'id_prodi';
    public $timestamps = false;
    protected $fillable     = ['nama'];

    public function listRuang() {
        return $this->hasMany(RuangModel::class,'id_prodi', 'id_prodi');
    }



}