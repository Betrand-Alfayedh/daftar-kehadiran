@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5 text-center">Dashboard Sistem Absensi</h1>

    <div class="row text-white mb-4">
        <div class="col-md-3">
            <div class="card bg-secondary-subtle rounded-4 shadow">
                <div class="card-body text-center">
                    <h5>Total Dosen</h5>
                    <h2>{{ $totalDosen }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-secondary-subtle rounded-4 shadow">
                <div class="card-body text-center">
                    <h5>Total Mahasiswa</h5>
                    <h2>{{ $totalMahasiswa }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-secondary-subtle rounded-4 shadow">
                <div class="card-body text-center">
                    <h5>Total Kelas</h5>
                    <h2>{{ $totalKelas }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-secondary-subtle rounded-4 shadow">
                <div class="card-body text-center">
                    <h5>Total Mata Kuliah</h5>
                    <h2>{{ $totalMatkul }}</h2>
                </div>
            </div>
        </div>
    </div>

    <h4>Absensi Terbaru</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nama Mahasiswa</th>
                <th>Kelas</th>
                <th>Dosen</th>
                <th>Mata Kuliah</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($absensiTerbaru as $absen)
                <tr>
                    <td>{{ $absen->mahasiswa->nama ?? '-' }}</td>
                    <td>{{ $absen->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $absen->dosen->nama ?? '-' }}</td>
                    <td>{{ $absen->matkul->nama_matkul ?? '-' }}</td>
                    <td>{{ $absen->tanggal }}</td>
                    <td>{{ $absen->status_keterangan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada absensi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
