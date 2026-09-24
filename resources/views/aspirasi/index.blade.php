@extends('layouts.master')

@section('title', 'Data Aspirasi Masuk')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title">Daftar Pengaduan Siswa</h3>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">ID Pelaporan</th>
                            <th>NIS Siswa</th>
                            <th>ID Kategori</th>
                            <th>Lokasi</th>
                            <th>Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                        <tr>
                            <td class="text-center">{{ $item->id_pelaporan }}</td>
                            <td>{{ $item->nis }}</td>
                            <td>{{ $item->id_kategori }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ $item->ket }}</td>
                            <td class="text-center">
                                <a href="{{ url('/aspirasi/proses/'.$item->id_pelaporan) }}" class="btn btn-sm btn-info"><i class="fas fa-check"></i> Proses</a>
                                <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data pengaduan masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection