<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    // Define the correct table name if it's not the default plural form of the model
    protected $table = 'dosen'; 

    // Add the fillable columns if necessary
    protected $fillable = ['nip', 'nama'];
}

