<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RuangModel;

class RuangController extends Controller
{
    //method untuk tampil data ruang
    public function ruangtampil()
    {
        $ruang_kuliah = RuangModel::orderby('kode_ruang', 'ASC')
        ->paginate(5);

        
        return view('bagianakademik/aturruang',['ruang_kuliah'=>$ruang_kuliah]);
    }

    //method untuk tambah data ruang
    public function tambahruang(Request $request)
    {
        $request->validate([
            'kode_ruang' => 'required',
            'jenis_ruang' => 'required',
            'kapasitas' => 'required|numeric'
        ]);

        

        RuangModel::create([
            'kode_ruang' => $request->kode_ruang,
            'jenis_ruang' => $request->jenis_ruang,
            'kapasitas' => $request->kapasitas
        ]);

        return redirect('bagianakademik/aturruang')->with('success', 'Data berhasil ditambahkan!');
    }

    public function getData()
    {
        $ruang_kuliah = RuangModel::orderby('kode_ruang', 'ASC')->get();
            return response()->json($ruang_kuliah);
    }


     //method untuk hapus data ruang
     public function hapusruang($kode_ruang)
    {
        $ruang = RuangModel::where('kode_ruang', $kode_ruang)->first();

        if ($ruang) {
            $ruang->delete(); // Hapus data dari database
            return redirect('bagianakademik/aturruang')->with('success', 'Data berhasil dihapus!');
        }

        return redirect('bagianakademik/aturruang')->with('error', 'Data tidak ditemukan.');
    }

     

     //method untuk edit data ruang
    public function editruang($kode_ruang, Request $request)
    {
        $request->validate([
            'kode_ruang' => 'required',
            'jenis_ruang' => 'required',
            'kapasitas' => 'required|numeric',
        ]);

        // Cari data berdasarkan kode_ruang
        $ruang_kuliah = RuangModel::where('kode_ruang', $kode_ruang)->first();
        if (!$ruang_kuliah) {
            return redirect()->back()->with('error', 'Data ruangan tidak ditemukan.');
        }

        
        $ruang_kuliah->update([
            'kode_ruang' => $request->kode_ruang,
            'jenis_ruang' => $request->jenis_ruang,
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect('bagianakademik/aturruang')->with('success', 'Ruangan berhasil diperbarui!');
    
    }
        public function cariruang(Request $request)
    {
        $search = $request->input('search'); // Ambil query dari input pencarian

        $ruang_kuliah = RuangModel::where('kode_ruang', 'LIKE', "%{$search}%")
            ->orWhere('jenis_ruang', 'LIKE', "%{$search}%")
            ->orWhere('kapasitas', 'LIKE', "%{$search}%")
            ->paginate(5);

        return view('bagianakademik/aturruang', ['ruang_kuliah' => $ruang_kuliah]);
    }

}
