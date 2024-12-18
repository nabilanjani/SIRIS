<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Models\MataKuliah;
use Illuminate\Support\Facades\DB;
use App\Models\Jadwal;

// Jika ada model untuk jadwal, impor juga:

class JadwalController extends Controller
{
    public function creatematkul(Request $request)
        {
        // Ambil data mata kuliah untuk dropdown
        $mata_kuliah = MataKuliah::select('kodemk', 'namamk')->get();
      
        return view('kaprodi.buatjadwalbaru', compact('mata_kuliah'));
        }

    // Daftar prodi yang tetap
    protected $prodi = [
        'Informatika', 
        'Biologi', 
        'Matematika', 
        'Statistika', 
        'Kimia', 
        'Fisika', 
        'Bioteknologi'
    ];
    
    // Menampilkan halaman jadwal dengan semua data jadwal
    public function index()
    {
        // Ambil semua data dari tabel jadwal
        $jadwal = DB::table('jadwal')->get();
        
        // Kirim data ke view
        return view('kaprodi.lihatjadwal', compact('jadwal'));
    }
    

    // Mendapatkan jadwal berdasarkan prodi
    public function jadwal($namaProdi)
    {
        // Validasi prodi
        if (!in_array($namaProdi, $this->prodi)) {
            return response()->json([
                'error' => 'Prodi tidak valid'
            ], 400);
        }

        // Ambil jadwal dari database berdasarkan prodi
        $jadwal = DB::table('jadwal')
            ->where('prodi', $namaProdi)
            ->get();

        return response()->json($jadwal);
    }

    public function createdosen(Request $request)
    {
        // Ambil data prodi untuk dropdown
        $dosen = DB::table('dosen')->select('nip', 'nama')->get();
        
        // Debug: Check if data is retrieved
        dd($dosen); // This will dump and die, showing you the data
    
        return view('kaprodi.buatjadwalbaru', compact('dosen'));
    }

    public function createruang(Request $request)
        {
    
        // Ambil data prodi untuk dropdown
        $ruang_kuliah = DB::table('ruang_kuliah')->select('kode_ruang', 'kapasitas')->get();

        return view('kaprodi.buatjadwalbaru', compact('ruang_kuliah'));
        }

    public function createjadwal()
    {
        $mata_kuliah = DB::table('mata_kuliah')->select('kodemk', 'namamk')->get();
        $dosen = DB::table('dosen')->select('nip', 'nama')->get();
        $ruang_kuliah = DB::table('ruang_kuliah')->select('kode_ruang', 'kapasitas')->get();
    
        return view('kaprodi.buatjadwalbaru', [
            'mata_kuliah' => $mata_kuliah,
            'dosen' => $dosen,
            'ruang_kuliah' => $ruang_kuliah
        ]);
    }

 // Tambahkan di atas jika belum ada

 public function store(Request $request)
 {
     try {
         // Validasi data
         $validated = $request->validate([
            'prodi' => 'required|string',
             'namamk' => 'required',
             'jenis_mata_kuliah' => 'required',
             'jenis_pertemuan' => 'required',
             'jenis_kelas' => 'required',
             'kelas' => 'required',
             'sks' => 'required|integer',
             'semester' => 'required|integer',
             'ruang_kuliah' => 'required',
             'dosen_pengampu' => 'required',
             'koordinator' => 'nullable',
             'hari' => 'required',
             'mulai' => 'required',
             'selesai' => 'required|after:mulai',
             'kuota' => 'required|integer',
             'kurikulum' => 'required',
             'status' => 'nullable|integer|in:0,1,2'
         ]);

         $validated['status'] = $validated['status'] ?? 0;

         $isConflict = Jadwal::where('hari', $validated['hari'])
         ->where('ruang_kuliah', $validated['ruang_kuliah'])
         ->where(function ($query) use ($validated) {
             $query->whereBetween('mulai', [$validated['mulai'], $validated['selesai']])
                   ->orWhereBetween('selesai', [$validated['mulai'], $validated['selesai']])
                   ->orWhere(function ($query) use ($validated) {
                       $query->where('mulai', '<=', $validated['mulai'])
                             ->where('selesai', '>=', $validated['selesai']);
                   });
          })
          ->exists();
      
        if ($isConflict) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, jadwal bertabrakan dengan jadwal yang sudah ada.'
            ], 400);
        }

         // Cari nama dosen berdasarkan NIP
        $dosen = \App\Models\Dosen::where('nip', $validated['dosen_pengampu'])->first();
        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen tidak ditemukan.',
            ], 404);
        }

        $dosen = \App\Models\Dosen::where('nip', $validated['koordinator'])->first();
        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen tidak ditemukan.',
            ], 404);
        }

        $mata_kuliah = \App\Models\MataKuliah::where('kodemk', $validated['namamk'])->first();
        if (!$mata_kuliah) {
            return response()->json([
                'success' => false,
                'message' => 'Mata kuliah tidak ditemukan.',
            ], 404);
        }
 
         // Simpan ke database
         Jadwal::create([
             'prodi' => $validated['prodi'],
             'namamk' => $mata_kuliah->namamk,
             'jenis_mata_kuliah' => $validated['jenis_mata_kuliah'],
             'jenis_pertemuan' => $validated['jenis_pertemuan'],
             'jenis_kelas' => $validated['jenis_kelas'],
             'kelas' => $validated['kelas'],
             'sks' => $validated['sks'],
             'semester' => $validated['semester'],
             'ruang_kuliah' => $validated['ruang_kuliah'],
             'dosen_pengampu' => $dosen->nama,
             'koordinator' => $dosen->nama,
             'hari' => $validated['hari'],
             'mulai' => $validated['mulai'],
             'selesai' => $validated['selesai'],
             'kuota' => $validated['kuota'],
             'kurikulum' => $validated['kurikulum'],
         ]);
 

         $jadwals = Jadwal::where('prodi', $validated['prodi'])->get();

         // Ambil jadwal terbaru
         $jadwals = Jadwal::where('hari', $validated['hari'])->get();

         return response()->json([
             'success' => true,
             'message' => 'Jadwal berhasil ditambahkan!',
             'jadwals' => $jadwals,
         ], 200);
     } catch (\Exception $e) {
         Log::error('Error saat menyimpan data: ' . $e->getMessage());
 
         return response()->json([
             'success' => false,
             'message' => 'Terjadi kesalahan: ' . $e->getMessage()
         ], 500);
     }
 }

}