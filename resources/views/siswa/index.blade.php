@extends('layouts.master')

@section('title', 'Data Siswa')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Daftar Data Siswa (Pelapor)</h3>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap table-bordered table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="text-center" width="10%">No</th>
                            <th>NIS Siswa</th>
                            <th>Kelas</th>
                            <th>Waktu Terdaftar</th>
                            <th class="text-center" width="15%">Aksi</th> <!-- TAMBAHAN KOLOM AKSI -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_siswa as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $item->nis }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}</td>
                            
                            <!-- TOMBOL HAPUS -->
                            <td class="text-center">
                                <a href="{{ url('/siswa/hapus/' . $item->nis) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus data siswa dengan NIS {{ $item->nis }} ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">Belum ada siswa yang login/melapor.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection