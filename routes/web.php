<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PembimbingAkademikController;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/register', function () {
    return view('auth/register');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
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
});

//dekan
Route::get('dekan/dashboard', [HomeController::class, 'dekanDashboard'])
    ->middleware(['auth', 'dekan'])
    ->name('dekan.dashboard');

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

//kaprodi
Route::get('kaprodi/dashboard', [HomeController::class, 'kaprodiDashboard'])
    ->middleware(['auth', 'kaprodi'])
    ->name('kaprodi.dashboard');

// Pembimbing Akademik routes
    Route::prefix('pembimbingakademik')->group(function () {
    Route::get('/dashboard', [PembimbingAkademikController::class, 'dashboard'])
        ->name('pembimbingakademik.dashboard');

    Route::get('/perwalian', [PembimbingAkademikController::class, 'perwalian'])
        ->name('pembimbingakademik.perwalian');
    
    Route::get('/halamanrevie', [PembimbingAkademikController::class, 'halamanRevie'])
        ->name('pembimbingakademik.halamanrevie');
    
    Route::get('/halamanirsmhs', [PembimbingAkademikController::class, 'halamanIrsMhs'])
        ->name('pembimbingakademik.halamanirsmhs');
    
    Route::get('/halamankhsmhs', [PembimbingAkademikController::class, 'halamanKhsMhs'])
        ->name('pembimbingakademik.halamankhsmhs');
    
    Route::get('/halamantranskripmhs', [PembimbingAkademikController::class, 'halamanTranskripMhs'])
        ->name('pembimbingakademik.halamantranskripmhs');
    
    Route::get('/perwalian/{user}', [PembimbingAkademikController::class, 'detailPerwalian'])
        ->name('pembimbingakademik.perwalian.detail');
});

require __DIR__.'/auth.php';