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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_siswa as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $item->nis }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada siswa yang login/melapor.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection