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
        // Kalau yang dipilih di dropdown adalah Admin
        if ($request->role == 'admin') {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect('/dashboard'); // Arahkan ke dashboard admin
            }
            return back()->with('error', 'Email atau Password Admin salah wak!');
        } 
        
        // Kalau yang dipilih di dropdown adalah Siswa
        else {
            $request->validate([
                'nis' => 'required|numeric',
                'kelas' => 'required'
            ]);

            // Cek/Simpan NIS ke database Siswa
            $siswa = Siswa::firstOrCreate(
                ['nis' => $request->nis],
                ['kelas' => $request->kelas]
            );

            // Simpan NIS ke session
            session(['nis_siswa' => $siswa->nis]);
            return redirect('/aspirasi/tambah'); // Arahkan ke form lapor
        }
    }

   public function logout(Request $request)
    {
        // 1. Tendang login Admin
        Auth::logout(); 
        
        // 2. Tendang login Siswa
        $request->session()->forget('nis_siswa'); 
        
        // 3. Bersihkan sisa cache session di browser
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // 4. Arahkan balik ke halaman login
        return redirect('/'); 
    }
}