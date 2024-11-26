<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;
    protected $fillable = [
        'kodemk',
        'nama',
        'semester',
        'sks',
    ];
    public function irs(){
        return $this->hasMany(IRS::class, 'kodemk');
    }
    public function khs(){
        return $this->hasMany(KHS::class, 'kodemk');
    }
    public function jadwalKuliah(){
        return $this->hasMany(JadwalKuliah::class, 'kodemk');
    }
}
