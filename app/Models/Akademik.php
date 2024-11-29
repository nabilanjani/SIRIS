<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akademik extends Model
{
    protected $table = 'akademik';
    use HasFactory;
    protected $fillable = [
        'nidn',
        'nama',
        'no_hp',
        'email',
        'jabatan',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // Sesuaikan kolom foreign key
    }
}
