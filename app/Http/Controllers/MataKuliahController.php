<?php 
 
namespace App\Http\Controllers; 
 
use App\Models\MataKuliah; 
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB; 
 
class MataKuliahController extends Controller 
{ 
    public function index() 
    { 
        $mata_kuliah = DB::table('mata_kuliah')->select('kodemk', 'namamk', 'sks', 'semester')->get(); 
     
        return view('kaprodi.kelolamatkul', [ 
            'mata_kuliah' => $mata_kuliah, 
        ]); 
    } 
 
    public function create() 
    { 
        $mata_kuliah = DB::table('mata_kuliah')->select('kodemk', 'namamk', 'sks', 'semester')->get(); 
        return view('kaprodi.kelolamatkul', [
            'mata_kuliah' => $mata_kuliah
        ]); 
    } 
 
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'kodeProdi' => 'required|string',
                'kodemkText' => 'required|string',
                'namamk' => 'required|string',
                'sks' => 'required|integer',
                'semester' => 'required|string',
            ]);
    
            // Membuat kode mata kuliah (kodemk)
            $kodemk = $validatedData['kodeProdi'] . $validatedData['kodemkText'];
    
            // Cek apakah kodemk sudah ada di database
            $existingMatkul = MataKuliah::where('kodemk', $kodemk)->first();
    
            if ($existingMatkul) {
                // Jika sudah ada, kembalikan respons error
                return response()->json([
                    'success' => false,
                    'message' => 'Mata kuliah dengan kode ' . $kodemk . ' sudah ada.'
                ], 409); // 409 Conflict status code
            }
    
            // Membuat instance MataKuliah baru dan menyimpan data
            $mataKuliah = new MataKuliah();
            $mataKuliah->kodemk = $kodemk;
            $mataKuliah->namamk = $validatedData['namamk'];
            $mataKuliah->sks = $validatedData['sks'];
            $mataKuliah->semester = $validatedData['semester'];
    
            // Simpan data ke database
            $mataKuliah->save();
    
            // Kembalikan respons sukses
            return response()->json([
                'success' => true,
                'message' => 'Mata kuliah berhasil disimpan!'
            ]);
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Mata Kuliah Store Error: ' . $e->getMessage());
    
            // Kembalikan respons error jika terjadi pengecualian
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan mata kuliah: ' . $e->getMessage()
            ], 500); // Internal Server Error
        }
    }
    


 
    public function edit($id) 
    { 
        $mataKuliah = MataKuliah::findOrFail($id); 
        $mata_kuliah = DB::table('mata_kuliah')->select('kodemk', 'namamk', 'sks', 'semester')->get(); 
        return view('kaprodi.kelolamatkul', compact('mataKuliah', 'mata_kuliah')); 
    } 
 
    public function update(Request $request, $kodemk)
{
    try {
        // Manually validate the incoming request data
        $validatedData = $request->validate([
            'namamk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1',
            'semester' => 'required|integer|min:1',
        ]);

        // Find the MataKuliah by kodeMK
        $mataKuliah = MataKuliah::findOrFail($kodemk);
        
        // Update the MataKuliah record with validated data
        $mataKuliah->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Mata Kuliah berhasil diupdate'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 400);
    }
}
 
    public function destroy($id) 
    { 
        try {
            MataKuliah::findOrFail($id)->delete(); 
            return redirect()->route('matkul.index')->with('success', 'Mata Kuliah berhasil dihapus!'); 
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus Mata Kuliah: ' . $e->getMessage());
        }
    } 

    public function getTableData()
{
    $mata_kuliah = MataKuliah::all(); // Sesuaikan dengan kondisi spesifik Anda
    $tableHtml = view('components.mata-kuliah-table', compact('mata_kuliah'))->render();
    
    return response()->json([
        'tableHtml' => $tableHtml
    ]);
}
}