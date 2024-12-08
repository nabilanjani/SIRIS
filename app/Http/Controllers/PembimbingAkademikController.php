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
        $mahasiswa = Mahasiswa::with('irs')->get()->map(function($mhs) {
            // Hitung IPS
            $dataKHS = DB::table('khs')
                ->where('nim', $mhs->nim)
                ->where('semester', $mhs->semester - 1)
                ->whereNotNull('nilai_huruf')
                ->get(['sks', 'nilai_huruf']);
                
            $nilai = [
                'A' => 4,
                'B' => 3,
                'C' => 2,
                'D' => 1,
                'E' => 0,
            ];
            
            $total_nilai = 0;
            $totalSKS = 0;
    
            foreach($dataKHS as $KHS){
                $bobot = $nilai[strtoupper(trim($KHS->nilai_huruf))] ?? 0;
                $total_nilai += $KHS->sks * $bobot;
                $totalSKS += $KHS->sks;
            }
            
            $mhs->ips = $totalSKS > 0 ? round($total_nilai / $totalSKS, 2) : 0;
            return $mhs;
        });
        
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

        $dataIRS = IRS::with('jadwal')
            ->where('nim', $nim)
            ->get();

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