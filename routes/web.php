<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    Route::get('mahasiswa/dashboard', [HomeController::class, 'mahasiswaDashboard'])->name('mahasiswa.dashboard');

    // HER Registrasi
    Route::get('mahasiswa/herreg', function () {
        return view('mahasiswa.herreg');
    })->name('mahasiswa.herreg');

    // Akademik
    Route::get('mahasiswa/akademik', function () {
        return view('mahasiswa.akademik');
    })->name('mahasiswa.akademik');

    // ISIIRS
    Route::get('mahasiswa/isiirs', function () {
        return view('mahasiswa.isiirs');
    })->name('mahasiswa.isiirs');

    //Route::post('irs/tambah', [IsiIRSController::class, 'buatIRS'])->name('irs.tambah');

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
Route::get('/bagianakademik/aturruang', function () {
    return view('/bagianakademik/aturruang');

});

//atur prodi
Route::get('/bagianakademik/aturprodi', function () {
    return view('/bagianakademik/aturprodi');

});

//kaprodi
Route::get('kaprodi/dashboard', [HomeController::class, 'kaprodiDashboard'])
    ->middleware(['auth', 'kaprodi'])
    ->name('kaprodi.dashboard');

// Pembimbing Akademik routes
    

require __DIR__.'/auth.php';