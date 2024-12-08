<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\IRS;
use App\Models\KHS;
use App\Models\Jadwal;

class MahasiswaController extends Controller
{
    
    public function index(){

        //data mahasiswa yang login
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        $irs = $mahasiswa->mataKuliahDiambil ?? [];
        $semester = $mahasiswa->semester;
        $jurusan = $mahasiswa->jurusan;
        $statusMhs = $mahasiswa->status;
        // dd($irs);


        //ambil data jadwal matkul sesuai semester
        $jadwal = Jadwal::where('semester', $semester);

        //cek status mahasiswa
        $alertStatusMhs = null;
        if($statusMhs == 'Aktif'){
            $jadwal = $jadwal->get();
        }elseif($statusMhs == 'Cuti'){
            $alertStatusMhs = 'Anda tidak bisa melakukan pengambilan IRS';
        }else{
            $alertStatusMhs = 'Anda belum melakukan HER-Registrasi';
        }
        
        //ambil total sks yang telah diambil
        $totalSKSdiambil = IRS::where('nim', $mahasiswa->nim)->sum('sks');

        $irsSebelum = DB::table('irs')
            ->where('nim', $mahasiswa->nim)
            ->get(['kodemk', 'kelas'])
            ->toArray();

        //list matkul di luar semester yang sedang berjalan    
        $daftarMK = Jadwal::select('kodemk', 'namamk')
            ->where('semester', '<>', $semester)
            ->distinct()
            ->get();
        
        //hitung IP semester sebelum    
        $dataKHS = DB::table('khs')
            ->where('nim', $mahasiswa->nim)
            ->where('semester', $semester - 1)
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
            $bobot = $nilai[strtoupper(trim($KHS->nilai_huruf))] ?? 0; // Bobot nilai
            $total_nilai += $KHS->sks * $bobot;
            $totalSKS += $KHS->sks;
        }
        $ips = $totalSKS > 0 ? round($total_nilai / $totalSKS, 2) : 0;
        
        //total SKS yang boleh diambil berdasarkan IP semester sebelum
        if ($ips >= 3.00){
            $maksSKS = 24;
        }elseif ($ips >= 2.50 && $ips <= 2.99){
            $maksSKS = 22;
        }elseif ($ips >= 2.00 && $ips <= 2.49){
            $maksSKS = 20;
        }else{
            $maksSKS = 18;
        }

        $statusIRS = IRS::where('nim', $mahasiswa->nim)
            ->where('semester', $semester)
            ->first();
        $statusIRS = $statusIRS ? $statusIRS->status : null;
        return view('mahasiswa.irs', compact('irs','jadwal','user','irsSebelum','mahasiswa','totalSKSdiambil','daftarMK','ips','maksSKS','statusIRS','alertStatusMhs'));
    }

    public function store(Request $request)
    {
        try {
            // Ambil data mahasiswa berdasarkan email
            $user = Auth::user();
            $mahasiswa = Mahasiswa::where('email', $user->email)->first();

            // Validasi request (pastikan semua field ada)
            $request->validate([
                'kodemk' => 'required',
                'namamk' => 'required',
                'semester' => 'required|integer',
                'kelas' => 'required',
                'sks' => 'required|integer',
            ]);

            // Simpan data ke tabel IRS tanpa kolom tahun_akademik
            $irs = new IRS([
                'nim' => $mahasiswa->nim, // Gunakan nim dari mahasiswa yang sedang login
                'nama' => $mahasiswa->nama, // Ambil nama dari mahasiswa
                'jurusan' => $mahasiswa->jurusan, // Ambil jurusan dari mahasiswa
                'semester' => $request->semester, // Ambil semester dari input request
                'kodemk' => $request->kodemk, // Ambil kode MK dari input request
                'namamk' => $request->namamk, // Ambil nama MK dari input request
                'kelas' => $request->kelas, // Ambil kelas dari input request
                'sks' => $request->sks, // Ambil SKS dari input request
                'status' => 'pending', // Status default adalah 'pending'
                'tanggal_pengajuan' => now(), // Set tanggal pengajuan ke sekarang
                'tanggal_persetujuan' => null, // Tidak diisi, biarkan NULL
            ]);

            // Simpan data IRS ke database
            if ($irs->save()) {
                return redirect()->back()->with('success', 'Pengambilan IRS berhasil.');
            } else {
                dd('Data gagal disimpan'); // Debug jika gagal
            }

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Pengambilan IRS gagal: ' . $e->getMessage()]);
        }
    }

    
    
    public function delete(Request $request){
        $validated = $request->validate([
            'kodemk' => 'required',
            'namaMhs' => 'required',
            'kelas' => 'required',
        ]);
        try{
            $irs = IRS::where('kodemk', $validated['kodemk'])
                    ->where('nama', $validated['namaMhs'])
                    ->where('kelas', $validated['kelas'])
                    ->first();
            if($irs){
                $irs->delete();
            }
            KHS::where('kodemk', $validated['kodemk'])
                ->where('nama', $validated['namaMhs'])
                ->delete();        
            return redirect()->back()->with('success', 'IRS berhasil dihapus.');
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus mata kuliah' . $e->getMessage(),
            ], 500);
        }
    }

    public function daftarMhs()
    {
        $mahasiswa = Mahasiswa::with('irs')->get(); // Ambil data mahasiswa beserta IRS
        return view('pembimbingakademik.halamanrevie', compact('mahasiswa')); // Kirim ke view
    }

}