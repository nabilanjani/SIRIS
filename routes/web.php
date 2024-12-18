<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\PembimbingAkademikController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;


Route::get('/', function () {
    return view('auth/login');
});

Route::get('/register', function () {
    return view('auth/register');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//mahasiswa
Route::middleware(['auth', 'mahasiswa'])->group(function () {
    // Mahasiswa Dashboard
    Route::get('mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');

    // Her-Registrasi
    Route::get('mahasiswa/herreg', [MahasiswaController::class, 'herreg'])->name('mahasiswa.herreg');
    Route::post('/herreg/setAktif/{nim}', [MahasiswaController::class, 'setAktif'])->name('herreg.setAktif');
    Route::post('/herreg/setCuti/{nim}', [MahasiswaController::class, 'setCuti'])->name('herreg.setCuti');
    Route::post('/herreg/batalkan/{nim}', [MahasiswaController::class, 'batalkan'])->name('herreg.batalkan');

    // Akademik
    Route::get('mahasiswa/akademik', function () {
        return view('mahasiswa.akademik');
    })->name('mahasiswa.akademik');

    Route::get('mahasiswa/irs', [MahasiswaController::class, 'index'])->name('irs.index');
    Route::post('/irs/store', [MahasiswaController::class, 'store'])->name('irs.store');
    Route::delete('/irs/delete', [MahasiswaController::class, 'delete'])->name('irs.delete');
    Route::get('mahasiswa/cetak', [MahasiswaController::class, 'cetak'])->name('mahasiswa.cetak');
    Route::get('/mahasiswa/cetakpdf', [MahasiswaController::class, 'cetakPdf'])->name('mahasiswa.cetakpdf');


});

//dekan
//Dekan
Route::get('dekan/dashboard', [HomeController::class, 'dekanDashboard'])
    ->middleware(['auth', 'dekan'])
    ->name('dekan.dashboard');


//Perkuliahan
Route::get('dekan/perkuliahan', function () {
    return view('dekan/perkuliahan'); 

});
Route::prefix('dekan')->group(function () {
    Route::get('/ruangkelas', [SetujuRuangController::class, 'ruangTampil'])->name('ruang.tampil');
    Route::get('/filter-ruang', [SetujuRuangController::class, 'showRuangByProdi'])->name('filter.ruang');
    Route::post('/ruangkelas/update/{id}', [SetujuRuangController::class, 'updateStatus'])->name('ruang.update.status');
    Route::post('/ruangkelas/updateAllStatus', [SetujuRuangController::class, 'updateAllStatus'])->name('ruang.updateAll');
    Route::post('/dekan/ruangkelas/cancelAllStatus', [SetujuRuangController::class, 'cancelAllStatus'])->name('ruang.cancel');
});


//persetujuan jadwal

Route::prefix('dekan')->group(function () {
    Route::get('/persetujuanjadwal', [DekanJadwalController::class, 'index'])->name('dekan.jadwal.index');
    Route::get('/jadwal/lihat/{id_prodi}', [DekanJadwalController::class, 'lihatJadwal'])->name('lihatJadwal');
    Route::post('/jadwal/status/{id}', [DekanJadwalController::class, 'updateStatus'])->name('dekan.jadwal.status');
    

});

//Lihat jadwal
Route::prefix('dekan')->group(function () {
    Route::get('/dekan/jadwal/lihat/{id_prodi}', [LihatJadwalController::class, 'lihatJadwalByProdi'])->name('dekan.lihatjadwal.prodi');
    Route::post('/lihat-jadwal/filter', [LihatJadwalController::class, 'filterByProdi'])->name('dekan.lihatjadwal.filter');
});

//Bagian Akademik
Route::get('bagianakademik/dashboard', [HomeController::class, 'bagianakademikDashboard'])
->middleware(['auth', 'bagianakademik'])
->name('bagianakademik.dashboard');

//Perkuliahan
Route::get('bagianakademik/perkuliahanba', function () {
    return view('bagianakademik/perkuliahanba'); 
});

// =============================
// ATUR RUANG

// Untuk menampilkan data ruang
Route::get('/bagianakademik/aturruang', [RuangController::class, 'ruangtampil']);

// Untuk menambah ruang
Route::post('/ruang/tambah', [RuangController::class, 'tambahruang'])->name('ruang.tambah');

// Untuk mengambil data ruang
Route::get('/ruang/data', [RuangController::class, 'getData'])->name('ruang.data');

// Untuk menghapus ruang
Route::delete('/ruang/hapus/{kode_ruang}', [RuangController::class, 'hapusRuang'])->name('ruang.hapus');


// Untuk mengedit ruang
// Menyimpan route yang benar
Route::put('/ruang/edit/{kode_ruang}', [RuangController::class, 'editruang'])->name('ruang.edit');

// Untuk pencarian ruang
Route::get('/ruang/cari', [RuangController::class, 'cariruang'])->name('ruang.cari');

// =============================
 

//atur ruang


//kaprodi yg udah bener
    

Route::get('kaprodi/perkuliahan', function () {
    return view('kaprodi/perkuliahan');
});

Route::get('kaprodi/jadwal', function () {
    return view('kaprodi/jadwal');
});

Route::get('kaprodi/pilihprodi', function () {
    return view('kaprodi/pilihprodi');
});


Route::get('kaprodi/lihatjadwal', [JadwalController::class, 'index'])->name('jadwal.index');

// Route::get('kaprodi/buatjadwalbaru', [JadwalController::class, 'tampilkan'])->name('jadwal.tampilkan');
    

Route::get('kaprodi/buatjadwalbaru', function () {
    return view('kaprodi/buatjadwalbaru');
});

Route::get('kaprodi/kelolamatkul', function () {
    return view('kaprodi/kelolamatkul');
});

Route::get('/prodi/{namaProdi}/jadwal', [JadwalController::class, 'jadwal']);

//Route::get('/prodi/{prodi}/jadwal', [JadwalController::class, 'getJadwal'])->name('jadwal.get');

Route::get('kaprodi/dashboard', [HomeController::class, 'kaprodiDashboard'])
    ->middleware(['auth', 'kaprodi'])
    ->name('kaprodi.dashboard');

Route::get('/kaprodi/buatjadwalbaru', [JadwalController::class, 'createjadwal'])
->name('kaprodi.buatjadwalbaru');

Route::post('/kaprodi/buatjadwalbaru/store', [JadwalController::class, 'store'])
    ->name('kaprodi.buatjadwalbaru.store');

Route::get('/kaprodi/kelolamatkul', [MataKuliahController::class, 'create'])
    ->name('kaprodi.kelolamatkul');

Route::post('/kaprodi/kelolamatkul/store', [MataKuliahController::class, 'store'])
    ->name('kaprodi.kelolamatkul.store');

Route::get('kaprodi/kelolamatkul/edit/{kodemk}', [MataKuliahController::class, 'edit'])
    ->name('kaprodi.kelolamatkul.edit');

Route::post('kaprodi/kelolamatkul/update/{kodemk}', [MataKuliahController::class, 'update'])
->name('kaprodi.kelolamatkul.update');

Route::delete('/kaprodi/kelolamatkul/destroy/{kodemk}', [MataKuliahController::class, 'destroy'])
->name('kaprodi.kelolamatkul.destroy');

Route::get('/kaprodi/kelolamatkul/index', [MataKuliahController::class, 'index'])
->name('kaprodi.kelolamatkul.index');

Route::get('/kaprodi/kelolamatkul/get-table-data', [MataKuliahController::class, 'getTableData'])
->name('kaprodi.kelolamatkul.get-table-data');

//Route::resource('matkul', MataKuliahController::class);


//pa
Route::middleware(['auth', 'pembimbingakademik'])->group(function () {
    Route::get('/pembimbingakademik/dashboard', [PembimbingAkademikController::class, 'dashboard'])
        ->name('pembimbingakademik.dashboard');
    Route::get('/pembimbingakademik/perwalian', [PembimbingAkademikController::class, 'perwalian'])
        ->name('pembimbingakademik.perwalian');
    Route::get('/pembimbingakademik/halamanrevie', [PembimbingAkademikController::class, 'halamanrevie'])
        ->name('pembimbingakademik.halamanrevie');
    Route::get('/pembimbingakademik/halamanirsmhs/{nim}', [PembimbingAkademikController::class, 'halamanIrsMhs'])->name('halamanirsmhs');
    Route::post('/pembimbingakademik/approve-irs/{semester}', [PembimbingAkademikController::class, 'approveIrs'])
        ->name('pembimbingakademik.approveIrs');  
    Route::get('/reset-filter', [PembimbingAkademikController::class, 'resetFilter'])->name('pembimbingakademik.resetFilter');
});

require __DIR__.'/auth.php';