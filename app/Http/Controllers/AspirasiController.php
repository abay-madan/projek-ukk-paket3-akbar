<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\InputAspirasi;
use App\Models\Aspirasi;
use Illuminate\Support\Facades\DB;

class AspirasiController extends Controller
{
    // Menampilkan halaman form input aspirasi (Untuk Siswa)
    public function create()
    {
        $kategori = Kategori::all(); 
        return view('aspirasi.create', compact('kategori'));
    }

    // Memproses data dari form ke database (Untuk Siswa)
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'id_kategori' => 'required',
            'lokasi' => 'required',
            'ket' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120' 
        ]);

        $nama_foto = null;
        
        // LOGIKA KOMPRES & KONVERSI KE SVG
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            
            // 1. Siapkan nama file baru berekstensi .svg
            $nama_foto = time() . '_' . uniqid() . '.svg'; 
            
            // ======================================================
            // TAMBAHAN BARU: Otomatis buat folder kalau belum ada
            // ======================================================
            $direktori = public_path('uploads/pengaduan');
            if (!file_exists($direktori)) {
                mkdir($direktori, 0775, true); 
            }
            // ======================================================

            $lokasi_simpan = $direktori . '/' . $nama_foto;
            
            // 2. Baca gambar asli yang diupload
            $gambar_sumber = imagecreatefromstring(file_get_contents($file->getRealPath()));
            $lebar = imagesx($gambar_sumber);
            $tinggi = imagesy($gambar_sumber);
            
            // 3. Kompres gambar (Kualitas 50)
            ob_start();
            imagejpeg($gambar_sumber, null, 50);
            $gambar_terkompres = ob_get_clean();
            
            // 4. Ubah gambar yang sudah dikompres menjadi kode teks (Base64)
            $base64 = base64_encode($gambar_terkompres);
            
            // 5. Bungkus kodenya ke dalam struktur format XML/SVG murni
            $svg_content = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
            <svg width="'.$lebar.'" height="'.$tinggi.'" xmlns="http://www.w3.org/2000/svg">
                <image href="data:image/jpeg;base64,'.$base64.'" width="'.$lebar.'" height="'.$tinggi.'" />
            </svg>';
            
            // 6. Simpan file sebagai .svg ke folder tujuan
            file_put_contents($lokasi_simpan, $svg_content);
            
            // Bersihkan sisa memori PHP
            imagedestroy($gambar_sumber);
        }

        InputAspirasi::create([
            'id_pelaporan' => rand(10000, 99999), 
            'nis' => session('nis_siswa'),
            'id_kategori' => $request->id_kategori,
            'lokasi' => $request->lokasi,
            'ket' => $request->ket,
            'foto' => $nama_foto // Yang tersimpan di database adalah file .svg
        ]);

        return redirect('/aspirasi/tambah')->with('success', 'Aspirasi beserta foto bukti berhasil dikirim!');
    }
    
    // Menampilkan halaman tabel daftar aspirasi (Untuk Admin)
    public function index()
    {
        // Gabungkan tabel input_aspirasis dengan tabel aspirasis untuk mengambil kolom 'status'
        $data = DB::table('input_aspirasis')
            ->leftJoin('aspirasis', 'input_aspirasis.id_pelaporan', '=', 'aspirasis.id_aspirasi')
            ->select('input_aspirasis.*', 'aspirasis.status')
            ->orderBy('input_aspirasis.created_at', 'desc')
            ->get();

        return view('aspirasi.index', compact('data'));
    }

    //  Menampilkan riwayat/histori pengaduan (Untuk Siswa)
    public function history()
    {
        // Ambil NIS siswa yang sedang login dari session
        $nisLogin = session('nis_siswa');

        // Ambil data khusus punya siswa tersebut
        $data = DB::table('input_aspirasis')
            ->leftJoin('aspirasis', 'input_aspirasis.id_pelaporan', '=', 'aspirasis.id_aspirasi')
            ->select('input_aspirasis.*', 'aspirasis.status', 'aspirasis.feedback')
            ->where('input_aspirasis.nis', $nisLogin) 
            ->orderBy('input_aspirasis.created_at', 'desc')
            ->get();

        // Kita lempar variabel $data sekaligus alias-nya $aspirasi, 
        // jadi pakai nama apa pun di file Blade-nya, dijamin aman dan gak error!
        $aspirasi = $data; 

        return view('aspirasi.history', compact('data', 'aspirasi'));
    }

    //  Menampilkan halaman form untuk ngasih tanggapan (Untuk Admin)
    public function proses($id)
    {
        $data = InputAspirasi::where('id_pelaporan', $id)->first();
                
        return view('aspirasi.proses', compact('data'));
    }

    // Fungsi simpanTanggapan (Untuk Admin)
    public function simpanTanggapan(Request $request, $id)
    {
        // UBAH: integer diganti jadi string biar bisa ketik teks bebas
        $request->validate([
            'feedback' => 'required|string' 
        ]);
        
        $laporan = InputAspirasi::where('id_pelaporan', $id)->first();

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