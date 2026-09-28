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
                                @if($item->status == 'Menunggu' || $item->status == null)
                                    <span class="badge badge-secondary">Menunggu</span>
                                @elseif($item->status == 'Proses')
                                    <span class="badge badge-warning">Diproses</span>
                                @elseif($item->status == 'Selesai')
                                    <span class="badge badge-success">Selesai</span>
                                @endif
                            </td>
                            <td>
                                @if($item->feedback)
                                    <span class="text-success"><i class="fas fa-check-circle"></i> ID Balasan: {{ $item->feedback }}</span>
                                @else
                                    <span class="text-muted"><i>Belum ada tanggapan</i></span>
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