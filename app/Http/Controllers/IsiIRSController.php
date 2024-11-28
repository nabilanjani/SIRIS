<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IRS;
use App\Models\MataKuliah;

class IsiIRSController extends Controller
{
    public function buatIRS(Request $request){
        $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'kodemk' => 'required|exists:mata_kuliah,kodemk',
        ]);
        $existing = IRS::where('nim', $request->nim)
            ->where('kodemk', $request->kodemk)
            ->first();
        if ($existing){
            return back()->with('error', 'Mata Kuliah sudah diambil.');
        }
        IRS::create([
            'nim'=>$request->nim,
            'kodemk'=>$request->kodemk,
            'nama'=>MataKuliah::where('kodemk', $request->kodemk)->first()->nama,
        ]);
        return back()->with('success', 'Mata kuliah berhasil ditambahkan ke IRS.');
    }

}
