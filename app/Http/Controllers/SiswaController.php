<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil semua data siswa dari database
        $data_siswa = Siswa::all();
        return view('siswa.index', compact('data_siswa'));
    }
    public function destroy($nis)
    {
        // Cari dan hapus siswa berdasarkan NIS
        Siswa::where('nis', $nis)->delete();

        return redirect('/siswa')->with('success', 'Data siswa berhasil dihapus!');
    }
}