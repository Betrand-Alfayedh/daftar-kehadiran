<?php

use App\Http\Controllers\AbsensiMahasiswaController;
use App\Http\Controllers\DosenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\RoleAdmin;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', RoleAdmin::class])->group(function () {
    Route::resource('kelas', KelasController::class);
   
    Route::resource('dosen', DosenController::class);

    Route::resource('matkul', MatkulController::class);
});

Route::get('/absensi/preview/{id_kelas}', [AbsensiMahasiswaController::class, 'preview'])->name('absensi.preview');
 Route::resource('absensi', AbsensiMahasiswaController::class);
    Route::resource('mahasiswa', MahasiswaController::class);



Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
// Register
Route::get('/register', [AuthController::class, 'formRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
