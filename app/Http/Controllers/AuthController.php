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
        // Cek dulu dia milih login sebagai apa di dropdown
        if ($request->role === 'admin') {
            
            // ==========================================
            // 1. LOGIKA LOGIN ADMIN
            // ==========================================
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            // Cek email dan password admin ke database (tabel users)
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
                return redirect('/dashboard'); // Arahkan ke dashboard admin
            }

            // Kalau salah, tendang balik bawa pesan error
            return back()->with('error', 'Email atau Password Admin salah!');

        } else {

            // ==========================================
            // 2. LOGIKA LOGIN SISWA (DIPERKETAT)
            // ==========================================
            $request->validate([
                'nis' => 'required|numeric|digits_between:4,10',
                'tingkat' => 'required',
                'jurusan' => 'required|string'
            ], [
                'nis.required' => 'NIS wajib diisi!',
                'nis.numeric' => 'NIS hanya boleh angka!',
                'nis.digits_between' => 'Format NIS harus 4-10 angka!',
                'tingkat.required' => 'Tingkat kelas wajib dipilih!',
                'jurusan.required' => 'Jurusan wajib diisi!'
            ]);

            // Gabungkan Tingkat dan Jurusan (Contoh: "XII" + "RPL 1" = "XII RPL 1")
            $kelas_lengkap = $request->tingkat . ' ' . $request->jurusan;

            // Cek apakah data siswa dengan NIS tersebut sudah ada di database
            $siswa = Siswa::where('nis', $request->nis)->first();

            if ($siswa) {
                // JIKA NIS SUDAH ADA: Validasi apakah kelasnya cocok dengan database?
                if (strtolower(trim($siswa->kelas)) !== strtolower(trim($kelas_lengkap))) {
                    return back()->with('error', 'Kelas tidak sesuai dengan data NIS yang terdaftar di sekolah!');
                }
            } else {
                // JIKA NIS BELUM ADA: Baru buat data baru (Otomatis daftar untuk siswa baru)
                $siswa = Siswa::create([
                    'nis' => $request->nis,
                    'kelas' => $kelas_lengkap
                ]);
            }

            // Buat Session dan Arahkan ke Dashboard Siswa
            session(['nis_siswa' => $siswa->nis]);
            
            return redirect('/dashboard-siswa'); // Arahkan ke dashboard siswa
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