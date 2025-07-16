@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Mahasiswa</h1>

        @if (Auth::user()->role === 'admin')
            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Tambah Mahasiswa
            </a>
        @endif
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Kelas</th>
                @if (Auth::user()->role === 'admin')
                    <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($mahasiswa as $index => $m)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $m->nim }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->kelas->nama_kelas ?? '-' }}</td>
                    @if (Auth::user()->role === 'admin')
                        <td>
                            <a href="{{ route('mahasiswa.edit', $m->id_mahasiswa) }}" class="btn btn-sm btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('mahasiswa.destroy', $m->id_mahasiswa) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ Auth::user()->role === 'admin' ? 5 : 4 }}" class="text-center">Tidak ada data mahasiswa</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
