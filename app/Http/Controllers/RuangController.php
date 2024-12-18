<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RuangModel;
use App\Models\prodi;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class RuangController extends Controller
{
    //method untuk tampil data ruang
    public function ruangtampil()
    {
        // Menggunakan eager loading untuk relasi program_studi
        $ruang_kuliah = RuangModel::with(['programStudi' => function($query) {
            $query->select('id_prodi', 'nama_prodi'); // Ambil id_prodi dan nama_prodi
        }])
        ->orderby('kode_ruang', 'ASC')
        ->paginate(50);        

        // Mengambil semua data program studi untuk dropdown
        $prodi = prodi::all(); // Menggunakan model Prodi

        return view('bagianakademik/aturruang', compact('ruang_kuliah', 'prodi'));
    }

    public function tambahruang(Request $request)
{
    // Debugging: Menampilkan seluruh data yang dikirimkan
        // dd($request->all());

    // Validasi data
    $request->validate([
        'kode_ruang' => 'required',
        'kapasitas' => 'required|numeric',
        'id_prodi' => 'required|exists:program_studi,id_prodi',
    ]);

    // Menambahkan data ke database
    $ruang = RuangModel::create([
        'kode_ruang' => $request->kode_ruang,
        'kapasitas' => $request->kapasitas,
        'id_prodi' => $request->id_prodi,
        'status' => 0
    ]);

    // // Cek apakah data berhasil disimpan
    // if ($ruang) {
    //     Log::info('Data berhasil disimpan: ', $ruang->toArray());
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Ruang berhasil ditambahkan!'
    //     ], 200);
    // } else {
    //     Log::error('Data gagal disimpan!');
    //     return response()->json([
    //         'success' => false,
    //         'message' => 'Gagal menambahkan ruang'
    //     ], 500);
    // }
    return redirect('bagianakademik/aturruang')
            ->with('success', 'Ruangan berhasil ditambah!');
}



public function getData()
    {
        $ruang_kuliah = RuangModel::orderby('kode_ruang', 'ASC')->get();
            return response()->json($ruang_kuliah);
    }


     //method untuk hapus data ruang
//      public function hapusruang($kode_ruang)
// {
//     $ruang = RuangModel::find($kode_ruang);

//     if ($ruang) {
//         $ruang->delete();
//         return redirect('bagianakademik/aturruang')->with('success', 'Data berhasil dihapus!');
//     }

//     return redirect('bagianakademik/aturruang')->with('error', 'Data tidak ditemukan.');
// }

     
     //method untuk edit data ruang
    //  public function editruang($kode_ruang, Request $request)
    //  {
    //      $request->validate([
    //         'kode_ruang' => 'required',
    //          'kapasitas' => 'required|numeric',
    //          'program_studi' => 'required',
    //          'status' => 'required',
    //         'id_prodi' => 'required',
    //      ]);
     
    //      // Cari data berdasarkan id_ruang
    //      $ruang_kuliah = RuangModel::find($kode_ruang);

     
    //      if (!$ruang_kuliah) {
    //          return redirect()->back()->with('error', 'Data ruangan tidak ditemukan.');
    //      }

    //      // Cek apakah kode_ruang yang baru sudah ada di database
    //         $existingRuang = RuangModel::where('kode_ruang', $request->kode_ruang)
    //          // Pastikan tidak membandingkan dengan ruang yang sedang diedit
    //         ->exists();

    //     if ($existingRuang) {
    //     return redirect()->back()->with('error', 'Kode ruang sudah terdaftar! Silakan pilih kode yang lain.');
    //     }
     
    //     //  $ruang_kuliah->update([
    //     //     'kode_ruang' => $request->kode_ruang,
    //     //      'kapasitas' => $request->kapasitas,
    //     //      'program_studi' => $request->program_studi,
    //     //      'status'  => $request->status,
    //     //     'id_prodi' => $request->program_studi,
    //     //  ]);
    //     $ruang_kuliah->update([
    //         'kode_ruang' => $request->kode_ruang,
    //         'kapasitas' => $request->kapasitas,
    //         'status'  => $request->status,
    //         'id_prodi' => $request->id_prodi,  // Pastikan 'id_prodi' yang digunakan di sini
    //     ]);
        
        

    //      return redirect('bagianakademik/aturruang')
    //         ->with('success', 'Ruangan berhasil diperbarui!');
        
    
    // }


    public function editruang($kode_ruang, Request $request)
{
    try {
        // Validasi input
        $validated = $request->validate([
            'kapasitas' => 'required|numeric',
            'id_prodi' => 'required|exists:program_studi,id_prodi',
        ]);

        // Cari ruang yang akan diupdate
        $ruang_kuliah = RuangModel::findOrFail($kode_ruang);

        // Update data
        $ruang_kuliah->update([
            'kapasitas' => $validated['kapasitas'],
            'id_prodi' => $validated['id_prodi'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ruangan berhasil diperbarui!'
        ]);

    } catch (\Exception $e) {
        \Log::error('Error updating ruang: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Gagal memperbarui ruangan: ' . $e->getMessage()
        ], 500);
    }
}

    // public function editruang($kode_ruang, Request $request)
    // {
    //     // Validasi data yang diterima dari form
    //     $request->validate([
    //         'kode_ruang' => 'required',
    //         'kapasitas' => 'required|numeric',
    //         'program_studi' => 'required',
    //     ]);

    //     // Mencari data ruang berdasarkan kode_ruang
    //     $ruang_kuliah = RuangModel::find($kode_ruang);

    //     if (!$ruang_kuliah) {
    //         return redirect()->back()->with('error', 'Data ruangan tidak ditemukan.');
    //     }

    //     // Mengupdate data ruangan
    //     $ruang_kuliah->update([
    //         'kode_ruang' => $request->kode_ruang,
    //         'kapasitas' => $request->kapasitas,
    //         'id_prodi' => $request->program_studi,
    //     ]);

    //     return redirect('bagianakademik/aturruang')->with('success', 'Ruangan berhasil diperbarui!');
    // }

     
    //     public function cariruang(Request $request)
    // {
    //     $search = $request->input('search'); // Ambil query dari input pencarian

    //     // $ruang_kuliah = RuangModel::where('kode_ruang', 'LIKE', "%{$search}%")
    //     // ->orWhere('kode_ruang', 'LIKE', "%{$search}%")
    //     //     ->orWhere('kapasitas', 'LIKE', "%{$search}%")
    //     //     ->orWhere('program_studi', 'LIKE', "%{$search}%")
    //     //     ->paginate(5);
    //     $ruang_kuliah = RuangModel::where('kode_ruang', 'LIKE', "%{$search}%")
    //     ->orWhere('kapasitas', 'LIKE', "%{$search}%")
    //     ->orWhereHas('programStudi', function($query) use ($search) {
    //         $query->where('nama_prodi', 'LIKE', "%{$search}%");
    //         })
    //     ->paginate(5);


    //         $program_studi = \App\Models\prodi::all();

    //     return view('bagianakademik/aturruang', ['ruang_kuliah' => $ruang_kuliah]);
    // }

        //method untuk tambah data ruang
    // public function tambahruang(Request $request)
    // {
        
    //     $request->validate([
    //         'kode_ruang' => 'required',
    //         'kapasitas' => 'required|numeric',
    //         'id_prodi' => 'required|exists:program_studi,id_prodi',
    //     ]);

    //     // Cek apakah kode_ruang sudah ada di database
    //     $existingRuang = RuangModel::where('kode_ruang', $request->kode_ruang)->first();

    //     if ($existingRuang) {
    //         // Jika ada, tampilkan alert bahwa ruangan sudah ada
    //         return redirect('bagianakademik/aturruang')->with('error', 'Kode ruang sudah tersedia!');
    //     }

    //     RuangModel::create([
    //         'kode_ruang' => $request->kode_ruang,
    //         'kapasitas' => $request->kapasitas,
    //         'id_prodi' => $request->id_prodi,
    //         'status' => 0
    //     ]);

    //     // Ambil semua data program studi
    //     $program_studi = \App\Models\prodi::all();
    //     $ruang_kuliah = \App\Models\RuangModel::all();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Ruang berhasil ditambahkan!'
    //     ], 200);
    // }

    public function hapusRuang($kode_ruang)
{
    \Log::info('Attempting to delete ruang with kode: ' . $kode_ruang);
    
    try {
        $ruang = RuangModel::where('kode_ruang', $kode_ruang)->first();
        
        if (!$ruang) {
            \Log::warning('Ruang not found with kode: ' . $kode_ruang);
            return response()->json([
                'success' => false,
                'message' => 'Ruang tidak ditemukan'
            ], 404);
        }

        DB::beginTransaction();
        try {
            $ruang->delete();
            DB::commit();
            
            \Log::info('Successfully deleted ruang with kode: ' . $kode_ruang);
            return response()->json([
                'success' => true,
                'message' => 'Data ruang berhasil dihapus'
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

    } catch (\Exception $e) {
        \Log::error('Failed to delete ruang: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus data: ' . $e->getMessage()
        ], 500);
    }
}
    



}