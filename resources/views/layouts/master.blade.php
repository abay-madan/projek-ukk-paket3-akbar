<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengaduan Sarana | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<<<<<<< HEAD
    <!-- Theme style (AdminLTE v3) -->
=======
    <!-- Theme style (AdminLTE) -->
>>>>>>> 3ed1c5f4c0b6f6827a0d43741efb858363b977b8
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar Atas -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>

    <!-- Main Sidebar Container (Format AdminLTE 3) -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        
        <!-- Brand Logo -->
<a href="/" class="brand-link">
    <span class="brand-text font-weight-light text-center d-block">🧾Pengaduan Sarana</span>
</a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <!-- ========================================== -->
                    <!-- MENU KHUSUS ADMIN -->
                    <!-- ========================================== -->
                    @if(Auth::check())
                        <li class="nav-header mt-2">MENU ADMIN</li>
                        
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/siswa" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Data Siswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/aspirasi" class="nav-link">
                                <i class="nav-icon fas fa-check-square"></i>
                                <p>Kelola Aspirasi</p>
                            </a>
                        </li>
                    @endif


                    <!-- ========================================== -->
                    <!-- MENU KHUSUS SISWA -->
                    <!-- ========================================== -->
                    @if(session()->has('nis_siswa'))
                        <li class="nav-header mt-2">MENU SISWA</li>
                        
                        <li class="nav-item">
                            <a href="/history" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard Siswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/aspirasi/tambah" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Tulis Aspirasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/history" class="nav-link">
                                <i class="nav-icon fas fa-history"></i>
                                <p>Histori Laporanku</p>
                            </a>
                        </li>
                    @endif


                    <!-- ========================================== -->
                    <!-- TOMBOL LOGOUT -->
                    <!-- ========================================== -->
                    <li class="nav-item mt-4">
                        <a href="/logout" class="nav-link text-danger">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Keluar (Logout)</p>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>

    <!-- Area Konten Utama -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">@yield('title')</h1>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <!-- Konten dinamis akan masuk ke sini -->
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2026 UKK RPL.</strong>
    </footer>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>