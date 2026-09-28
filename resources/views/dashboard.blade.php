@extends('layouts.master')

@section('title', 'Dashboard Statistik')

@section('content')
<div class="row">
    <!-- Kotak Total Aspirasi -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $total }}</h3>
                <p>Total Aspirasi Masuk</p>
            </div>
            <div class="icon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <a href="{{ url('/aspirasi') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Kotak Menunggu -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $menunggu }}</h3>
                <p>Menunggu Tanggapan</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
            <a href="{{ url('/aspirasi') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Kotak Sedang Diproses -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $proses }}</h3>
                <p>Sedang Diproses</p>
            </div>
            <div class="icon">
                <i class="fas fa-tools"></i>
            </div>
            <a href="{{ url('/aspirasi') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Kotak Selesai -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $selesai }}</h3>
                <p>Telah Selesai</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <a href="{{ url('/aspirasi') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Selamat Datang, Admin!</h3>
            </div>
            <div class="card-body">
                <p>Ini adalah halaman utama panel pengaduan sarana sekolah. Silakan kelola data aspirasi siswa melalui menu yang tersedia.</p>
                
                <!-- Tombol Logout diletakkan di sini -->
                <a href="{{ url('/logout') }}" class="btn btn-danger mt-2" onclick="return confirm('Yakin mau keluar dari halaman admin wak?')">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                
            </div>
        </div>
    </div>
</div>
@endsection