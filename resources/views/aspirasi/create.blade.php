@extends('layouts.master')

@section('title', 'Form Input Aspirasi')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Sampaikan Pengaduan Sarana Sekolah</h3>
            </div>
            
            <form action="{{ url('/aspirasi/simpan') }}" method="POST">
                @csrf
                <div class="card-body">
                    <!-- Notifikasi Sukses -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label>NIS Siswa</label>
                        <input type="number" name="nis" class="form-control" placeholder="Masukkan NIS Anda" required>
                    </div>

                    <div class="form-group">
                        <label>Kategori Pengaduan</label>
                        <select name="id_kategori" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id_kategori }}">{{ $kat->ket_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Kamar Mandi Lantai 2" maxlength="50" required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan / Detail Pengaduan</label>
                        <textarea name="ket" class="form-control" rows="3" placeholder="Jelaskan kerusakannya..." maxlength="50" required></textarea>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Kirim Aspirasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection