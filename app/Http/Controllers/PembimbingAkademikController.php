<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\prodi;
use App\Models\User;

class PembimbingAkademikController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function dashboard()
    {
        $user = Auth::user();
        $user->load('akademik');    
        return view('pembimbingakademik.dashboard', compact('user'));
    }

    public function perwalian()
    {
        $user = Auth::user();
        $user->load('akademik');
        return view('pembimbingakademik.perwalian', compact('user'));
    }

    public function halamanRevie(Request $request)
{
    $user = Auth::user();
    $user->load('akademik');

    // Inisialisasi query
    $query = User::query();

    // Filter angkatan
    if ($request->filled('angkatan')) {
        $query->where('angkatan', $request->angkatan);
    }

    // Filter prodi
    if ($request->filled('prodi')) {
        $query->where('id_prodi', $request->prodi);
    }

    // Ambil data prodi untuk dropdown
    $prodi = DB::table('prodi')->select('id_prodi', 'nama')->get();

    // Eksekusi query
    $data = $query->get();

    return view('pembimbingakademik.halamanrevie', compact('user', 'prodi', 'data'));
} 

        public function resetFilter()
    {
        return redirect()->route('pembimbingakademik.halamanrevie');
    }

    public function halamanIrsMhs()
    {
        $user = Auth::user();
        $user->load('akademik');
        return view('pembimbingakademik.halamanirsmhs', compact('user'));
    }

    public function halamanKhsMhs()
    {
        $user = Auth::user();
        $user->load('akademik');
        return view('pembimbingakademik.halamankhsmhs', compact('user'));
    }

    public function halamanTranskripMhs()
    {
        $user = Auth::user();
        $user->load('akademik');
        return view('pembimbingakademik.halamantranskripmhs', compact('user'));
    }
}