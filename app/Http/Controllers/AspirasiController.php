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
        $data = DB::table('input_aspirasis')
            ->leftJoin('aspirasis', 'input_aspirasis.id_pelaporan', '=', 'aspirasis.id_aspirasi')
            ->select('input_aspirasis.*', 'aspirasis.status', 'aspirasis.feedback')
            ->orderBy('input_aspirasis.created_at', 'desc')
            ->get();

        return view('aspirasi.history', compact('data'));
    }

    // 5. Menampilkan halaman form untuk ngasih tanggapan (Untuk Admin)
    public function proses($id)
    {
        $data = InputAspirasi::where('id_pelaporan', $id)->first();
                
        return view('aspirasi.proses', compact('data'));
    }

    public function simpanTanggapan(Request $request, $id)
    {
        // 1. Cari data laporan aslinya untuk mengambil id_kategori
        $laporan = InputAspirasi::where('id_pelaporan', $id)->first();

        // 2. Simpan tanggapan admin ke database
        Aspirasi::updateOrCreate(
            ['id_aspirasi' => $id], 
            [
                'status' => $request->status,
                'id_kategori' => $laporan->id_kategori, 
                'feedback' => $request->feedback 
            ]
        );

        return redirect('/aspirasi')->with('success', 'Aspirasi berhasil diproses dan diberi tanggapan!');
    }
}