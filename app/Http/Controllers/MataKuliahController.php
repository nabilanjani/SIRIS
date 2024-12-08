<?php 
 
namespace App\Http\Controllers; 
 
use App\Models\MataKuliah; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB; 
 
class MataKuliahController extends Controller 
{ 
    public function index() 
    { 
        $mata_kuliah = DB::table('mata_kuliah')->select('kodemk', 'nama', 'sks', 'semester')->get(); 
     
        return view('kaprodi.kelolamatkul', [ 
            'mata_kuliah' => $mata_kuliah, 
        ]); 
    } 
 
    public function create() 
    { 
        $mata_kuliah = DB::table('mata_kuliah')->select('kodemk', 'nama', 'sks', 'semester')->get(); 
        return view('kaprodi.kelolamatkul', [
            'mata_kuliah' => $mata_kuliah
        ]); 
    } 
 
    public function store(Request $request)
{
    // Validasi input dari form
    $validatedData = $request->validate([
        'kodeProdi' => 'required|string',
        'kodemkText' => 'required|string',
        'nama' => 'required|string',
        'sks' => 'required|integer',
        'semester' => 'required|string',
    ]);

    // Gabungkan kodeProdi dan kodemkText untuk mendapatkan kodemk
    $kodemk = $validatedData['kodeProdi'] . $validatedData['kodemkText'];

    // Menyimpan data ke dalam database
    $mataKuliah = new MataKuliah();
    $mataKuliah->kodemk = $kodemk;  // Menyimpan gabungan kodeProdi dan kodemkText sebagai kodemk
    $mataKuliah->nama = $validatedData['nama'];
    $mataKuliah->sks = $validatedData['sks'];
    $mataKuliah->semester = $validatedData['semester'];

    // Simpan ke database
    $mataKuliah->save();

    // Redirect atau respons setelah berhasil
    return redirect()->route('kaprodi.kelolamatkul.index')->with('success', 'Mata kuliah berhasil disimpan!');
}


 
    public function edit($id) 
    { 
        $mataKuliah = MataKuliah::findOrFail($id); 
        $mata_kuliah = DB::table('mata_kuliah')->select('kodemk', 'nama', 'sks', 'semester')->get(); 
        return view('kaprodi.kelolamatkul', compact('mataKuliah', 'mata_kuliah')); 
    } 
 
    public function update(Request $request, $kodemk)
{
    try {
        // Manually validate the incoming request data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
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
}