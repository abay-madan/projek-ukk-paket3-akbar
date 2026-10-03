<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekSiswa
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kalau belum login (session nis kosong), tendang ke halaman login
        if (!session()->has('nis_siswa')) {
            return redirect('/')->with('error', 'Maaf, Anda harus login sebagai Siswa terlebih dahulu!');
        }

        return $next($request);
    }
}