@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Dosen</h1>
        <a href="{{ route('dosen.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Tambah Dosen
        </a>
    </div>


    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dosen as $index => $d)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $d->nip }}</td>
                    <td>{{ $d->nama }}</td>
                    <td>
                        <a href="{{ route('dosen.edit', $d->id_dosen) }}" class="btn btn-sm btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('dosen.destroy', $d->id_dosen) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus dosen ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Tidak ada data dosen</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
