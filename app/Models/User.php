<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function akademik()
    {
        return $this->hasOne(Akademik::class, 'user_id'); // pastikan relasi ini benar, misal hasOne
        //return $this->belongsTo(Akademik::class);
    }
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'doswal'); // pastikan relasi ini benar, misal hasOne
        //return $this->belongsTo(Akademik::class);
    }
}
