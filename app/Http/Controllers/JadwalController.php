<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
// Jika ada model untuk jadwal, impor juga:
use App\Models\Jadwal;

class JadwalController extends Controller
{
    /**
     * Menampilkan form untuk membuat jadwal baru.
     */
    public function create()
    {
        // Ambil semua data mata kuliah
        $mata_kuliah = MataKuliah::all();
        //dd($mata_kuliah);

        // Kirim data ke view 'kaprodi.buatjadwalbaru'
        return view('kaprodi.buatjadwalbaru', compact('kodemk'));
    }



    /**
     * Menyimpan data jadwal baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'mata_kuliah' => 'required',
            'jenis_mata_kuliah' => 'required',
            'jenis_pertemuan' => 'required',
            'jenis_kelas' => 'required',
            'kelas' => 'required',
            'sks' => 'required|integer',
            'semester' => 'required',
            'ruang_kuliah' => 'required',
            'dosen_pengampu' => 'required',
            'koordinator' => 'required',
            'mulai' => 'required|date_format:H:i',
            'selesai' => 'required|date_format:H:i|after:mulai',
            'kuota' => 'required|integer',
            'kurikulum' => 'required',
        ]);

        // Simpan data ke database (pastikan model Jadwal ada)
        // Contoh jika menggunakan model Jadwal:
        // Jadwal::create($validated);

        // Redirect kembali ke halaman create jadwal dengan pesan sukses
        return redirect()->route('createjadwal')->with('success', 'Jadwal berhasil ditambahkan!');
    }
}