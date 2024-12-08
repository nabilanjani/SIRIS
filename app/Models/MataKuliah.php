<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;  // Tambahkan trait ini

    protected $table = 'mata_kuliah';
    protected $primaryKey = 'kodemk';
    public $incrementing = false;  // Karena primary key bukan auto-increment
    public $timestamps = false;

    protected $fillable = ['kodemk', 'namamk', 'sks', 'semester'];
}