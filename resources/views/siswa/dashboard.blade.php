@extends('layouts.master')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Pesan Selamat Datang -->
        <div class="alert alert-info alert-dismissible shadow-sm">
            <h5><i class="icon fas fa-info-circle"></i> Selamat Datang!</h5>
            Halo, kamu berhasil login dengan NIS: <strong>{{ session('nis_siswa') }}</strong>.<br>
            Silakan gunakan sistem ini untuk melaporkan kerusakan sarana dan prasarana di sekolah.
        </div>
    </div>
</div>

<!-- Kotak Shortcut / Jalan Pintas -->
<div class="row mt-3">
    <!-- Box 1: Tombol Tulis Laporan -->
    <div class="col-lg-6 col-12">
        <div class="small-box bg-primary shadow">
            <div class="inner">
                <h3>Tulis</h3>
                <p>Laporan / Aspirasi Baru</p>
            </div>
            <div class="icon">
                <i class="fas fa-edit"></i>
            </div>
            <a href="/aspirasi/tambah" class="small-box-footer">Buat Laporan Sekarang <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <!-- Box 2: Tombol Histori -->
    <div class="col-lg-6 col-12">
        <div class="small-box bg-success shadow">
            <div class="inner">
                <h3>Histori</h3>
                <p>Pantau Status Laporanku</p>
            </div>
            <div class="icon">
                <i class="fas fa-history"></i>
            </div>
            <a href="/history" class="small-box-footer">Cek Daftar Laporanku <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<!-- Petunjuk Penggunaan -->
<div class="row mt-3">
    <div class="col-md-12">
        <div class="card card-outline card-primary shadow-sm">
            <div class="card-header">
                <h3 class="card-title fw-bold"><i class="fas fa-book-open mr-2"></i> Petunjuk Penggunaan Sistem</h3>
            </div>
            <div class="card-body">
                <ol class="mb-0">
                    <li class="mb-2">Klik tombol <strong>Buat Laporan Sekarang</strong> pada kotak biru di atas atau menu <strong>Tulis Aspirasi</strong> di sidebar.</li>
                    <li class="mb-2">Isi formulir pengaduan dengan lengkap (Pilih Kategori, Lokasi detail, dan Keterangan kerusakan sarana).</li>
                    <li class="mb-2">Klik tombol <strong>Kirim Aspirasi</strong> untuk menyerahkan laporan ke pihak sekolah.</li>
                    <li>Pantau terus status laporanmu (Menunggu / Proses / Selesai) beserta tanggapan dari Admin melalui menu <strong>Histori Laporanku</strong>.</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection