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
            background-color: #f8f9fa;
            color: #333;
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #dee2e6;
            padding-top: 30px;
            width: 240px;
        }

        .sidebar .nav-link {
            color: #495057;
            font-weight: 500;
            border-radius: 8px;
            padding: 10px 16px;
            transition: background 0.2s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #f1f3f5;
            color: #000;
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: #fff !important;
        }

        .main-content {
            flex: 1;
            padding: 30px;
            background-color: #f8f9fa;
        }

        .nav-icon {
            margin-right: 8px;
        }

        .alert {
            border-radius: 0.75rem;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
        }

        .navbar-nav .nav-link:hover {
            color: #adb5bd !important;
        }

        footer {
            background-color: #212529;
            color: #fff;
            padding: 16px;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3 px-4">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-4" href="#">
            <img src="{{ asset('images/Logo.png') }}" alt="Logo" height="36" class="rounded">
            <span>Sistem Absensi</span>
        </a>

        @auth
            @if(Auth::user()->role === 'user')
                <!-- Menu untuk USER -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-4">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="/dashboard">
                                <i class="fas fa-home nav-icon"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('mahasiswa*') ? 'active' : '' }}" href="/mahasiswa">
                                <i class="fas fa-user-graduate nav-icon"></i> Mahasiswa
                            </a>
                        </li>
                        <li class="nav-item">
                        <a href="/dosen" class="nav-link {{ Request::is('dosen*') ? 'active' : '' }}">
                            <i class="fas fa-chalkboard-teacher nav-icon"></i> Dosen
                        </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('absensi*') ? 'active' : '' }}" href="/absensi">
                                <i class="fas fa-calendar-check nav-icon"></i> Absensi
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        @endauth

        <div class="d-flex align-items-center gap-3 ms-auto">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-danger d-flex align-items-center">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="d-flex flex-grow-1">
    @auth
        @if(Auth::user()->role === 'admin')
            <!-- Sidebar for Admin -->
            <div class="sidebar p-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                            <i class="fas fa-home nav-icon"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/dosen" class="nav-link {{ Request::is('dosen*') ? 'active' : '' }}">
                            <i class="fas fa-chalkboard-teacher nav-icon"></i> Dosen
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/kelas" class="nav-link {{ Request::is('kelas*') ? 'active' : '' }}">
                            <i class="fas fa-door-open nav-icon"></i> Kelas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/matkul" class="nav-link {{ Request::is('matkul*') ? 'active' : '' }}">
                            <i class="fas fa-book-open nav-icon"></i> Mata Kuliah
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/mahasiswa" class="nav-link {{ Request::is('mahasiswa*') ? 'active' : '' }}">
                            <i class="fas fa-user-graduate nav-icon"></i> Mahasiswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/absensi" class="nav-link {{ Request::is('absensi*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check nav-icon"></i> Absensi Mahasiswa
                        </a>
                    </li>
                </ul>
            </div>
        @endif
    @endauth

    <!-- Main Content -->
    <div class="main-content w-100">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</div>

<!-- Footer (Only for user) -->
@auth
    @if(Auth::user()->role === 'user')
        <footer>
            &copy; {{ date('Y') }} Sistem Absensi - Hak Cipta Dilindungi
        </footer>
    @endif
@endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
