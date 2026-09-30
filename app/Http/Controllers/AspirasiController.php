<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\InputAspirasi;
use App\Models\Aspirasi;
use Illuminate\Support\Facades\DB;

class AspirasiController extends Controller
{
    // 1. Menampilkan halaman form input aspirasi (Untuk Siswa)
    public function create()
    {
        $kategori = Kategori::all(); 
        return view('aspirasi.create', compact('kategori'));
    }

    // 2. Memproses data dari form ke database (Untuk Siswa)
    public function store(Request $request)
    {
        InputAspirasi::create([
            'id_pelaporan' => rand(10000, 99999), 
            'nis' => $request->nis,
            'id_kategori' => $request->id_kategori,
            'lokasi' => $request->lokasi,
            'ket' => $request->ket,
        ]);

        return redirect('/aspirasi/tambah')->with('success', 'Aspirasi berhasil dikirim!');
    }
    
    // 3. Menampilkan halaman tabel daftar aspirasi (Untuk Admin)
    public function index()
    {
        $data = InputAspirasi::all();
        return view('aspirasi.index', compact('data'));
    }

    // 4. Menampilkan riwayat/histori pengaduan (Untuk Siswa)
    public function history()
    {
        // Ambil NIS siswa yang sedang login dari session
        $nisLogin = session('nis_siswa');

        // Ambil data khusus punya siswa tersebut
        $data = DB::table('input_aspirasis')
            ->leftJoin('aspirasis', 'input_aspirasis.id_pelaporan', '=', 'aspirasis.id_aspirasi')
            ->select('input_aspirasis.*', 'aspirasis.status', 'aspirasis.feedback')
            ->where('input_aspirasis.nis', $nisLogin) // Filter biar cuma kelihatan punya dia sendiri
            ->orderBy('input_aspirasis.created_at', 'desc')
            ->get();

        // Kita lempar variabel $data sekaligus alias-nya $aspirasi, 
        // jadi pakai nama apa pun di file Blade-nya, dijamin aman dan gak error!
        $aspirasi = $data; 

        return view('aspirasi.history', compact('data', 'aspirasi'));
    }

    // 5. Menampilkan halaman form untuk ngasih tanggapan (Untuk Admin)
    public function proses($id)
    {
        $data = InputAspirasi::where('id_pelaporan', $id)->first();
                
        return view('aspirasi.proses', compact('data'));
    }

    public function simpanTanggapan(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required|integer'
        ]);
        // 1. Cari data laporan aslinya untuk mengambil id_kategori
        $laporan = InputAspirasi::where('id_pelaporan', $id)->first();

        // 2. Simpan tanggapan admin ke database
        Aspirasi::updateOrCreate(
            ['id_aspirasi' => $id], 
            [
                'status' => $request->status,
                'id_kategori' => $laporan->id_kategori, 
                'feedback' => $request->feedback,
            ]
        );

        return redirect('/aspirasi')->with('success', 'Aspirasi berhasil diproses dan diberi tanggapan!');
    }
    // Menampilkan Dashboard Admin
    public function dashboard()
    {
        // Menghitung total semua laporan yang masuk
        $total = InputAspirasi::count();
        
        // Menghitung status berdasarkan tabel tanggapan (aspirasis)
        $proses = Aspirasi::where('status', 'Proses')->count();
        $selesai = Aspirasi::where('status', 'Selesai')->count();
        
        // Yang menunggu = Total laporan dikurangi yang sudah diproses & selesai
        $menunggu = $total - ($proses + $selesai);

        return view('dashboard', compact('total', 'menunggu', 'proses', 'selesai'));
    }

    // Menghapus data aspirasi dan tanggapannya sekaligus
    public function destroy($id)
    {
        // Hapus data di tabel input_aspirasis
        InputAspirasi::where('id_pelaporan', $id)->delete();
        
        // Hapus juga data tanggapan di tabel aspirasis (kalau ada)
        Aspirasi::where('id_aspirasi', $id)->delete();

        return redirect('/aspirasi')->with('success', 'Aspirasi berhasil dihapus!');
    }
}