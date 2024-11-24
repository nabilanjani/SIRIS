<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class User extends Controller
{
    public function show($id)
    {
        // Ambil user beserta akademik yang terhubung
        $user = User::with('akademik')->find($id);

        // Cek apakah user dan akademik ada
        if ($user && $user->akademik) {
            return view('user.show', ['nama_akademik' => $user->akademik->nama]);
        } else {
            return view('user.show', ['message' => 'Akademik tidak ditemukan!']);
        }
    }
}
