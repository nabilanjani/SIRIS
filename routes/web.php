<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\PembimbingAkademikController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MahasiswaController;


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
Route::get('dekan/dashboard', [HomeController::class, 'dekanDashboard'])
    ->middleware(['auth', 'dekan'])
    ->name('dekan.dashboard');


    //Perkuliahan
    Route::get('dekan/perkuliahan', function () {
        return view('dekan/perkuliahan'); 

    });
        //ruangkelas
        Route::get('/dekan/ruangkelas', function () {
            return view('/dekan/ruangkelas');

        });

        //persetujuan jadwal
        Route::get('/dekan/persetujuanjadwal', function () {
            return view('/dekan/persetujuanjadwal');
});

Route::get('dekan/perkuliahan', function () {
    return view('dekan/perkuliahan');
    });

Route::get('dekan/jadwal', function () {
    return view('dekan/jadwal');
    });

Route::get('dekan/lihatjadwal', function () {
    return view('dekan/lihatjadwal');
    });

//bagian akademik
Route::get('bagianakademik/dashboard', [HomeController::class, 'bagianakademikDashboard'])
->middleware(['auth', 'bagianakademik'])
->name('bagianakademik.dashboard');

//Perkuliahan
Route::get('bagianakademik/perkuliahanba', function () {
    return view('bagianakademik/perkuliahanba'); 
});

//atur ruang
Route::get('/bagianakademik/aturruang', [RuangController::class, 'ruangtampil']);

Route::post('/ruang/tambah', [RuangController::class, 'tambahruang'])->name('ruang.tambah');
Route::get('/ruang/data', [RuangController::class, 'getData'])->name('ruang.data');
Route::delete('/ruang/hapus/{kode_ruang}', [RuangController::class, 'hapusruang'])->name('ruang.hapus');
Route::put('/ruang/edit/{kode_ruang}', [RuangController::class, 'editruang'])->name('ruang.edit');
Route::get('/ruang/cari', [RuangController::class, 'cariruang'])->name('ruang.cari');


//atur prodi
Route::get('/bagianakademik/aturprodi', function () {
    return view('/bagianakademik/aturprodi');

});

//kaprodi
Route::get('kaprodi/dashboard', [HomeController::class, 'kaprodiDashboard'])
    ->middleware(['auth', 'kaprodi'])
    ->name('kaprodi.dashboard');

    Route::get('kaprodi/perkuliahan', function () {
        return view('kaprodi/perkuliahan');
    });

Route::get('kaprodi/jadwal', function () {
    return view('kaprodi/jadwal');
});
    
Route::get('kaprodi/buatjadwalbaru', function () {
    return view('kaprodi/buatjadwalbaru');
});
    
Route::get('kaprodi/formjadwal', function () {
    return view('kaprodi/formjadwal');
});

Route::get('kaprodi/createjadwal', [JadwalController::class, 'create'])->name('createjadwal');

Route::post('kaprodi/storejadwal', [JadwalController::class, 'store'])->name('storejadwal');

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