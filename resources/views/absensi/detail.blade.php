@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Detail Absensi Kelas: {{ $kelas->nama_kelas }}</h4>

    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('absensi.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('absensi.create', ['id_kelas' => $kelas->id_kelas]) }}" class="btn btn-success">Isi Absensi</a>
    </div>

    {{-- Form Filter Tanggal --}}
    <form method="GET" action="{{ route('absensi.preview', $kelas->id_kelas) }}" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <label for="tanggal" class="col-form-label">Tanggal:</label>
            </div>
            <div class="col-auto">
                <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ $tanggal }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>Tanggal</th>
                <th>Dosen</th>
                <th>Matkul</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mahasiswa as $mhs)
                @php
                    $absensi = $absensiList->firstWhere('id_mahasiswa', $mhs->id_mahasiswa);
                @endphp
                <tr>
                    <td>{{ $mhs->nama }}</td>
                    <td>{{ $absensi ? \Carbon\Carbon::parse($absensi->tanggal)->format('d M Y') : $tanggal }}</td>
                    <td>{{ $absensi?->dosen?->nama ?? '-' }}</td>
                    <td>{{ $absensi?->matkul?->nama_matkul ?? '-' }}</td>
                    <td>
                        @if($absensi)
                            <span class="badge bg-info">{{ $absensi->status_keterangan }}</span>
                        @else
                            <span class="badge bg-secondary">Belum Absen</span>
                        @endif
                    </td>
                    <td>{{ $absensi->keterangan ?? '-' }}</td>
                    <td>
   @if($absensi)
  <a href="{{ route('absensi.edit', $absensi->id) }}" class="btn btn-sm btn-warning">

        <i class="fas fa-edit"></i>
    </a>

    <form action="{{ route('absensi.destroy', $absensi->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus absensi ini?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger">
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>
@else
    <span class="text-muted">-</span>
@endif

</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada mahasiswa di kelas ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
