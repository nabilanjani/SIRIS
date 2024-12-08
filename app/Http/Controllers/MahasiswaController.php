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
    
    public function herreg()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();

        if (!$mahasiswa) {
            abort(404, 'Mahasiswa tidak ditemukan');
        }

        return view('mahasiswa.herreg', compact('user', 'mahasiswa'));
    }

    public function setAktif($nim)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('nim', $nim)->where('email', $user->email)->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
        }

        $mahasiswa->status = 'Aktif'; // Set status ke Aktif
        $mahasiswa->save();

        return redirect()->back()->with('success', 'Status berhasil diubah ke Aktif.');
    }

    public function setCuti($nim)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('nim', $nim)->where('email', $user->email)->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
        }

        $mahasiswa->status = 'Cuti'; // Set status ke Cuti
        $mahasiswa->save();

        return redirect()->back()->with('success', 'Status berhasil diubah ke Cuti.');
    }

    public function batalkan($nim)
    {
    $user = Auth::user();
    $mahasiswa = Mahasiswa::where('nim', $nim)->where('email', $user->email)->first();

    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
    }

    $mahasiswa->status = 'Belum Her-Registrasi';
    $mahasiswa->save();

    return redirect()->back()->with('success', 'Status berhasil dibatalkan.');
    }

    public function dashboard(){
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.dashboard', compact('mahasiswa'));
    }
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
        return view('mahasiswa.lihatirs', compact('mahasiswa', 'irs', 'jadwal', 'ips', 'maksSKS', 'totalSKSdiambil'));

    }

    public function store(Request $request)
    {
        try {
            // Ambil data mahasiswa berdasarkan email
            $user = Auth::user();
            $mahasiswa = Mahasiswa::where('email', $user->email)->first();
            $jadwal = Jadwal::all();

            // Validasi request (pastikan semua field ada)
            $request->validate([
                'kodemk' => 'required',
                'namamk' => 'required',
                'semester' => 'required|integer',
                'kelas' => 'required',
                'sks' => 'required|integer',
                'mulai' => 'required|date_format:H:i', 
                'selesai' => 'required|date_format:H:i', 
                'hari' => 'required|string', 
            ]);


            // Simpan data ke tabel IRS tanpa kolom tahun_akademik
            $irs = new IRS([
                'nim' => $mahasiswa->nim, 
                'nama' => $mahasiswa->nama, 
                'jurusan' => $mahasiswa->jurusan,
                'semester' => $request->semester,
                'kodemk' => $request->kodemk, 
                'namamk' => $request->namamk,
                'kelas' => $request->kelas,
                'sks' => $request->sks,
                'mulai' => $request->mulai,
                'selesai' => $request->selesai,
                'hari' => $request->hari,
                'status' => 'pending',
                'tanggal_pengajuan' => now(),
                'tanggal_persetujuan' => null,
            ]);

            
            // Ambil informasi jadwal berdasarkan kode MK dan kelas
            $jadwal = DB::table('jadwal')
            ->where('kodemk', $request->kodemk)
            ->where('kelas', $request->kelas)
            ->first();

            if (!$jadwal) {
                return redirect()->back()->withErrors(['message' => 'Jadwal tidak ditemukan.']);
            }

            // Cek Duplikasi Mata Kuliah
            $existingMK = IRS::where('nim', $mahasiswa->nim)
            ->where('kodemk', $request->kodemk)
            ->where('semester', $request->semester)
            ->first();

            if ($existingMK) {
                return redirect()->back()->withErrors(['message' => 'Mata kuliah ini sudah diambil.']);
            }

            // Cek Jadwal Bentrok
            $bentrok = IRS::where('nim', $mahasiswa->nim)
            ->where('semester', $request->semester)
            ->whereHas('jadwal', function ($query) use ($jadwal) {
                $query->where('hari', $jadwal->hari)
                    ->whereTime('mulai', '<', $jadwal->selesai)
                    ->whereTime('selesai', '>', $jadwal->mulai);
            })->first();

            if ($bentrok) {
                return redirect()->back()->withErrors(['message' => 'Jadwal mata kuliah bentrok dengan mata kuliah lain.']);
            }

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

    public function daftarMhs(){
        $mahasiswa = Mahasiswa::with('irs')->get();
        return view('pembimbingakademik.halamanrevie', compact('mahasiswa'));
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
            return redirect()->back()->with('success', 'Mata Kuliah berhasil dihapus.');
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus mata kuliah' . $e->getMessage(),
            ], 500);
        }
    }

}