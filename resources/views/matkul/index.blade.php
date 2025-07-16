@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Mata Kuliah</h1>
        <a href="{{ route('matkul.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Tambah Matkul
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Mata Kuliah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($matkul as $index => $m)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $m->nama_matkul }}</td>
                    <td>
                        <a href="{{ route('matkul.edit', $m->id_matkul) }}" class="btn btn-sm btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('matkul.destroy', $m->id_matkul) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus matkul ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">Tidak ada data mata kuliah</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
