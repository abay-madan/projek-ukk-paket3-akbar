<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pengaduan Sarana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="card shadow-sm rounded-4" style="width: 400px;">
        <div class="card-body p-4">
            <h4 class="text-center fw-bold mb-4 text-primary">Portal Pengaduan</h4>

            <!-- Notifikasi Error dari Controller -->
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST">
                @csrf
                
                <!-- Dropdown Pilihan Role -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Masuk Sebagai</label>
                    <select name="role" id="roleSelect" class="form-select" onchange="gantiForm()">
                        <option value="siswa">Siswa</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>

                <!-- BUNGKUSAN FORM SISWA (Default Muncul) -->
                <div id="formSiswa">
                    <div class="mb-3">
                        <label class="form-label">Nomor Induk Siswa (NIS)</label>
                        <input type="number" name="nis" class="form-control" placeholder="Contoh: 10293847">
                    </div>
                    
                    <!-- KELAS & JURUSAN SUDAH DIPISAH -->
                    <div class="mb-4">
                        <label class="form-label">Tingkat & Jurusan</label>
                        <div class="row g-2">
                            <div class="col-4">
                                <select name="tingkat" class="form-select">
                                    <option value="">Tingkat</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>
                            <div class="col-8">
                                <input type="text" name="jurusan" class="form-control" placeholder="Cth: RPL 1" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BUNGKUSAN FORM ADMIN (Default Sembunyi) -->
                <div id="formAdmin" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label">Email Admin</label>
                        <input type="email" name="email" class="form-control" placeholder="admin@sekolah.com">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-bold">Masuk</button>
            </form>
        </div>
    </div>

    <!-- Script buat ganti-ganti form -->
    <script>
        function gantiForm() {
            var role = document.getElementById("roleSelect").value;
            if (role === "admin") {
                document.getElementById("formAdmin").style.display = "block";
                document.getElementById("formSiswa").style.display = "none";
            } else {
                document.getElementById("formAdmin").style.display = "none";
                document.getElementById("formSiswa").style.display = "block";
            }
        }
    </script>
</body>
</html>