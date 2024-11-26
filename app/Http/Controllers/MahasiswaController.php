<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function daftarMK(){
        $mataKuliah = MataKuliah::all();
        return view('mahasiswa.isiirs', compact('mataKuliah'));
    }
    public function profilMhs(){
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();

        if (!$mahasiswa) {
            abort(404, 'Mahasiswa tidak ditemukan');
        }

        return view('mahasiswa.isiirs', compact('user', 'mahasiswa'));

    }

}
