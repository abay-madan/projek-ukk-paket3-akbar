@extends('layouts.master')

@section('title', 'Proses Pengaduan')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Berikan Tanggapan / Tindak Lanjut</h3>
            </div>
            
            <form action="{{ url('/aspirasi/tanggapan/'.$data->id_pelaporan) }}" method="POST">
                @csrf
                <div class="card-body">
                    <!-- Detail info laporan siswa (Sengaja dibuat readonly biar gak keubah Admin) -->
                    <div class="row bg-light p-3 rounded mb-4">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>ID Pelaporan:</strong> {{ $data->id_pelaporan }}</p>
                            <p class="mb-1"><strong>NIS Siswa:</strong> {{ $data->nis }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Lokasi:</strong> {{ $data->lokasi }}</p>
                            <p class="mb-1"><strong>Keterangan:</strong> {{ $data->ket }}</p>
                        </div>
                    </div>

                    <!-- Input untuk Admin -->
                    <div class="form-group">
                        <label>Ubah Status</label>
                        <select name="status" class="form-control" required>
                            <option value="Menunggu">Menunggu</option>
                            <option value="Proses">Diproses (Sedang dikerjakan)</option>
                            <option value="Selesai">Selesai (Sudah diperbaiki)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggapan / Feedback Admin</label>
                        <textarea name="feedback" class="form-control" rows="4" placeholder="Tulis pesan balasan untuk siswa disini..." required></textarea>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Tanggapan</button>
                    <a href="{{ url('/aspirasi') }}" class="btn btn-default float-right">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection