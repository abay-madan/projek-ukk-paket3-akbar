<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspirasiController;

// Bawaan laravel (opsional, biarkan saja)
Route::get('/', function () {
    return view('welcome');
});

// Route baru untuk ngetes template
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/aspirasi/tambah', [AspirasiController::class, 'create']);
Route::post('/aspirasi/simpan', [AspirasiController::class, 'store']);
Route::get('/aspirasi', [AspirasiController::class,'index']);
Route::get('/aspirasi/proses/{id}', [AspirasiController::class, 'proses']);
Route::post('/aspirasi/proses/{id}', [AspirasiController::class, 'simpanProses']);
Route::get('/history', [AspirasiController::class, 'history']);
Route::get('/aspirasi/proses/{id}', [App\Http\Controllers\AspirasiController::class, 'proses']);
Route::post('/aspirasi/tanggapan/{id}', [App\Http\Controllers\AspirasiController::class, 'simpanTanggapan']);