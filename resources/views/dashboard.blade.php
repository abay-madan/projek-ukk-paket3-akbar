@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0">Selamat Datang di Aplikasi Pengaduan</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Gunakan menu di sebelah kiri untuk mengelola data aspirasi siswa.</p>
                <a href="/aspirasi/tambah" class="btn btn-primary">Lihat Form Aspirasi</a>
            </div>
        </div>
    </div>
</div>
@endsection