<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function halamanRevie()
    {
        $user = Auth::user();
        $user->load('akademik');
        return view('pembimbingakademik.halamanrevie', compact('user'));
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

    public function detailPerwalian($user)
    {
        $user = Auth::user();
        $user->load('akademik');
        return view('pembimbingakademik.perwalian.detail', compact('user'));
    }
}