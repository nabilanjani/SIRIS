<?php

namespace App\Http\Controllers;

use App\Models\LihatJadwalModel as LihatJadwal;
use App\Models\prodi;
use Illuminate\Http\Request;

class LihatJadwalController extends Controller
{
    public function index()
    {
        // Ambil semua jadwal
        $jadwals = LihatJadwal::with('prodi')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Ambil data prodi untuk dropdown filter
        $prodis = prodi::all();
        
        return view('dekan.lihatjadwal', compact('jadwals', 'prodis'));
    }

    public function lihatJadwalByProdi($idProdi)
{
    \Log::info('ID Prodi yang diterima: ' . $idProdi);
    
    $jadwals = LihatJadwal::where('prodi', $idProdi)
        ->with('prodi')
        ->orderBy('created_at', 'desc')
        ->get();
    
    $prodis = Prodi::all();
    
    return view('dekan.lihatjadwal', [
        'jadwals' => $jadwals,
        'prodis' => $prodis,
        'selectedProdi' => $idProdi
    ]);
}


    public function filterByProdi(Request $request)
    {
        $prodiId = $request->prodi_id;
        
        $jadwals = LihatJadwal::where('prodi', $prodiId)
            ->with('prodi')
            ->get();
        
        $prodis = prodi::all();
        
        return view('dekan.lihatjadwal', [
            'jadwals' => $jadwals,
            'prodis' => $prodis,
            'selectedProdi' => $prodiId
        ]);
    }
}