<?php

namespace App\Http\Controllers;

use App\Models\DekanJadwalModel;
use App\Models\Jadwal;
use App\Models\prodi;
use Illuminate\Http\Request;

class DekanJadwalController extends Controller
{
    public function index()
    {
        $jadwals = DekanJadwalModel::with('prodi')->get();
        return view('dekan.persetujuanjadwal', compact('jadwals'));
    }

    public function lihatJadwal($idProdi)
    {
        Log::info('Mencari jadwal untuk prodi: ' . $idProdi);
        
        try {
            $jadwal = LihatJadwal::where('prodi', $idProdi)
                ->get();

            Log::info('Jumlah jadwal ditemukan: ' . $jadwal->count());

            if ($jadwal->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada jadwal ditemukan untuk prodi ini'
                ]);
            }

            $formattedJadwal = $jadwal->map(function($item) {
                return [
                    'mata_kuliah' => $item->mata_kuliah ?? 'Tidak tersedia',
                    'dosen_pengampu' => $item->dosen_pengampu ?? 'Tidak tersedia',
                    'hari' => $item->hari ?? 'Tidak tersedia',
                    'mulai' => $item->mulai ?? 'Tidak tersedia',
                    'selesai' => $item->selesai ?? 'Tidak tersedia',
                    'ruang_kuliah' => $item->ruang_kuliah ?? 'Tidak tersedia'
                ];
            });

            return response()->json([
                'success' => true,
                'jadwal' => $formattedJadwal
            ]);

        } catch (\Exception $e) {
            Log::error('Kesalahan saat mengambil jadwal: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request, $id)
{
    try {
        // Validate request
        $request->validate([
            'status' => 'required|in:0,1'
        ]);

        // Find and update the record
        $jadwal = DekanJadwalModel::findOrFail($id);
        $jadwal->status = $request->status;
        $jadwal->save();

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui',
            'status' => $request->status,
            'statusText' => $request->status == 1 ? 'Disetujui' : 'Menunggu'
        ]);
    } catch (\Exception $e) {
        \Log::error('Error updating status: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Gagal memperbarui status: ' . $e->getMessage()
        ], 500);
    }
}
}