<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RuangModel;
use App\Models\prodi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SetujuRuangController extends Controller
{
    public function ruangTampil()
    {
        // Mengambil data ruang dengan eager loading prodi
        $ruang_kuliah = RuangModel::with('programStudi')
            ->orderBy('kode_ruang', 'ASC')
            ->get();
        
        // Mengambil semua program studi
        $prodi = Prodi::all();
        
        return view('dekan.ruangkelas', compact('ruang_kuliah', 'prodi'));
    }

    public function showRuangByProdi(Request $request)
{
    try {
        // Debug log untuk melihat ID yang diterima
        \Log::info('Request data:', $request->all());
\Log::info('Query result:', ['data' => $ruang_kuliah]);

        $ruang_kuliah = RuangModel::where('prodi', $request->prodi)
            ->with('programStudi') // pastikan nama relasi sesuai
            ->get();

        // Debug log untuk melihat hasil query
        \Log::info('Query result:', ['ruang_kuliah' => $ruang_kuliah]);

        return response()->json([
            'success' => true,
            'ruang_kuliah' => $ruang_kuliah
        ]);

    } catch (\Exception $e) {
        \Log::error('Error in showRuangByProdi: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Gagal memuat data ruangan: ' . $e->getMessage()
        ], 500);
    }
}

    public function updateAllStatus(Request $request)
{
    try {
        // Pastikan update dengan nilai status = 1 dan eksekusi query
        RuangModel::query()->uapdate([
            'status' => 1
        ]);

        // Log untuk memastikan update berhasil
        Log::info('All rooms status updated to 1');

        return response()->json([
            'success' => true,
            'message' => 'Semua ruangan berhasil disetujui'
        ]);
    } catch (\Exception $e) {
        Log::error('Error updating all status: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Gagal memperbarui status: ' . $e->getMessage()
        ], 500);
    }
}

public function cancelAllStatus()
{
    try {
        // Update semua status menjadi 0
        RuangModel::query()->update(['status' => 0]);
        
        // Debug log untuk memastikan fungsi dipanggil
        \Log::info('Cancel all status executed');
        
        return response()->json([
            'success' => true,
            'message' => 'Semua status berhasil direset'
        ]);
    } catch (\Exception $e) {
        \Log::error('Error in cancelAllStatus: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
}