<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\prodi;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\IRS;
use Barryvdh\DomPDF\Facade\Pdf;

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
        
        $prodi = DB::table('prodi')->select('nama')->get();
        
        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }
        
        if ($request->filled('prodi')) {
            $query->where('jurusan', $request->prodi);
        }

        if ($request->filled('status_irs')) {
            switch ($request->status_irs) {
                case 'belum_irs':
                    $query->whereDoesntHave('irs', 'semester');
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

        
        $mahasiswa = $query->get()->map(function($mhs) {
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
        $mhs = Mahasiswa::find($nim);

        return view('pembimbingakademik.halamanirsmhs', compact('user', 'dataIRS', 'statusIRS', 'mhs'));
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

    public function allowChangesIrs(Request $request, $semester)
    {
        $irs = IRS::where('nim', $request->nim)
                ->where('semester', $semester)
                ->first();

        if ($irs) {
            $irs->status = 'allow_changes'; 
            $irs->save();
        }

        return redirect()->route('pembimbingakademik.halamanIrsMhs', ['nim' => $request->nim])
                        ->with('success', 'IRS berhasil diberikan izin perubahan.');
    }

    public function revokeApproveIrs(Request $request, $semester)
    {
        $irs = IRS::where('semester', $semester)->first();

        if (!$irs) {
            return redirect()->back()->with('error', 'IRS semester ' . $semester . ' tidak ditemukan.');
        }
        $newStatus = $request->input('status', 'ditolak');

        if (!in_array($newStatus, ['pending', 'ditolak'])) {
            return redirect()->back()->with('error', 'Status yang diberikan tidak valid.');
        }

        $irs->update([
            'status' => $newStatus,
            'tanggal_persetujuan' => null, 
        ]);

        $message = $newStatus === 'pending'
            ? 'Mahasiswa diizinkan untuk mengubah IRS semester ' . $semester . '.'
            : 'Persetujuan IRS semester ' . $semester . ' berhasil dibatalkan. Mahasiswa tidak dapat mengubah IRS.';

        return redirect()->back()->with('success', $message);
    }

    public function cetakPdf($nim, $semester)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->first(); 
        $irs = Irs::where('nim', $nim)
                  ->where('semester', $semester)
                  ->with('jadwal')
                  ->get(); 
    
        if ($mahasiswa && $irs->count()) {
            $pdf = PDF::loadView('mahasiswa.cetakpdf', compact('mahasiswa', 'irs'));
            $filename = 'Laporan_Mahasiswa_' . $mahasiswa->nim . '.pdf';
            return $pdf->download($filename); 
        } else {
            return response()->json(['error' => 'Data tidak ditemukan'], 404); 
        }
    }
    
}