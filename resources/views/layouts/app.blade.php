<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistem Absensi')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #fff;
            color: #000;
        }
        .navbar {
            background-color: #f1f1f1;
            border-bottom: 1px solid #ccc;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #eaeaea;
            border-right: 1px solid #ccc;
            padding-top: 20px;
            width: 220px;
        }
        .sidebar .nav-link {
            color: #000;
        }
        .sidebar .nav-link.active {
            background-color: #cfcfcf;
            color: #000 !important;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #fff;
        }
        .btn-outline-danger {
            color: #fff;
            border-color: #fff;
        }
        .btn-outline-danger:hover {
            background-color: #ff0000;
            color: #fff;
        }
    </style>
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-4" href="">
        <img src="{{ asset('images/Logo.png') }}" alt="Logo" height="35">
        Sistem Absensi
    </a>
    <div class="ms-auto">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-danger" type="submit">Logout</button>
        </form>
    </div>
</nav>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3">
        <ul class="nav flex-column">
             <li class="nav-item">
                <a href="/dashboard" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">Dashboard</a>
            </li>
            
           @auth
    @if(Auth::user()->role === 'admin')
        <li class="nav-item">
            <a href="/dosen" class="nav-link {{ Request::is('dosen*') ? 'active' : '' }}">Dosen</a>
        </li>
        <li class="nav-item">
            <a href="/kelas" class="nav-link {{ Request::is('kelas*') ? 'active' : '' }}">Kelas</a>
        </li>
        <li class="nav-item">
            <a href="/matkul" class="nav-link {{ Request::is('matkul*') ? 'active' : '' }}">Mata Kuliah</a>
        </li>
       
    @endif
@endauth
<li class="nav-item">
            <a href="/mahasiswa" class="nav-link {{ Request::is('mahasiswa*') ? 'active' : '' }}">Mahasiswa</a>
        </li>
 <li class="nav-item">
            <a href="/absensi" class="nav-link {{ Request::is('absensi*') ? 'active' : '' }}">Absensi Mahasiswa</a>
        </li>

        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
   

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
