<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Menampilkan Halaman Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // 2. Memproses Data Login
    public function prosesLogin(Request $request)
    {
        // Validasi inputan
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek apakah email dan password cocok dengan database (tabel users)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Kalau berhasil, arahkan ke dashboard
            return redirect()->intended('/dashboard')->with('success', 'Selamat datang, Anda berhasil login!');
        }

        // Kalau gagal, kembalikan ke halaman login bawa pesan error
        return back()->with('error', 'Email atau Password salah wak!');
    }

    // 3. Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Anda berhasil logout!');
    }
}