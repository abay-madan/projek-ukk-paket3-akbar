@extends('layouts.master')

@section('title', 'Histori Pengaduan Saya')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Pantau Status Pengaduan</h3>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap table-striped">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center">ID Pelaporan</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Keterangan</th>
                            <th class="text-center">Bukti</th> <!-- Kolom Baru -->
                            <th class="text-center">Status</th>
                            <th>Umpan Balik (Feedback)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                        <tr>
                            <td class="text-center font-weight-bold">{{ $item->id_pelaporan }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ $item->ket }}</td>
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

                            <!-- Kolom Umpan Balik (Feedback) Langsung Tampil Teks -->
                            <td>
                                @if($item->feedback)
                                    <!-- Jika admin sudah ngisi teks, tampilkan teksnya langsung -->
                                    <span class="badge bg-light text-dark">{{ $item->feedback }}</span>
                                @else
                                    <!-- Jika laporan baru masuk dan belum ditanggapi admin -->
                                    <span class="badge bg-secondary">Belum Ditanggapi</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Kamu belum pernah mengirimkan pengaduan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection