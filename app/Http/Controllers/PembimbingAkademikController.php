<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\prodi;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\IRS;

class PembimbingAkademikController extends Controller
{
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

        $query = Mahasiswa::with('irs');
    
        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }
        if ($request->filled('prodi')) {
            $query->where('jurusan', $request->prodi);
        }
        if ($request->filled('status_irs')) {
            switch ($request->status_irs) {
                case 'belum_irs':
                    $query->whereDoesntHave('irs');
                    break;
                case 'belum_disetujui':
                    $query->whereHas('irs', function($q) {
                        $q->where('status', 'pending');
                    });
                    break;
                case 'sudah_disetujui':
                    $query->whereHas('irs', function($q) {
                        $q->where('status', 'disetujui');
                    });
                    break;
            }
        }
        $prodi = DB::table('prodi')->select('nama')->get();
        $counts = [
            'belum_irs' => Mahasiswa::whereDoesntHave('irs')->count(),
            'belum_disetujui' => Mahasiswa::whereHas('irs', function($q) {
                $q->where('status', 'pending');
            })->count(),
            'sudah_disetujui' => Mahasiswa::whereHas('irs', function($q) {
                $q->where('status', 'disetujui');
            })->count()
        ];
        $mahasiswa = $query->get();
        return view('pembimbingakademik.halamanrevie', compact('user', 'prodi', 'mahasiswa', 'counts'));
    }
    public function resetFilter()
    {
        return redirect()->route('pembimbingakademik.halamanrevie')->with('success', 'Filter berhasil direset');
    }

    public function halamanIrsMhs($nim)
    {
        $user = Auth::user();
        $user->load('akademik');

        $dataIRS = IRS::with('jadwal')->where('nim', $nim)->get();
        $statusIRS = $dataIRS->isNotEmpty() ? $dataIRS->first()->status : 'pending';

        return view('pembimbingakademik.halamanirsmhs', compact('user', 'dataIRS', 'statusIRS'));
    }

    public function approveIrs($semester)
    {
        IRS::where('semester', $semester)
            ->update([
                'status' => 'disetujui',
                'tanggal_persetujuan' => now(),
            ]);

        return redirect()->back()->with('success', 'IRS semester ' . $semester . ' berhasil disetujui.');
    }
}