<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akademik extends Model
{
    use HasFactory;
    protected $table = 'akademik'; 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // relasi ke user, misal belongsTo
    }
}
