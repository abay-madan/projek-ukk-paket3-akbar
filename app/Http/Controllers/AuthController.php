<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function prosesLogin(Request $request)
    {
        if ($request->role === 'admin') {
            // ==========================================
            // 1. LOGIKA LOGIN ADMIN
            // ==========================================
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
                return redirect('/dashboard'); 
            }

            return back()->with('error', 'Email atau Password Admin salah!');

        } else {
            // ==========================================
            // 2. LOGIKA LOGIN SISWA (SANGAT KETAT)
            // ==========================================
            $request->validate([
                'nis' => 'required|numeric',
                'tingkat' => 'required',
                'jurusan' => 'required|string'
            ]);

            $kelas_lengkap = $request->tingkat . ' ' . $request->jurusan;

            // Cari data siswa di database
            $siswa = Siswa::where('nis', $request->nis)->first();

            if ($siswa) {
                // JIKA NIS ADA: Validasi kelasnya
                if (strtolower(trim($siswa->kelas)) !== strtolower(trim($kelas_lengkap))) {
                    return back()->with('error', 'Kelas tidak sesuai dengan data NIS yang terdaftar!');
                }
            } else {
                // JIKA NIS TIDAK ADA: Tolak mentah-mentah! (Tidak ada lagi fitur otomatis daftar)
                return back()->with('error', 'NIS tidak terdaftar! Anda bukan siswa sekolah ini.');
            }

            // Kalau lolos semua, baru boleh masuk
            session(['nis_siswa' => $siswa->nis]);
            return redirect('/dashboard-siswa'); 
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); 
        $request->session()->forget('nis_siswa'); 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); 
    }
}