<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;

// RUTE PUBLIC & LOGIN
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin']);
Route::get('/logout', [AuthController::class, 'logout']);


// RUTE SISWA (Digembok pakai Middleware CekSiswa)
Route::middleware([\App\Http\Middleware\CekSiswa::class])->group(function () {
    Route::get('/dashboard-siswa', function () {
        return view('siswa.dashboard');
    });
    Route::get('/aspirasi/tambah', [AspirasiController::class, 'create']);
    Route::post('/aspirasi/simpan', [AspirasiController::class, 'store']);
    Route::get('/history', [AspirasiController::class, 'history']);
});

// Route Hapus Aspirasi (Berdasarkan id_pelaporan)
Route::get('/aspirasi/hapus/{id}', [AspirasiController::class, 'destroy']);

// Route Hapus Data Siswa (Berdasarkan nis)
Route::get('/siswa/hapus/{nis}', [SiswaController::class, 'destroy']);

// RUTE ADMIN (Wajib Login / Middleware Auth)
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [AspirasiController::class, 'dashboard']);

    // Data Siswa (Hanya admin yang bisa lihat)
    Route::get('/siswa', [SiswaController::class, 'index']);

    // Kelola Aspirasi & Tanggapan
    Route::get('/aspirasi', [AspirasiController::class, 'index']);
    Route::get('/aspirasi/proses/{id}', [AspirasiController::class, 'proses']);
    Route::post('/aspirasi/proses/{id}', [AspirasiController::class, 'simpanProses']);
    Route::post('/aspirasi/tanggapan/{id}', [AspirasiController::class, 'simpanTanggapan']);
    
});