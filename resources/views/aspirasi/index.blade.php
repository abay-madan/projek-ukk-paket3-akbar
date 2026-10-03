@extends('layouts.master')

@section('title', 'Data Aspirasi Masuk')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card-primary card-outline">
                <h3 class="card-title">Daftar Pengaduan Siswa</h3>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap table-bordered table-striped">
                    <thead class="bg-dark text-white">
                    <tr>
                        <th class="text-center">ID Pelaporan</th>
                        <th class="text-center">NIS Siswa</th>
                        <th class="text-center">Kategori</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                        <th class="text-center">Bukti Foto</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" width="150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                        <tr>
                            <td class="text-center">{{ $item->id_pelaporan }}</td>
                            <td class="text-center">{{ $item->nis }}</td>
                            <td class="text-center">{{ $item->id_kategori }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ $item->ket }}</td>
                            
                            <!-- Kolom Foto (Sama seperti punya Siswa) -->
                            <td class="text-center">
                                @if($item->foto)
                                    <a href="{{ asset('uploads/pengaduan/' . $item->foto) }}" target="_blank" class="btn btn-info btn-sm text-white">
                                        <i class="fas fa-image"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <!-- Kolom Status Dinamis -->
                            <td class="text-center">
                                @if($item->status == 'Selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($item->status == 'Proses')
                                    <span class="badge bg-warning text-dark">Proses</span>
                                @else
                                    <span class="badge bg-secondary">Menunggu</span>
                                @endif
                            </td>

                            <!-- Kolom Aksi Dinamis -->
                            <td class="text-center">
                                <a href="{{ url('/aspirasi/proses/'.$item->id_pelaporan) }}" class="btn btn-sm text-white {{ ($item->status == 'Selesai' || $item->status == 'Proses') ? 'btn-success' : 'btn-primary' }}">
                                    @if($item->status == 'Selesai' || $item->status == 'Proses')
                                        <i class="fas fa-edit"></i> Edit
                                    @else
                                        <i class="fas fa-check"></i> Proses
                                    @endif
                                </a>
                                <a href="{{ url('/aspirasi/hapus/'.$item->id_pelaporan) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus laporan ini beserta tanggapannya?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data pengaduan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
@endsection