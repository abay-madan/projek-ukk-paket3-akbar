<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AuthController;
// Bawaan laravel (opsional, biarkan saja)
Route::get('/', function () {
    return view('auth.login');
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
Route::get('/dashboard', [App\Http\Controllers\AspirasiController::class, 'dashboard']);
// Rute untuk Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin']);
Route::get('/logout', [AuthController::class, 'logout']); // Pakai GET biar gampang ditaruh di link sidebar
// Rute yang cuma boleh diakses kalau udah login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AspirasiController::class, 'dashboard']);
    // Masukkan rute aspirasi admin lainnya ke dalam sini juga wak
});